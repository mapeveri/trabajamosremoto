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
                                @foreach($category->jobs as $job)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="{{ route('jobs.show', ['id' => $job->id, 'slug' => $job->slug]) }}">{{ $job->title }}</a></h5>
                                            <p><small class="card-text">
                                                {{ str_limit(preg_replace("/\s|&nbsp;/", ' ', strip_tags($job->content)), $limit = 350, $end = '...') }}
                                            </small></p>


                                            <div class="pull-left">
                                            @foreach($job->subcategories as $subcategory)
                                                <span class="badge badge-dark">{{ $subcategory->name }}</span>
                                            @endforeach
                                            </div>
                                            <div class="pull-right">
                                                <small>{{ date('d-m-Y', strtotime($job->created_at)) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
