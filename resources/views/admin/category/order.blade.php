@extends('admin.layout.master')

@section('pagetitle', 'Categories - ' . config('app.name'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Order Category</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Order Categories
                    <a href="{{ Route('category.create') }}" class="btn btn-primary pull-right" style="position: relative;top: -7px;right: 10px;">Add New</a>
                </header>
                <div class="panel-body table-responsive">
                    @if(count($categories) > 0)
                    <div class="alert alert-warning">
                        Drag &amp; Drop Category position to adjust
                    </div> 
                    <div class="table-responsive">
                        {!! Form::open(array('route' => 'categoryChangeOrder')) !!}
                        <table class="table table-hover" id="sortable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th> 
                                    <th>Parent Category</th>
                                    <th>Quick Quiz</th>
                                    <th>Quetions</th>
                                    <th>Added On</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $category)                                
                                <tr style="cursor: move;">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $category->title }}</td>  
                                    <td>{!! $category->parent['title'] ? $category->parent['title'] : '<span class="badge badge-dark" style="padding: 5px 10px;">N/A</span>' !!}</td>
                                    <td>{!! $category->quick == 1 ? '<span class="label label-success" style="padding: 5px 10px;">Yes</span>' : '<span class="label label-danger" style="padding: 5px 10px;">No</span>' !!}</td>
                                    <td>{{ $category->question_count }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>{!! $category->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' !!}</td>
                                    <input type="hidden" name="cat_id[]" value="{{ $category->id }}">
                                </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                        {!! Form::submit('Change Order', ['class' => 'btn btn-info btn-fill pull-right']); !!}
                        {!! Form::close() !!}
                    </div>
                    @else
                        <p><h5 style="color:#F00;">No Data</h5></p>
                    @endif
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection

@push('styles')
   <link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
@endpush

@push('scripts')
    
    <script src="//code.jquery.com/jquery-1.11.1.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

    <script>
        $(function  () {
            $('tbody').sortable();
        });
    </script>
@endpush