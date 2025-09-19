# BÀI 01 - QUẢN LÝ HOA

## Mô tả
Bài tập xây dựng ứng dụng quản lý danh sách các loài hoa với đầy đủ chức năng CRUD (Create, Read, Update, Delete).

## Chức năng chính

### 1. Giao diện Khách (Guest View)
- **File:** `resources/views/flowers/guest.blade.php`
- **Route:** `/flowers/guest` 
- **Chức năng:** Hiển thị danh sách hoa dạng card cho người dùng thông thường
- **Đặc điểm:** Chỉ xem, không có chức năng chỉnh sửa

### 2. Giao diện Quản trị (Admin View)
- **File:** `resources/views/flowers/admin.blade.php`
- **Route:** `/flowers/admin`
- **Chức năng:** Hiển thị danh sách hoa dạng bảng với các nút thao tác
- **Thao tác:** Thêm, Sửa, Xóa hoa

### 3. Thêm hoa mới
- **File:** `resources/views/flowers/create.blade.php`
- **Route:** `/flowers/create`
- **Chức năng:** Form thêm hoa mới với các trường: tên, mô tả, hình ảnh

### 4. Chỉnh sửa hoa
- **File:** `resources/views/flowers/edit.blade.php`
- **Route:** `/flowers/{id}/edit`
- **Chức năng:** Form chỉnh sửa thông tin hoa đã có

## Cấu trúc file

```
Bai01_QuanLyHoa/
├── app/Http/Controllers/
│   └── FlowerController.php          # Controller xử lý logic hoa
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php            # Layout chung
│   └── flowers/
│       ├── guest.blade.php          # View khách
│       ├── admin.blade.php          # View admin
│       ├── create.blade.php         # Form thêm hoa
│       └── edit.blade.php           # Form sửa hoa
├── public/
│   ├── images/                      # Thư mục chứa hình ảnh hoa
│   └── css/
│       └── flowers.css              # CSS riêng cho bài hoa
├── routes/
│   └── web.php                      # Routes riêng cho bài 01
└── README.md                        # Hướng dẫn này
```

## Routes

```php
// Guest view
Route::get('/flowers/guest', [FlowerController::class, 'guest'])->name('flowers.guest');

// Admin routes
Route::get('/flowers/admin', [FlowerController::class, 'admin'])->name('flowers.admin');
Route::get('/flowers/create', [FlowerController::class, 'create'])->name('flowers.create');
Route::post('/flowers', [FlowerController::class, 'store'])->name('flowers.store');
Route::get('/flowers/{id}/edit', [FlowerController::class, 'edit'])->name('flowers.edit');
Route::put('/flowers/{id}', [FlowerController::class, 'update'])->name('flowers.update');
Route::delete('/flowers/{id}', [FlowerController::class, 'destroy'])->name('flowers.destroy');
```

## Dữ liệu mẫu
Hệ thống có sẵn 3 loài hoa mẫu:
1. Hoa dạ yến thảo
2. Hoa đồng tiền  
3. Hoa giấy

## Hướng dẫn chạy
1. Truy cập `/flowers/guest` để xem giao diện khách
2. Truy cập `/flowers/admin` để vào giao diện quản trị
3. Sử dụng các nút "Thêm", "Sửa", "Xóa" để quản lý danh sách hoa