@extends('layouts.master')
@section('css')
@section('title')
    معالجات الرسوم الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            معالجات الرسوم الدراسية

            <h4 class="mb-0">
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> معالجات الرسوم الدراسية


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
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>المبلغ</th>
                                            <th>البيان</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ProcessingFees as $ProcessingFee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ProcessingFee->student->trans_name }}</td>
                                                <td>{{ number_format($ProcessingFee->amount, 2) }}</td>
                                                <td>{{ $ProcessingFee->description }}</td>
                                                <td>
                                                    <a href="{{ route('processing_fees.edit', $ProcessingFee->id) }}"
                                                        class="btn btn-info btn-sm" role="button"
                                                        aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#Delete_receipt{{ $ProcessingFee->id }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>


                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_receipt{{ $ProcessingFee->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">حذف رسوم
                                                                معالجة</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('processing_fees.destroy', $ProcessingFee->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="id"
                                                                    value="{{ $ProcessingFee->id }}">
                                                                <h5 style="font-family: 'Cairo', sans-serif;">هل انت
                                                                    متاكد مع عملية الحذف ؟</h5>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('Students_trans.Close') }}</button>
                                                                    <button
                                                                        class="btn btn-danger">{{ trans('Students_trans.submit') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

@endsection
