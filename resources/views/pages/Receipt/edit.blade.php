@extends('layouts.master')
@section('css')
@section('title')
    {{ __('main_tans.EditDeedofreceipt') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.EditDeedofreceipt') }} : <label
                    style="color: red">{{ $receipt_student->student->trans_name }}</label></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('main_tans.EditDeedofreceipt') }}</li>
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

                <form action="{{ route('Receipt_Student.update', $receipt_student->id) }}" method="post"
                    autocomplete="off">
                    @method('PUT')
                    @csrf
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('main_tans.Amount') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="Debit" value="{{ $receipt_student->Debit }}"
                                    type="number">
                                <input type="hidden" name="student_id" value="{{ $receipt_student->student->id }}"
                                    class="form-control">
                                <input type="hidden" name="id" value="{{ $receipt_student->id }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('main_tans.Statement') }} : <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $receipt_student->description }}</textarea>
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ trans('main_tans.save_change') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')


@endsection
