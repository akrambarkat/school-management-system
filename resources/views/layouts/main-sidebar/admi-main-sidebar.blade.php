<div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ __('main_tans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>


        <!-- menu title -->

        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('main_tans.title') }}
        </li>



        <!-- Grades-->

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                <div class="pull-left"><i class="fas fa-school"></i>
                    <span class="right-nav-text">{{ __('main_tans.grade_level') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="elements" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('grades.index') }}">{{ __('main_tans.grade_list') }}</a></li>
            </ul>
        </li>



        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{ __('main_tans.classes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('classroom.index') }}"> {{ __('main_tans.listofclass') }}</a> </li>
            </ul>
        </li>



        <!-- sections-->

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{ __('main_tans.sections') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('sections.index') }}">{{ __('main_tans.section_list') }}</a> </li>
            </ul>
        </li>


        <!-- students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i
                    class="fas fa-user-graduate"></i>{{ trans('main_tans.students') }}<div class="pull-right"><i
                        class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="students-menu" class="collapse">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Student_information">{{ trans('main_tans.Student_information') }}
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Student_information" class="collapse">
                        <li> <a href="{{ route('student.create') }}">{{ trans('main_tans.add_student') }}</a>
                        </li>
                        <li> <a href="{{ route('student.index') }}">{{ __('main_tans.list_student') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Students_upgrade">{{ trans('main_tans.upgrade_student') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Students_upgrade" class="collapse">
                        <li> <a href="{{ route('Promotion.index') }}">{{ __('main_tans.upgrade_student') }}</a>
                        <li> <a
                                href="{{ route('Promotion.create') }}">{{ __('main_tans.Student_promotion_management') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Graduate students">{{ trans('main_tans.Graduate_students') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Graduate students" class="collapse">
                        <li> <a href="{{ route('Graduated.create') }}">{{ trans('main_tans.add_Graduate') }}</a>
                        </li>
                        <li> <a href="{{ route('Graduated.index') }}">{{ trans('main_tans.list_Graduate') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>




        <!-- Teachers-->

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers">
                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                        class="right-nav-text">{{ __('main_tans.teachers') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('teacher.index') }}">{{ __('main_tans.list_techers') }} </a> </li>

            </ul>
        </li>




        <!-- Parents-->

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{ __('main_tans.Parents') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('parent.index') }}">{{ __('main_tans.parent_list') }} </a> </li>

            </ul>
        </li>




        <!-- Accounts-->

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts">
                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                        class="right-nav-text">{{ __('main_tans.account') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('fees.index') }}">{{ __('main_tans.Tuition_fees') }}</a> </li>
                <li> <a href="{{ route('Fees_Invoices.index') }}">{{ __('main_tans.Tuition_bills') }}</a> </li>
                <li> <a href="{{ route('Receipt_Student.index') }}">{{ __('main_tans.Bonds_Receipt') }}</a> </li>
                <li> <a href="{{ route('processing_fees.index') }}">{{ __('main_tans.Exclude_fees') }}</a> </li>
                <li> <a href="{{ route('Payment_Students.index') }}">{{ __('main_tans.Exchange_bonds') }}</a> </li>
            </ul>
        </li>





        <!-- Subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">
                        {{ __('main_tans.School_subjects') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Subjects.index') }}">{{ __('main_tans.List_of_subjects') }}</a> </li>
            </ul>
        </li>




        <!-- Exams-->

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams">
                <div class="pull-left"><i class="fas fa-book-open"></i><span
                        class="right-nav-text">{{ __('main_tans.exams') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Quizze.index') }}">{{ __('main_tans.List_of_exams') }}</a> </li>
                <li> <a href="{{ route('Questions.index') }}">{{ __('main_tans.List_of_questions') }}</a> </li>

            </ul>
        </li>


        <!-- library-->


        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
                <div class="pull-left"><i class="fas fa-book"></i><span
                        class="right-nav-text">{{ __('main_tans.library') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Library.index') }}">{{ __('main_tans.List_of_books') }}</a> </li>

            </ul>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{ route('settings.index') }}"><i class="fas fa-cogs"></i><span
                    class="right-nav-text">{{ __('main_tans.settings') }}</span></a>
        </li>




    </ul>
</div>
