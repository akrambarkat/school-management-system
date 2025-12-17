@extends('layouts.master')

@section('css')
@livewireStyles
@section('title') نتيجة الاختبار @stop
@endsection

@section('page-header')
@section('PageTitle') نتيجة الاختبار @stop
@endsection

@section('content')

@php
    $total_score = \App\Models\Question::where('quizze_id', request('quiz_id'))->sum('score');
@endphp

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card p-5 shadow text-center" style="background-color: #fff;">
        <h3 class="mb-4"> تم الانتهاء من الامتحان✅</h3>
        <h4  style="color: #84ba3f">درجتك: {{ $score }} من {{ $total_score }}</h4><a href="{{ route('student_exams.index') }}"
   class="btn text-white mt-4"
   style="background-color: #84ba3f;">
    العودة إلى قائمة الاختبارات
</a>
    </div>
</div>

@endsection

@section('js')
@endsection
