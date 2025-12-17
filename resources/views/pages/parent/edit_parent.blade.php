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
    {{ __('main_tans.edit_parent') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_tans.edit_parent') }}
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ __('main_tans.home') }}
                    </a></li>
                <li class="breadcrumb-item active"> {{ __('main_tans.edit_parent') }}
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

                <h5>{{ __('main_tans.father_information') }}</h5><br>
                <form action="{{ route('parent.update', $y->id) }}" method="POST" autocomplete="off">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <!-- حقل الاسم باللغتين -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name_ar">{{ __('main_tans.name_parent_ar') }}</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar"
                                    value="{{ old('name_ar', $y->name_ar) }}">
                                @error('name_ar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name_en">{{ __('main_tans.name_parent_en') }}</label>
                                <input type="text" class="form-control" id="name_en" name="name_en"
                                    value="{{ old('name_en', $y->name_en) }}">
                                @error('name_en')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="notes_en">{{ __('main_tans.email_parent') }}</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $y->email) }}">
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
                            <div class="col-md-6">
                                <label for="notes_en">{{ __('main_tans.address_parent') }}</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address', $y->Address) }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="notes_en">{{ __('main_tans.National_ID') }}</label>
                                <input type="number" name="National_ID" id="National_ID" class="form-control"
                                    value="{{ old('National_ID', $y->National_ID) }}">
                                @error('National_ID')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="notes_ar">{{ __('main_tans.phone_parent') }}</label>
                                <input type="number" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone', $y->Phone) }}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="notes_ar">{{ __('main_tans.parent_job') }}</label>
                                <input type="text" name="job" id="job" class="form-control"
                                    value="{{ old('job', $y->Job) }}">
                                @error('job')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="notes_en">{{ __('main_tans.Nationality') }}</label>
                                <select name="Nationality" id="Nationality" class="form-control">
                                    <option value="" selected disabled>{{ __('main_tans.select_of_list') }}
                                    </option>

                                    @foreach ($Nationalitie as $x)
                                        <option value="{{ $x->id }}"
                                            {{ old('Nationality', $y->Nationality_id) == $x->id ? 'selected' : '' }}>
                                            {{ $x->trans_name }}</option>
                                    @endforeach
                                </select>
                                @error('Nationality')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="notes_en">{{ __('main_tans.Religion') }}</label>
                                <select name="Religion" id="Religion" class="form-control">
                                    <option value="" selected disabled>{{ __('main_tans.select_of_list') }}
                                    </option>
                                    @foreach ($religion as $x)
                                        <option value="{{ $x->id }}"
                                            {{ old('Religion', $y->Religion_id) == $x->id ? 'selected' : '' }}>
                                            {{ $x->trans_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Religion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-success">{{ __('main_tans.edit') }}</button>
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


@endsection
