<div class="form-body">
    <div class="row">
		<div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('review', 'Review') !!}
    		{!! Form::textarea('review', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor', 'required' => 'required'] : ['class' => 'form-control']) !!}
    </div>
</div><div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('rating', 'Rating') !!}
        <select name="rating" id="" class="form-control">
            <option value="1" {!! isset($review) && $review->rating == '1' ? 'selected' : '' !!}>1</option>
            <option value="2" {!! isset($review) && $review->rating == '2' ? 'selected' : '' !!}>2</option>
            <option value="3" {!! isset($review) && $review->rating == '3' ? 'selected' : '' !!}>3</option>
            <option value="4" {!! isset($review) && $review->rating == '4' ? 'selected' : '' !!}>4</option>
            <option value="5" {!! isset($review) && $review->rating == '5' ? 'selected' : '' !!}>5</option>
        </select>
    </div>
</div><div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('name', 'Name') !!}
    	    	{!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    </div>
</div>
	</div>
</div>
<div class="form-actions text-right pb-0">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
