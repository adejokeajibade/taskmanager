@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') UsersList - Index @stop

@section('page_title') UsersList @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
 <div class="card">

        <div class="card-header">
		
		<h5>View All Users</h5>
			 <div class="btn-group float-right">
            <a href="{{ route('users.new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Create {{ trans('redprint::core.new') }} User</a>&nbsp;&nbsp;
			
			<a href="{{ route('task.frontend.index') }}" class="btn btn-success"><i class="fa fa-list"></i>&nbsp;&nbsp;View Tasks</a>
			
          
        </div> 
        </div>


        <div class="card-body">
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <thead>
                        <tr>
                            <td>Name</td>
<td>Email</td>

                            <th>{{ trans('redprint::core.actions') }}</th>
                        </tr>
                    </thead>
					
                    @foreach($usersListsData as $usersListItem)
                    <tr>
                        <td> {{ $usersListItem['name'] }}</td>
						<td> {{ $usersListItem['email'] }}</td>

                        <th>
                            @if(!$usersListItem['deleted_at'])
                                <a href="#" class="btn btn-xs btn-success" data-target="#viewModal{{ $usersListItem['id'] }}" data-toggle="modal" >View</a>
		
		<!-- modal starts -->
			<div class="modal fade" id="viewModal{{ $usersListItem['id'] }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                           
                   <div class="modal-header">
                     
                     <h4 class="modal-title"> View {{ $usersListItem['name'] }}'s Task </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                             <table class="table table-striped table-hover table-bordered">
												<tbody>
													<thead>
														<tr>
															<td>Description</td>
															<td>State</td>
														</tr>
													</thead>
			
				@foreach ($usersListItem['assigned_task'] as $assignedTask)
														<tr>
							<td>{{ $assignedTask['description'] }}</td>
							<td>{{ $assignedTask['state'] }}</td>
														</tr>
														@endforeach
												</tbody>
											 </table>					
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->
								
								<a href="{{ route('users.edit', $usersListItem['id']) }}" class="btn btn-primary btn-xs">{{ trans('redprint::core.edit') }}</a>
                               
							   <a href="#" class="btn btn-xs btn-warning" data-target="#deleteModal{{ $usersListItem['id'] }}" data-toggle="modal" >{{ trans('redprint::core.delete') }}</a>


                                <!-- modal starts -->
                                <div class="modal fade" id="deleteModal{{ $usersListItem['id'] }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('users.delete', $usersListItem['id']) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                
                                                <h4 class="modal-title"> {{ trans('redprint::core.delete') }}: {{ $usersListItem['name'] }}'s Profile </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_delete') }} <strong>{{ $usersListItem['name'] }}'s Profile ?</strong>
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                                <button type="submit" class="btn btn-danger">{{ trans('redprint::core.delete') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->

                            @else

                                <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $usersListItem['id'] }}" data-toggle="modal" >Restore</a>
                                <a href="#" class="btn btn-xs btn-danger" data-target="#forceDeleteModal{{ $usersListItem['id'] }}" data-toggle="modal" >{{ trans('redprint::core.permanently_delete') }}</a>


                                <!-- modal starts -->
                                <div class="modal fade" id="restoreModal{{ $usersListItem['id'] }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('usersList.restore', $usersListItem['id']) }}" >
                                            {!! csrf_field() !!}

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> {{ trans('redprint::core.restore') }}: {{ $usersListItem['id'] }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_restore') }} <code>{{ $usersListItem['id'] }} ?</code>
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                                <button type="submit" class="btn btn-primary">{{ trans('redprint::core.restore') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->



                                <!-- modal starts -->
                                <div class="modal fade" id="forceDeleteModal{{ $usersListItem['id'] }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('usersList.force-delete', $usersListItem['id']) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Permanently: {{ $usersListItem['id'] }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_permanent_delete') }} <strong>{{ $usersListItem['id'] }} </strong> ? {{ trans('redprint::core.permanent_delete_warning') }}
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                                <button type="submit" class="btn btn-primary">{{ trans('redprint::core.permanently_delete') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->

                            @endif
                        </th>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>
@stop