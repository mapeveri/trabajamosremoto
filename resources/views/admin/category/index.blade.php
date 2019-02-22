@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary pull-right" href="{{ route('categories.create') }}" role="button">Nueva Categoría</a>
        <br>
        <br>
        @include('admin.category.partials.table')
    </div>
@endsection
