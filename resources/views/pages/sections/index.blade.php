@extends('layouts.master')
@section('css')

@section('title')
    {{ __('main_tans.section_list') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.section_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="" class="default-color">{{ __('main_tans.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('main_tans.sections') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<html lang="{{ app()->getLocale() }}">

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">


            <div class="card-body">
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                    {{ __('main_tans.add_new_section') }}</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">

                        @foreach ($Grades as $Grade)
                            <div class="acd-group">

                                <a href="#" class="acd-heading">{{ $Grade->trans_name }}</a>
                                <div class="acd-des">

                                    <div class="row">
                                        <div class="col-xl-12 mb-30">
                                            <div class="card card-statistics h-100">
                                                <div class="card-body">
                                                    <div class="d-block d-md-flex justify-content-between">
                                                        <div class="d-block">
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ __('main_tans.name_section') }}
                                                                    </th>
                                                                    <th>{{ __('main_tans.name_class') }}</th>
                                                                    <th>{{ __('main_tans.status') }}</th>
                                                                    <th>{{ __('main_tans.action') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i = 0; ?>
                                                                @foreach ($Grade->sections as $x)
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $x->trans_name }}</td>
                                                                        <td>{{ $x->class_room->trans_name }}</td>

                                                                        <td>
                                                                            @if ($x->status == 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ trans('main_tans.active') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ trans('main_tans.inactive') }}</label>
                                                                            @endif

                                                                        </td>
                                                                        <td>

                                                                            <a href="#"
                                                                                class="btn btn-outline-info btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#edit{{ $x->id }}">{{ trans('main_tans.edit') }}</a>
                                                                            <a href="#"
                                                                                class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#delete{{ $x->id }}">{{ trans('main_tans.delete') }}</a>
                                                                        </td>
                                                                    </tr>

                                                                    <!--تعديل قسم جديد -->
                                                                    <div class="modal fade"
                                                                        id="edit{{ $x->id }}" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                {{-- @dump($list_Grades) --}}
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        style="font-family: 'Cairo', sans-serif;"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('main_tans.edit_section') }}
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <form
                                                                                        action="{{ route('sections.update', $x->id) }}"
                                                                                        method="POST">
                                                                                        @method('put')
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                    name="Name_Section_Ar"
                                                                                                    class="form-control"
                                                                                                    value="{{ $x->name_ar }}"
                                                                                                    placeholder="{{ __('main_tans.name_section_ar') }}">
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                    name="Name_Section_En"
                                                                                                    class="form-control"
                                                                                                    value="{{ $x->name_en }}"
                                                                                                    placeholder="{{ __('main_tans.name_section_en') }}">
                                                                                                <input id="id"
                                                                                                    type="hidden"
                                                                                                    name="id"
                                                                                                    class="form-control"
                                                                                                    value="{{ $x->id }}">
                                                                                            </div>

                                                                                        </div>
                                                                                        <br>


                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                class="control-label">{{ trans('main_tans.name') }}</label>
                                                                                            <select id="edit_grade_id"
                                                                                                name="edit_grade_id"
                                                                                                class="custom-select"
                                                                                                onchange="console.log($(this).val())">
                                                                                                <!--placeholder-->
                                                                                                <option
                                                                                                    value="{{ $x->id }}"
                                                                                                    disabled selected>
                                                                                                    {{ $x->grade->trans_name }}
                                                                                                </option>
                                                                                                @foreach ($list_Grades as $list_Grade)
                                                                                                    <option
                                                                                                        value="{{ $list_Grade->id }}">
                                                                                                        {{ $list_Grade->trans_name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                class="control-label">{{ trans('main_tans.name_class') }}</label>
                                                                                            <select
                                                                                                id="edit_classroom_id"
                                                                                                name="edit_classroom_id"
                                                                                                class="custom-select">
                                                                                                <option
                                                                                                    value="{{ $x->class_room->id }}">
                                                                                                    {{ $x->class_room->trans_name }}
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>
                                                                                        <style>
                                                                                            .form-check-label {
                                                                                                font-weight: bold;
                                                                                                color: #28a745;
                                                                                                /* لون أخضر للحالة المفعّلة */
                                                                                            }

                                                                                            .form-check-input:checked+.form-check-label {
                                                                                                color: #28a745;
                                                                                            }

                                                                                            .form-check-input:not(:checked)+.form-check-label {
                                                                                                color: #dc3545;
                                                                                                /* لون أحمر للحالة غير المفعّلة */
                                                                                            }
                                                                                        </style>

                                                                                        <div class="col">
                                                                                            <div class="form-check">

                                                                                                <input type="checkbox"
                                                                                                    id="status"
                                                                                                    name="Status"
                                                                                                    class="form-check-input"
                                                                                                    {{ $x->status == 1 ? 'checked' : '' }}>
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="status">
                                                                                                    {{ $x->status == 1 ? '✔ مفعل' : 'غير مفعل' }}
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                class="control-label">{{ trans('list_techers') }}</label>
                                                                                            <select multiple
                                                                                                name="teacher_id[]"
                                                                                                class="form-control"
                                                                                                id="exampleFormControlSelect2">
                                                                                                @foreach ($x->teachers as $teacher)
                                                                                                    <option selected
                                                                                                        value="{{ $teacher['id'] }}">
                                                                                                        {{ $teacher->trans_name }}
                                                                                                    </option>
                                                                                                @endforeach

                                                                                                @foreach ($teachers as $teacher)
                                                                                                    <option
                                                                                                        value="{{ $teacher->id }}">
                                                                                                        {{ $teacher->trans_name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>


                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">{{ trans('main_tans.close_btn') }}</button>
                                                                                    <button style="background-color: #84ba3f" type="submit"
                                                                                        class="btn btn-success">{{ trans('main_tans.edit') }}</button>
                                                                                </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <!-- delete_modal_Grade -->
                                                                    <div class="modal fade"
                                                                        id="delete{{ $x->id }}" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                        class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('main_tans.delete_confierm') }}
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ route('sections.destroy', 'test') }}"
                                                                                        method="post">
                                                                                        @method('delete')
                                                                                        @csrf
                                                                                        {{ trans('main_tans.delete_iteam') }}
                                                                                        <input id="id"
                                                                                            type="hidden"
                                                                                            name="id"
                                                                                            class="form-control"
                                                                                            value="{{ $x->id }}">
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ trans('main_tans.close_btn') }}</button>
                                                                                            <button type="submit"
                                                                                                class="btn btn-danger">{{ trans('main_tans.sure') }}</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!--اضافة قسم جديد -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                {{ __('main_tans.add_new_section') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('sections.store') }}" method="POST">

                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="Name_Section_Ar" class="form-control"
                                            placeholder="{{ __('main_tans.name_section_ar') }}">
                                    </div>

                                    <div class="col">
                                        <input type="text" name="Name_Section_En" class="form-control"
                                            placeholder="{{ __('main_tans.name_section_en') }}">
                                    </div>

                                </div>
                                <br>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ trans('main_tans.grade_level') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="grade_id">
                                            <option selected disabled>{{ trans('main_tans.select_of_list') }}...
                                            </option>
                                            @foreach ($list_Grades as $c)
                                                <option value="{{ $c->id }}">
                                                    {{ $c->trans_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('Grade_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Classroom_id">{{ trans('main_tans.classes') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="Classroom_id">

                                        </select>
                                        @error('Classroom_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="col">
                                    <label for="inputName"
                                        class="control-label">{{ trans('main_tans.list_techers') }}</label>
                                    <select multiple name="teacher_id[]" class="form-control"
                                        id="exampleFormControlSelect2">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->trans_name }}</option>
                                        @endforeach
                                    </select>
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

        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('select[name="grade_id"]').on('change', function() {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "{{ url('Get_classrooms') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    headers: {
                        'X-localization': '{{ app()->getLocale() }}' // 👈 إرسال اللغة الحالية
                    },
                    success: function(data) {
                        var options =
                            '<option selected disabled>{{ trans("main_tans.select_of_list") }}</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + key + '">' + value + '</option>';
                        });
                        $('select[name="Classroom_id"]').html(options);
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


<script>

    $('select[name="edit_grade_id"]').on('change', function () {
    var grade_id = $(this).val();
    if (grade_id) {
        $.ajax({
            url: "{{ url('Get_classrooms') }}/" + grade_id,
            type: "GET",
            dataType: "json",
            headers: {
                'X-localization': '{{ app()->getLocale() }}'
            },
            success: function (data) {
                var options = '<option selected disabled>{{ trans("main_tans.select_of_list") }}</option>';
                $.each(data, function (key, value) {
                    options += '<option value="' + key + '">' + value + '</option>';
                });
                $('select[name="edit_classroom_id"]').html(options); // ← تأكد من هذا أيضًا
            }
        });
    } else {
        console.log('AJAX load did not work');
    }
});

</script>
@endsection
