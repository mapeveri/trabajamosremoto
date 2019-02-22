<div class="form-group">
    {!! Form::label('title', 'Título', ['for' => 'title'] ) !!}
    {!! Form::text('title', null , ['class' => 'form-control', 'style' => 'width: 40%', 'required', 'id' => 'title', 'placeholder' => 'Escribe el título del trabajo...' ]  ) !!}
</div>

<div class="form-group">
    {!! Form::label('content', 'Contenido', ['for' => 'content'] ) !!}
    {!! Form::textarea('content', null , ['class' => 'form-control', 'id' => 'content', 'placeholder' => 'Escribe el contenido del trabajo...' ]  ) !!}
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categoría', ['for' => 'category_id'] ) !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'required', 'style' => 'width: 40%']) !!}
</div>

<div class="form-group">
    {!! Form::label('subcategory_id', 'Sub Categoría', ['for' => 'subcategory_id'] ) !!}
    {!! Form::select('subcategory_id', $subcategories, null, ['class' => 'form-control', 'multiple', 'required', 'style' => 'width: 40%', 'name' => 'subcategories[]']) !!}
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
    var category = document.querySelector('#category_id');
    category.addEventListener('change', function() {
        const token = document.head.querySelector('meta[name="csrf-token"]');
        fetch('/api/subcategories/' + category.value + '/', {
                method: 'GET',
                headers: {
                    Authorization: 'Bearer:' + token.content
                }
            })
        .then(function(response) {
            return response.json();
        })
        .then(function(subcategories) {
            const comboSubCategory = document.querySelector('#subcategory_id');
            comboSubCategory.innerHTML = '';

            subcategories.forEach(function (subcategory) {
                const option = document.createElement("option");
                option.text = subcategory.name;
                option.value = subcategory.id;
                comboSubCategory.appendChild(option);
            });
        });
    });
});

</script>
