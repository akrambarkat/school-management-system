@extends('layouts.master')
@section('css')
@section('title')
    {{ __('main_tans.edit_tuition_bills') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.edit_tuition_bills') }}
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('main_tans.edit_tuition_bills') }}</li>
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

                <form action="{{ route('Fees_Invoices.update', $fee_invoices->id) }}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">{{ __('main_tans.name_student') }}</label>
                            <input type="text" value="{{ $fee_invoices->student->trans_name }}" readonly
                                name="title_ar" class="form-control">
                        </div>


                        <div class="form-group col">
                            <label for="inputEmail4">{{ __('main_tans.Amount') }}</label>
                            <input type="number" value="{{ $fee_invoices->amount }}" name="amount"
                                class="form-control">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputAddress">{{ __('main_tans.note') }}</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{ $fee_invoices->description }}</textarea>
                    </div>
                    <br>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ __('main_tans.save_change') }}</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
