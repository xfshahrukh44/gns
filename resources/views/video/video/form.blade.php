<div class="form-body">
    <div class="row">
		<div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('title', 'Title') !!}
    	    	{!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    </div>
</div><div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('video', 'Video') !!}
        <input id="video" name="video" type="file" class="form-control dropify" accept="video/*"/>
    </div>
</div><div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('youtube', 'Youtube link') !!}
        <input id="youtube" name="youtube" type="text" class="form-control"/>
    </div>
</div>
	</div>
</div>
<div class="form-actions text-right pb-0">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
