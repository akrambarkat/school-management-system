@extends('layouts.master')
@section('css')

@section('title')
    {{ __('main_tans.list_student') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.list_student') }}
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('main_tans.list_student') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a style="background-color: #84ba3f" href="{{ route('student.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{ trans('main_tans.add_student') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('main_tans.name_student') }}</th>
                                            <th>{{ trans('main_tans.email_parent') }}</th>
                                            <th>{{ trans('main_tans.gender') }}</th>
                                            <th>{{ trans('main_tans.grade_level') }}</th>
                                            <th>{{ trans('main_tans.classrome') }}</th>
                                            <th>{{ trans('main_tans.sections') }}</th>
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
                                                    <div class="dropdown show">
                                                        <a style="background-color: #84ba3f" class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                            role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ __('main_tans.action') }}
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item"
                                                                href="{{ route('student.show', $student->id) }}"><i
                                                                    style="color: #ffc107"
                                                                    class="far fa-eye "></i>&nbsp;{{ __('main_tans.show_data_student') }}
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('student.edit', $student->id) }}"><i
                                                                    style="color:green" class="fa fa-edit"></i>&nbsp;
                                                                {{ __('main_tans.edit_student') }}</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('Fees_Invoices.show', $student->id) }}"><i
                                                                    style="color: #0000cc" class="fa fa-edit"></i>&nbsp;
                                                                {{ __('main_tans.Add_invoice') }}&nbsp;</a>
                                                            <a class="dropdown-item"
                                                                data-target="#Delete_Student{{ $student->id }}"
                                                                data-toggle="modal"
                                                                href="#Delete_Student{{ $student->id }}"><i
                                                                    style="color: red" class="fa fa-trash"></i>&nbsp;
                                                                {{ __('main_tans.delete_student') }}</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('Receipt_Student.show', $student->id) }}"><i
                                                                    style="color: #9dc8e2"
                                                                    class="fas fa-money-bill-alt"></i>&nbsp; &nbsp; {{ __('main_tans.Deedofreceipt') }}</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('processing_fees.show', $student->id) }}"><i
                                                                    style="color: #9dc8e2"
                                                                    class="fas fa-money-bill-alt"></i>&nbsp;
                                                                &nbsp;{{ __('main_tans.Exclusion_of_fees') }}</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('Payment_Students.show', $student->id) }}"><i
                                                                    style="color:goldenrod"
                                                                    class="fas fa-donate"></i>&nbsp; &nbsp;{{ __('main_tans.Deed_of_exchange') }} </a>

                                                            <a class="dropdown-item"
                                                                href="#graduation{{ $student->id }}"
                                                                data-toggle="modal"
                                                                data-target="#graduation{{ $student->id }}"><i
                                                                    style="color: green"
                                                                    class="fas fa-user-graduate"></i>&nbsp;&nbsp;
                                                                {{ trans('main_tans.Student_graduation') }}</a>


                                                            {{-- <a class="dropdown-item"
                                                                data-target="#Delete_Student{{ $student->id }}"
                                                                data-toggle="modal"
                                                                href="##Delete_Student{{ $student->id }}"><i
                                                                    style="color: red" class="fa fa-trash"></i>&nbsp;
                                                                حذف بيانات الطالب</a> --}}


                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>

                                            <div class="modal fade" id="graduation{{ $student->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">
                                                                {{ __('main_tans.Student_graduation') }}</h5>

                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ __('main_tans.sure_Student_graduation') }}</p>
                                                            <input type="text" name="student_id"
                                                                value="{{ $student->trans_name }}" disabled>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('main_tans.close_btn') }}</button>
                                                            <form id="deleteForm"
                                                                action="{{ route('student.destroy', $student->id) }}"
                                                                method="POST">

                                                                @csrf
                                                                @method('delete')
                                                                <input type="hidden" name="page_id" value="2">
                                                                <button type="submit"
                                                                    class="btn btn-success">{{ __('main_tans.Student_graduation') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_Student{{ $student->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{ trans('main_tans.delete_confierm') }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('student.destroy', $student->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <input type="hidden" name="id"
                                                                    value="{{ $student->id }}">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">
                                                                    {{ trans('main_tans.delete_iteam') }}
                                                                </h5>
                                                                <input type="text" readonly
                                                                    value="{{ $student->trans_name }}"
                                                                    class="form-control">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('main_tans.close_btn') }}</button>
                                                                    <button
                                                                        class="btn btn-danger">{{ trans('main_tans.delete_confierm') }}</button>
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
