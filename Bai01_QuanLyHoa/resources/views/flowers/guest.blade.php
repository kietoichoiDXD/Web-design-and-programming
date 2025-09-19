@extends('layouts.app')

@section('title', '14 loại hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-primary mb-3">
                    14 loại hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè
                </h1>
                <p class="lead text-muted">
                    Khám phá những loài hoa đẹp và dễ trồng, phù hợp với khí hậu Việt Nam
                </p>
            </div>

            @foreach($flowers as $index => $flower)
            <article class="flower-card mb-5 p-4 bg-white shadow-sm rounded border">
                <div class="row align-items-start">
                    <div class="col-md-4">
                        <div class="flower-image-container">
                            @if(file_exists(public_path('images/' . $flower['image'])))
                                <img src="{{ asset('images/' . $flower['image']) }}" 
                                     alt="{{ $flower['name'] }}" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="width: 100%; height: 250px; object-fit: cover;">
                            @else
                                <div class="placeholder-image d-flex align-items-center justify-content-center bg-light rounded" 
                                     style="width: 100%; height: 250px;">
                                    <div class="text-center">
                                        <i class="fas fa-seedling fa-3x text-secondary mb-2"></i>
                                        <p class="text-muted mb-0">{{ $flower['name'] }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="flower-content">
                            <h2 class="h3 fw-bold text-dark mb-3">
                                {{ $index + 1 }}. {{ $flower['name'] }}
                            </h2>
                            <p class="text-muted lh-lg">
                                {{ $flower['description'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach

            <div class="text-center mt-5 p-4 bg-light rounded">
                <p class="mb-3">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    Bạn muốn quản lý danh sách hoa này?
                </p>
                <a href="{{ route('flowers.admin') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-tools me-2"></i>
                    Chuyển sang chế độ Quản trị
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.flower-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.flower-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.flower-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 0.375rem;
}

.flower-image-container img {
    transition: transform 0.3s ease;
}

.flower-card:hover .flower-image-container img {
    transform: scale(1.05);
}

.placeholder-image {
    border: 2px dashed #dee2e6;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
</style>
@endsection