<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="./img/apple-icon.png"> --}}
    <link rel="icon" type="image/png" {{ asset('./img/favicon.ico') }}>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        BKACAD
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('./css/vue-multiselect.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/material-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>

<body>
    <div id="app">
        <div class="wrapper ">
            <!-- Side bar -->
            <sidebar-component></sidebar-component>
            <!-- End Sidebar -->

       
            <div class="main-panel">
                <!-- Navbar -->
                <navbar-component></navbar-component>
                <!-- End navbar -->

                <!--   Content   -->
                <div class="content">
                    <div class="container-fluid">
                        <div id="app">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
                <!-- End Content -->

                <!--   Footer   -->
                <footer-component></footer-component>
                <!-- End Footer -->
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>

    <!-- Plugin files -->
    <script src="{{ asset('/js/plugin/jquery.md5.min.js') }}"></script>
    <!-- Empty -->
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/js/material-dashboard.min.js') }}"></script>
</body>

</html>
