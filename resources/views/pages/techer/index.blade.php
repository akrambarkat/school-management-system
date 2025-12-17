@extends('layouts.master')
@section('css')

@section('title')
    {{ __('main_tans.list_techers') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.list_techers') }}
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('main_tans.list_techers') }}</li>
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
                <a href="{{ route('teacher.create') }}"><button type="button" class="btn btn-success"
                        data-toggle="modal">
                        {{ __('main_tans.add_techer') }}
                    </button></a>

                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-success">
                                <th>#</th>
                                <th>{{ trans('main_tans.name_teacher') }}</th>
                                <th>{{ trans('main_tans.email_parent') }}</th>
                                <th>{{ trans('main_tans.National_ID') }}</th>
                                <th>{{ trans('main_tans.phone_parent') }}</th>
                                <th>{{ trans('main_tans.Specialization') }}</th>
                                <th>{{ trans('main_tans.Joining_Date') }}</th>
                                <th>{{ trans('main_tans.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($techer as $x)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $x->trans_name }}</td>
                                    <td>{{ $x->email }}</td>
                                    <td>{{ $x->National_ID }}</td>
                                    <td>{{ $x->phone }}</td>
                                    <td>{{ $x->specialization->trans_name }}</td>
                                    <td>{{ $x->joining_data }}</td>
                                    <td>
                                        <a href="{{ route('teacher.edit', $x->id) }}">
                                            <button type="button" class="btn btn-success">
                                                {{ __('main_tans.edit') }}
                                            </button>
                                        </a>

                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteModal" onclick="openDeleteModal({{ $x->id }})">
                                            {{ __('main_tans.delete') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>



@if ($techer->isnotempty())
    {{-- delete iteam --}}

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('main_tans.delete_confierm') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('main_tans.delete_iteam') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('main_tans.close_btn') }}</button>
                    <form id="deleteForm" action="{{ route('teacher.destroy', $x->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteItemId" name="id">
                        <button type="submit" class="btn btn-danger">{{ __('main_tans.delete_confierm') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- row closed -->
@endsection
@section('js')

<script>
    function openDeleteModal(id) {
        document.getElementById('deleteItemId').value = id;
    }
</script>

@endsection
