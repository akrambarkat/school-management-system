@extends('layouts.master')
@section('css')
@section('title')
    {{ __('main_tans.add_new_fee') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.add_new_fee') }} : {{ $student->trans_name }}

            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active">     {{ __('main_tans.add_new_fee') }}

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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class=" row mb-30" action="{{ route('Fees_Invoices.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Fees">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name" class="mr-sm-2">{{ __('main_tans.name_student') }}</label>
                                            <select class="fancyselect" name="student_id" required>
                                                <option value="{{ $student->id }}">{{ $student->trans_name }}</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="Name_en" class="mr-sm-2">{{ __('main_tans.Type_of_fee') }}</label>
                                            <div class="box">
                                                <select class="fancyselect" name="fee_id" required>
                                                    <option value="">-- {{ __('main_tans.select_of_list') }} --</option>
                                                    @foreach ($fees as $fee)
                                                        <option value="{{ $fee->id }}">{{ $fee->trans_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="Name_en" class="mr-sm-2">{{ __('main_tans.Amount') }}</label>
                                            <div class="box">
                                                <select class="fancyselect" name="amount" required>
                                                    <option value="">-- {{ __('main_tans.select_of_list') }} --</option>
                                                    @foreach ($fees as $fee)
                                                        <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="description" class="mr-sm-2">{{ __('main_tans.Statement') }}</label>
                                            <div class="box">
                                                <input type="text" class="form-control" name="description" required>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('main_tans.action') }}:</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                                value="{{ trans('main_tans.delete') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button"
                                        value="{{ trans('main_tans.add_row') }}" />
                                </div>
                            </div><br>
                            <input type="hidden" name="Grade_id" value="{{ $student->grade_id }}">
                            <input type="hidden" name="Classroom_id" value="{{ $student->classroom_id }}">

                            <button type="submit" class="btn btn-primary">{{ __('main_tans.sure') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')


@endsection
