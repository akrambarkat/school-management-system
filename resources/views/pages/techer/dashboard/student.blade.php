@extends('layouts.master')
@section('css')
@section('title')
    قائمة الحضور والغياب للطلاب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> قائمة الحضور والغياب للطلاب

            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active"> قائمة الحضور والغياب للطلاب
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ session('status') }}</li>
        </ul>
    </div>
@endif

<h5 style="font-family: 'Cairo', sans-serif;color: red"> تاريخ اليوم : {{ date('Y-m-d') }}</h5>
<form method="post" action="{{ route('attendance') }}" autocomplete="off">

    @csrf
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
        style="text-align: center">
        <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ trans('main_tans.name_student') }}</th>
                <th class="alert-success">{{ trans('main_tans.email_parent') }}</th>
                <th class="alert-success">{{ trans('main_tans.gender') }}</th>
                <th class="alert-success">{{ trans('main_tans.grade_student') }}</th>
                <th class="alert-success">{{ trans('main_tans.name_class') }}</th>
                <th class="alert-success">{{ trans('main_tans.name_section') }}</th>
                <th class="alert-success">الحضور والغياب</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->trans_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender->trans_name }}</td>
                    <td>{{ $student->grade->trans_name }}</td>
                    <td>{{ $student->classroom->trans_name }}</td>
                    <td>{{ $student->section->trans_name }}</td>
                    <td>
                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="attendences[{{ $student->id }}]"
                                @foreach ($student->attendance()->where('attendence_date', date('Y-m-d'))->get() as $attendance)
                                   {{ $attendance->attendence_status == 1 ? 'checked' : '' }} @endforeach
                                class="leading-tight" type="radio" value="presence">
                            <span class="text-success">حضور</span>
                        </label>

                        <label class="ml-4 block text-gray-500 font-semibold">
                            <input name="attendences[{{ $student->id }}]"
                                @foreach ($student->attendance()->where('attendence_date', date('Y-m-d'))->get() as $attendance)
                                   {{ $attendance->attendence_status == 0 ? 'checked' : '' }} @endforeach
                                class="leading-tight" type="radio" value="absent">
                            <span class="text-danger">غياب</span>
                        </label>

                        <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                        <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                        <input type="hidden" name="section_id" value="{{ $student->section_id }}">


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <P>
        <button class="btn btn-success" type="submit">{{ trans('main_tans.sure') }}</button>
    </P>
</form><br>
<!-- row closed -->
@endsection
@section('js')

@endsection
