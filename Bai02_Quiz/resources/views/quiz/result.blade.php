@extends('layouts.app')

@section('title', 'Kết quả bài thi')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center bg-success text-white px-4 py-2 rounded-pill mb-3">
                    <i class="fas fa-chart-line me-2"></i>
                    <span class="fw-bold">Kết quả bài thi</span>
                </div>
                <h1 class="display-6 fw-bold text-dark mb-2">Bài thi đã hoàn thành!</h1>
            </div>

            <!-- Score Summary -->
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="score-circle mx-auto mb-3 d-flex align-items-center justify-content-center
                                        {{ $percentage >= 80 ? 'bg-success' : ($percentage >= 60 ? 'bg-warning' : 'bg-danger') }}"
                                 style="width: 80px; height: 80px; border-radius: 50%;">
                                <span class="text-white fw-bold fs-4">{{ $percentage }}%</span>
                            </div>
                            <h5 class="card-title mb-1">Điểm số</h5>
                            <p class="card-text text-muted">{{ $score }}/{{ $totalQuestions }} câu đúng</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="result-icon mx-auto mb-3 d-flex align-items-center justify-content-center bg-primary"
                                 style="width: 80px; height: 80px; border-radius: 50%;">
                                <i class="fas fa-{{ $percentage >= 60 ? 'trophy' : 'redo-alt' }} text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-1">Kết quả</h5>
                            <p class="card-text">
                                <span class="badge {{ $percentage >= 80 ? 'bg-success' : ($percentage >= 60 ? 'bg-warning' : 'bg-danger') }}">
                                    @if($percentage >= 80)
                                        Xuất sắc
                                    @elseif($percentage >= 60)
                                        Đạt yêu cầu
                                    @else
                                        Cần cải thiện
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="time-icon mx-auto mb-3 d-flex align-items-center justify-content-center bg-info"
                                 style="width: 80px; height: 80px; border-radius: 50%;">
                                <i class="fas fa-clock text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-1">Thời gian</h5>
                            <p class="card-text text-muted">Hoàn thành</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Results -->
            <div class="card shadow-sm">
                <div class="card-header bg-light py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list-ul text-primary me-2"></i>
                        <h5 class="card-title mb-0">Chi tiết từng câu hỏi</h5>
                        <div class="ms-auto">
                            <small class="text-muted">{{ $totalQuestions }} câu hỏi</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($results as $index => $result)
                    <div class="result-item mb-4 p-4 border rounded 
                         {{ $result['is_correct'] ? 'border-success bg-light-success' : 'border-danger bg-light-danger' }}">
                        
                        <div class="d-flex align-items-start mb-3">
                            <div class="result-status me-3">
                                @if($result['is_correct'])
                                    <span class="badge bg-success rounded-circle" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-check"></i>
                                    </span>
                                @else
                                    <span class="badge bg-danger rounded-circle" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-times"></i>
                                    </span>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="question-text fw-semibold mb-2">
                                    <span class="text-primary">Câu {{ $index + 1 }}:</span> 
                                    {{ $result['question']['question'] }}
                                </h6>
                                
                                <div class="answer-details">
                                    @if($result['user_answer'])
                                        <p class="mb-1">
                                            <span class="fw-semibold">Câu trả lời của bạn:</span>
                                            <span class="{{ $result['is_correct'] ? 'text-success' : 'text-danger' }}">
                                                {{ $result['user_answer'] }}. {{ $result['question']['options'][$result['user_answer']] }}
                                            </span>
                                        </p>
                                    @else
                                        <p class="mb-1 text-warning">
                                            <span class="fw-semibold">Câu trả lời của bạn:</span> Chưa trả lời
                                        </p>
                                    @endif
                                    
                                    @if(!$result['is_correct'])
                                        <p class="mb-0">
                                            <span class="fw-semibold">Đáp án đúng:</span>
                                            <span class="text-success">
                                                {{ $result['question']['correct_answer'] }}. {{ $result['question']['options'][$result['question']['correct_answer']] }}
                                            </span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-5">
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('quiz.restart') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-redo-alt me-2"></i>
                        Làm lại bài thi
                    </a>
                    <a href="{{ route('quiz.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="fas fa-arrow-left me-2"></i>
                        Về trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-light-success {
    background-color: rgba(25, 135, 84, 0.05) !important;
}

.bg-light-danger {
    background-color: rgba(220, 53, 69, 0.05) !important;
}

.result-item {
    transition: transform 0.2s ease;
}

.result-item:hover {
    transform: translateY(-2px);
}

.score-circle, .result-icon, .time-icon {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .d-flex.gap-3 {
        flex-direction: column;
        gap: 1rem !important;
    }
    
    .btn-lg {
        width: 100%;
    }
}
</style>
@endsection