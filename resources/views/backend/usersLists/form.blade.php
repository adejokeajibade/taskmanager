@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') UsersList - Form @stop

@section('page_title') UsersList @stop
@section('page_subtitle') @if ($usersList->exists) {{ trans('redprint::core.editing') }} UsersList: {{ $usersList->id }} @else Add New UsersList @endif @stop

@section('title')
  @parent
  UsersList
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

  <form method="post" action="{{ route('usersList.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
        <input type="hidden" name="id" value="{{ $usersList->id }}" >
                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $usersList->name ?: old('name') }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('email') ? 'has-error' : '' }}">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="{{ $usersList->email ?: old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
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