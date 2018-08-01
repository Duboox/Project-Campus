<div class="form-group">
  {{ Form::label('name', 'Nombre') }}
  {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Ej: Samsung']) }}
  @if ($errors->has('name'))
      <span class="error-validate">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('description', 'Descripción') }}
    {{ Form::text('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Ej: Samsung Corp.']) }}
    @if ($errors->has('description'))
        <span class="error-validate">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
  {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>