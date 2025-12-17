@extends('layouts.master')
@section('css')
@endsection
@section('title')
    {{ __('main_tans.listofclass') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ __('main_tans.classrome') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('main_tans.classrome') }}</li>
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
                    <button style="background-color: #84ba3f" type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#addModal">
                        {{ __('main_tans.add_new_room') }}
                    </button>
                    <button style="background-color: #84ba3f" type="button" class="btn btn-success" id="btn_delete_all">
                        {{ __('main_tans.delete_selected') }}
                    </button>
                    <br><br>
                    <form action="{{ route('search_iteam') }}" method="POST">
                        @csrf
                        <SElect class="selectpicker" data-style="btn-info" name="grade_id" required
                            onchange="this.form.submit()">
                            <option value="" selected disabled>{{ __('main_tans.search_by_name') }}</option>
                            @foreach ($grade as $x)
                                <option value="{{ $x->id }}">{{ $x->trans_name }}</option>
                            @endforeach
                        </SElect>
                    </form>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>

                                    <th><input name="select_all" id="example-select-all" type="checkbox"
                                            onclick="CheckAll('box1', this)" /></th>

                                    <th>#</th>

                                    <th>{{ __('main_tans.name_class') }}</th>
                                    <th>{{ __('main_tans.name') }}</th>
                                    <th>{{ __('main_tans.action') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($details)) {
                                    $list = $details;
                                } else {
                                    $list = $classRoom;
                                }
                                ?>

                                @foreach ($list as $x)
                                    <tr>
                                        <td><input type="checkbox" value="{{ $x->id }}" class="box1"></td>


                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $x->trans_name }}</td>
                                        <td>{{ $x->grade->trans_name }}</td>
                                        <td>
                                            <button style="background-color: #84ba3f" type="button" class="btn btn-success"
                                                data-toggle="modal" data-target="#editModal"
                                                onclick="openEditModal({{ $x->id }}, '{{ $x->name_ar }}', '{{ $x->name_en }}', '{{ $x->grade->trans_name }}')">
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

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ __('main_tans.add_new_room') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class=" row mb-30" action="{{ route('classroom.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>

                                        <div class="row">

                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">{{ __('main_tans.name_class_ar') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="name_ar" />
                                            </div>


                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">{{ __('main_tans.name_class_en') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="name_en" />
                                            </div>


                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ __('main_tans.grade_list') }}
                                                    :</label>

                                                <div class="box">
                                                    <select class="fancyselect" name="Grade_id">
                                                        @foreach ($grade as $x)
                                                            <option value="{{ $x->id }}">{{ $x->trans_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ __('main_tans.action') }}
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button" value="{{ __('main_tans.delete') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                            value="{{ __('main_tans.add_row') }}" />
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ __('main_tans.close_btn') }}</button>
                                    <button style="background-color: #84ba3f" type="submit"
                                        class="btn btn-success">{{ __('main_tans.add_btn') }}</button>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>

    </div>



    @if ($grade->isnotempty())
        {{-- edit iteam --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">{{ __('main_tans.edit_iteam') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm" action="{{ route('classroom.update', $x->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <input type="hidden" id="itemId" name="id">

                            <div class="form-group">
                                <label for="NameAr">{{ __('main_tans.name_ar') }}</label>
                                <input type="text" class="form-control" id="NameAr" name="name_ar" required>
                            </div>

                            <div class="form-group">
                                <label for="NameEn">{{ __('main_tans.name_en') }}</label>
                                <input type="text" class="form-control" id="NameEn" name="name_en" required>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="gradeid">{{ __('main_tans.grade_level') }}:</label>
                                    <select name="section_name" id="gradeid" class="form-control w-100"
                                        style="direction: rtl;" required>
                                        @foreach ($grade as $x)
                                            <option value="{{ $x->id }}">{{ $x->trans_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>






                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                {{ __('main_tans.close_btn') }}
                            </button>
                            <button style="background-color: #84ba3f" type="submit" class="btn btn-success">
                                {{ __('main_tans.edit') }}
                            </button>
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
                        <form id="deleteForm" action="{{ route('classroom.destroy', $x->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="deleteItemId" name="id">
                            <button type="submit" class="btn btn-danger">{{ __('main_tans.delete_confierm') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- delete selected --}}
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ __('main_tans.delete_confierm') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('delete_all') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            {{ __('main_tans.delete_iteam') }}
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id"
                                value=''>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('main_tans.close_btn') }}</button>
                            <button type="submit" class="btn btn-danger">{{ __('main_tans.delete_confierm') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('js')
    <Script>
        function openEditModal(id, name_ar, name_en, grade_name) {
            document.getElementById('itemId').value = id;
            document.getElementById('NameAr').value = name_ar;
            document.getElementById('NameEn').value = name_en;

            let select = document.getElementById('gradeid');
            for (let i = 0; i < select.options.length; i++) {
                if (select.options[i].text.trim() === grade_name.trim()) {
                    select.selectedIndex = i;
                    break;
                }
            }
        }


        function openDeleteModal(id) {
            document.getElementById('deleteItemId').value = id;
        }
    </Script>

    <script>
        function CheckAll(className, elem) {
            var elements = document.getElementsByClassName(className);
            var l = elements.length;

            if (elem.checked) {
                for (var i = 0; i < l; i++) {
                    elements[i].checked = true;
                }
            } else {
                for (var i = 0; i < l; i++) {
                    elements[i].checked = false;
                }
            }
        }
    </script>
    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>
@endsection
