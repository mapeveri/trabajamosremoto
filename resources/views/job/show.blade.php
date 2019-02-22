@extends('layouts.app')

@section('content')
    <div class="container">
        @if (auth()->user()->id == $job->user_id)
            <a class="btn btn-primary pull-right" href="{{ route('jobs.edit', $job->id) }}" role="button">Editar</a>
            <br><br><br>
        @endif

        <div class="panel panel-default">
                <div class="panel-body">
                <div class="card">
                    <div class="card-body">
                        <div class="pull-right">
                            <small>{{ date('d-m-Y', strtotime($job->created_at)) }}</small>
                        </div>
                        <h1 class="card-title">{{ $job->title }}</h1>

                        <hr>

                        <p class="card-text"> {!! $job->content !!} </p>

                        <hr>
                        @foreach($job->subcategories as $subcategory)
                            <span class="badge badge-dark">{{ $subcategory->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
