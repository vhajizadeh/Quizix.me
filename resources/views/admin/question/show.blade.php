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

                <div class="panel-body" style="max-width: 600px;">
                    @if($question->thumbnail)
                        <img src="{{ '../../uploads/question/' . $question->thumbnail }}" alt="{{ $question->title }}" class="img-responsive"><br />
                    @endif

                    <ul class="list-group">
                        <li class="list-group-item"><strong>Question Type:</strong> {{ ucfirst($question->question_type) }}</li>
                        <hr>
                        <li class="list-group-item"><strong>Choice A:</strong> {{ $question->choice_a }}</li>
                        <li class="list-group-item"><strong>Choice B:</strong> {{ $question->choice_b }}</li>
                        @if($question->choice_c)
                        <li class="list-group-item"><strong>Choice C:</strong> {{ $question->choice_c }}</li>
                        @endif
                        @if($question->choice_d)
                        <li class="list-group-item"><strong>Choice D:</strong> {{ $question->choice_d }}</li>
                        @endif
                        <hr>
                        <li class="list-group-item"><strong>Answer:</strong> {{ $question->answer }}</li>
                    </ul>
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