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
        <div class="alert alert-danger">
            Quick Quiz Round- Within given time Answer as many Questions as you can!            
        </div>        
        <div class="form-group">
            {!! Form::label('quick', 'Is it a Qucik Quiz Round Category?'); !!}
            {!! Form::select('quick', [0 => 'No', 1 => 'Yes'], null, ['class' => 'form-control', 'placeholder' => 'Select One']) !!}
        </div> 
        <div class="alert alert-success">
            Limit Questions- Numbers of questions you want to show on that Category, leave blank if you want to show all    
        </div>   
        <div class="form-group">
            {!! Form::label('limit_questions', 'Limit Questions'); !!}
            {!! Form::text('limit_questions', null, ['class' => 'form-control', 'placeholder' => 'Example- 10/20/30']); !!}
        </div>
        <div class="alert alert-info">
            Paid- Is it a Paid Category? Need In-App-Purchase to unlock.  
        </div>   
        <div class="form-group">
            {!! Form::label('paid', 'Paid Category'); !!}
            {!! Form::select('paid', [0 => 'No', 1 => 'Yes'], null, ['class' => 'form-control', 'placeholder' => 'Select One']) !!}
        </div>
    </div>

</div>                        

{!! Form::submit($btntitle, ['class' => 'btn btn-info btn-fill pull-right']); !!}
<div class="clearfix"></div>