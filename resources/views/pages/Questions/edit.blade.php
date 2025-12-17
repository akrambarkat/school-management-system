@extends('layouts.master')
@section('css')

@section('title')
    {{ __('main_tans.edit_questions') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.edit_questions') }}

            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.edit_questions') }}

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
                        <form action="{{ route('Questions.update', $question->id) }}" method="post" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <div class="form-row">

                                <div class="col">
                                    <label for="title"> {{ __('main_tans.questions') }} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" id="input-name"
                                        class="form-control form-control-alternative" value="{{ $question->title }}">
                                    <input type="hidden" name="id" value="{{ $question->id }}">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ __('main_tans.answer') }} : <span
                                            class="text-danger">*</span></label>
                                    <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="4">{{ $question->answers }}</textarea>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ __('main_tans.righte_answer') }} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="right_answer" id="input-name"
                                        class="form-control form-control-alternative"
                                        value="{{ $question->right_answer }}">
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
                                                <option value="{{ $quizze->id }}"
                                                    {{ $quizze->id == $question->quizze_id ? 'selected' : '' }}>
                                                    {{ $quizze->trans_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ __('main_tans.mark') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="score">
                                            <option selected disabled>{{ __('main_tans.select_of_list') }}...</option>
                                            <option value="1" {{ $question->score == 1 ? 'selected' : '' }}>1
                                            </option>
                                            <option value="2" {{ $question->score == 2 ? 'selected' : '' }}>2
                                            </option>
                                            <option value="3" {{ $question->score == 3 ? 'selected' : '' }}>3
                                            </option>
                                            <option value="4" {{ $question->score == 4 ? 'selected' : '' }}>4
                                            </option>
                                            <option value="5" {{ $question->score == 5 ? 'selected' : '' }}>5
                                            </option>
                                            <option value="10" {{ $question->score == 10 ? 'selected' : '' }}>10
                                            </option>

                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ __('main_tans.save_change') }}</button>
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
