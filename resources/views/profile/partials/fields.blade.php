<div class="form-group">
    {!! Form::label('location', 'Ubicación', ['for' => 'location'] ) !!}
    {!! Form::text('location', null , ['class' => 'form-control', 'style' => 'width: 40%', 'id' => 'location' ]  ) !!}
</div>

<div class="form-group">
    {!! Form::label('content', 'Sobre tí', ['for' => 'content'] ) !!}
    {!! Form::textarea('content', null , ['class' => 'form-control', 'id' => 'content' ]  ) !!}
</div>

<div class="form-group">
    {!! Form::label('website', 'Página web', ['for' => 'location'] ) !!}
    {!! Form::text('website', null , ['class' => 'form-control', 'style' => 'width: 40%', 'id' => 'website' ]  ) !!}
</div>
