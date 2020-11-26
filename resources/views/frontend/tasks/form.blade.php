@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Task - Form @stop

@section('page_title') Task @stop
@section('page_subtitle') @if ($task->exists) {{ trans('redprint::core.editing') }} Task: {{ $task->id }} @else Add New Task @endif @stop

@section('title')
  @parent
  Task
@stop

@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('vendor/redprintUnity/vendor/summernote/summernote-bs4.css') }}" />
@stop

@section('js')
  @parent
  <script src="{{ asset('vendor/redprintUnity/vendor/summernote/summernote-bs4.min.js') }}"></script>
@stop


@section('content')

  <form method="post" action="{{ route('tasklist.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">
  
  <div class="card">

        <div class="card-header">
            
			<h5>Create New Task</h5>
			 <div class="btn-group float-right">
			<a href="{{ route('task.frontend.index') }}" class="btn btn-success"><i class="fa fa-list"></i>&nbsp;&nbsp;View Tasks</a>
			
          
        </div>
        </div>

    <div class="card-body row">
        <input type="hidden" name="id" value="{{ $task->id }}" >
                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('description') ? 'has-error' : '' }}">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ $task->description ?: old('description') }}">
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('state') ? 'has-error' : '' }}">
            <label>State</label>
			<div class="radio-inline">
				<input required type="radio" name="state" value="Done" @if($task->state === "Done") checked="checked" @endif >
				<label>Done</label>&nbsp;
				<input required type="radio" name="state" value="Undone" @if($task->state === "Undone") checked="checked" @endif>
				<label>Undone</label>
			</div>
            
            @if ($errors->has('state'))
                <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('user_id') ? 'has-error' : '' }}">
            <label>Task Assigned to</label>
			
			   <select type="text"  class="form-control" name="user_id">
 
					 @foreach($user_names as $user_name)
					 
				<option value="{{$user_name->id}}"  @if(old('user_id',$user_name->id) ==  "$task->user_id") selected @endif> {{$user_name->name}}</option>
						
					@endforeach
				</select>
			
            @if ($errors->has('user_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('user_id') }}</strong>
                </span>
            @endif
        </div>

    </div>

    <div class="card-footer">
      <div class="row">
        <div class="col-sm-8">
          <button type="submit" class="btn-primary btn" >{{ trans('redprint::core.save') }}</button>
        </div>
      </div>
    </div>

  </div>
  </form>

@stop