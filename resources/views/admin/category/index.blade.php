@extends('admin.layout.master')

@section('pagetitle', 'Categories - ' . config('app.name'))

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
                <li class="active">Category</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Categories
                    <a href="{{ Route('category.create') }}" class="btn btn-primary pull-right" style="position: relative;top: -7px;right: 10px;">Add New</a>
                </header>
                <div class="panel-body table-responsive">
                    @if(count($categories) > 0)
                    <table class="table table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Title</th> 
                            <th>Quetions</th>
                            <th>Thumbnail</th>
                            <th>Added On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $category->title }}</td>  
                            <td>{{ $category->question_count }}</td>
                            <td>
                                @if($category->thumbnail)
                                    <img src="{{ '../uploads/category/' . $category->thumbnail }}" alt="{{ $category->title }}" class="img-responsive" style="max-width: 100px !important;height: auto;" />
                                @endif
                            </td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                            <td>{!! $category->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' !!}</td>
                            <td>
                                <a href="{{ Route('categoryStatus', ['id' => $category->id, 'status' => $category->status]) }}"><button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Change Status"><i class="fa fa-check"></i></button></a>
                                <a href="{{ Route('category.edit', $category->id) }}"><button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Edit"><i class="fa fa-pencil"></i></button></a>
                                {{ Form::open(array('route' => array('category.destroy', $category->id), 'method' => 'delete', 'style' => 'display:initial;')) }}
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <p>&nbsp;</p>
                    
                    {{ $categories->render() }}  
                    @else
                        <p><h5 style="color:#F00;">No Data</h5></p>
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