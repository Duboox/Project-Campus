@extends('layouts.dashboard')
@section('title', 'Register')
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
            <div class="form-open">
                {{ Form::open(['route' => 'password.request', 'class' => 'm-t', 'role' => 'form']) }}
                {{ Form::hidden('token', $token) }}

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

                    <div class="form-group">
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Recuperar Contraseña', 'required' ]) }}
                        @if ($errors->has('password_confirmation'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Modificar</button>
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