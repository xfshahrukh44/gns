<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
            	{!! Form::label('name', 'Name') !!}
            	{!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            </div>
        </div>
   </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('image', 'Image') !!}
        <input class="form-control dropify" name="image" type="file" id="image" data-default-file="{{ asset($category->image) }}" value="{{ $category->image }}" >
    </div>
</div>

<?php 

    $category = DB::table('categories')->get();

?>

<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('category', 'Parent Category') !!}
    	<select name="parent_id" class="form-control">
    	    <option value="0"> No Parent </option>
            @foreach($category as $key => $val_category)
            <option value="{{ $val_category->id }}"> {{ $val_category->name }} </option>
            @endforeach
        </select>
    </div>
</div>





<div class="form-actions text-right pb-0">
	{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
 