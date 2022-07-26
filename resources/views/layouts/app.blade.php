<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Meta -->
    <meta name="description" content="لوحة التحكم">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="images/fav.png">

    <!-- Title -->
    <title>لوحة التحكم | @yield('title')</title>

    @include('layouts.css')
    @yield('css')

</head>

<body>

    <!-- Loading starts -->
    <div id="loading-wrapper">
        <div class="spinner-border" role="status">
            <span class="sr-only">تحميل...</span>
        </div>
    </div>
    <!-- Loading ends -->


    <!-- Header start -->
    @include('layouts.header')
    <!-- Header end -->

    <!-- Screen overlay start -->
    <div class="screen-overlay"></div>
    <!-- Screen overlay end -->

    <!-- Container fluid start -->
    <div class="container-fluid">

        <!-- Navigation start -->
        @include('layouts.navbar')
        <!-- Navigation end -->

        <div class="main-container">
            @include('flash::message')

            <!-- Page header start -->
            @include('layouts.breadcrumb')
            <!-- Page header end -->

            <!-- Content wrapper start -->
            <div class="content-wrapper">
                <div class="notify-notifications clearfix">
                    <div id="notes"></div>
                </div>
                @yield('content')
            </div>
            <!-- Content wrapper end -->
        </div>
        <!-- Footer start -->
        <footer class="main-footer">جميع الحقوق محفوظة</footer>
        <!-- Footer end -->

    </div>
    <!-- Container fluid end -->

    @include('layouts.js')
    @yield('scripts')
    <script>
        if ("{{ Session::has('message') }}") {
            notes.show(
                "{{ Session::get('message') }}", {
                    type: 'success',
                    title: 'نجاح',
                    icon: '<i class="icon-sentiment_satisfied"></i>'
                }
            );
        }

        if ("{{ Session::has('error') }}") {
            notes.show(
                "{{ Session::get('error') }}", {
                    type: 'error',
                    title: 'خطأ',
                    icon: '<i class="icon-error"></i>'
                }
            );
        }

    </script>

</body>

</html>
