@extends('layouts.dashboard')
@section('title', 'Email')
@section('styles')
    {{ Html::style('tmpl_dashboard/css/bootstrap.min.css') }}
    {{ Html::style('tmpl_dashboard/font-awesome/css/font-awesome.css') }}
    {{ Html::style('tmpl_dashboard/css/animate.css') }}
    {{ Html::style('tmpl_dashboard/css/template.css') }}
@endsection
@section('body')
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">RE+</h1>
            </div>
            <h3>Recuperar Contraseña</h3>
            <p>Si deseas Iniciar sesión click <a href="{{ route('login') }}">aquí</a></p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-open">
                {{ Form::open(['route' => 'password.email', 'class' => 'm-t', 'role' => 'form']) }}
                    <div class="form-group">
                        {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo Eléctronico', 'required' ]) }}
                        @if ($errors->has('email'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Buscar</button>
                    </div>
                {{ Form::close() }}
            </div>
            <div class="copyright">
                <p class="m-t"> 
                    <small>{{ config('app.name') }} &copy; {{ date('Y') }}</small> 
                </p>
            </div>
        </div>
    </div>
@endsection
@section('wrapper')
@stop
@section('scripts')
    <!-- Mainly scripts -->
    {{ Html::script('tmpl_dashboard/js/jquery-2.1.1.js') }}
    {{ Html::script('tmpl_dashboard/js/bootstrap.min.js') }}
@endsection
