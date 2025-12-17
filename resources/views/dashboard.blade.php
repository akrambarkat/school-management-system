<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ __('admin_dashboard.admin_dash') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')

</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <br>
        <br>
        <br>

        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">{{ __('admin_dashboard.admin_dash') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <br>
            <!-- widgets -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{ __('admin_dashboard.Number_of_students') }}</p>
                                    <h4>{{ \App\Models\student::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ route('student.index') }}" target="_blank"><span class="text-danger">{{ __('admin_dashboard.show_data') }}
                                        </span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{ __('admin_dashboard.Number_of_teachers') }}</p>
                                    <h4>{{ \App\Models\Techer::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ route('teacher.index') }}" target="_blank"><span class="text-danger">
                                        {{ __('admin_dashboard.show_data') }}</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-tie highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{ __('admin_dashboard.Number_of_parents') }}</p>
                                    <h4>{{ \App\Models\my_Parent::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ route('parent.index') }}" target="_blank"><span class="text-danger">{{ __('admin_dashboard.show_data') }}
                                        </span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{ __('admin_dashboard.Number_of_classroomes') }}</p>
                                    <h4>{{ \App\Models\section::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ route('classroom.index') }}" target="_blank"><span class="text-danger">
                                        {{ __('admin_dashboard.show_data') }}</span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>





            <div class="row">

                <div style="height: 400px;" class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">{{ __('admin_dashboard.tlo') }}</h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                                    href="#students" role="tab" aria-controls="students"
                                                    aria-selected="true"> {{ __('main_tans.students') }}</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="teachers-tab" data-toggle="tab"
                                                    href="#teachers" role="tab" aria-controls="teachers"
                                                    aria-selected="false">{{ __('main_tans.teachers') }}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="parents-tab" data-toggle="tab"
                                                    href="#parents" role="tab" aria-controls="parents"
                                                    aria-selected="false">{{ __('main_tans.Parents') }}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="fee_invoices-tab" data-toggle="tab"
                                                    href="#fee_invoices" role="tab" aria-controls="fee_invoices"
                                                    aria-selected="false">{{ __('main_tans.Tuition_bills') }}
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">

                                    {{-- students Table --}}
                                    <div class="tab-pane fade active show" id="students" role="tabpanel"
                                        aria-labelledby="students-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>{{ __('main_tans.name_student') }}</th>
                                                        <th>{{ __('main_tans.email_parent') }}</th>
                                                        <th>{{ __('main_tans.gender') }}</th>
                                                        <th>{{ __('main_tans.grade_level') }}</th>
                                                        <th>{{ __('main_tans.classrome') }}</th>
                                                        <th>{{ __('main_tans.name_section') }}</th>
                                                        <th>{{ __('admin_dashboard.Date_added') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $student->trans_name }}</td>
                                                            <td>{{ $student->email }}</td>
                                                            <td>{{ $student->gender->trans_name }}</td>
                                                            <td>{{ $student->grade->trans_name }}</td>
                                                            <td>{{ $student->classroom->trans_name }}</td>
                                                            <td>{{ $student->section->trans_name }}</td>
                                                            <td class="text-success">{{ $student->created_at }}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- teachers Table --}}
                                    <div class="tab-pane fade" id="teachers" role="tabpanel"
                                        aria-labelledby="teachers-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>{{ __('main_tans.name_teacher') }}</th>
                                                        <th>{{ __('main_tans.gender') }}</th>
                                                        <th>{{ __('admin_dashboard.Appointment_date') }}</th>
                                                        <th>{{ __('main_tans.Specialization') }}</th>
                                                        <th>{{ __('admin_dashboard.Date_added') }}</th>
                                                    </tr>
                                                </thead>

                                                @forelse(\App\Models\Techer::latest()->take(5)->get() as $teacher)
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $teacher->trans_name }}</td>
                                                            <td>{{ $teacher->gender->trans_name }}</td>
                                                            <td>{{ $teacher->joining_data }}</td>
                                                            <td>{{ $teacher->specialization->trans_name }}</td>
                                                            <td class="text-success">{{ $teacher->created_at }}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                        </tr>
                                                    </tbody>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>

                                    {{-- parents Table --}}
                                    <div class="tab-pane fade" id="parents" role="tabpanel"
                                        aria-labelledby="parents-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>{{ __('main_tans.name_parent') }}</th>
                                                        <th>{{ __('main_tans.email_parent') }}</th>
                                                        <th>{{ __('main_tans.National_ID') }}</th>
                                                        <th>{{ __('main_tans.phone_parent') }}</th>
                                                        <th>{{ __('admin_dashboard.Date_added') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\my_Parent::latest()->take(5)->get() as $parent)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $parent->trans_name }}</td>
                                                            <td>{{ $parent->email }}</td>
                                                            <td>{{ $parent->National_ID }}</td>
                                                            <td>{{ $parent->Phone }}</td>
                                                            <td class="text-success">{{ $parent->created_at }}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- sections Table --}}
                                    <div class="tab-pane fade" id="fee_invoices" role="tabpanel"
                                        aria-labelledby="fee_invoices-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>{{ __('admin_dashboard.Date_of_invoice') }}</th>
                                                        <th>{{ __('main_tans.name_student') }}</th>
                                                        <th>{{ __('main_tans.grade_level') }}</th>
                                                        <th>{{ __('main_tans.classes') }}</th>
                                                        <th>{{ __('main_tans.Amount') }}</th>
                                                        <th>{{ __('admin_dashboard.Date_added') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\Fees_Invoices::latest()->take(10)->get() as $section)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $section->invoice_date }}</td>
                                                            <td>{{ $section->student->trans_name??'' }}</td>
                                                            <td>{{ $section->grade->trans_name??'' }}</td>
                                                            <td>{{ $section->classroom->trans_name??'' }}</td>
                                                            <td>{{ $section->amount }}</td>
                                                            <td class="text-success">{{ $section->created_at }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="alert-danger" colspan="9">لاتوجد بيانات</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>







            
            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')



</body>

</html>
