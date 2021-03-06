@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::check())
            @if (auth()->user()->id == $job->user_id)
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('jobs.edit', $job->id) }}" role="button">Editar</a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteJob" role="button" style="color: white">Eliminar</a>
                </div>
                <br><br><br>
            @endif
        @endif

        <div class="panel panel-default">
                <div class="panel-body">
                <div class="card">
                    <div class="card-body">
                        <div class="pull-right">
                            <small>{{ date('d-m-Y', strtotime($job->created_at)) }}</small>
                        </div>
                        <h1 class="card-title">{{ $job->title }}</h1>

                        <small>Por: <a href="{{ route('profile', ['username' => $job->user->username]) }}">{{ $job->user->name }}</a></small>
                        <hr>

                        <p class="card-text"> {!! $job->content !!} </p>
                        <p class="card-text"><b>Contacto:</b> {{ $job->contact }} </p>
                        <hr>
                        @foreach($job->subcategories as $subcategory)
                            <span class="badge badge-dark">
                                <a class="white" href="{{ route('jobs.show_subcategory', ['id' => $job->category_id, 'slug' => $job->category->slug, 'subcategory_id' => $subcategory->id, 'subcategory_slug' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
    <div id="modalDeleteJob" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eliminar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar <i>{{ $job->title }}</i>?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                {!! Form::open(['route' => ['jobs.destroy', $job->id], 'method' => 'DELETE']) !!}
                    {{ Form::submit('Eliminar', array('class'=>'btn btn-danger')) }}
                {!! Form::close() !!}
            </div>
            </div>
        </div>
    </div>
@endsection
