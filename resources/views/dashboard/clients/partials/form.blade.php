<div class="form-group">
  {{ Form::label('name', 'Empresa') }}
  {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Ej: Maria']) }}
  @if ($errors->has('name'))
      <span class="error-validate">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
  {{ Form::label('rubro', 'Rubro') }}
  {{ Form::text('rubro', null, ['class' => 'form-control', 'id' => 'rubro', 'placeholder' => 'Ej: Maria']) }}
  @if ($errors->has('rubro'))
      <span class="error-validate">
          <strong>{{ $errors->first('rubro') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('last_name', 'Responsable') }}
    {{ Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Ej: Suarez']) }}
    @if ($errors->has('last_name'))
        <span class="error-validate">
            <strong>{{ $errors->first('last_name') }}</strong>
        </span>
      @endif
  </div>
<div class="form-group">
    {{ Form::label('city', 'Ciudad') }}
    {{ Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Ej: Cochamamba']) }}
    @if ($errors->has('city'))
        <span class="error-validate">
            <strong>{{ $errors->first('city') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
  {{ Form::label('residency', 'Residencia') }}
  {{ Form::textarea('residency', null, ['class' => 'form-control', 'placeholder' => 'Ej: Av. Nobel 1563, Edf. Tecnibilds Piso 3, Ofc 43.']) }}
  @if ($errors->has('residency'))
      <span class="error-validate">
          <strong>{{ $errors->first('residency') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
  {{ Form::label('zone', 'Zona') }}
  {{ Form::textarea('zone', null, ['class' => 'form-control', 'placeholder' => 'Ej: Av. Nobel 1563, Edf. Tecnibilds Piso 3, Ofc 43.']) }}
  @if ($errors->has('zone'))
      <span class="error-validate">
          <strong>{{ $errors->first('zone') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('phone', 'Telefono') }}
    {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Ej: +58 424 233 6927']) }}
    @if ($errors->has('phone'))
        <span class="error-validate">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('fax', 'Celular') }}
    {{ Form::text('fax', null, ['class' => 'form-control', 'id' => 'fax', 'placeholder' => 'Ej: +58 424 233 6927']) }}
    @if ($errors->has('fax'))
        <span class="error-validate">
            <strong>{{ $errors->first('fax') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Ej: skynessj@gmail.com']) }}
    @if ($errors->has('email'))
        <span class="error-validate">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('web_page', 'Pagina Web') }}
    {{ Form::text('web_page', null, ['class' => 'form-control', 'id' => 'web_page', 'placeholder' => 'Ej: skynessj@gmail.com']) }}
    @if ($errors->has('web_page'))
        <span class="error-validate">
            <strong>{{ $errors->first('web_page') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
  {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>