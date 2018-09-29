 <div class="form-group">
    {{ Form::label('product', 'Equipo') }}
    {!! Form::text('product', $product->name, ['class' => 'form-control', 'id' => 'name', 'disabled' => 'disabled']) !!}
    @if ($errors->has('product'))
        <span class="error-validate">
            <strong>{{ $errors->first('product') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
    {{ Form::label('product_model', 'Modelo equipo') }}
    {!! Form::text('product_model', $product->model, ['class' => 'form-control', 'id' => 'name', 'disabled' => 'disabled']) !!}
    @if ($errors->has('product_model'))
        <span class="error-validate">
            <strong>{{ $errors->first('product_model') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
    {{ Form::label('product_serial', 'Serial equipo') }}
    {!! Form::text('product_serial', $product->serial_number, ['class' => 'form-control', 'id' => 'name', 'disabled' => 'disabled']) !!}
    @if ($errors->has('product_serial'))
        <span class="error-validate">
            <strong>{{ $errors->first('product_serial') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
    {{ Form::label('internal_code', 'COD interno equipo') }}
    {!! Form::text('internal_code', $product->internal_code, ['class' => 'form-control', 'id' => 'name', 'disabled' => 'disabled']) !!}
    @if ($errors->has('internal_code'))
        <span class="error-validate">
            <strong>{{ $errors->first('internal_code') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
    {{ Form::label('client', 'Cliente') }}
    {!! Form::text('client', $product->client->name, ['class' => 'form-control', 'id' => 'name', 'disabled' => 'disabled']) !!}
    @if ($errors->has('client'))
        <span class="error-validate">
            <strong>{{ $errors->first('client') }}</strong>
        </span>
      @endif
</div>

<!-- <div class="form-group">
    {{ Form::label('date_return', 'Fecha conclusión') }}
    {{ Form::date('date_return', null, ['class' => 'form-control', 'id' => 'date_return', 'placeholder' => 'Ej: Suarez']) }}
    @if ($errors->has('date_return'))
        <span class="error-validate">
            <strong>{{ $errors->first('date_return') }}</strong>
        </span>
      @endif
  </div> -->
<div class="form-group">
    {{ Form::label('observation', 'Observación') }}
    {!! Form::text('observation', null, ['class' => 'form-control', 'id' => 'name']) !!}
    @if ($errors->has('observation'))
        <span class="error-validate">
            <strong>{{ $errors->first('observation') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
  {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>