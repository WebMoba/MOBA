<style>
    .required-label::after {
        content: "*";
        color: red;
        margin-left: 5px;
    }
</style>

<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Nombre', null, ['class' => 'required-label']) }}
            {{ Form::text('name', $materialsRaw->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad existente', null, ['class' => 'required-label']) }}
            {{ Form::text('existing_quantity', $materialsRaw->existing_quantity, ['class' => 'form-control' . ($errors->has('existing_quantity') ? ' is-invalid' : ''), 'placeholder' => 'Existing Quantity']) }}
            {!! $errors->first('existing_quantity', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo de unidad', null, ['class' => 'required-label']) }}
            {{ Form::select('units_id', $units, $materialsRaw->units_id ?? 'Sin tipo de unidad', ['class' => 'form-control' . ($errors->has('units_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el tipo de unidades']) }}
            {!! $errors->first('units_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 my-2">

        @if ($confirm)
            <button type="submit" class="btn btn-primary"
                onclick="return confirm('¿Está seguro de editar este registro?');">{{ __('Submit') }}</button>
        @else
            <button type="submit" class="btn btn-success">{{ __('Crear') }}</button>
        @endif
        <a class="btn btn-primary" href="{{ route('materials_raws.index') }}"> {{ __('Back') }}</a>

    </div>

</div>