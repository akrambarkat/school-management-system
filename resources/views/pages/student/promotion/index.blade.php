@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('main_tans.upgrade_student') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.upgrade_student') }}
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.upgrade_student') }}
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

                @if ($errors->has('error_promotions'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $errors->first('error_promotions') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif



                <h6 style="color: red;font-family: Cairo">{{ __('main_tans.old_grade') }}</h6><br>

                <form method="post" action="{{ route('Promotion.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputState">{{ trans('main_tans.grade_student') }}</label>
                            <select class="custom-select mr-sm-2" name="Grade_id" required>
                                <option selected disabled>{{ trans('main_tans.select_of_list') }}...</option>
                                @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->trans_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="Classroom_id">{{ trans('main_tans.class_student') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="Classroom_id" required>

                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="section_id">{{ trans('main_tans.section_student') }} : </label>
                            <select class="custom-select mr-sm-2" name="section_id" required>

                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{ trans('main_tans.academic_year') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{ trans('main_tans.select_of_list') }}...</option>
                                    @php
                                        $current_year = date('Y');
                                    @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h6 style="color: red;font-family: Cairo">{{ __('main_tans.New_grade') }}</h6><br>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputState">{{ trans('main_tans.grade_student') }}</label>
                            <select class="custom-select mr-sm-2" name="Grade_id_new">
                                <option selected disabled>{{ trans('main_tans.select_of_list') }}...</option>
                                @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->trans_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="Classroom_id">{{ trans('main_tans.class_student') }}: <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="Classroom_id_new">

                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="section_id">:{{ trans('main_tans.section_student') }} </label>
                            <select class="custom-select mr-sm-2" name="section_id_new">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{ trans('main_tans.academic_year') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year_new">
                                    <option selected disabled>{{ trans('main_tans.select_of_list') }}...</option>
                                    @php
                                        $current_year = date('Y');
                                    @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('main_tans.sure') }}</button>
                </form>

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
                    url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
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
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
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



<script>
    $(document).ready(function() {
        $('select[name="Grade_id_new"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // تفريغ الخيارات القديمة
                        $('select[name="Classroom_id_new"]').empty();
                        // إضافة الخيار الافتراضي
                        $('select[name="Classroom_id_new"]').append(
                            '<option selected disabled>{{ trans('main_tans.select_of_list') }}...</option>'
                        );
                        // إضافة الخيارات الجديدة
                        $.each(data, function(key, value) {
                            $('select[name="Classroom_id_new"]').append(
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
        $('select[name="Classroom_id_new"]').on('change', function() {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id_new"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id_new"]').append(
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
