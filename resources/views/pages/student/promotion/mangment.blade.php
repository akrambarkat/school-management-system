@extends('layouts.master')
@section('css')


@section('title')
    {{ trans('main_tans.Student_promotion_management') }}
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.Student_promotion_management') }}
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.Student_promotion_management') }}
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.list_students') }}
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

                            <!-- الزر -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                {{ __('main_tans.all_back') }}
                            </button>




                            <br><br>


                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{ trans('main_tans.name_student') }}</th>
                                            <th class="alert-danger">{{ __('main_tans.old_grade') }}</th>
                                            <th class="alert-danger">{{ __('main_tans.old_year') }}</th>
                                            <th class="alert-danger">{{ __('main_tans.old_class') }}</th>
                                            <th class="alert-danger">{{ __('main_tans.old_section') }}</th>
                                            <th class="alert-success">{{ __('main_tans.New_grade') }}</th>
                                            <th class="alert-success">{{ __('main_tans.New_year') }}</th>
                                            <th class="alert-success">{{ __('main_tans.New_class') }}</th>
                                            <th class="alert-success">{{ __('main_tans.New_sectio') }}</th>
                                            <th>{{ trans('main_tans.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $promotion->student->trans_name }}</td>
                                                <td>{{ $promotion->fromGrade->trans_name }}</td>
                                                <td>{{ $promotion->academic_year }}</td>
                                                <td>{{ $promotion->fromClassRoom->trans_name }}</td>
                                                <td>{{ $promotion->fromSection->trans_name }}</td>
                                                <td>{{ $promotion->toGrade->trans_name }}</td>
                                                <td>{{ $promotion->academic_year_new }}</td>
                                                <td>{{ $promotion->toClassRoom->trans_name }}</td>
                                                <td>{{ $promotion->toSection->trans_name }}</td>
                                                <td>


                                                    <div
                                                        style="display: flex; justify-content: space-between; gap: 10px;">

                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            onclick="openDeleteModal({{ $promotion->id }})"
                                                            title="{{ trans('main_tans.delete') }}">{{ __('main_tans.back_student') }}</button>
                                                        <button type="button" class="btn btn-outline-success"
                                                            data-toggle="modal"
                                                            data-target="#graduation{{ $promotion->id }}">{{ __('main_tans.Student_graduation') }}</button>
                                                    </div>
                                                </td>
                                            </tr>




                                            <div class="modal fade" id="graduation{{ $promotion->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">
                                                                {{ __('main_tans.back_student') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ __('main_tans.sure_bake') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('main_tans.close_btn') }}</button>
                                                            <form id="deleteForm"
                                                                action="{{ route('Promotion.edit', $promotion->id) }}"
                                                                method="POST">
                                                                @csrf


                                                                <input type="text" name="id"
                                                                    value="{{ $promotion->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-danger">{{ __('main_tans.delete_confierm') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- row closed -->



                                            <div class="modal fade" id="deleteModal" tabindex="-1"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">
                                                                {{ __('main_tans.back_student') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ __('main_tans.sure_bake') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('main_tans.close_btn') }}</button>
                                                            <form id="deleteForm"
                                                                action="{{ route('Promotion.destroy', $promotion->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="page_id" value="2">
                                                                <input type="hidden" id="deleteItemId"
                                                                    name="id">
                                                                <button type="submit"
                                                                    class="btn btn-danger">{{ __('main_tans.delete_confierm') }}</button>
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
@if ($promotions->isNotempty())
    {{-- delete iteam --}}
@endif

<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('main_tans.all_back') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Promotion.destroy', 'test') }}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="page_id" value="1">
                    <h5 style="font-family: 'Cairo', sans-serif;">{{ __('main_tans.sure_all_bake') }}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('main_tans.close_btn') }}</button>
                        <button class="btn btn-danger">{{ trans('main_tans.sure') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
@section('js')
<script>
    function openDeleteModal(id) {
        document.getElementById('deleteItemId').value = id;
    }
</script>



@endsection
