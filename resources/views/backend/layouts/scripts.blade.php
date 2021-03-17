
<script src="{{asset('backend/assets/vendor/jquery/jquery.min.js')}}"></script>
    <!-- bootstap bundle js -->
    <script src="{{asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js -->
    <script src="{{asset('backend/assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- main js -->
    <script src="{{asset('backend/assets/libs/js/main-js.js')}}"></script>
    <!-- chart chartist js -->
    <script src="{{asset('backend/assets/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
    <!-- sparkline js -->
    <script src="{{asset('backend/assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
    <!-- morris js -->
    <script src="{{asset('backend/assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/charts/morris-bundle/morris.js')}}"></script>
    <!-- chart c3 js -->
    <script src="{{asset('backend/assets/vendor/charts/c3charts/c3.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/charts/c3charts/d3.min.js')}}"></script> 
    <script src="{{asset('backend/assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>
    <script src="{{asset('backend/assets/libs/js/dashboard-ecommerce.js')}}"></script>
    <script>
                $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('url')
            }
                });
            </script>
            @stack('script')