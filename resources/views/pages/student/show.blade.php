@extends('layouts.master')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

@section('title')
    {{ trans('main_tans.Student_information') }}
@endsection

@section('page-header')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('main_tans.Student_information') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('main_tans.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('main_tans.Student_information') }}</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab">
                                    {{ trans('main_tans.Student_information') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments"
                                    role="tab">
                                    {{ trans('main_tans.Attachments') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="fees-tab" data-toggle="tab" href="#fees" role="tab">
                                    الرسوم الدراسية
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- معلومات الطالب -->
                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                                <table class="table table-striped table-hover text-center">
                                    <tbody>
                                        <tr>
                                            <th>{{ trans('main_tans.name_student') }}</th>
                                            <td>{{ $Student->trans_name }}</td>
                                            <th>{{ trans('main_tans.email_parent') }}</th>
                                            <td>{{ $Student->email }}</td>
                                            <th>{{ trans('main_tans.gender') }}</th>
                                            <td>{{ $Student->gender->trans_name }}</td>
                                            <th>{{ trans('main_tans.Nationality') }}</th>
                                            <td>{{ $Student->nationality->trans_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('main_tans.grade_student') }}</th>
                                            <td>{{ $Student->grade->trans_name }}</td>
                                            <th>{{ trans('main_tans.class_student') }}</th>
                                            <td>{{ $Student->classroom->trans_name }}</td>
                                            <th>{{ trans('main_tans.section_student') }}</th>
                                            <td>{{ $Student->section->trans_name }}</td>
                                            <th>{{ trans('main_tans.DOB') }}</th>
                                            <td>{{ $Student->Date_Birth }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('main_tans.name_parent') }}</th>
                                            <td>{{ $Student->parent->trans_name }}</td>
                                            <th>{{ trans('main_tans.academic_year') }}</th>
                                            <td>{{ $Student->academic_year }}</td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- المرفقات -->
                            <div class="tab-pane fade" id="attachments" role="tabpanel">
                                <div class="card-body">
                                    <form method="post" action="{{ route('add_attachment') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-3">
                                            <label>{{ trans('main_tans.Attachments') }} : <span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile"
                                                    name="photos[]" multiple accept="image/*">
                                                <label class="custom-file-label" for="customFile"
                                                    data-default="{{ __('validation.no_file_selected') }}">
                                                    {{ __('validation.no_file_selected') }}
                                                </label>
                                            </div>
                                            <div id="file-list" class="mt-2"></div>
                                            <input type="hidden" name="student_name" value="{{ $Student->name_en }}">
                                            <input type="hidden" name="student_id" value="{{ $Student->id }}">
                                        </div>
                                        <br>
                                        <button type="submit" class="button button-border x-small">
                                            {{ trans('main_tans.add_btn') }}
                                        </button>
                                    </form>
                                </div>
                                <br>
                                <table class="table table-hover text-center">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('main_tans.file_name') }}</th>
                                            <th>{{ trans('main_tans.created_at') }}</th>
                                            <th>{{ trans('main_tans.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Student->image as $attachment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img style="width: 80px"
                                                        src="{{ asset('attachment/students/' . $Student->name_en . '/' . $attachment->filename) }}"
                                                        alt=""><br>
                                                    {{ $attachment->filename }}
                                                </td>
                                                <td>{{ $attachment->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <a class="btn btn-outline-info btn-sm"
                                                        href="{{ url('Download_attachment') }}/{{ $Student->name_en }}/{{ $attachment->filename }}">
                                                        <i class="fas fa-download"></i> {{ trans('main_tans.downloade') }}
                                                    </a>
                                                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteModal{{ $attachment->id }}">
                                                        <i class="fas fa-trash"></i> {{ trans('main_tans.delete') }}
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $attachment->id }}"
                                                        tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        {{ __('main_tans.delete_confierm') }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{ trans('main_tans.delete_iteam') }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('main_tans.close_btn') }}</button>
                                                                    <form
                                                                        action="{{ route('delete.attachment', $attachment->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('main_tans.delete') }}</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">لا توجد مرفقات</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="fees" role="tabpanel">
                                <div class="table-responsive mt-4">
                                    @if ($Student->feeInvoices && $Student->feeInvoices->count() > 0)
                                        @php
                                            $totalPaid = \App\Models\ReceiptStudent::where(
                                                'student_id',
                                                $Student->id,
                                            )->sum('Debit');
                                            $remainingPaid = $totalPaid;
                                        @endphp

                                        <table class="table table-striped text-center">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>المبلغ الإجمالي</th>
                                                    <th>المدفوع</th>
                                                    <th>المتبقي</th>
                                                    <th>الحالة</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Student->feeInvoices as $index => $fee)
                                                    @php
                                                        // نوزع المدفوعات على الفواتير تدريجياً
                                                        $paid = min($fee->amount, $remainingPaid);
                                                        $remaining = $fee->amount - $paid;
                                                        $remainingPaid -= $paid;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ number_format($fee->amount, 2) }} ₪</td>
                                                        <td>{{ number_format($paid, 2) }} ₪</td>
                                                        <td>{{ number_format($remaining, 2) }} ₪</td>
                                                        <td>
                                                            @if ($remaining == 0)
                                                                <span class="badge badge-success">مدفوعة بالكامل</span>
                                                            @else
                                                                <span class="badge badge-warning">متبقي</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="alert alert-info text-center mt-3">
                                            <strong>إجمالي الفواتير:</strong>
                                            {{ number_format($Student->feeInvoices->sum('amount'), 2) }} ₪ |
                                            <strong>إجمالي المدفوع:</strong> {{ number_format($totalPaid, 2) }} ₪ |
                                            <strong>المتبقي الكلي:</strong>
                                            {{ number_format($Student->feeInvoices->sum('amount') - $totalPaid, 2) }} ₪
                                        </div>
                                    @else
                                        <div class="alert alert-info text-center">لا توجد رسوم مسجلة لهذا الطالب.</div>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            let files = e.target.files;
            let label = e.target.nextElementSibling;
            let fileListDiv = document.getElementById('file-list');

            if (files.length > 0) {
                label.textContent = `${files.length} ملفات محددة`;
                fileListDiv.innerHTML =
                    `<ul>${Array.from(files).map(file => `<li>${file.name}</li>`).join('')}</ul>`;
            } else {
                label.textContent = label.getAttribute('data-default');
                fileListDiv.innerHTML = '';
            }
        });
    </script>
@endsection
