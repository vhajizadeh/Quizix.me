<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('title', 'Title'); !!}
            {{ Form::textarea('title', null, ['class' => 'form-control input-editor', 'placeholder' => 'Title', 'size' => '30x2']) }}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category'); !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('question_type', 'Question Type'); !!}
            {!! Form::select('question_type', ['regular' => 'Regular Question', 'photo' => 'Photo Question'], null, ['id' => 'question_type', 'class' => 'form-control']); !!}
        </div>
        @if($btntitle == 'Update Question')
        <div class="alert alert-success question_image" style="{{ isset($question) && $question->question_type == 'photo' ? 'display: block;' : 'display: none;' }}">
            Upload image if you want to ovewrite existing one(if any), otherwise leave that field blank
        </div>    
        @endif   
        <div class="form-group question_image" style="{{ isset($question) && $question->question_type == 'photo' ? 'display: block;' : 'display: none;' }}">
            {!! Form::label('thumbnail', 'Question Image'); !!}
            {!! Form::file('thumbnail', ['class' => 'form-control']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('number_of_answer', 'Number of Answer'); !!}
            {!! Form::select('number_of_answer', ['5' => '5', '4' => '4', '3' => '3', '2' => '2'], null, ['id' => 'number_of_answer', 'class' => 'form-control']); !!}
        </div>        
        <div class="form-group">
            {!! Form::label('choice_a', 'Choice A'); !!}
            {{ Form::textarea('choice_a', null, ['class' => 'form-control input-editor', 'placeholder' => 'Choice A', 'size' => '30x2']) }}
        </div>
        <div class="form-group">
            {!! Form::label('choice_b', 'Choice B'); !!}
            {{ Form::textarea('choice_b', null, ['class' => 'form-control input-editor', 'placeholder' => 'Choice B', 'size' => '30x2']) }}
        </div>
        <div class="form-group choice_c" style="{{ isset($question) && $question->number_of_answer == 2 ? 'display: none;' : 'display: block;' }}">
            {!! Form::label('choice_c', 'Choice C'); !!}
            {{ Form::textarea('choice_c', null, ['class' => 'form-control input-editor', 'placeholder' => 'Choice C', 'size' => '30x2']) }}
        </div>
        <div class="form-group choice_d" style="{{ isset($question) && ($question->number_of_answer == 2 || $question->number_of_answer == 3) ? 'display: none;' : 'display: block;' }}">
            {!! Form::label('choice_d', 'Choice D'); !!}
            {{ Form::textarea('choice_d', null, ['class' => 'form-control input-editor', 'placeholder' => 'Choice D', 'size' => '30x2']) }}
        </div>
        <div class="form-group choice_e" style="{{ isset($question) && ($question->number_of_answer == 2 || $question->number_of_answer == 3|| $question->number_of_answer == 4) ? 'display: none;' : 'display: block;' }}">
            {!! Form::label('choice_e', 'Choice E'); !!}
            {{ Form::textarea('choice_e', null, ['class' => 'form-control input-editor', 'placeholder' => 'Choice E', 'size' => '30x2']) }}
        </div>
        @php
            if(isset($question)){
                switch($question->answer){
                    case $question->choice_a:
                        $answer_choice = 'choice_a';
                        break;
                    case $question->choice_b:
                        $answer_choice = 'choice_b';
                        break;
                    case $question->choice_c:
                        $answer_choice = 'choice_c';
                        break;
                    case $question->choice_d:
                        $answer_choice = 'choice_d';
                        break;
                    case $question->choice_e:
                        $answer_choice = 'choice_e';
                        break;
                    default:
                        $answer_choice = 'choice_a';
                        break;
                }
            }
            else{
                $answer_choice = null;
            }
        @endphp
        <div class="form-group">
            {!! Form::label('answer', 'Correct Answer'); !!}
            {!! Form::select('answer', ['choice_a' => 'Choice A', 'choice_b' => 'Choice B', 'choice_c' => 'Choice C', 'choice_d' => 'Choice D', 'choice_e' => 'Choice E'], $answer_choice, ['id' => 'answer', 'class' => 'form-control', 'placeholder' => 'Correct Answer']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('explanation', 'Answer Explanation'); !!}
            {{ Form::textarea('explanation', null, ['class' => 'form-control input-editor', 'placeholder' => 'Answer Explanation', 'size' => '30x2']) }}
        </div>
    </div>

</div>                        

{!! Form::submit($btntitle, ['class' => 'btn btn-info btn-fill pull-right']); !!}
<div class="clearfix"></div>