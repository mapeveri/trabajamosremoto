@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-primary">Admin Home</h3>

        <div class="card">
            <div class="card-body">
                <p>Total de categorías: {{ $categories}}</p>
                <p><a href="{{ route('categories.index') }}">Link</a></p>
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-body">
                <p>Total de subcategorías: {{ $subcategories }}</p>
                <p><a href="{{ route('subcategories.index') }}">Link</a></p>
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-body">
                <p>Total de usuarios: {{ $users }}</p>
                <p><a href="{{ route('users.index') }}">Link</a></p>
            </div>
        </div>
    </div>
@endsection
