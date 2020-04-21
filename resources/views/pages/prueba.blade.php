hola
<div class="row">
    <label class="col-sm-2 col-form-label">{{ __('Nombre del Cliente') }}</label>
    <div class="col-sm-7">
      <div class="form-group">
          <select id="id" name="id" class="form-control" required>
              <option> </option>
              @foreach($files as $item)
                  <option value="{{ $item }}">{{ $item }}</option>
              @endforeach
       </select>
       {{-- {{ $listar }} --}}
      </div>
    </div>
  </div>
