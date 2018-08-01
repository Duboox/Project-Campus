<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- URL dashboard -->
    <meta name="url-dashboard" content="{{ url('dashboard') }}">
    <!-- URL website -->
    <meta name="url-website" content="{{ url('/') }}">
    <title>@yield('title')</title>
    @section('styles')
    {{ css('bootstrap.min') }}
    {{ Html::style('tmpl_dashboard/font-awesome/css/font-awesome.css') }}
    <!-- Toastr style -->
    {{ css_plugin('toastr', 'toastr.min') }}
    {{ css('animate') }}
    {{ css('template') }}
    @show
      {{ css('styles') }}
      {{ Html::favicon('favicon.ico') }}
    @section('css')
    @show
</head>
    @section('body')
        <body>
    @show
    @section('wrapper')
    <div id="wrapper">
        @section('nav')
            @include('dashboard.nav')
        @show
        <div id="page-wrapper" class="gray-bg dashbard-1">
          <div class="row border-bottom">
           <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
              <div class="navbar-header">
                 <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                    <i class="fa fa-bars"></i> 
                 </a>
              </div>
              <ul class="nav navbar-top-links navbar-right">
                 <li>
                    <span class="m-r-sm text-muted welcome-message">
                      Bienvenido a {{ config('app.name') }} +Admin
                    </span>
                 </li>
                 <li>
                    <a href="{{ route('logout') }}" class="logout">
                       <i class="fa fa-sign-out"></i> Cerrar sesión
                    </a>
                    {{ Form::open(['route' => 'logout', 'method' => 'POST', 'class' => 'hide', 'id' => 'logout-form']) }}
                    {{ Form::close() }}
                 </li>
              </ul>
           </nav>
        </div>
            @yield('content')
          <div class="footer">
              <div class="pull-right">
                  Develop by 
                  <strong>
                    <a href="#" target="_parent">{{ config('app.name') }}</a>
                  </strong>
              </div>
          </div>
        </div>
      </div>
    @show
    @section('scripts')
    <!-- Mainly scripts -->
    {{ js('jquery-2.1.1') }}
    {{ js('bootstrap.min') }}

    {{ js_plugin('metisMenu', 'jquery.metisMenu') }}
    {{ js_plugin('slimscroll', 'jquery.slimscroll.min') }}
    
    <!-- Flot -->
    {{ js_plugin('flot', 'jquery.flot') }}
    {{ js_plugin('flot', 'jquery.flot.tooltip.min') }}
    {{ js_plugin('flot', 'jquery.flot.spline') }}
    {{ js_plugin('flot', 'jquery.flot.resize') }}
    {{ js_plugin('flot', 'jquery.flot.pie') }}
    
    <!-- Peity -->
    {{ js_plugin('peity', 'jquery.peity.min') }}

    {{ js('demo/peity-demo') }}
    
    <!-- Custom and plugin javascript -->

    {{ js_plugin('pace', 'pace.min') }}
    
    <!-- jQuery UI -->
    {{ js_plugin('jquery-ui', 'jquery-ui.min') }}
    
    <!-- GITTER -->
    {{ js_plugin('gritter', 'jquery.gritter.min') }}
    
    <!-- Sparkline -->
    {{ js_plugin('sparkline', 'jquery.sparkline.min') }}
    
    <!-- Sparkline demo data  -->
    {{ js('demo/sparkline-demo') }}
    
    <!-- Toastr -->
    {{ js_plugin('toastr', 'toastr.min') }}

    {{ js('template') }}
    {{ js('template-dashboard') }}
    @show
    @yield('script')
</body>
</html>
