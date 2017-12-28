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
        <div class="form-group">
            {!! Form::label('thumbnail', 'Thumbnail Image'); !!}
            {!! Form::file('thumbnail', ['class' => 'form-control']); !!}
        </div>
    </div>

</div>                        

{!! Form::submit($btntitle, ['class' => 'btn btn-info btn-fill pull-right']); !!}
<div class="clearfix"></div>