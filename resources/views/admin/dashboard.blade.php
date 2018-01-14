@extends('admin.layout.master')

@section('pagetitle', 'Dashboard - ' . config('app.name'))

@section('content')
   <div class="row" style="margin-bottom:5px;">
      <div class="col-md-3">
         <div class="sm-st clearfix">
            <span class="sm-st-icon st-violet"><i class="fa fa-check-square-o"></i></span>
            <div class="sm-st-info">
               <span>{{ $total_category }}</span>
               Total Categories
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="sm-st clearfix">
            <span class="sm-st-icon st-blue"><i class="fa fa-envelope-o"></i></span>
            <div class="sm-st-info">
               <span>{{ $total_question }}</span>
               Total Questions
            </div>
         </div>
      </div>
{{--       <div class="col-md-3">
         <div class="sm-st clearfix">
            <span class="sm-st-icon st-green"><i class="fa fa-star"></i></span>
            <div class="sm-st-info">
               <span>10</span>
               Score per Correct Answer
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="sm-st clearfix">
            <span class="sm-st-icon st-red"><i class="fa fa-clock-o"></i></span>
            <div class="sm-st-info">
               <span>On</span>
               Countdown Timer
            </div>
         </div>
      </div> --}}
   </div>
   <!-- Main row -->
   <div class="row">
      <div class="col-md-5">
         <section class="panel tasks-widget">
            <header class="panel-heading">
               Recently added Categories
            </header>
            <div class="panel-body">
               @if(count($categories) > 0)
                    <table class="table table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Title</th> 
                            <th>Parent Category</th>
                            <th>Quetions</th>
                            <th>Added On</th>
                            <th>Status</th>
                        </tr>
                        @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $category->title }}</td>  
                            <td>{!! $category->parent['title'] ? $category->parent['title'] : '<span class="badge badge-dark" style="padding: 5px 10px;">N/A</span>' !!}</td>
                            <td>{{ $category->question_count }}</td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                            <td>{!! $category->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' !!}</td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                        <p><h5 style="color:#F00;">No Data</h5></p>
                    @endif
               <div class=" add-task-row">
                  <a class="btn btn-success btn-sm pull-left" href="{{ Route('category.create') }}">Add New Category</a>
                  <a class="btn btn-default btn-sm pull-right" href="{{ Route('category.index') }}">See All Categories</a>
               </div>
            </div>
         </section>
      </div>
      <!--end col-6 -->
      <div class="col-md-7">
         <section class="panel tasks-widget">
            <header class="panel-heading">
              Recently added Questions
            </header>
            <div class="panel-body">
               @if(count($questions) > 0)
                    <table class="table table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>   
                            <th>Category</th>
                            <th>Choice A</th>  
                            <th>Choice B</th>
                            <th>Choice C</th>
                            <th>Choice D</th>
                            <th>Answer</th>
                            <th>Added On</th>
                            <th>Status</th>
                        </tr>
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
                            <td>{{ $question->choice_a }}</td> 
                            <td>{{ $question->choice_b }}</td>  
                            <td>{!! $question->choice_c ? $question->choice_c : '<span class="badge badge-dark" style="padding: 5px 10px;">N/A</span>' !!}</td>  
                            <td>{!! $question->choice_d ? $question->choice_d : '<span class="badge badge-dark" style="padding: 5px 10px;">N/A</span>' !!}</td>  
                            <td>{{ $question->answer }}</td>     
                            <td>{{ $question->created_at->diffForHumans() }}</td>                      
                            <td>{!! $question->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' !!}</td>                            
                        </tr>
                        @endforeach
                    </table>
                    @else
                        <p><h5 style="color:#F00;">No Data</h5></p>
                    @endif
               <div class=" add-task-row">
                  <a class="btn btn-success btn-sm pull-left" href="{{ Route('question.create') }}">Add New Questions</a>
                  <a class="btn btn-default btn-sm pull-right" href="{{ Route('question.index') }}">See All Questions</a>
               </div>
            </div>
         </section>
      </div>
   </div>
   <!-- row end -->
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