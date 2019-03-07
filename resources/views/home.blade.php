@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-primary pull-right" href="{{ route('jobs.create') }}" role="button">Nuevo trabajo</a>
            <br>
            <br>

            <h1>Trabajos</h1>
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @foreach($categories as $category)
                        <h3>{{ $category->name }}</h3>
                        <hr>
                        @if ($category->jobs->count() > 0)
                            <ul>
                                @foreach($category->jobs->take(6) as $job)
                                    @include('job.partials.job')
                                @endforeach

                                <a class="btn btn-primary pull-right" href="{{ route('jobs.show_category', ['id' => $category->id, 'slug' => $category->slug]) }}" role="button">Ver más ofertas de {{ $category->name }}</a>
                                <br>
                            </ul>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
