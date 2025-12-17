@extends('layouts.master')
@section('css')
@section('title')
    {{ __('main_tans.List_of_books') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.List_of_books') }}

            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.List_of_books') }}

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
                        <a href="{{ route('Library.create') }}"><button type="button" class="btn btn-success"
                                data-toggle="modal">
                                {{ __('main_tans.add_new_books') }}
                            </button></a><br><br>
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('main_tans.name_books') }}</th>
                                        <th>{{ __('main_tans.grade_student') }}</th>
                                        <th>{{ __('main_tans.class_student') }}</th>
                                        <th>{{ __('main_tans.section_student') }}</th>
                                        <th>{{ __('main_tans.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->grade->trans_name }}</td>
                                            <td>{{ $book->classroom->trans_name }}</td>
                                            <td>{{ $book->section->trans_name }}</td>
                                            <td>
                                                <a href="{{ route('downloadAttachment', $book->file_name) }}"
                                                    title="تحميل الكتاب" class="btn btn-warning btn-sm" role="button"
                                                    aria-pressed="true"><i class="fas fa-download"></i></a>
                                                <a href="{{ route('Library.edit', $book->id) }}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_book{{ $book->id }}" title="حذف"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        @include('pages.library.destroy')
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
