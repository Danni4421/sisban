<!DOCTYPE html>
<html lang="en">
    @include('layouts.includes.head')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            {{-- Preloader --}}
            {{-- <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake rounded" src="{{ asset('assets/img/Logo1_RBG.png') }}" alt="SisbanLogo"
                    height="60" width="60">
            </div> --}}

            {{-- Navbar --}}
            @livewire('admin.navbar')

            {{-- Sidebar --}}
            @livewire('admin.sidebar')


            <div class="content-wrapper py-4 px-3">
               <div>
                <div class="content-header">
                    <div class="container-fluid d-flex justify-content-between align-items-center pb-3">
                        @yield('content_header')
                        @yield('breadcrumb')
                    </div>
               </div>
               
                <section class="content d-flex justify-content-center">
                    @yield('content')
                </section>
               </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2024 <span>Sisban</span>.</strong> All rights reserved.
        </footer>

        @include('layouts.includes.foot')
    </body>

</html>
