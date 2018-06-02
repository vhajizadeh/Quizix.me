@extends('admin.layout.master')

@section('pagetitle', 'Create Question - ' . config('app.name'))

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
                    Add New Question
                </header>
                <div class="panel-body">
                  @if($categories->count())
                    {!! Form::open(array('route' => 'question.store', 'files' => true)) !!}
                        @include('admin.question.partial.form', ['btntitle' => 'Add Question'])
                    {!! Form::close() !!}
                  @else
                    <div class="alert alert-danger">
                      You need to add Category First!
                    </div>
                  @endif
                </div>
            </section>
        </div>
    </div>
 @endsection

@push('styles')
   <style>
      @if(env("MATH_QUESTION", "no") == 'no')
        textarea.form-control {
            height: 34px;
        }

        textarea#title {
            height: 68px;
        }
      @endif
   </style>
@endpush

@push('scripts')
   <script>
      @if(env("MATH_QUESTION", "no") == 'yes')
       $(document).ready(function() {
          $('.input-editor').summernote({
             toolbar: [
                ['font', ['superscript', 'subscript']],
             ]
          });
       });
      @endif
   </script>
@endpush