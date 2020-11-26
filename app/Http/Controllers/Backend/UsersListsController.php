<?php

namespace App\Http\Controllers\Backend;

use App\UsersList;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\UsersListRequest;
use App\Http\Controllers\Controller;

class UsersListsController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usersLists = UsersList::withTrashed();
        
        $usersLists = $usersLists->paginate(20);
        return view('backend.usersLists.index')->with('usersListsData', $usersLists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(UsersList $usersList = null)
    {
        $usersList = $usersList ?: new UsersList;
        return view('backend.usersLists.form')->with('usersList', $usersList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(UsersListRequest $request)
    {
        $usersList = UsersList::firstOrNew(['id' => $request->get('id')]);
        $usersList->id = $request->get('id');
		$usersList->name = $request->get('name');
		$usersList->email = $request->get('email');

        $usersList->save();

        $message = trans('redprint::core.model_added', ['name' => 'usersList']);
        return redirect()->route('usersList.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(UsersList $usersList)
    {
        $usersList->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'usersList']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($usersListId)
    {
        $usersList = UsersList::withTrashed()->find($usersListId);
        $usersList->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'usersList']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($usersListId)
    {
        $usersList = UsersList::withTrashed()->find($usersListId);
        $usersList->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'usersList']);
        return redirect()->back()->withMessage($message);
    }
}
