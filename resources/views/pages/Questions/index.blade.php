@extends('layouts.master')
@section('css')

@section('title')
    {{ __('main_tans.List_of_questions') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.List_of_questions') }}

            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.List_of_questions') }}

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
                        <a href="{{ route('Questions.create') }}"><button type="button" class="btn btn-success"
                                data-toggle="modal">
                                {{ __('main_tans.add_new_questions') }}
                            </button></a><br><br>
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('main_tans.questions') }}</th>
                                        <th scope="col">{{ __('main_tans.answer') }}</th>
                                        <th scope="col">{{ __('main_tans.righte_answer') }}</th>
                                        <th scope="col">{{ __('main_tans.mark') }}</th>
                                        <th scope="col">{{ __('main_tans.name_ecms') }}</th>
                                        <th scope="col">{{ __('main_tans.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $question->title }}</td>
                                            <td>{{ $question->answers }}</td>
                                            <td>{{ $question->right_answer }}</td>
                                            <td>{{ $question->score }}</td>
                                            <td>{{ $question->quiz->trans_name }}</td>
                                            <td>
                                                <a href="{{ route('Questions.edit', $question->id) }}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_exam{{ $question->id }}" title="حذف"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        @include('pages.Questions.destroy')
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
