<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title id="title">{{ $titlePage}}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/dc8985d071.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugin/bootstrap-datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/core/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugin/responsive.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugin/buttons.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugin/scroller.bootstrap4.css') }}" rel="stylesheet">

    <style>
    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
    .shadow {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
    .shadow-none {
        box-shadow: none !important;
    }
    </style>

    <script src="{{ asset('js/core/jquery-3.3.1.js') }}" ></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('js/plugin/popper.min.js') }}" ></script>
    <script src="{{ asset('js/plugin/bootstrap-datepicker.js') }}" ></script>
    <script src="{{ asset('js/core/datatables.js') }}" ></script>
    <script src="{{ asset('js/plugin/jszip.js') }}" ></script>
    <script src="{{ asset('js/plugin/buttons.bootstrap.js') }}" ></script>
    <script src="{{ asset('js/plugin/responsive.bootstrap4.js') }}" ></script>
    <script src="{{ asset('js/plugin/scroller.bootstrap4.js') }}" ></script>
</head>
<body>
    <div id="app">
        @include('layouts.nav')
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript">
        $('#input-birthdate').datepicker({
                format: 'yyyy-mm-dd',
                clearBtn: true,
                autoclose: true,
                todayHighlight: true
        });
    </script>
    
    <script>
    (function(){
        $('#search').click(function(){
            var province = $('.input-province').val();
            var municipality = $('.input-mun').val();
            var barangay = $('.input-brgy').val();
            var sex = $('.input-sex').val();
            var min = $('.input-min').val();
            var max = $('.input-max').val();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{!! route('getFilter') !!}', {
                province:province,
                municipality:municipality,
                barangay:barangay,
                sex:sex,
                min:min,
                max:max,
            },function(data){
                $('body').html(data);
                $('.dropdown-toggle').dropdown();
            });
        });
    })();
    </script>

<script>
    (function(){
        $('#filter').click(function(){
            var province = $('.input-province').val();
            var municipality = $('.input-mun').val();
            var barangay = $('.input-brgy').val();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{!! route('getAreaData') !!}', {
                province:province,
                municipality:municipality,
                barangay:barangay
            },function(data){
                $('#app').html(data);
                $('.dropdown-toggle').dropdown();
            });
        });
    })();
    </script>

    <script>
    (function(){
            $('#reset').click(function(){
                var province = $('.input-province').val(null);
                var municipality = $('.input-mun').val(null);
                var barangay = $('.input-brgy').val(null);
                var sex = $('.input-sex').val(null);
                var min = $('.input-min').val('');
                var max = $('.input-max').val('');
            });
        })();    
    </script>

    <script>
        $('.input-province').change(function(){
            var province = $('.input-province').val();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{!! route('getMunicipality') !!}', {
                province:province,
            },function(data){
                $('#municipality').html(data);
            });          

        });

        $('.input-mun').change(function(){
            var province = $('.input-province').val();
            var municipality = $('.input-mun').val();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{!! route('getBarangay') !!}', {
                province:province,
                municipality:municipality,
            },function(data){
                $('#barangay').html(data);
            });  
        });

        $('.input-brgy').change(function(){
            var municipality = $('.input-mun').val();
            var barangay = $('.input-brgy').val();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{!! route('getLeader') !!}', {
                municipality:municipality,
                barangay:barangay,
            },function(data){
                $('#leader').html(data);
            });  
        });
        
        $('.input-brgy').change(function(){
            var municipality = $('.input-mun').val();
            var barangay = $('.input-brgy').val();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{!! route('getHead') !!}', {
                municipality:municipality,
                barangay:barangay,
            },function(data){
                $('#head').html(data);
            });  
        });

    </script>

    <script>
        $(document).ready(function () {
            
            $('#ip').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'List of Indigenous People',
                    },
                    
                    {
                        extend: 'print',
                        messageTop: 'INDIGENOUS PEOPLE REGISTRY INFORMATION SYSTEM -',
                        // lanscape orientation
                        customize: function(win)
                        {
            
                            var last = null;
                            var current = null;
                            var bod = [];
            
                            var css = '@page { size: landscape; }',
                                head = win.document.head || win.document.getElementsByTagName('head')[0],
                                style = win.document.createElement('style');
            
                            style.type = 'text/css';
                            style.media = 'print';
            
                            if (style.styleSheet)
                            {
                            style.styleSheet.cssText = css;
                            }
                            else
                            {
                            style.appendChild(win.document.createTextNode(css));
                            }
            
                            head.appendChild(style);
                        }
                    }
                ],
                stateSave: true,
                ordering: false,
                responsive: true
            });
        });
        </script>

</body>
</html>
