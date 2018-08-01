<div class="form-group">
  {{ Form::label('name', 'Usuario') }}
  <select name="id_user" class="form-control">
    @foreach($data[0] as $user)
      <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
  </select>
  @if ($errors->has('name'))
    <span class="error-validate">
        <strong>{{ $errors->first('name') }}</strong>
    </span>
  @endif
</div>
<div class="form-group">
  {{ Form::label('name', 'Rol') }}
  <select name="role_id" class="form-control">
    @foreach($data[1] as $role)
      <option value="{{ $role->id }}">{{ $role->name }}</option>
    @endforeach
  </select>
  @if ($errors->has('name'))
    <span class="error-validate">
        <strong>{{ $errors->first('name') }}</strong>
    </span>
  @endif
</div>
<div class="form-group">
  {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>