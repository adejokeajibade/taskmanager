<?php

namespace App\Http\Controllers\Backend\API;

use App\UsersList;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\UsersListRequest;
use App\Http\Resources\UsersListCollection;
use App\Http\Resources\UsersList as UsersListResource;
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
        $usersLists = UsersList::with('AssignedTask')->get();
        
        return (new UsersListCollection($usersLists));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
		$usersList = UsersList::firstOrNew(['id' => $request->get('id')]);
		$usersList->id = $request->get('id');
		$usersList->name = $request->get('name');
		$usersList->email = $request->get('email');

        $usersList->save(); 
		

        $responseCode = $request->get('id') ? 200 : 201;
        return response()->json(['saved' => true], $responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
		$usersList = UsersList::find($request->get('id'));
        $usersList->delete();
        return response()->json(['no_content' => true], 200);
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $usersList = UsersList::withTrashed()->find($request->get('id'));
        $usersList->restore();
        return response()->json(['no_content' => true], 200);
    }
}
