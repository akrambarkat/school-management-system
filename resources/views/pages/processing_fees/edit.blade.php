@extends('layouts.master')
@section('css')

@section('title')
    تعديل معالجة رسوم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            تعديل معالجة رسوم : <label style="color: red">{{ $ProcessingFee->student->trans_name }}</label>

            <h4 class="mb-0">
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> تعديل معالجة رسوم


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

                <form action="{{ route('processing_fees.update', $ProcessingFee->id) }}" method="post"
                    autocomplete="off">
                    @method('PUT')
                    @csrf
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>المبلغ : <span class="text-danger">*</span></label>
                                <input class="form-control" name="Debit" value="{{ $ProcessingFee->amount }}"
                                    type="number">
                                <input type="hidden" name="student_id" value="{{ $ProcessingFee->student->id }}"
                                    class="form-control">
                                <input type="hidden" name="id" value="{{ $ProcessingFee->id }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>البيان : <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $ProcessingFee->description }}</textarea>
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ trans('Students_trans.submit') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')


@endsection
