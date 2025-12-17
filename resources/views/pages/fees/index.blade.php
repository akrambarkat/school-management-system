@extends('layouts.master')
@section('css')
@section('title')
    {{ __('main_tans.Tuition_fees') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.Tuition_fees') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('main_tans.Tuition_fees') }}</li>
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

                    <div class="card-body">
                        <a href="{{ route('fees.create') }}"><button type="button" class="btn btn-success"
                                data-toggle="modal">
                                {{ __('main_tans.add_new_fee') }}
                            </button></a><br><br>
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr class="alert-success">
                                        <th>#</th>
                                        <th>{{ __('main_tans.name_student') }}</th>
                                        <th>{{ __('main_tans.Amount') }}</th>
                                        <th>{{ __('main_tans.grade_student') }}</th>
                                        <th>{{ __('main_tans.class_student') }}</th>
                                        <th>{{ __('main_tans.academic_year') }}</th>
                                        <th>{{ __('main_tans.note') }}</th>
                                        <th>{{ __('main_tans.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fees as $fee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $fee->trans_name }}</td>
                                            <td>{{ number_format($fee->amount, 2) }}</td>
                                            <td>{{ $fee->grade->trans_name }}</td>
                                            <td>{{ $fee->classroom->trans_name }}</td>
                                            <td>{{ $fee->year }}</td>
                                            <td>{{ $fee->description }}</td>
                                            <td>
                                                <a href="{{ route('fees.edit', $fee->id) }}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#Delete_Fee{{ $fee->id }}"
                                                    title="{{ trans('Grades_trans.Delete') }}"><i
                                                        class="fa fa-trash"></i></button>
                                                <a href="{{ route('show_fees', $fee->id) }}"
                                                    class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i
                                                        class="far fa-eye"></i></a>

                                            </td>

                                        </tr>
                                        <!-- Deleted inFormation Student -->
                                        <div class="modal fade" id="Delete_Fee{{ $fee->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">
                                                            {{ trans('main_tans.delete_confierm') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('fees.destroy', $fee->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <h5 style="font-family: 'Cairo', sans-serif;">
                                                                {{ __('main_tans.delete_iteam') }}</h5>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('main_tans.close_btn') }}</button>
                                                                <button
                                                                    class="btn btn-danger">{{ trans('main_tans.sure') }}</button>
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
<!-- row closed -->
@endsection
@section('js')

@endsection
