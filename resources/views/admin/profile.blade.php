@extends('admin.layout.master')

@section('pagetitle', 'Profile - ' . config('app.name'))

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
                <li class="active">Profile</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>  

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Update User Data</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('updatePassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('uname') ? ' has-error' : '' }}">
                            <label for="uname" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="uname" type="text" class="form-control" name="uname" value="{{ old('uname') }}" required autofocus>

                                @if ($errors->has('uname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('uemail') ? ' has-error' : '' }}">
                            <label for="uemail" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="uemail" type="email" class="form-control" name="uemail" value="{{ Auth::user()->email }}" required>

                                @if ($errors->has('uemail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uemail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('upassword') ? ' has-error' : '' }}">
                            <label for="upassword" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="upassword" type="password" class="form-control" name="upassword" required>

                                @if ($errors->has('upassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('upassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="upassword-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="upassword-confirm" type="password" class="form-control" name="upassword_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Add New User</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('createUser') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Current Users
                </header>
                <div class="panel-body table-responsive">
                    @if(count($users) > 0)
                    <div class="table-responsive">
                    <table class="table table-hover" id="questions">
                        <thead>                          
                            <tr>
                                <th>SL</th>
                                <th>Name</th>   
                                <th>Email Address</th>
                                <th>Added On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($users as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{!! $user->name !!}</td>
                            <td>{{ $user->email }}</td>                    
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                <form class="form-horizontal" method="POST" action="{{ route('deleteUser') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                <form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                    
                    <p>&nbsp;</p>
                    
                    {{ $users->render() }}  
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