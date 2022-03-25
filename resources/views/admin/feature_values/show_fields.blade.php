<!-- Feature Id Field -->
<div class="col-sm-12">
    {!! Form::label('feature_id', __('models/featureValues.fields.feature_id').':') !!}
    <p>{{ $featureValues->feature_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/featureValues.fields.created_at').':') !!}
    <p>{{ $featureValues->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/featureValues.fields.updated_at').':') !!}
    <p>{{ $featureValues->updated_at }}</p>
</div>

