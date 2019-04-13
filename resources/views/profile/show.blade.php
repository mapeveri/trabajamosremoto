@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (Auth::check())
                @if (auth()->user()->id == $user->id)
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('profile.form') }}" role="button">Editar</a>
                    </div>
                @endif
            @endif

            <h1>{{ $user->name }}</h1>
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <label><b>Correo electrónico</b></label>
                    <p>{{ $user->email }}</p>

                    <label><b>Ubicación</b></label>
                    <p>{{ $user->profile->location }}</p>

                    <hr>
                    <label><b>Sitio web</b></label>
                    <p>{{ $user->profile->website }}</p>

                    <hr>
                    <label><b>Sobre tí</b></label>
                    <p>{{ $user->profile->content }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
