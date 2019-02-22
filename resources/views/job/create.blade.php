@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="text-primary">Nuevo trabajo</h3></div>
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

                {!! Form::open([ 'route' => 'jobs.store', 'method' => 'POST']) !!}
                    @include('job.partials.fields')
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/libs/tiny_mce/tiny_mce.js') }}"></script>
    <script src="{{ asset('js/textarea.js') }}"></script>
@endsection
