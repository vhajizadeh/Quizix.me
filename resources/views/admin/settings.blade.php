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

    {{-- <div class="row">
        <div class="col-md-2">
	        <div class="stat">
	            <div class="stat-icon" style="color:#fa8564;">
	                <i class="fa fa-star-o fa-3x stat-elem"></i>
	            </div>
	            <h5 class="stat-info">Score per Correct Answer- <strong>10</strong></h5>
	        </div>
	    </div>
	    <div class="col-md-2">
	        <div class="stat">
	            <div class="stat-icon" style="color:#45cf95;">
	                <i class="fa fa-clock-o fa-3x stat-elem"></i>
	            </div>
	            <h5 class="stat-info">Show Countdown Timer- <strong>Yes</strong></h5>
	        </div>
	    </div>
	    <div class="col-md-3">
	        <div class="stat">
	            <div class="stat-icon" style="color:#AC75F0">
	                <i class="fa fa-lock fa-3x stat-elem"></i>
	            </div>
	            <h5 class="stat-info">Countdown Timer Duration- <strong>30 Seconds</strong></h5>
	        </div>
	    </div>
	    <div class="col-md-2">
	        <div class="stat">
	            <div class="stat-icon" style="color:#45cf95;">
	                <i class="fa fa-arrow-right fa-3x stat-elem"></i>
	            </div>
	            <h5 class="stat-info">Skip Button- <strong>Yes</strong></h5>
	        </div>
	    </div>
	    <div class="col-md-2">
	        <div class="stat">
	            <div class="stat-icon" style="color:#AC75F0">
	                <i class="fa fa-dollar fa-3x stat-elem"></i>
	            </div>
	            <h5 class="stat-info">AdMob- <strong>On</strong></h5>
	        </div>
	    </div>
	</div>   --}}

	<div class="row">
        <div class="col-xs-6">
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
                            <td>Get all Categories(First Level)</td>
                            <td>{{ url('/') }}/api/categories</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get all Child Categories of a Category</td>
                            <td>{{ url('/') }}/api/categories/{id}</td>
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