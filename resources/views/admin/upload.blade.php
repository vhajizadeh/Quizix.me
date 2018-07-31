@extends('admin.layout.master')

@section('pagetitle', 'Bulk Upload - ' . config('app.name'))

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
                <li class="active">Bulk Upload</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
            <section class="panel">
                @include('admin.partial.error')
                <header class="panel-heading">
                    Bulk Upload
                </header>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'uploadData', 'files' => true)) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('category_id', 'Category'); !!}
                                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Pick a Category']); !!}
                                </div>
                                <div class="alert alert-danger">
                                    For Photo Questions, add the corresponding photos on- backend_root/uploads/question/
                                </div> 
                                <div class="alert alert-success">
                                    Excel File, Format- xlsx or xls
                                </div>   
                                <div class="form-group">
                                    {!! Form::label('upload_file', 'File'); !!}
                                    {!! Form::file('upload_file', ['class' => 'form-control', 'accept' => 'application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv']); !!}
                                </div>  
                            </div>

                        </div>                        

                        {!! Form::submit('Upload Data', ['class' => 'btn btn-info btn-fill pull-right']); !!}
                        <div class="clearfix"></div>
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