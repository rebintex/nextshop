<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/pages.fields.name').':') !!}
    <p>{{ $page->name }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', __('models/pages.fields.content').':') !!}
    <p>{{ $page->content }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/pages.fields.created_at').':') !!}
    <p>{{ $page->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/pages.fields.updated_at').':') !!}
    <p>{{ $page->updated_at }}</p>
</div>

