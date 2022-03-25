<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/products.fields.name').':') !!}
    <p>{{ $product->name }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', __('models/products.fields.price').':') !!}
    <p>{{ $product->price }}</p>
</div>

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_id', __('models/products.fields.category_id').':') !!}
    <p>{{ $product->category_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/products.fields.created_at').':') !!}
    <p>{{ $product->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/products.fields.updated_at').':') !!}
    <p>{{ $product->updated_at }}</p>
</div>

