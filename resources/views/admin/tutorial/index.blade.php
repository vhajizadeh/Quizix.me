@extends('admin.layout.master')

@section('pagetitle', 'Tutorial - ' . config('app.name'))

@section('content')
    @if(session()->has('message'))
        <script>
            window.onload = function() {
                quizix.showNotification('top','right', '{{ session()->get('type') }}', '{{ session()->get('message') }}')
            }
        </script>
    @endif

    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Tutorial</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Tutorial
                </header>
                <div class="panel-body table-responsive">
                     {!! Form::open(array('route' => 'addTutorial')) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('content', 'Content'); !!}
                                    {!! Form::textarea('content', null, ['class' => 'form-control tutorial', 'placeholder' => 'Content', 'style' => 'height: 400px;']); !!}
                                </div>        
                            </div>
                        </div>                        

                        {!! Form::submit('Submit', ['class' => 'btn btn-info btn-fill pull-right']); !!}
                        <div class="clearfix"></div>
                    {!! Form::close() !!}
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
        $(document).ready(function() {
            $('.tutorial').summernote({
                height: 400,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });

            @if(count($tutorial) > 0)
                $('.tutorial').summernote('code', '{!! $tutorial['content'] !!}');
            @endif
        });
    </script>
@endpush