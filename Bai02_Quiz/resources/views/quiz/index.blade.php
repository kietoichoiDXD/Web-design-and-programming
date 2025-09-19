@extends('layouts.app')

@section('title', 'Bài thi trắc nghiệm Android')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center bg-primary text-white px-4 py-2 rounded-pill mb-3">
                    <i class="fas fa-graduation-cap me-2"></i>
                    <span class="fw-bold">Bài thi trắc nghiệm</span>
                </div>
                <h1 class="display-6 fw-bold text-dark mb-2">
                    Kiểm tra kiến thức Android
                </h1>
                <p class="lead text-muted">
                    Thời gian làm bài: <span class="fw-bold text-primary">Không giới hạn</span> | 
                    Tổng số câu: <span class="fw-bold text-primary">{{ count($questions) }}</span>
                </p>
            </div>

            @if(count($questions) > 0)
            <!-- Quiz Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-light py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list-ol text-primary me-2"></i>
                        <h5 class="card-title mb-0">Danh sách câu hỏi</h5>
                        <div class="ms-auto">
                            <span class="badge bg-primary fs-6">{{ count($questions) }} câu</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('quiz.submit') }}" method="POST" id="quizForm">
                        @csrf
                        
                        @foreach($questions as $index => $question)
                        <div class="question-block mb-5 p-4 border rounded {{ $index % 2 == 0 ? 'bg-light' : 'bg-white' }}">
                            <div class="d-flex align-items-start mb-3">
                                <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 35px; height: 35px; min-width: 35px;">
                                    <span class="fw-bold">{{ $index + 1 }}</span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="question-text fw-semibold text-dark mb-0">
                                        {{ $question['question'] }}
                                    </h6>
                                </div>
                            </div>
                            
                            <div class="options ms-5">
                                @foreach($question['options'] as $optionKey => $optionValue)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="answers[{{ $question['id'] }}]" 
                                           value="{{ $optionKey }}" 
                                           id="q{{ $question['id'] }}_{{ $optionKey }}"
                                           required>
                                    <label class="form-check-label" for="q{{ $question['id'] }}_{{ $optionKey }}">
                                        <span class="option-letter fw-bold text-primary">{{ $optionKey }}.</span>
                                        {{ $optionValue }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Submit Section -->
                        <div class="text-center pt-4 border-top">
                            <div class="mb-3">
                                <p class="text-muted mb-2">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Hãy kiểm tra lại các câu trả lời của bạn trước khi nộp bài
                                </p>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg px-5" onclick="return confirmSubmit()">
                                <i class="fas fa-paper-plane me-2"></i>
                                Nộp bài thi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <!-- No Questions Available -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-exclamation-circle fa-4x text-warning"></i>
                </div>
                <h4 class="text-muted">Không có câu hỏi nào</h4>
                <p class="text-muted">File dữ liệu quiz.txt không tồn tại hoặc không có nội dung hợp lệ.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.question-block {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.question-block:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}

.form-check-input:checked + .form-check-label {
    color: #0d6efd;
    font-weight: 500;
}

.option-letter {
    display: inline-block;
    min-width: 25px;
}

.question-number {
    font-size: 16px;
    font-weight: bold;
}

.question-text {
    line-height: 1.4;
    font-size: 1.05em;
}

@media (max-width: 768px) {
    .options {
        margin-left: 0 !important;
    }
    
    .question-block {
        padding: 1rem !important;
    }
}
</style>

<script>
function confirmSubmit() {
    const form = document.getElementById('quizForm');
    const questions = {{ count($questions) }};
    let answered = 0;
    
    // Count answered questions
    for (let i = 1; i <= questions; i++) {
        const radioButtons = form.querySelectorAll(`input[name="answers[${i}]"]`);
        for (let radio of radioButtons) {
            if (radio.checked) {
                answered++;
                break;
            }
        }
    }
    
    if (answered < questions) {
        const unanswered = questions - answered;
        return confirm(`Bạn chưa trả lời ${unanswered} câu hỏi. Bạn có chắc muốn nộp bài không?`);
    }
    
    return confirm(`Bạn đã trả lời tất cả ${questions} câu hỏi. Xác nhận nộp bài?`);
}
</script>
@endsection