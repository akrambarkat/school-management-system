@extends('layouts.master')
@section('css')
@section('title')
    اضافة اختبار جديد
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> اضافة اختبار جديد
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active">اضافة اختبار جديد</li>
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

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('Quizzes.store') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">اسم الاختبار باللغة العربية</label>
                                    <input type="text" name="Name_ar" class="form-control">
                                </div>

                                <div class="col">
                                    <label for="title">اسم الاختبار باللغة الانجليزية</label>
                                    <input type="text" name="Name_en" class="form-control">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">المادة الدراسية : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="subject_id">
                                            <option selected disabled>حدد المادة الدراسية...</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->trans_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="Grade_id">
                                            <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->trans_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="Classroom_id">

                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                                        <select class="custom-select mr-sm-2" name="section_id">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="duration_minutes">مدة الامتحان (بالدقائق):</label>
                                    <input type="number" class="form-control" name="duration_minutes" value="{{ old('duration_minutes', 15) }}">
                                </div>

                            </div>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ
                                البيانات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('select[name="Grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classroom') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // تفريغ الخيارات القديمة
                        $('select[name="Classroom_id"]').empty();
                        // إضافة الخيار الافتراضي
                        $('select[name="Classroom_id"]').append(
                            '<option selected disabled>{{ trans('main_tans.select_of_list') }}...</option>'
                        );
                        // إضافة الخيارات الجديدة
                        $.each(data, function(key, value) {
                            $('select[name="Classroom_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>'
                            );
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('select[name="Classroom_id"]').on('change', function() {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Section') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

@endsection
