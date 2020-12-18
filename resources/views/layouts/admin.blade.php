@include('admin.section.header')
        <!-- START HEADER-->
        @include('admin.section.top-nav')
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        @include('admin.section.sidebar')
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                @include('admin.section.notify')
                @yield('content')

            </div>
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13"> {{ date('Y-m-d H:i:s') }} <b>Eqrium</b> - All rights reserved.</div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    @include('admin.section.footer')
