# PHÂN CHIA BÀI TẬP THEO CHỦNG LOẠI

## Tổng quan

Dự án đã được tổ chức lại thành 3 bài tập riêng biệt, mỗi bài có cấu trúc thư mục và chức năng độc lập:

## 📁 Cấu trúc thư mục chính

```
e:\UED\TK và LT WEB\
├── Bai01_QuanLyHoa/           # Bài 01: Quản lý Hoa
├── Bai02_Quiz/                # Bài 02: Hệ thống Quiz
├── Bai03_TaiKhoan/            # Bài 03: Quản lý Tài khoản
└── project_name/              # Thư mục gốc (có thể xóa)
```

---

## 🌸 BÀI 01 - QUẢN LÝ HOA

**📂 Thư mục:** `Bai01_QuanLyHoa/`

### Chức năng chính:
- ✅ **Giao diện Khách**: Xem danh sách hoa dạng card
- ✅ **Giao diện Admin**: Quản lý hoa với bảng + CRUD
- ✅ **Thêm hoa**: Form thêm hoa mới
- ✅ **Sửa hoa**: Form chỉnh sửa thông tin hoa
- ✅ **Xóa hoa**: Xóa hoa khỏi danh sách

### Routes chính:
```
/flowers/guest    → Xem hoa (khách)
/flowers/admin    → Quản lý hoa (admin)
/flowers/create   → Thêm hoa mới
/flowers/{id}/edit → Sửa hoa
```

### File quan trọng:
- `FlowerController.php` - Logic xử lý hoa
- `flowers/` views - Giao diện người dùng
- `public/images/` - Hình ảnh hoa

---

## 📝 BÀI 02 - HỆ THỐNG QUIZ

**📂 Thư mục:** `Bai02_Quiz/`

### Chức năng chính:
- ✅ **Hiển thị quiz**: Đọc câu hỏi từ file txt
- ✅ **Xử lý đáp án**: Tính điểm tự động
- ✅ **Hiển thị kết quả**: Số câu đúng + phần trăm

### Routes chính:
```
/quiz           → Làm bài quiz
/quiz/submit    → Nộp bài và xem kết quả
```

### File quan trọng:
- `QuizController.php` - Logic xử lý quiz
- `quiz/` views - Giao diện quiz
- `storage/data/quiz.txt` - Câu hỏi và đáp án

### Dữ liệu:
- 4 câu hỏi về Android development
- Format: Câu hỏi → 4 lựa chọn A,B,C,D → ANSWER

---

## 👥 BÀI 03 - QUẢN LÝ TÀI KHOẢN

**📂 Thư mục:** `Bai03_TaiKhoan/`

### Chức năng chính:
- ✅ **Hiển thị danh sách**: Đọc từ file CSV
- ✅ **Xem chi tiết**: Thông tin chi tiết từng tài khoản
- ✅ **Tìm kiếm**: Tìm theo từ khóa trong tất cả trường

### Routes chính:
```
/accounts         → Danh sách tài khoản
/accounts/{id}    → Chi tiết tài khoản
/accounts/search  → Tìm kiếm
```

### File quan trọng:
- `AccountController.php` - Logic xử lý tài khoản
- `accounts/` views - Giao diện tài khoản
- `storage/data/ds.csv` - Dữ liệu 24 tài khoản học sinh

### Dữ liệu:
- 24 tài khoản với đầy đủ thông tin
- Định dạng CSV: username, password, họ tên, email, khóa học

---

## 🚀 HƯỚNG DẪN SỬ DỤNG

### Cách chạy từng bài:

1. **Bài 01 - Quản lý Hoa:**
   ```
   Vào thư mục: Bai01_QuanLyHoa/
   Truy cập: /flowers/guest hoặc /flowers/admin
   ```

2. **Bài 02 - Quiz:**
   ```
   Vào thư mục: Bai02_Quiz/
   Truy cập: /quiz
   ```

3. **Bài 03 - Tài khoản:**
   ```
   Vào thư mục: Bai03_TaiKhoan/
   Truy cập: /accounts
   ```

### Lưu ý:
- Mỗi bài có file `README.md` riêng với hướng dẫn chi tiết
- Dữ liệu được lưu trong `storage/data/` của từng bài
- Các file lint errors là do chưa cài đặt Laravel framework (bình thường)

---

## 📋 TỔNG KẾT

| Bài | Chủ đề | Công nghệ | Dữ liệu | Chức năng chính |
|-----|--------|-----------|---------|-----------------|
| 01 | Quản lý Hoa | Session | Hardcode | CRUD + 2 giao diện |
| 02 | Quiz System | File TXT | quiz.txt | Đọc file + tính điểm |
| 03 | Tài khoản | File CSV | ds.csv | Đọc CSV + tìm kiếm |

**🎯 Mục tiêu đạt được:**
- ✅ Tách biệt rõ ràng từng bài tập
- ✅ Dễ dàng tìm kiếm và quản lý
- ✅ Mỗi bài có documentation riêng
- ✅ Cấu trúc code rõ ràng, dễ hiểu