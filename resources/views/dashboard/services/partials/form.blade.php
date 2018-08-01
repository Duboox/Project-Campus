<div class="form-group">
  {{ Form::label('date_delivery', 'Fecha entrega') }}
  {{ Form::date('date_delivery', null, ['class' => 'form-control', 'id' => 'date_delivery', 'placeholder' => 'Ej: Maria']) }}
  @if ($errors->has('date_delivery'))
      <span class="error-validate">
          <strong>{{ $errors->first('date_delivery') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
    {{ Form::label('date_return', 'Fecha devolución') }}
    {{ Form::date('date_return', null, ['class' => 'form-control', 'id' => 'date_return', 'placeholder' => 'Ej: Suarez']) }}
    @if ($errors->has('date_return'))
        <span class="error-validate">
            <strong>{{ $errors->first('date_return') }}</strong>
        </span>
      @endif
  </div>
  <div class="form-group">
    {{ Form::label('id_client', 'Cliente') }}
    {!! Form::select('id_client', json_decode($clients->pluck('name', 'id'), true), null, ['class' => 'form-control', 'id' => 'name']) !!}
    @if ($errors->has('id_client'))
        <span class="error-validate">
            <strong>{{ $errors->first('id_client') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
    {{ Form::label('id_product', 'Producto') }}
    {!! Form::select('id_product', json_decode($products->pluck('name', 'id'), true), null, ['class' => 'form-control', 'id' => 'name']) !!}
    @if ($errors->has('id_product'))
        <span class="error-validate">
            <strong>{{ $errors->first('id_product') }}</strong>
        </span>
      @endif
</div>
<div class="form-group">
  {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>