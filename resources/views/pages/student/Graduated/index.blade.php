@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('main_tans.list_Graduate') }}
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.list_Graduate') }} <i class="fas fa-user-graduate"></i>
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.list_Graduate') }}
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.list_Graduate') }} <i class="fas fa-user-graduate"></i>
@stop
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
                                            <th>{{ trans('main_tans.name_student') }}</th>
                                            <th>{{ trans('main_tans.email_parent') }}</th>
                                            <th>{{ trans('main_tans.gender') }}</th>
                                            <th>{{ trans('main_tans.grade_student') }}</th>
                                            <th>{{ trans('main_tans.class_student') }}</th>
                                            <th>{{ trans('main_tans.section_student') }}</th>
                                            <th>{{ trans('main_tans.action') }}</th>
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
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#Return_Student{{ $student->id }}">{{ __('main_tans.back_student') }}</button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#deleteModal{{ $student->id }}"
                                                        title="{{ trans('main_tans.delete_std') }}">{{ trans('main_tans.delete_std') }}</button>

                                                </td>
                                            </tr>





                                            <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{ __('main_tans.delete_confierm') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('Graduated.destroy', $student->id) }}"
                                                                method="post" autocomplete="off">
                                                                @method('delete')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $student->id }}">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">
                                                                    {{ __('main_tans.force_delete') }}</h5>
                                                                <input type="text" readonly
                                                                    value="{{ $student->trans_name }}"
                                                                    class="form-control">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('main_tans.close_btn') }}</button>
                                                                    <button
                                                                        class="btn btn-danger">{{ __('main_tans.delete_confierm') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Return_Student{{ $student->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{ __('main_tans.back_student') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('Graduated.update', $student->id) }}"
                                                                method="post" autocomplete="off">
                                                                @method('PUT')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $student->id }}">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">
                                                                    {{ __('main_tans.sure_ok') }}</h5>
                                                                <input type="text" readonly
                                                                    value="{{ $student->trans_name }}"
                                                                    class="form-control">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('main_tans.close_btn') }}</button>
                                                                    <button
                                                                        class="btn btn-success">{{ trans('main_tans.back_student') }}</button>
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
<script>
    function openDeleteModal(id) {
        document.getElementById('deleteItemId').value = id;
    }
</script>

@endsection
