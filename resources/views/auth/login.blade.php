@extends('layouts.dashboard')
@section('title', 'Inicio de Sesión')
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
            <p>Si deseas Registrarte click <a href="{{ route('register') }}">aquí</a></p>
            <div class="include-alert-alerts">
                @include('alert.alerts')
            </div>
            <div class="form-open">
                {{ Form::open(['route' => 'login', 'method' => 'POST', 'class' => 'm-t', 'role' => 'form']) }}
                    <div class="form-group">
                        {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo Eléctronico', 'required' ]) }}
                        @if ($errors->has('email'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('email') }}</strong>
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
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Entrar</button>
                    </div>
                    <div class="options">
                        <a href="{{ route('password.request') }}"><small>¿Olvido contraseña?</small></a>
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
