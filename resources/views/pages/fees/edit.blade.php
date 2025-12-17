@extends('layouts.master')
@section('css')
@section('title')
    {{ __('main_tans.edit_fee') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.edit_fee') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('main_tans.edit_fee') }}</li>
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('fees.update', $fee->id) }}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">{{ __('main_tans.name_ar') }}</label>
                            <input type="text" value="{{ old('title_ar', $fee->name_ar) }}" name="title_ar"
                                class="form-control">
                            <input type="hidden" value="{{ $fee->id }}" name="id" class="form-control">
                        </div>

                        <div class="form-group col">
                            <label for="inputEmail4">{{ __('main_tans.name_en') }}</label>
                            <input type="text" value="{{ old('title_en', $fee->name_en) }}" name="title_en"
                                class="form-control">
                        </div>


                        <div class="form-group col">
                            <label for="inputEmail4">{{ __('main_tans.Amount') }}</label>
                            <input type="number" value="{{ old('amount', $fee->amount) }}" name="amount"
                                class="form-control">
                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group col">
                            <label for="inputState">{{ __('main_tans.grade_student') }}</label>
                            <select class="custom-select mr-sm-2" name="Grade_id" id="Grade_id">
                                @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}"
                                        {{ $Grade->id == $fee->grade_id ? 'selected' : '' }}>{{ $Grade->trans_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="inputZip">{{ __('main_tans.class_student') }}</label>
                            <select class="custom-select mr-sm-2" name="Classroom_id" id="Classroom_id">
                                <option value="{{ $fee->classroom_id }}">{{ $fee->classroom->trans_name }}</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="inputZip">{{ __('main_tans.academic_year') }}</label>
                            <select class="custom-select mr-sm-2" name="year">
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}" {{ $year == $fee->year ? 'selected' : ' ' }}>
                                        {{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputAddress">{{ __('main_tans.note') }}</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{ $fee->description }}</textarea>
                    </div>
                    <br>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
                        {{ __('main_tans.save_change') }}</button>

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
@endsection
