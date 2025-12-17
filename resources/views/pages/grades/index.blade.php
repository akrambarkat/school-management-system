@extends('layouts.master')
@section('css')
@endsection
@section('title')
    {{ __('main_tans.grade_list') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ __('main_tans.grade_level') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('main_tans.grade_level') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <div class="row">


        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button style="background-color: #84ba3f" type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">
                        {{ __('main_tans.add_new_stage') }}
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main_tans.name') }}</th>
                                    <th>{{ __('main_tans.note') }}</th>
                                    <th>{{ __('main_tans.action') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grade as $x)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $x->trans_name }}</td>
                                        <td>{{ $x->trans_notes }}</td>
                                        <td>
                                            <button style="background-color: #84ba3f" type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#editModal"
                                                onclick="openEditModal({{ $x->id }},
                                                '{{ $x->name_ar }}','{{ $x->name_en }}',
                                                '{{ $x->notes_ar }}', '{{ $x->notes_en }}')">
                                                {{ __('main_tans.edit') }}
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal" onclick="openDeleteModal({{ $x->id }})">
                                                {{ __('main_tans.delete') }}
                                            </button>


                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- add iteam --}}

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">{{ __('main_tans.add_new_stage') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- حقل الاسم باللغتين -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name_en">{{ __('main_tans.name_en') }}</label>
                                <input type="text" class="form-control" id="name_en" name="name_en">
                            </div>
                            <div class="col-md-6">
                                <label for="name_ar">{{ __('main_tans.name_ar') }}</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar">
                            </div>
                        </div>

                        <!-- حقل الملاحظات باللغتين -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="notes_en">{{ __('main_tans.note_en') }}</label>
                                <input type="text" class="form-control" id="notes_en" name="notes_en" rows="3">
                            </div>
                            <div class="col-md-6">
                                <label for="notes_ar">{{ __('main_tans.note_ar') }}</label>
                                <input type="text" class="form-control" id="notes_ar" name="notes_ar" rows="3">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('main_tans.close_btn') }}</button>
                        <button style="background-color: #84ba3f" type="submit" class="btn btn-success">{{ __('main_tans.add_btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    @if ($grade->isnotempty())
        {{-- edit iteam --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">{{ __('main_tans.edit_iteam') }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm" action="{{ route('grades.update', $x->id) }}" method="POST">
                        @csrf
                        @method('PUT')


                        <div class="modal-body">
                            <!-- حقل الاسم باللغتين -->
                            <div class="form-group row">
                                <input type="hidden" id="itemId" name="id">

                                <div class="col-md-6">
                                    <label for="name-en">{{ __('main_tans.name_en') }}</label>
                                    <input type="text" class="form-control" id="NameEn" name="name_en" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name-ar">{{ __('main_tans.name_ar') }}</label>
                                    <input type="text" class="form-control" id="NameAr" name="name_ar" required>
                                </div>


                            </div>

                            <!-- حقل الملاحظات باللغتين -->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="notes_en">{{ __('main_tans.note_en') }}</label>
                                    <input type="text" class="form-control" id="NotesEn" name="notes_en" rows="3">
                                </div>
                                <div class="col-md-6">
                                    <label for="notes_ar">{{ __('main_tans.note_ar') }}</label>
                                    <input type="text" class="form-control" id="NotesAr" name="notes_ar" rows="3">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('main_tans.close_btn') }}</button>
                            <button style="background-color: #84ba3f" type="submit" class="btn btn-success">{{ __('main_tans.edit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



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
                        <form id="deleteForm" action="{{ route('grades.destroy', $x->id) }}" method="POST">
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
@endsection
@section('js')
    <Script>
        function openEditModal(id, name_ar, name_en, notes_ar, notes_en) {
            document.getElementById('itemId').value = id;

            document.getElementById('NameAr').value = name_ar;
            document.getElementById('NameEn').value = name_en;

            document.getElementById('NotesAr').value = notes_ar;
            document.getElementById('NotesEn').value = notes_en;
        }


        function openDeleteModal(id) {
            document.getElementById('deleteItemId').value = id;
        }
    </Script>
   
@endsection
