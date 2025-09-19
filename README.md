# Web Design and Programming - 3 Laravel Projects

## 📚 Tổng quan dự án

Repository này chứa 3 bài tập web development sử dụng Laravel framework:

### 🌸 **Bài 01: Quản lý Hoa (Flower Management)**
- **Mô tả**: Hệ thống quản lý 14 loại hoa tuyệt đẹp với giao diện guest và admin
- **Công nghệ**: Laravel, PHP, Bootstrap 5, Session Storage
- **Tính năng**: CRUD operations, Image management, Responsive design
- **Data**: 14 loại hoa từ afamily.vn với hình ảnh thật

### 📝 **Bài 02: Quiz System (Đọc tệp tin văn bản)**
- **Mô tả**: Hệ thống bài thi trắc nghiệm đọc từ file text
- **Công nghệ**: Laravel, PHP, File Processing, Bootstrap 5
- **Tính năng**: File parsing, Quiz interface, Auto scoring, Result analysis
- **Data**: Quiz về Android development (4 câu hỏi)

### 👥 **Bài 03: Tài khoản (Account Management)**
- **Mô tả**: Quản lý tài khoản sinh viên với MySQL database
- **Công nghệ**: Laravel, MySQL, CSV Import, Bootstrap 5
- **Tính năng**: Database CRUD, CSV import, Search, User management
- **Data**: Danh sách sinh viên lớp thcs_2023

## 🚀 Cấu trúc thư mục

```
Web-design-and-programming/
├── Bai01_QuanLyHoa/           # Flower Management System
│   ├── app/Http/Controllers/FlowerController.php
│   ├── resources/views/flowers/
│   ├── public/images/         # 14 flower images
│   └── routes/web.php
├── Bai02_Quiz/               # Quiz System  
│   ├── app/Http/Controllers/QuizController.php
│   ├── resources/views/quiz/
│   ├── public/data/quiz.txt
│   └── routes/web.php
├── Bai03_TaiKhoan/          # Account Management
│   ├── app/Http/Controllers/AccountController.php
│   ├── resources/views/accounts/
│   ├── storage/data/ds.csv
│   └── routes/web.php
└── day 1/                   # Original data files
    ├── ds.csv
    ├── quiz.txt
    └── th1.pdf
```

## 💻 Yêu cầu hệ thống

- **PHP**: >= 7.4
- **Laravel**: >= 8.0
- **MySQL**: >= 5.7 (cho Bài 03)
- **Web Server**: Apache/Nginx
- **Browser**: Chrome, Firefox, Safari

## 🔧 Cài đặt và chạy

### Bài 01 - Quản lý Hoa
```bash
cd Bai01_QuanLyHoa
php -S localhost:8000 -t public
# Truy cập: http://localhost:8000
```

### Bài 02 - Quiz System
```bash
cd Bai02_Quiz  
php -S localhost:8001 -t public
# Truy cập: http://localhost:8001
```

### Bài 03 - Tài khoản
```bash
cd Bai03_TaiKhoan
# Setup MySQL database 'ten_database' on port 3307
php -S localhost:8002 -t public  
# Truy cập: http://localhost:8002
```

## ✨ Tính năng chính

### 🌸 Bài 01 Features
- ✅ Hiển thị 14 loại hoa với hình ảnh thật
- ✅ Guest view: Article-style layout
- ✅ Admin view: CRUD management
- ✅ Session-based data storage
- ✅ Responsive mobile design

### 📝 Bài 02 Features  
- ✅ File text parsing với regex
- ✅ Interactive quiz interface
- ✅ Auto scoring và detailed results
- ✅ Progress tracking
- ✅ Retake functionality

### 👥 Bài 03 Features
- ✅ MySQL database integration
- ✅ CSV import từ file ds.csv
- ✅ Full CRUD operations
- ✅ Search functionality
- ✅ User-friendly interface

## 📊 Demo Data

- **Bài 01**: 14 loài hoa Việt Nam từ afamily.vn
- **Bài 02**: 4 câu hỏi Android development
- **Bài 03**: 24 tài khoản sinh viên thcs_2023

## 🎯 Mục tiêu học tập

1. **File Processing**: Đọc và xử lý file text/CSV
2. **Database**: MySQL integration với PHP
3. **Session Management**: Lưu trữ dữ liệu tạm thời
4. **CRUD Operations**: Create, Read, Update, Delete
5. **Responsive UI**: Bootstrap 5 framework
6. **User Experience**: Intuitive interface design

## 🚨 Lưu ý

- **Bài 01**: Sử dụng session storage, data sẽ reset khi restart server
- **Bài 02**: Cần file quiz.txt đúng format
- **Bài 03**: Requires MySQL server running on port 3307

## 📱 Screenshots

*(Thêm screenshots của các giao diện sau khi deploy)*

## 🤝 Đóng góp

Dự án này được phát triển cho mục đích học tập. Mọi góp ý và cải thiện đều được chào đón!

## 📄 License

MIT License - Sử dụng tự do cho mục đích học tập

---

👨‍💻 **Phát triển bởi**: [kietoichoiDXD](https://github.com/kietoichoiDXD)  
📅 **Ngày tạo**: September 2025  
🏫 **Môn học**: Thiết kế và Lập trình Web