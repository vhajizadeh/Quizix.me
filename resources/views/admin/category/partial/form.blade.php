<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('title', 'Title'); !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description'); !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'style' => 'height: 100px;']); !!}
        </div>   
        @if($btntitle == 'Update Category')
        <div class="alert alert-success">
            Upload image if you want to ovewrite existing one(if any), otherwise leave that field blank
        </div>    
        @endif       
        <div class="form-group">
            {!! Form::label('thumbnail', 'Thumbnail Image'); !!}
            {!! Form::file('thumbnail', ['class' => 'form-control']); !!}
        </div>
        @if($categories->count())
        <hr />
        <div class="alert alert-success">
            Select Parent Category if that is Child Category, otherwise leave that field blank
        </div>        
        <div class="form-group">
            {!! Form::label('parent_id', 'Child Category Of'); !!}
            {!! Form::select('parent_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select Parent Category']); !!}
        </div> 
        @endif 
    </div>

</div>                        

{!! Form::submit($btntitle, ['class' => 'btn btn-info btn-fill pull-right']); !!}
<div class="clearfix"></div>