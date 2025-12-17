@extends('layouts.master')
@section('css')
@section('title')
    {{ __('main_tans.add_new_questions') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.add_new_questions') }}

            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.add_new_questions') }}

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

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('Questions.store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-row">

                                <div class="col">
                                    <label for="title"> {{ __('main_tans.questions') }} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" id="input-name"
                                        class="form-control form-control-alternative" autofocus>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ __('main_tans.answer') }} : <span
                                            class="text-danger">*</span></label>
                                    <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ __('main_tans.righte_answer') }} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="right_answer" id="input-name"
                                        class="form-control form-control-alternative" autofocus>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ __('main_tans.name_ecms') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="quizze_id">
                                            <option selected disabled>{{ __('main_tans.select_of_list') }}...</option>
                                            @foreach ($quizzes as $quizze)
                                                <option value="{{ $quizze->id }}">{{ $quizze->trans_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ __('main_tans.mark') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="score">
                                            <option selected disabled>{{ __('main_tans.select_of_list') }} ...</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ __('main_tans.sure') }}</button>
                        </form>
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
