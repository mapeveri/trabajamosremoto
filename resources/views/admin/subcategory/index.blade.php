@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary pull-right" href="{{ route('subcategories.create') }}" role="button">Nueva Sub-Categoría</a>
        <br>
        <br>
        @include('admin.subcategory.partials.table')
    </div>
@endsection
