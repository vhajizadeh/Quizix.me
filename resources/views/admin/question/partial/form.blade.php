<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('title', 'Title'); !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category'); !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('choice_a', 'Choice A'); !!}
            {!! Form::text('choice_a', null, ['class' => 'form-control', 'placeholder' => 'Choice A']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('choice_b', 'Choice B'); !!}
            {!! Form::text('choice_b', null, ['class' => 'form-control', 'placeholder' => 'Choice B']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('choice_c', 'Choice C'); !!}
            {!! Form::text('choice_c', null, ['class' => 'form-control', 'placeholder' => 'Choice C']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('choice_d', 'Choice D'); !!}
            {!! Form::text('choice_d', null, ['class' => 'form-control', 'placeholder' => 'Choice D']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('answer', 'Correct Answer'); !!}
            {!! Form::select('answer', ['choice_a' => 'Choice A', 'choice_b' => 'Choice B', 'choice_c' => 'Choice C', 'choice_d' => 'Choice D'], null, ['class' => 'form-control', 'placeholder' => 'Correct Answer']); !!}
        </div>
    </div>

</div>                        

{!! Form::submit($btntitle, ['class' => 'btn btn-info btn-fill pull-right']); !!}
<div class="clearfix"></div>