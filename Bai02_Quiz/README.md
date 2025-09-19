# Bài 02: Đọc tệp tin văn bản - Quiz System

## 📋 Mô tả
Hệ thống bài thi trắc nghiệm đọc dữ liệu từ file text và hiển thị giao diện làm bài online với tính năng chấm điểm tự động.

## 📁 Cấu trúc dự án

```
Bai02_Quiz/
├── app/Http/Controllers/
│   └── QuizController.php           # Controller chính xử lý logic quiz
├── resources/views/
│   ├── layouts/app.blade.php        # Layout chính
│   └── quiz/
│       ├── index.blade.php          # Trang làm bài
│       └── result.blade.php         # Trang kết quả
├── public/data/
│   └── quiz.txt                     # File dữ liệu câu hỏi
├── routes/
│   └── web.php                      # Định tuyến
└── storage/data/                    # Backup data
```

## 📄 Định dạng file quiz.txt

File dữ liệu có cấu trúc như sau:

```
Câu 1. Nội dung câu hỏi đầu tiên
A. Đáp án A
B. Đáp án B  
C. Đáp án C
D. Đáp án D
ANSWER: C

Câu 2. Nội dung câu hỏi thứ hai
A. Đáp án A
B. Đáp án B
C. Đáp án C  
D. Đáp án D
ANSWER: B
```

## Cấu trúc file

```
Bai02_Quiz/
├── app/Http/Controllers/
│   └── QuizController.php           # Controller xử lý logic quiz
├── resources/views/quiz/
│   ├── index.blade.php             # Hiển thị câu hỏi
│   └── result.blade.php            # Hiển thị kết quả
├── storage/data/
│   └── quiz.txt                    # File chứa câu hỏi và đáp án
├── routes/
│   └── web.php                     # Routes riêng cho bài 02
└── README.md                       # Hướng dẫn này
```

## Format file quiz.txt

```
Câu 1. Thành phần nào sau đây KHÔNG phải là một thành phần giao diện người dùng (UI) trong Android
A. TextView
B. Button  
C. Service
D. ImageView
ANSWER: C

Câu 2. Layout nào thường được sử dụng để sắp xếp các thành phần UI theo chiều dọc hoặc chiều ngang
A. RelativeLayout
B. LinearLayout
C. ConstraintLayout
D. FrameLayout
ANSWER: B
```

## ⚙️ Chức năng chính

### 🎯 QuizController.php
- **loadQuizData()**: Đọc và phân tích file quiz.txt
- **index()**: Hiển thị danh sách câu hỏi và form làm bài  
- **submit()**: Xử lý nộp bài, tính điểm và lưu kết quả
- **result()**: Hiển thị kết quả chi tiết từng câu
- **restart()**: Reset và làm lại bài thi

### 🎨 Giao diện Views

**index.blade.php** - Trang làm bài:
- Form với radio buttons cho từng câu hỏi
- JavaScript validation trước khi submit
- Responsive design với Bootstrap 5

**result.blade.php** - Trang kết quả:
- Thống kê tổng quan (điểm số, phần trăm)
- Chi tiết từng câu đúng/sai
- Nút làm lại bài thi

## 🛣️ Routes

```php
GET /              → Trang chủ quiz
POST /quiz/submit  → Nộp bài thi
GET /quiz/result   → Xem kết quả
GET /quiz/restart  → Làm lại bài thi
```

## 🚀 Cách sử dụng

1. **Chuẩn bị file dữ liệu**: Chỉnh sửa `public/data/quiz.txt` theo đúng format
2. **Truy cập**: Mở browser và vào `http://localhost/quiz`
3. **Làm bài**: Chọn đáp án cho từng câu hỏi
4. **Xem kết quả**: Nhấn "Nộp bài" để xem điểm số và giải thích

## 📊 Sample Data

File quiz.txt mặc định chứa 4 câu hỏi về Android development:

1. **UI Components** - Service không phải UI component
2. **Layout types** - LinearLayout cho sắp xếp theo chiều
3. **Intent usage** - Intent để khởi chạy Activity  
4. **Activity lifecycle** - onCreate() bắt đầu vòng đời

## 🔧 Tính năng kỹ thuật

- **File parsing**: Đọc và phân tích file text với regex
- **Session management**: Lưu kết quả tạm trong session
- **Responsive UI**: Hoạt động tốt trên mobile và desktop
- **Error handling**: Xử lý trường hợp file không tồn tại

---

💻 **Version**: 1.0 - September 2025

## Routes

```php
// Quiz routes
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
```

## Dữ liệu mẫu

File `quiz.txt` chứa 4 câu hỏi về Android:
1. Thành phần UI trong Android
2. Layout sắp xếp thành phần
3. Chức năng của Intent
4. Vòng đời Activity

## Hướng dẫn chạy

1. Truy cập `/quiz` để bắt đầu làm bài
2. Chọn đáp án cho từng câu hỏi
3. Nhấn "Nộp bài" để xem kết quả
4. Kết quả hiển thị số câu đúng và phần trăm điểm