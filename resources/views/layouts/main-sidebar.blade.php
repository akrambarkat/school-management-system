<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Changa:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



<style>
    body {
        font-family: 'Changa', sans-serif;

        /* استبدل 'Tahoma' بالخط المطلوب */
    }
</style>
<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            @if (auth('admin')->check())
                @include('layouts.main-sidebar.admi-main-sidebar')
            @endif

            @if (auth('student')->check())
                @include('layouts.main-sidebar.student-main-sidebar')
            @endif

            @if (auth('teacher')->check())
                @include('layouts.main-sidebar.teacher-main-sidebar')
            @endif

            @if (auth('parent')->check())
                @include('layouts.main-sidebar.parent-main-sidebar')
            @endif
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
