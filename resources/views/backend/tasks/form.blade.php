@extends(config('main-app-layout', 'redprintUnity::page'))

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

  <form method="post" action="{{ route('task.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

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
            <input type="text" name="state" class="form-control" value="{{ $task->state ?: old('state') }}">
            @if ($errors->has('state'))
                <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('user_id') ? 'has-error' : '' }}">
            <label>User_Id</label>
            <input type="text" name="user_id" class="form-control" value="{{ $task->user_id ?: old('user_id') }}">
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