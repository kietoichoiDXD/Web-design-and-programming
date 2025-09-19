# BÀI 03 - QUẢN LÝ TÀI KHOẢN

## Mô tả

Bài tập xây dựng hệ thống hiển thị danh sách tài khoản từ file CSV với các chức năng xem chi tiết và tìm kiếm.

## Chức năng chính

### 1. Hiển thị danh sách tài khoản
- **File:** `resources/views/accounts/index.blade.php`
- **Route:** `/accounts`
- **Chức năng:** Hiển thị danh sách tài khoản từ file `ds.csv` dạng bảng
- **Đặc điểm:** Hiển thị tất cả thông tin: username, password, họ tên, email, khóa học

### 2. Xem chi tiết tài khoản
- **File:** `resources/views/accounts/show.blade.php`
- **Route:** `/accounts/{id}`
- **Chức năng:** Hiển thị thông tin chi tiết của một tài khoản cụ thể
- **Đặc điểm:** Hiển thị đầy đủ thông tin trong layout đẹp

### 3. Tìm kiếm tài khoản
- **File:** Cùng với `index.blade.php`
- **Route:** `/accounts/search` (POST)
- **Chức năng:** Tìm kiếm tài khoản theo từ khóa trong tất cả các trường
- **Đặc điểm:** Tìm kiếm không phân biệt hoa thường

## Cấu trúc file

```
Bai03_TaiKhoan/
├── app/Http/Controllers/
│   └── AccountController.php       # Controller xử lý logic tài khoản
├── resources/views/accounts/
│   ├── index.blade.php            # Hiển thị danh sách
│   └── show.blade.php             # Chi tiết tài khoản
├── storage/data/
│   └── ds.csv                     # File CSV chứa dữ liệu tài khoản
├── routes/
│   └── web.php                    # Routes riêng cho bài 03
└── README.md                      # Hướng dẫn này
```

## Format file ds.csv

```csv
username,password,firstname,lastname,email,course1
t23_3220121709,27022003,01-Y,Thạo,t23_3220121709@m.com,thcs_2023
t23_3180719008,10082001,02-Trịnh Hoàng,Phước,t23_3180719008@m.com,thcs_2023
...
```

## Routes

```php
// Account routes
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
Route::get('/accounts/{id}', [AccountController::class, 'show'])->name('accounts.show');
Route::post('/accounts/search', [AccountController::class, 'search'])->name('accounts.search');
```

## Dữ liệu mẫu

File `ds.csv` chứa thông tin của 24 tài khoản học sinh với các trường:
- **username**: Tên đăng nhập (mã sinh viên)
- **password**: Mật khẩu (ngày sinh)
- **firstname**: Họ và tên đệm
- **lastname**: Tên
- **email**: Địa chỉ email
- **course1**: Khóa học (thcs_2023)

## Chức năng đặc biệt

### 1. Đọc CSV động
- Tự động đọc headers từ dòng đầu tiên
- Linh hoạt với số cột khác nhau
- Xử lý lỗi khi file không tồn tại

### 2. Tìm kiếm thông minh
- Tìm trong tất cả các trường
- Không phân biệt hoa thường
- Highlight kết quả tìm kiếm

### 3. Pagination
- Hỗ trợ phân trang khi có nhiều tài khoản
- Hiển thị số lượng kết quả

## Hướng dẫn chạy

1. Truy cập `/accounts` để xem danh sách tài khoản
2. Click vào ID để xem chi tiết tài khoản
3. Sử dụng ô tìm kiếm để lọc dữ liệu
4. Dữ liệu được tự động đọc từ file CSV