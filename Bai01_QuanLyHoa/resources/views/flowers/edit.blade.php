@extends('layouts.app')

@section('title', 'Chỉnh sửa hoa')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit me-2"></i>
                        <h4 class="mb-0">Chỉnh sửa thông tin hoa</h4>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('flowers.update', $id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-seedling text-success me-2"></i>
                                Tên hoa <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $flower['name']) }}"
                                   placeholder="Nhập tên loài hoa..."
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="fas fa-align-left text-primary me-2"></i>
                                Mô tả chi tiết <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="6"
                                      placeholder="Nhập mô tả về đặc điểm, cách trồng, ý nghĩa của hoa..."
                                      required>{{ old('description', $flower['description']) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-lightbulb me-1"></i>
                                Hãy mô tả chi tiết về hình dáng, màu sắc, thời điểm nở hoa và cách chăm sóc.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">
                                <i class="fas fa-image text-warning me-2"></i>
                                Tên file hình ảnh <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   value="{{ old('image', $flower['image']) }}"
                                   placeholder="Ví dụ: hoa-hong.jpg"
                                   required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Nhập tên file hình ảnh (đã upload vào thư mục public/images/).
                            </div>
                        </div>

                        <!-- Preview hiện tại -->
                        <div class="mb-4 p-3 bg-light rounded">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-eye text-info me-2"></i>
                                Xem trước hiện tại:
                            </h6>
                            <div class="row">
                                <div class="col-md-4">
                                    @if(file_exists(public_path('images/' . $flower['image'])))
                                        <img src="{{ asset('images/' . $flower['image']) }}" 
                                             alt="{{ $flower['name'] }}" 
                                             class="img-fluid rounded shadow-sm">
                                    @else
                                        <div class="bg-white rounded d-flex align-items-center justify-content-center border" 
                                             style="height: 150px;">
                                            <div class="text-center">
                                                <i class="fas fa-seedling fa-2x text-muted mb-2"></i>
                                                <p class="text-muted small mb-0">{{ $flower['name'] }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h6 class="fw-semibold">{{ $flower['name'] }}</h6>
                                    <p class="text-muted small">
                                        {{ Str::limit($flower['description'], 150) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4">
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-save me-2"></i>
                                    Cập nhật hoa
                                </button>
                                <a href="{{ route('flowers.admin') }}" class="btn btn-outline-secondary btn-lg px-4">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Quay lại
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4 p-3 bg-light rounded">
                <h6 class="fw-semibold mb-2">
                    <i class="fas fa-lightbulb text-warning me-2"></i>
                    Gợi ý về hình ảnh:
                </h6>
                <ul class="small text-muted mb-0">
                    <li>Đặt file hình ảnh trong thư mục <code>public/images/</code></li>
                    <li>Sử dụng định dạng JPG, PNG hoặc WebP</li>
                    <li>Đặt tên file không dấu, viết thường, cách nhau bằng dấu gạch ngang</li>
                    <li>Kích thước khuyến nghị: tối thiểu 300x300px</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection