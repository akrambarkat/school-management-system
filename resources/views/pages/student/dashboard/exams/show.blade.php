@extends('layouts.master')

@section('css')
@livewireStyles
@section('title') إجراء اختبار @stop
@endsection

@section('page-header')
@section('PageTitle') إجراء اختبار @stop
@endsection

@section('content')
<div class="container mt-4">
    {{-- شريط العنوان العلوي --}}
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div><strong>الوقت المتبقي: </strong> <span id="timer"></span> ⏳</div>
        <div><strong id="questionIndicator">السؤال 1 من {{ count($questions) }}</strong></div>
    </div>

    {{-- شريط التقدم --}}
    <div class="progress mb-3" style="height: 6px;">
        <div id="progress-bar" class="progress-bar" role="progressbar"
             style="width: 0%; background-color: #84ba3f;"></div>
    </div>

    {{-- نموذج الأسئلة --}}
    <form method="POST" action="{{ route('exam.submit') }}" id="examForm">
        @csrf
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
        <input type="hidden" name="student_id" value="{{ $student_id }}">

        @foreach($questions as $index => $question)
            <div class="question card p-4 shadow"
                 style="{{ $index > 0 ? 'display:none;' : '' }} background: #fff;"
                 data-index="{{ $index }}">
                <h5 class="mb-3">{{ $question->title }}</h5>

                @foreach(explode('-', $question->answers) as $answer)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="{{ $answer }}" required>
                        <label class="form-check-label">{{ $answer }}</label>
                    </div>
                @endforeach

                <div class="mt-4">
                    @if ($index < count($questions) - 1)
                        <button type="button" class="btn btn-primary next-btn" style="background-color: #84ba3f;">التالي</button>
                    @else
                        <button type="submit" class="btn btn-success">إنهاء المحاولة</button>
                    @endif
                </div>
            </div>
        @endforeach
    </form>
</div>
@endsection

@section('js')
<script>
    const totalSeconds = {{ $quiz->duration_minutes * 60 }};
    let endTime = localStorage.getItem("quiz_{{ $quiz->id }}_end");

    if (!endTime) {
        endTime = Date.now() + totalSeconds * 1000;
        localStorage.setItem("quiz_{{ $quiz->id }}_end", endTime);
    }

    let timerInterval;
    let formSubmitted = false;

    function updateTimer() {
        const now = Date.now();
        const distance = endTime - now;

        if (distance <= 0 && !formSubmitted) {
            formSubmitted = true; // تأكيد أن النموذج لا يُرسل أكثر من مرة
            clearInterval(timerInterval);
            localStorage.removeItem("quiz_{{ $quiz->id }}_end");
            document.getElementById("examForm").submit();
            return;
        }

        const minutes = Math.floor(distance / 1000 / 60);
        const seconds = Math.floor((distance / 1000) % 60);
        document.getElementById("timer").textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
        document.getElementById("progress-bar").style.width = ((totalSeconds - distance / 1000) / totalSeconds * 100) + '%';
    }

    timerInterval = setInterval(updateTimer, 1000);

    document.getElementById("examForm").addEventListener("submit", function () {
        formSubmitted = true;
        clearInterval(timerInterval);
        localStorage.removeItem("quiz_{{ $quiz->id }}_end");
    });

    const questions = document.querySelectorAll('.question');
    const nextButtons = document.querySelectorAll('.next-btn');
    const indicator = document.getElementById("questionIndicator");

    nextButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const current = btn.closest('.question');
            const index = parseInt(current.dataset.index);
            current.style.display = 'none';
            questions[index + 1].style.display = 'block';
            indicator.textContent = `السؤال ${index + 2} من {{ count($questions) }}`;
        });
    });
</script>

@endsection
