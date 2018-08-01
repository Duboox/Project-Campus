@extends('layouts.dashboard')
@section('title', 'Registro')
@section('styles')
    {{ Html::style('tmpl_dashboard/css/bootstrap.min.css') }}
    <!-- Social Buttons for Bootstrap -->
    {{ Html::style('css/bootstrap/bootstrap-social.css') }}
    {{ Html::style('tmpl_dashboard/font-awesome/css/font-awesome.css') }}
    {{ Html::style('tmpl_dashboard/css/animate.css') }}
    {{ Html::style('tmpl_dashboard/css/template.css') }}
@endsection
@section('body')
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">AD+</h1>
            </div>
            <h3>Bienvenido a <a href="{{ url('/') }}">{{ config('app.name') }}</a></h3>
            <p>Si deseas Iniciar sesión click <a href="{{ route('login') }}">aquí</a></p>
            <div class="form-open">
                {{ Form::open(['route' => 'register', 'method' => 'POST', 'class' => 'm-t', 'role' => 'form']) }}
                    <div class="form-group">
                        {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Nombre', 'required' ]) }}
                        @if ($errors->has('name'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Apellido', 'required' ]) }}
                        @if ($errors->has('last_name'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email', 'required' ]) }}
                        @if ($errors->has('email'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::number('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Teléfono', 'required' ]) }}
                        @if ($errors->has('phone'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required' ]) }}
                        @if ($errors->has('password'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repetir Contraseña', 'required' ]) }}
                        @if ($errors->has('password_confirmation'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Registro</button>
                    </div>
                    <div class="options">
                        <a href="{{ route('password.request') }}"><small>¿Olvido su Contraseña?</small></a>
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
