<div class="form-group">
  {{ Form::label('name', 'Rol') }}
  {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Ej: Administrador']) }}
  @if ($errors->has('name'))
      <span class="error-validate">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
    @endif
</div>
<div class="form-group">
  {{ Form::label('description', 'Descripción') }}
  {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Ej: Rol para el Administrador']) }}
  @if ($errors->has('description'))
      <span class="error-validate">
          <strong>{{ $errors->first('description') }}</strong>
      </span>
    @endif
</div>
<hr>
<h3>Lista de permisos</h3>
<div class="form-group">
  <ul class="list-unstyled">
    @foreach($permissions as $permission)
      <li>
          <label>
            {{ Form::checkbox('permissions[]', $permission->id, null) }}
            {{ $permission->name }} <em>({{ $permission->description }})</em>
          </label>
      </li>
      @endforeach
    </ul>
</div>
<div class="form-group">
  {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>