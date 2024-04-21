<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Noabs</title>


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('/plugins/iCheck/all.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{asset('/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('/dist/css/skins/_all-skins.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        .centrardiv{
            margin-right: auto;
            margin-left: auto;
            float: initial;
        }

    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>N</b>OABS</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>NOABS</b> 3.0</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- Notifications: style can be found in dropdown.less -->

                    <!-- Tasks: style can be found in dropdown.less -->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <span class="hidden-xs">{{Auth::user()->nombres .' '.Auth::user()->apellidos}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header" style="height: auto;">


                                <p>
                                    {{Auth::user()->nombres .' '.Auth::user()->apellidos}}
                                    <small>Creado {{Auth::user()->created_at }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer" >






                                <div class="pull-right">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Salir</a>
                                </div>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image" style="margin-bottom: 20px;">

                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->nombres .' '.Auth::user()->apellidos}}</p>

                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENÚ PRINCIPAL</li>


                @can('isNino',Auth::user())
                <li>
                    <a>
                        <i class="fa fa-th"></i> <span>Jugar</span>
                        <span class="pull-right-container">
              <small class="label pull-right bg-green">Noabs</small>
            </span>
                    </a>
                </li>
                @endcan
                @can('isAdmin',Auth::user())
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Instituciones</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('registarinstitucion')}}"><i class="fa fa-circle-o"></i> Agregar Institución</a></li>
                        <li><a href="{{route('instituciones')}}"><i class="fa fa-circle-o"></i> Opciones para instituciones</a></li>
                    </ul>
                </li>
            @endcan

                @can('isAdmin',Auth::user())
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Gestores</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('registergestor')}}"><i class="fa fa-circle-o"></i> Agregar Gestor</a></li>
                        <li><a href="{{route('gestores')}}"><i class="fa fa-circle-o"></i> Opciones para Gestores</a></li>
                    </ul>
                </li>
                @endcan

                @can('isGestor',Auth::user())


                 {{--@if($permitido)--}}

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Niños | Niñas</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('registarninos')}}"><i class="fa fa-circle-o"></i> Agregar Niño | Niña</a></li>
                        <li><a href="{{route('ninos')}}"><i class="fa fa-circle-o"></i> Opciones para Niño | Niña</a></li>

                    </ul>
                </li>
           {{--@endif--}}
           @endcan

                @can('isGestor',Auth::user())
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Resultados</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('resultados')}}"><i class="fa fa-circle-o"></i> Ver Resultados</a></li>
                        <li><a href="{{ route('GenerarInformeView') }}"><i class="fa fa-circle-o"></i> Ver Resultados Detallados</a></li>

                    </ul>
                 
                </li>
               @endcan

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">


        </section>

        <!-- Main content -->
       @yield('content')

    @if(Session::has('flash_message'))
        <!-- Messenger http://github.hubspot.com/messenger/ -->
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

            <script type="text/javascript">
                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-bottom-full-width"
                };
                toastr.info('{{Session::get('flash_message')}}');


            </script>
    @endif


        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 3.0
        </div>
        <strong>Copyright &copy; 2022<a href="#"> NOABS</a>.</strong> Todos los derechos reservados.
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/dist/js/demo.js')}}"></script>
<!-- Page script -->

<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script src="{{asset('bower_components/jquery-knob/js/jquery.knob.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- SlimScroll -->

<script>




    $(function () {

        $(".knob").knob({
            /*change : function (value) {
             //console.log("change : " + value);
             },
             release : function (value) {
             console.log("release : " + value);
             },
             cancel : function () {
             console.log("cancel : " + this.value);
             },*/
            draw: function () {

                // "tron" case
                if (this.$.data('skin') == 'tron') {

                    var a = this.angle(this.cv)  // Angle
                        , sa = this.startAngle          // Previous start angle
                        , sat = this.startAngle         // Start angle
                        , ea                            // Previous end angle
                        , eat = sat + a                 // End angle
                        , r = true;

                    this.g.lineWidth = this.lineWidth;

                    this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

                    if (this.o.displayPrevious) {
                        ea = this.startAngle + this.angle(this.value);
                        this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                        this.g.beginPath();
                        this.g.strokeStyle = this.previousColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                        this.g.stroke();
                    }

                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                    this.g.stroke();

                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();

                    return false;
                }
            }
        });
        /* END JQUERY KNOB */

        //INITIALIZE SPARKLINE CHARTS
        $(".sparkline").each(function () {
            var $this = $(this);
            $this.sparkline('html', $this.data());
        });

        /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
        drawDocSparklines();
        drawMouseSpeedDemo();

        $('#example1').DataTable({ 'paging'      : false,
});
        $('#example2').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        });

        //Initialize Select2 Elements
        $('.select2').select2();

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
        //Money Euro
        $('[data-mask]').inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' });
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );

        //Date picker
        $('#fecha_inicio').datepicker({
            autoclose: true

        });

        $('#fecha_final').datepicker({
            autoclose: true

        });

        $('#fecha_nacimiento').datepicker({
            autoclose: true

        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        });

        //Colorpicker
        $('.my-colorpicker1').colorpicker();
        //color picker with addon
        $('.my-colorpicker2').colorpicker();

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    });


    function drawDocSparklines() {

        // Bar + line composite charts
        $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
        $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
            {composite: true, fillColor: false, lineColor: 'red'});


        // Line charts taking their values from the tag
        $('.sparkline-1').sparkline();

        // Larger line charts for the docs
        $('.largeline').sparkline('html',
            {type: 'line', height: '2.5em', width: '4em'});

        // Customized line chart
        $('#linecustom').sparkline('html',
            {
                height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
                minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3
            });

        // Bar charts using inline values
        $('.sparkbar').sparkline('html', {type: 'bar'});

        {{--$('.barformat').sparkline([1, 3, 5, 3, 8], {--}}
            {{--type: 'bar',--}}
            {{--tooltipFormat: '{{value:levels}} - {{value}}',--}}
            {{--tooltipValueLookups: {--}}
                {{--levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})--}}
            {{--}--}}
        {{--});--}}

        // Tri-state charts using inline values
        $('.sparktristate').sparkline('html', {type: 'tristate'});
        $('.sparktristatecols').sparkline('html',
            {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

        // Composite line charts, the second using values supplied via javascript
        $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
        $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
            {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

        // Line charts with normal range marker
        $('#normalline').sparkline('html',
            {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
        $('#normalExample').sparkline('html',
            {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

        // Discrete charts
        $('.discrete1').sparkline('html',
            {type: 'discrete', lineColor: 'blue', xwidth: 18});
        $('#discrete2').sparkline('html',
            {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

        // Bullet charts
        $('.sparkbullet').sparkline('html', {type: 'bullet'});

        // Pie charts
        $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

        // Box plots
        $('.sparkboxplot').sparkline('html', {type: 'box'});
        $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
            {type: 'box', raw: true, showOutliers: true, target: 6});

        // Box plot with specific field order
        $('.boxfieldorder').sparkline('html', {
            type: 'box',
            tooltipFormatFieldlist: ['med', 'lq', 'uq'],
            tooltipFormatFieldlistKey: 'field'
        });

        // click event demo sparkline
        $('.clickdemo').sparkline();
        $('.clickdemo').bind('sparklineClick', function (ev) {
            var sparkline = ev.sparklines[0],
                region = sparkline.getCurrentRegionFields();
            value = region.y;
            alert("Clicked on x=" + region.x + " y=" + region.y);
        });

        // mouseover event demo sparkline
        $('.mouseoverdemo').sparkline();
        $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
            var sparkline = ev.sparklines[0],
                region = sparkline.getCurrentRegionFields();
            value = region.y;
            $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
        }).bind('mouseleave', function () {
            $('.mouseoverregion').text('');
        });
    }

    /**
     ** Draw the little mouse speed animated graph
     ** This just attaches a handler to the mousemove event to see
     ** (roughly) how far the mouse has moved
     ** and then updates the display a couple of times a second via
     ** setTimeout()
     **/
    function drawMouseSpeedDemo() {
        var mrefreshinterval = 500; // update display every 500ms
        var lastmousex = -1;
        var lastmousey = -1;
        var lastmousetime;
        var mousetravel = 0;
        var mpoints = [];
        var mpoints_max = 30;
        $('html').mousemove(function (e) {
            var mousex = e.pageX;
            var mousey = e.pageY;
            if (lastmousex > -1) {
                mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
            }
            lastmousex = mousex;
            lastmousey = mousey;
        });
        var mdraw = function () {
            var md = new Date();
            var timenow = md.getTime();
            if (lastmousetime && lastmousetime != timenow) {
                var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
                mpoints.push(pps);
                if (mpoints.length > mpoints_max)
                    mpoints.splice(0, 1);
                mousetravel = 0;
                $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
            }
            lastmousetime = timenow;
            setTimeout(mdraw, mrefreshinterval);
        };
        // We could use setInterval instead, but I prefer to do it this way
        setTimeout(mdraw, mrefreshinterval);
    }
</script>

@yield('script')

<!-- Modal -->
<div class="modal fade" id="modalCarga" tabindex="-1" role="dialog" aria-labelledby="modalCargaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCargaLabel">Cargando...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img src="{{asset('/img/loading.gif')}}" alt="Cargando..." style="max-width: 300px; max-height: 300px;">
      </div>
    </div>
  </div>
</div>
</body>
</html>
