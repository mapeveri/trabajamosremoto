<h3 class="text-primary">Usuarios</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Email</th>
            <th class="text-center">Admin</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td class="text-center">{{ $user->id }}</td>
                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center">{{ $user->email }}</td>
                <td class="text-center">{{ $user->is_admin ? 'Si' : 'No' }}</td>
                <td class="text-center">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-xs">
                        <span class="fa fa-pencil" aria-hidden="true"></span>
                    </a>
                    <a class="btn btn-danger btn-xs" style="color: white" data-toggle="modal" data-target="#modalDelete_{{ $user->id }}">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </a>

                    <!-- Modal -->
                    <div id="modalDelete_{{ $user->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Eliminar Usuario</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>¿Desea eliminar el usuario <i>{{ $user->name }}</i>?</p>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                    {{ Form::submit('Eliminar', array('class'=>'btn btn-danger')) }}
                                {!! Form::close() !!}
                            </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
