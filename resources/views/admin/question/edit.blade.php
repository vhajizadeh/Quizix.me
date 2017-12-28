@extends('admin.layout.master')

@section('pagetitle', 'Edit Question - ' . config('app.name'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Question</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
            <section class="panel">
                @include('admin.partial.error')
                <header class="panel-heading">
                    Edit Question
                </header>
                <div class="panel-body">
                    {!! Form::model($question, ['route' => ['question.update', $question->id], 'method' => 'PATCH', 'files' => true]) !!}
                        @include('admin.question.partial.form', ['btntitle' => 'Update Question'])
                    {!! Form::close() !!}
                </div>
            </section>
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