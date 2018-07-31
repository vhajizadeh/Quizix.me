@extends('admin.layout.master')

@section('pagetitle', 'GDPR - ' . config('app.name'))

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
                <li class="active">GDPR</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    GDPR
                </header>
                <div class="panel-body table-responsive">
                     {!! Form::open(array('route' => 'addGdpr')) !!}
                        <div class="row">
                            <div class="form-group question_image">
                                {!! Form::label('thumbnail', 'GDPR Image'); !!}
                                {!! Form::file('thumbnail', ['class' => 'form-control']); !!}
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('content', 'Content'); !!}
                                    {!! Form::textarea('content', null, ['class' => 'form-control gdpr', 'placeholder' => 'Content', 'style' => 'height: 400px;']); !!}
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
            $('.gdpr').summernote({
                height: 400,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });

            @isset($gdpr['content'])
                $('.gdpr').summernote('code', '{!! $gdpr['content'] !!}');
            @endisset
        });
    </script>
@endpush