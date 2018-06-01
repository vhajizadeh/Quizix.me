@extends('admin.layout.master')

@section('pagetitle', 'Settings - ' . config('app.name'))

@section('content')
	<div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Setting</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>      

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <header class="panel-heading">
                    API URLs
                </header>

                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Purpose</th>
                            <th>URL</th>
                            <th>Type</th>
                        </tr>
                        <tr>
                            <td>Get all Categories(First Level/No Child, Free + Premium)</td>
                            <td>{{ url('/') }}/api/categories/all</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get all Categories(First Level/No Child, Free)</td>
                            <td>{{ url('/') }}/api/categories/free</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get all Categories(First Level/No Child, Premium)</td>
                            <td>{{ url('/') }}/api/categories/premium</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get all Child Categories of a Category</td>
                            <td>{{ url('/') }}/api/categories/{id}/all</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get all Child Categories of a Category(Free)</td>
                            <td>{{ url('/') }}/api/categories/{id}/free</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get all Child Categories of a Category(Premium)</td>
                            <td>{{ url('/') }}/api/categories/{id}/premium</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get single Category</td>
                            <td>{{ url('/') }}/api/category/{id}</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get all Questions in a Category</td>
                            <td>{{ url('/') }}/api/category/{id}/questions</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get all Questions</td>
                            <td>{{ url('/') }}/api/questions</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get single Question</td>
                            <td>{{ url('/') }}/api/question/{id}</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get Tutorial</td>
                            <td>{{ url('/') }}/api/tutorial</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                    </table>
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