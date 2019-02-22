<div class="form-group">
    {!! Form::label('name', 'Nombre', ['for' => 'name'] ) !!}
    {!! Form::text('name', null , ['class' => 'form-control', 'style' => 'width: 40%', 'id' => 'detalle', 'placeholder' => 'Escribe el nombre de la sub-categoría...' ]  ) !!}
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categoría', ['for' => 'category_id'] ) !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'style' => 'width: 40%']) !!}
</div>
