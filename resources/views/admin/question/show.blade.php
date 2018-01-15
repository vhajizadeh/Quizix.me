@extends('admin.layout.master')

@section('pagetitle', 'Question - ' . config('app.name'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="{{ Route('question.index') }}">Question</a></li>
                <li class="active">{{ $question->title }}</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>    

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <header class="panel-heading">
                    <strong>Question:</strong> {{ $question->title }}
                </header>

                <div class="panel-body" style="font-family: 'Lato'; font-size: 15px;">
                    @if($question->thumbnail)
                        <img src="{{ '../../uploads/question/' . $question->thumbnail }}" alt="{{ $question->title }}" class="img-responsive"><br />
                    @endif
                    
                    <p><strong>Question Type:</strong> {{ ucfirst($question->question_type) }}</p>
                    <p><strong>Choice A:</strong> {{ $question->choice_a }}</p>
                    <p><strong>Choice B:</strong> {{ $question->choice_b }}</p>
                    @if($question->choice_c)
                    <p><strong>Choice C:</strong> {{ $question->choice_c }}</p>
                    @endif
                    @if($question->choice_d)
                    <p><strong>Choice D:</strong> {{ $question->choice_d }}</p>
                    @endif
                    <p><strong>Correct Answer:</strong> {{ $question->answer }}</p>
                    @if($question->explanation)
                    <p><strong>Answer Explnation:</strong> {{ $question->explanation }}</p>
                    @endif
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection

@push('styles')
   <style>
      /* Page Specific Custom Style Here */
   </style>
@endpush

@push('scripts')
   <script>
      // Page Specific Custom Script Here 
   </script>
@endpush