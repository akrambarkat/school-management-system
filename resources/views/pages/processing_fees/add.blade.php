@extends('layouts.master')
@section('css')
@section('title')
    {{ __('main_tans.Exclusion_of_fees') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            {{ __('main_tans.Exclusion_of_fees') }} : {{ $student->trans_name }}
            <h4 class="mb-0">
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.Exclusion_of_fees') }}

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

                <form method="post" action="{{ route('processing_fees.store') }}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('main_tans.Amount') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="Debit" type="number">
                                <input type="hidden" name="student_id" value="{{ $student->id }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('main_tans.Student_balance') }} : </label>
                                <input class="form-control" name="final_balance"
                                    value="{{ number_format($student->student_account->sum('Debit') - $student->student_account->sum('credit'), 2) }}"
                                    type="text" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('main_tans.Statement') }} : <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ trans('main_tans.sure') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')


@endsection
