@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="text-primary">Crear Categoría</h3></div>
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

                {!! Form::open([ 'route' => 'categories.store', 'method' => 'POST']) !!}
                    @include('admin.category.partials.fields')
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
