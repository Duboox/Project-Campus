<div class="form-group">
  {{ Form::label('name', 'Nombre') }}
  {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Ej: Telefono Android']) }}
  @if ($errors->has('name'))
      <span class="error-validate">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
        {{ Form::label('id_fabricator', 'Fabricante') }}
        {!! Form::select('id_fabricator', json_decode($fabricators->pluck('name', 'id'), true), null, ['class' => 'form-control', 'id' => 'name']) !!}
        @if ($errors->has('id_fabricator'))
            <span class="error-validate">
                <strong>{{ $errors->first('id_fabricator') }}</strong>
            </span>
          @endif
</div>
<div class="form-group">
    {{ Form::label('model', 'Modelo') }}
    {{ Form::text('model', null, ['class' => 'form-control', 'id' => 'model', 'placeholder' => 'Ej: AH56SD34']) }}
    @if ($errors->has('model'))
        <span class="error-validate">
            <strong>{{ $errors->first('model') }}</strong>
        </span>
      @endif
  </div>
<div class="form-group">
    {{ Form::label('serial_number', 'Nro Serial') }}
    {{ Form::text('serial_number', null, ['class' => 'form-control', 'id' => 'serial_number', 'placeholder' => 'Ej: AH56SD34']) }}
    @if ($errors->has('serial_number'))
        <span class="error-validate">
            <strong>{{ $errors->first('serial_number') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
  {{ Form::label('internal_code', 'Cod Interno') }}
  {{ Form::text('internal_code', null, ['class' => 'form-control', 'placeholder' => 'Ej: AH56SD34']) }}
  @if ($errors->has('internal_code'))
      <span class="error-validate">
          <strong>{{ $errors->first('internal_code') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
  {{ Form::label('magnitude', 'Magnitud') }}
  {{ Form::text('magnitude', null, ['class' => 'form-control', 'placeholder' => 'Ej: 5.6']) }}
  @if ($errors->has('magnitude'))
      <span class="error-validate">
          <strong>{{ $errors->first('magnitude') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('date_last_calibration', 'Fecha ultima calibración') }}
    {{ Form::date('date_last_calibration', null, ['class' => 'form-control', 'id' => 'date_last_calibration', 'placeholder' => 'Ej: +58 424 233 6927']) }}
    @if ($errors->has('date_last_calibration'))
        <span class="error-validate">
            <strong>{{ $errors->first('date_last_calibration') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('date_control_calibration', 'Fecha aprox. control de calibración') }}
    {{ Form::date('date_control_calibration', null, ['class' => 'form-control', 'id' => 'date_control_calibration', 'placeholder' => 'Ej: +58 424 233 6927']) }}
    @if ($errors->has('date_control_calibration'))
        <span class="error-validate">
            <strong>{{ $errors->first('date_control_calibration') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('status', 'Estado') }}
    {{ Form::text('status', null, ['class' => 'form-control', 'id' => 'status', 'placeholder' => 'Ej: skynessj@gmail.com']) }}
    @if ($errors->has('status'))
        <span class="error-validate">
            <strong>{{ $errors->first('status') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
        {{ Form::label('others', 'Otros') }}
        {{ Form::text('others', null, ['class' => 'form-control', 'id' => 'others', 'placeholder' => 'Ej: skynessj@gmail.com']) }}
        @if ($errors->has('others'))
            <span class="error-validate">
                <strong>{{ $errors->first('others') }}</strong>
            </span>
        @endif
    </div>
<div class="form-group">
  {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>