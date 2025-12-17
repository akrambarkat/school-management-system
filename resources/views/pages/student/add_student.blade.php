@extends('layouts.master')
@section('css')
    <Style>
        select.form-control {
            font-size: 14px;
            color: #333;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 5px;
        }

        select.form-control option {
            color: #000;
            background-color: #fff;
        }

        .match {
            color: green;
        }

        .no-match {
            color: red;
        }
    </Style>


@section('title')
    {{ __('main_tans.add_student') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.add_student') }}
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.add_student') }}
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

                <h5 style="color: blue">{{ __('main_tans.personal_information') }}</h5><br>
                <form  action="{{ route('student.store') }}" method="POST" autocomplete="off"
                    enctype="multipart/form-data">

                    @csrf
                    <div class="modal-body">
                        <!-- حقل الاسم باللغتين -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name_ar">{{ __('main_tans.name_student_ar') }}</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar"
                                    value="{{ old('name_ar') }}">
                                @error('name_ar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name_en">{{ __('main_tans.name_student_en') }}</label>
                                <input type="text" class="form-control" id="name_en" name="name_en"
                                    value="{{ old('name_en') }}">
                                @error('name_en')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="notes_en">{{ __('main_tans.email_parent') }}</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="notes_ar">{{ __('main_tans.password_parent') }}</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="password_confirmation">{{ __('main_tans.password_confirmation') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <small id="passwordMessage" class="form-text"></small> <!-- مكان الرسالة -->
                            </div>
                        </div>


                        <div class="form-group row">

                            <div class="col-md-3">
                                <label for="notes_en">{{ __('main_tans.National_ID') }}</label>
                                <input type="number" name="National_ID" id="National_ID" class="form-control"
                                    value="{{ old('National_ID') }}">
                                @error('National_ID')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('main_tans.DOB') }} :</label>
                                    <input class="form-control" type="text" id="datepicker-action" name="Date_Birth"
                                        data-date-format="yyyy-mm-dd" value="{{ old('Date_Birth') }}">
                                    @error('Date_Birth')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="notes_en">{{ __('main_tans.gender') }}</label>
                                <select name="gender_id" id="gender_id" class="form-control">
                                    <option value="" selected disabled>{{ __('main_tans.select_of_list') }}
                                    </option>
                                    @foreach ($gender as $x)
                                        <option value="{{ $x->id }}"
                                            {{ old('gender_id') == $x->id ? 'selected' : '' }}>{{ $x->trans_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="notes_en">{{ __('main_tans.Religion') }}</label>
                                <select name="Religion" id="Religion" class="form-control">
                                    <option value="" selected disabled>{{ __('main_tans.select_of_list') }}
                                    </option>
                                    @foreach ($religion as $x)
                                        <option value="{{ $x->id }}"
                                            {{ old('Religion') == $x->id ? 'selected' : '' }}>{{ $x->trans_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Religion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="notes_en">{{ __('main_tans.Nationality') }}</label>
                                <select name="Nationality" id="Nationality" class="form-control">
                                    <option value="" selected disabled>{{ __('main_tans.select_of_list') }}
                                    </option>

                                    @foreach ($Nationalitie as $x)
                                        <option value="{{ $x->id }}"
                                            {{ old('Nationality') == $x->id ? 'selected' : '' }}>
                                            {{ $x->trans_name }}</option>
                                    @endforeach
                                </select>
                                @error('Nationality')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <h5 style="color: blue">{{ __('main_tans.student_information') }}</h5><br>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{ trans('main_tans.grade_level') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Grade_id">
                                        <option selected disabled>{{ trans('main_tans.select_of_list') }}...</option>
                                        @foreach ($my_classes as $c)
                                            <option value="{{ $c->id }}">
                                                {{ $c->trans_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Grade_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-2">
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

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{ trans('main_tans.sections') }} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">

                                    </select>
                                    @error('section_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{ trans('main_tans.Parents') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>{{ trans('main_tans.select_of_list') }}...</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->trans_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{ trans('main_tans.academic_year') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year">
                                        <option selected disabled>{{ trans('main_tans.select_of_list') }}...</option>
                                        @php
                                            $current_year = date('Y');
                                        @endphp
                                        @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('academic_year')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div><br>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{ trans('Students_trans.Attachments') }} : <span
                                        class="text-danger">*</span></label>
                                <input type="file" accept="image/*" name="photos[]" multiple>
                            </div>
                        </div>






                        <button style="background-color: #84ba3f" type="submit" class="btn btn-success">{{ __('main_tans.add_btn') }}</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const message = document.getElementById('passwordMessage');

        function checkPasswords() {
            if (password.value === '' || passwordConfirmation.value === '') {
                message.textContent = ''; // لا رسالة إذا كانت الحقول فارغة
                return;
            }

            if (password.value === passwordConfirmation.value) {
                message.textContent = 'كلمة المرور متطابقة ✅';
                message.classList.remove('text-danger');
                message.classList.add('text-success');
            } else {
                message.textContent = 'كلمة المرور غير متطابقة ❌';
                message.classList.remove('text-success');
                message.classList.add('text-danger');
            }
        }

        // إضافة استماع للأحداث عند الكتابة في كلا الحقلين
        password.addEventListener('keyup', checkPasswords);
        passwordConfirmation.addEventListener('keyup', checkPasswords);
    });
</script>

<script>
    $(document).ready(function() {
        $('select[name="Grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ url('Get_classrooms') }}/" + Grade_id,
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
    $(document).ready(function() {
        $('select[name="Classroom_id"]').on('change', function() {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>



<script>
    $(document).ready(function () {
        $('#addStudentForm').on('submit', function (e) {
            e.preventDefault(); // منع الإرسال التقليدي

            var formData = new FormData(this); // أخذ كل بيانات الفورم بما فيها الصور

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // يمكنك عرض لودر هنا إن أردت
                },
                success: function (response) {
                    // في حال النجاح
                    Swal.fire({
                        title: 'تمت الإضافة',
                        text: 'تم إضافة الطالب بنجاح!',
                        icon: 'success',
                        confirmButtonText: 'حسناً'
                    });

                    // تفريغ الفورم بعد الإضافة الناجحة
                    $('#addStudentForm')[0].reset();
                },
                error: function (xhr) {
                    let response = xhr.responseJSON;

                    if (xhr.status === 422) {
                        // إزالة الرسائل القديمة
                        $('.text-danger').remove();

                        $.each(response.errors, function (key, value) {
                            let input = $('[name="' + key + '"]');
                            input.after('<small class="text-danger">' + value[0] + '</small>');
                        });
                    } else {
                        Swal.fire({
                            title: 'خطأ!',
                            text: 'حدث خطأ أثناء الإرسال. الرجاء المحاولة لاحقاً.',
                            icon: 'error',
                            confirmButtonText: 'موافق'
                        });
                    }
                }
            });
        });
    });
</script>


@endsection
