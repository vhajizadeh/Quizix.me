@extends('admin.layout.master')

@section('pagetitle', 'Question - ' . config('app.name'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="{{ Route('question.index') }}">Question</a></li>
                <li class="active">{!! preg_replace('~<p>(.*?)</p>~is', '$1', $question->title, 1) !!}</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>    

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <header class="panel-heading">
                    <strong>Question:</strong> {!! preg_replace('~<p>(.*?)</p>~is', '$1', $question->title, 1) !!}
                </header>

                <div class="panel-body" style="font-family: 'Lato'; font-size: 15px;">
                    @if($question->thumbnail)
                        <img src="{{ '../../uploads/question/' . $question->thumbnail }}" alt="{{ strip_tags($question->title) }}" class="img-responsive"><br />
                    @endif
                    
                    <p><strong>Question Type:</strong> {{ ucfirst($question->question_type) }}</p>
                    <p><strong>Choice A:</strong> {!! preg_replace('~<p>(.*?)</p>~is', '$1', $question->choice_a, 1) !!}</p>
                    <p><strong>Choice B:</strong> {!! preg_replace('~<p>(.*?)</p>~is', '$1', $question->choice_b, 1) !!}</p>
                    @if($question->choice_c)
                    <p><strong>Choice C:</strong> {!! preg_replace('~<p>(.*?)</p>~is', '$1', $question->choice_c, 1) !!}</p>
                    @endif
                    @if($question->choice_d)
                    <p><strong>Choice D:</strong> {!! preg_replace('~<p>(.*?)</p>~is', '$1', $question->choice_d, 1) !!}</p>
                    @endif
                    <p><strong>Correct Answer:</strong> {!! preg_replace('~<p>(.*?)</p>~is', '$1', $question->answer, 1) !!}</p>
                    @if($question->explanation)
                    <p><strong>Answer Explnation:</strong> {!! preg_replace('~<p>(.*?)</p>~is', '$1', $question->explanation, 1) !!}</p>
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