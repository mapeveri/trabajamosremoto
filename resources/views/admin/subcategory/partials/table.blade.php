<h3 class="text-primary">Sub-Categorías</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Categoría</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subcategories as $subcategory)
            <tr>
                <td class="text-center">{{ $subcategory->id }}</td>
                <td class="text-center">{{ $subcategory->name }}</td>
                <td class="text-center">{{ $subcategory->category->name }}</td>
                <td class="text-center">
                    <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-primary btn-xs">
                        <span class="fa fa-pencil" aria-hidden="true"></span>
                    </a>
                    <a class="btn btn-danger btn-xs" style="color: white" data-toggle="modal" data-target="#modalDelete_{{ $subcategory->id }}">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </a>

                    <!-- Modal -->
                    <div id="modalDelete_{{ $subcategory->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Eliminar Sub-Categoría</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>¿Desea eliminar la sub-categoría <i>{{ $subcategory->name }}</i>?</p>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                                {!! Form::open(['route' => ['subcategories.destroy', $subcategory->id], 'method' => 'DELETE']) !!}
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
