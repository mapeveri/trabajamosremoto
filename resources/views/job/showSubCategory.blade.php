@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1><a href="/">Trabajos</a> / <a href="{{ route('jobs.show_category', ['id' => $subcategory->category->id, 'slug' => $subcategory->category->slug]) }}">{{ $subcategory->category->name }}</a> / {{ $subcategory->name }}</h1>
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>{{ $subcategory->name }}</h3>
                    <hr>
                    @if ($jobs->count() > 0)
                        <ul>
                            @foreach($jobs as $job)
                                @include('job.partials.job')
                            @endforeach
                        </ul>

                        <div style="float: right;">{{ $jobs->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
