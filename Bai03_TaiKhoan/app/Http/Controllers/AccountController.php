<?php

namespace App\Http\Controllers;

class AccountController
{
    private $connection;
    
    public function __construct()
    {
        $this->initializeDatabase();
    }
    
    private function initializeDatabase()
    {
        // Initialize MySQL connection
        $this->connection = mysqli_connect('127.0.0.1', 'root', '', 'ten_database', 3307);
        
        if (!$this->connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        
        // Set charset to handle Vietnamese characters
        mysqli_set_charset($this->connection, "utf8mb4");
        
        // Create accounts table if it doesn't exist
        $this->createAccountsTable();
    }
    
    private function createAccountsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS accounts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            course VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        mysqli_query($this->connection, $sql);
    }
    
    private function loadAccountsFromCSV()
    {
        $csvFile = storage_path('data/ds.csv');
        
        if (!file_exists($csvFile)) {
            return [];
        }
        
        $accounts = [];
        $handle = fopen($csvFile, 'r');
        
        // Skip header row
        fgetcsv($handle);
        
        while (($data = fgetcsv($handle)) !== FALSE) {
            if (count($data) >= 6) {
                $accounts[] = [
                    'username' => trim($data[0]),
                    'password' => trim($data[1]),
                    'firstname' => trim($data[2]),
                    'lastname' => trim($data[3]),
                    'email' => trim($data[4]),
                    'course' => trim($data[5])
                ];
            }
        }
        
        fclose($handle);
        return $accounts;
    }
    
    public function index()
    {
        // Get all accounts from database
        $sql = "SELECT * FROM accounts ORDER BY firstname, lastname";
        $result = mysqli_query($this->connection, $sql);
        
        $accounts = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $accounts[] = $row;
            }
        }
        
        // If no accounts in database, show option to import from CSV
        $csvAccounts = $this->loadAccountsFromCSV();
        $canImport = count($csvAccounts) > 0 && count($accounts) === 0;
        
        return view('accounts.index', compact('accounts', 'canImport'));
    }
    
    public function importFromCSV()
    {
        $csvAccounts = $this->loadAccountsFromCSV();
        $imported = 0;
        $errors = [];
        
        foreach ($csvAccounts as $account) {
            $stmt = mysqli_prepare($this->connection, 
                "INSERT IGNORE INTO accounts (username, password, firstname, lastname, email, course) VALUES (?, ?, ?, ?, ?, ?)"
            );
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", 
                    $account['username'],
                    $account['password'],
                    $account['firstname'],
                    $account['lastname'],
                    $account['email'],
                    $account['course']
                );
                
                if (mysqli_stmt_execute($stmt)) {
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        $imported++;
                    }
                } else {
                    $errors[] = "Error importing {$account['username']}: " . mysqli_error($this->connection);
                }
                
                mysqli_stmt_close($stmt);
            }
        }
        
        session(['import_message' => "Successfully imported {$imported} accounts from CSV."]);
        
        if (!empty($errors)) {
            session(['import_errors' => $errors]);
        }
        
        return redirect()->route('accounts.index');
    }
    
    public function create()
    {
        return view('accounts.create');
    }
    
    public function store()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $lastname = $_POST['lastname'] ?? '';
        $email = $_POST['email'] ?? '';
        $course = $_POST['course'] ?? '';
        
        // Validate required fields
        if (empty($username) || empty($password) || empty($firstname) || empty($lastname) || empty($email)) {
            session(['error_message' => 'All fields are required.']);
            return redirect()->back();
        }
        
        // Check if username already exists
        $checkStmt = mysqli_prepare($this->connection, "SELECT id FROM accounts WHERE username = ?");
        mysqli_stmt_bind_param($checkStmt, "s", $username);
        mysqli_stmt_execute($checkStmt);
        $checkResult = mysqli_stmt_get_result($checkStmt);
        
        if (mysqli_num_rows($checkResult) > 0) {
            mysqli_stmt_close($checkStmt);
            session(['error_message' => 'Username already exists.']);
            return redirect()->back();
        }
        
        mysqli_stmt_close($checkStmt);
        
        // Insert new account
        $stmt = mysqli_prepare($this->connection, 
            "INSERT INTO accounts (username, password, firstname, lastname, email, course) VALUES (?, ?, ?, ?, ?, ?)"
        );
        
        mysqli_stmt_bind_param($stmt, "ssssss", $username, $password, $firstname, $lastname, $email, $course);
        
        if (mysqli_stmt_execute($stmt)) {
            session(['success_message' => 'Account created successfully.']);
            mysqli_stmt_close($stmt);
            return redirect()->route('accounts.index');
        } else {
            session(['error_message' => 'Error creating account: ' . mysqli_error($this->connection)]);
            mysqli_stmt_close($stmt);
            return redirect()->back();
        }
    }
    
    public function edit($id)
    {
        $stmt = mysqli_prepare($this->connection, "SELECT * FROM accounts WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $account = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            return view('accounts.edit', compact('account'));
        } else {
            mysqli_stmt_close($stmt);
            session(['error_message' => 'Account not found.']);
            return redirect()->route('accounts.index');
        }
    }
    
    public function update($id)
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $lastname = $_POST['lastname'] ?? '';
        $email = $_POST['email'] ?? '';
        $course = $_POST['course'] ?? '';
        
        if (empty($username) || empty($firstname) || empty($lastname) || empty($email)) {
            session(['error_message' => 'Username, first name, last name, and email are required.']);
            return redirect()->back();
        }
        
        // Check if username exists for other accounts
        $checkStmt = mysqli_prepare($this->connection, "SELECT id FROM accounts WHERE username = ? AND id != ?");
        mysqli_stmt_bind_param($checkStmt, "si", $username, $id);
        mysqli_stmt_execute($checkStmt);
        $checkResult = mysqli_stmt_get_result($checkStmt);
        
        if (mysqli_num_rows($checkResult) > 0) {
            mysqli_stmt_close($checkStmt);
            session(['error_message' => 'Username already exists for another account.']);
            return redirect()->back();
        }
        
        mysqli_stmt_close($checkStmt);
        
        // Update account
        $updateSql = "UPDATE accounts SET username = ?, firstname = ?, lastname = ?, email = ?, course = ?";
        $params = "sssss";
        $values = [$username, $firstname, $lastname, $email, $course];
        
        // Only update password if provided
        if (!empty($password)) {
            $updateSql .= ", password = ?";
            $params .= "s";
            $values[] = $password;
        }
        
        $updateSql .= " WHERE id = ?";
        $params .= "i";
        $values[] = $id;
        
        $stmt = mysqli_prepare($this->connection, $updateSql);
        mysqli_stmt_bind_param($stmt, $params, ...$values);
        
        if (mysqli_stmt_execute($stmt)) {
            session(['success_message' => 'Account updated successfully.']);
            mysqli_stmt_close($stmt);
            return redirect()->route('accounts.index');
        } else {
            session(['error_message' => 'Error updating account: ' . mysqli_error($this->connection)]);
            mysqli_stmt_close($stmt);
            return redirect()->back();
        }
    }
    
    public function destroy($id)
    {
        $stmt = mysqli_prepare($this->connection, "DELETE FROM accounts WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                session(['success_message' => 'Account deleted successfully.']);
            } else {
                session(['error_message' => 'Account not found.']);
            }
        } else {
            session(['error_message' => 'Error deleting account: ' . mysqli_error($this->connection)]);
        }
        
        mysqli_stmt_close($stmt);
        return redirect()->route('accounts.index');
    }
    
    public function search()
    {
        $query = $_GET['q'] ?? '';
        
        if (empty($query)) {
            return redirect()->route('accounts.index');
        }
        
        $searchPattern = "%{$query}%";
        $stmt = mysqli_prepare($this->connection, 
            "SELECT * FROM accounts WHERE 
             username LIKE ? OR 
             firstname LIKE ? OR 
             lastname LIKE ? OR 
             email LIKE ? OR 
             course LIKE ? 
             ORDER BY firstname, lastname"
        );
        
        mysqli_stmt_bind_param($stmt, "sssss", $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $accounts = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $accounts[] = $row;
            }
        }
        
        mysqli_stmt_close($stmt);
        
        return view('accounts.index', compact('accounts', 'query'));
    }
    
    public function __destruct()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}