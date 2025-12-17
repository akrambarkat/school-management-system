
@extends('layouts.master')
@section('css')
    @section('title')
        قائمة الاختبارات
    @stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> قائمة الاختبارات
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> قائمة الاختبارات
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>المادة الدراسية</th>
                                            <th>اسم الاختبار</th>
                                            <th>دخول / درجة الاختبار</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->subject->trans_name}}</td>
                                                <td>{{$quizze->trans_name}}</td>
                                                <td>
    @php
        $student_id = auth()->id();
        $quiz_id = $quizze->id;

        $degree = \App\Models\Degree::where('quizze_id', $quiz_id)
            ->where('student_id', $student_id)
            ->exists();

        $student_score = \App\Models\Degree::where('quizze_id', $quiz_id)
            ->where('student_id', $student_id)
            ->sum('score');

        $total_score = \App\Models\Question::where('quizze_id', $quiz_id)
            ->sum('score');
    @endphp

    @if($degree)
        <span class="badge badge-success" style="background-color: #84ba3f;
">
            درجتك: {{ $student_score }} من {{ $total_score }}
        </span>
    @else
        <a href="{{ route('exam.show', ['quiz_id' => $quizze->id, 'student_id' => $student_id]) }}"
           class="btn btn-outline-success btn-sm"
           role="button"
           aria-pressed="true"
           onclick="alertAbuse()">
            <i class="fas fa-person-booth"></i>
        </a>
    @endif
</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')


    {{--    <script>--}}
    {{--        function alertAbuse() {--}}
    {{--            alert("برجاء عدم إعادة تحميل الصفحة بعد دخول الاختبار - في حال تم تنفيذ ذلك سيتم الغاء الاختبار بشكل اوتوماتيك ");--}}
    {{--        }--}}
    {{--    </script>--}}

@endsection