@extends('layouts.master')
@section('css')
@section('title')
    {{ __('main_tans.List_of_subjects') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.List_of_subjects') }}

            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.List_of_subjects') }}

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
                    <div class="card-body">
                        <a href="{{ route('Subjects.create') }}"><button type="button" class="btn btn-success"
                                data-toggle="modal">
                                {{ __('main_tans.add_subject') }}
                            </button></a><br><br>
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('main_tans.name_sunj') }}</th>
                                        <th>{{ __('main_tans.grade_student') }}</th>
                                        <th>{{ __('main_tans.New_class') }}</th>
                                        <th>{{ __('main_tans.name_teacher') }}</th>
                                        <th>{{ __('main_tans.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subject->trans_name }}</td>
                                            <td>{{ $subject->grade->trans_name }}</td>
                                            <td>{{ $subject->classroom->trans_name }}</td>
                                            <td>{{ $subject->teacher->trans_name }}</td>
                                            <td>
                                                <a href="{{ route('Subjects.edit', $subject->id) }}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_subject{{ $subject->id }}" title="حذف"><i
                                                        class="fa fa-trash"></i></button>

                                            </td>
                                        </tr>

                                        <div class="modal fade" id="delete_subject{{ $subject->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('Subjects.destroy', $subject->id) }}"
                                                    method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
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
                                                            <p> {{ trans('main_tans.delete_iteam') }}
                                                                {{ $subject->trans_name }}</p>
                                                            <input type="hidden" name="id"
                                                                value="{{ $subject->id }}">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('main_tans.close_btn') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">{{ trans('main_tans.delete_confierm') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
    <!-- row closed -->
@endsection
@section('js')

@endsection
