@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-provokers">
                <h3 class="text-primary">Editar Categoría: {{ $category->name  }}</h3>
            </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::model($category, [ 'route' => ['categories.update', $category], 'method' => 'PUT']) !!}
                    @include('admin.category.partials.fields')
                    <button type="submit" class="btn btn-primary btn-sm">Guardar cambios</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
