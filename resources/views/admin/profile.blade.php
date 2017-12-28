@extends('admin.layout.master')

@section('pagetitle', 'Profile - ' . config('app.name'))

@section('content')
	<div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Profile</li>
            </ul>
            <!--breadcrumbs end -->
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