@extends('admin.layout.master')

@section('pagetitle', 'Questions - ' . config('app.name'))

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
                <li class="active">Question</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Questions
                    <a href="{{ Route('question.create') }}" class="btn btn-primary pull-right" style="position: relative;top: -7px;right: 10px;">Add New</a>
                </header>
                <div class="panel-body table-responsive">
                    @if(count($questions) > 0)
                    <table class="table table-hover" id="questions">
                        <thead>                          
                            <tr>
                                <th>SL</th>
                                <th>Title</th>   
                                <th>Category</th>
                                <th>Question Type</th>
                                <th>Choice A</th>  
                                <th>Choice B</th>
                                <th>Choice C</th>
                                <th>Choice D</th>
                                <th>Answer</th>
                                <th>Added On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($questions as $key => $question)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $question->title }}</td>
                            <td>
                                @if($question->category)
                                    {{ $question->category->title }}
                                @else
                                    {{ "N/A" }}
                                @endif                                
                            </td>  
                            <td>{{ ucfirst($question->question_type) }}</td>
                            <td>{{ $question->choice_a }}</td> 
                            <td>{{ $question->choice_b }}</td>  
                            <td>{!! $question->choice_c ? $question->choice_c : '<span class="badge badge-dark" style="padding: 5px 10px;">N/A</span>' !!}</td>  
                            <td>{!! $question->choice_d ? $question->choice_d : '<span class="badge badge-dark" style="padding: 5px 10px;">N/A</span>' !!}</td>  
                            <td>{{ $question->answer }}</td>                          
                            <td>{{ $question->created_at->diffForHumans() }}</td>
                            <td>{!! $question->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' !!}</td>
                            <td>
                                <a href="{{ Route('question.show', $question->id) }}"><button class="btn btn-primary btn-sm">View Details</button></a>
                                <a href="{{ Route('questionStatus', ['id' => $question->id, 'status' => $question->status]) }}"><button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Change Status to {{ $question->status == 1 ? 'Inactive' : 'Active' }}"><i class="fa fa-check"></i></button></a>
                                <a href="{{ Route('question.edit', $question->id) }}"><button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Edit"><i class="fa fa-pencil"></i></button></a>
                                {{ Form::open(array('route' => array('question.destroy', $question->id), 'method' => 'delete', 'style' => 'display:initial;')) }}
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <p>&nbsp;</p>
                    
                    {{ $questions->render() }}  
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
       /* Page Specific Custom Script Here */
   </script>
@endpush