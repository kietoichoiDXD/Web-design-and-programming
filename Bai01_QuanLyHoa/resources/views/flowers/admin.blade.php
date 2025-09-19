@extends('layouts.app')

@section('title', 'Quản lý hoa - Chế độ Admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold text-dark mb-1">Quản lý Hoa</h1>
            <p class="text-muted">Chế độ Quản trị - Thêm, sửa, xóa các loài hoa</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('flowers.guest') }}" class="btn btn-outline-secondary">
                <i class="fas fa-eye me-2"></i>
                Xem giao diện khách
            </a>
            <a href="{{ route('flowers.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>
                Thêm hoa mới
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2 text-primary"></i>
                    Danh sách hoa ({{ count($flowers) }} loài)
                </h5>
                <small class="text-muted">
                    Tổng cộng {{ count($flowers) }} loài hoa được quản lý
                </small>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-bold" style="width: 50px">#</th>
                            <th class="fw-bold" style="width: 100px">Hình ảnh</th>
                            <th class="fw-bold">Tên hoa</th>
                            <th class="fw-bold">Mô tả</th>
                            <th class="fw-bold text-center" style="width: 150px">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($flowers as $index => $flower)
                        <tr class="align-middle">
                            <td class="fw-semibold text-primary">{{ $index + 1 }}</td>
                            <td>
                                @if(file_exists(public_path('images/' . $flower['image'])))
                                    <img src="{{ asset('images/' . $flower['image']) }}" 
                                         alt="{{ $flower['name'] }}" 
                                         class="img-thumbnail"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-seedling text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $flower['name'] }}</span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ Str::limit($flower['description'], 100) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('flowers.edit', $index) }}" 
                                       class="btn btn-outline-primary btn-sm"
                                       title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('flowers.destroy', $index) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc muốn xóa hoa này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm"
                                                title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-seedling fa-3x mb-3"></i>
                                    <p>Chưa có hoa nào được thêm vào danh sách.</p>
                                    <a href="{{ route('flowers.create') }}" class="btn btn-primary">
                                        Thêm hoa đầu tiên
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center text-muted">
        <small>
            <i class="fas fa-info-circle me-1"></i>
            Dữ liệu được lưu trữ tạm thời trong session. Làm mới trình duyệt sẽ khôi phục dữ liệu mặc định.
        </small>
    </div>
</div>

<style>
.table th {
    border-bottom: 2px solid #dee2e6;
    color: #495057;
}

.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.04);
}

.btn-group .btn {
    margin: 0 1px;
}

.img-thumbnail {
    border: 1px solid #dee2e6;
    transition: transform 0.2s ease;
}

.img-thumbnail:hover {
    transform: scale(1.1);
}
</style>
@endsection