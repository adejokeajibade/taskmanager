<?php

namespace App\Http\Controllers\Frontend;

use App\Task;
use App\UsersList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
        //define API Endpoint
		$api_base_url = env('BASE_API_URL_TASKS');
		
		//initialize curl session
         $curl = curl_init();
		
		// Set some options
		curl_setopt_array($curl, array(
                   CURLOPT_RETURNTRANSFER => 1,
                   CURLOPT_URL => $api_base_url,
                   ));
				   
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
             'Content-Type: application/json',
             "accept: application/json"
                ));
									
		// Send the request & save response to $resp
            $resp = curl_exec($curl);
        
		// Close request to clear up some resources
            $err = curl_error($curl);
			
			curl_close($curl);
						
		 if ($resp) 
		 {
            $response = json_decode($resp, true);
			$tasks = $response['data'];
			return view('frontend.tasks.index')->with('tasksData', $tasks);
		 }else 
			{
              return redirect()->back()->with('error', 'Sorry, Try again');
             }
          
	
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	  public function edit(Task $task = null)
    {
        $task = $task ?: new Task;
		
		$user_names = UsersList::select('id','name')->get();
	
		return view('frontend.tasks.form')->with(['task'=>$task,'user_names' => $user_names]);
    }
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function save(Request $request)
    {
    
	   $data = array (
					
				'id' =>	$request->get('id'),	
				'description' =>	$request->get('description'),
				'state' => $request->get('state'),
				'user_id' => $request->get('user_id'),
				
				);
	   //define API Endpoint
		$api_base_url = env('BASE_API_URL_EDITTASKS');
		
		//initialize curl session
         $curl = curl_init();
		
		// Set some options
		curl_setopt_array($curl, array(
                   CURLOPT_RETURNTRANSFER => 1,
                   CURLOPT_URL => $api_base_url,
				   CURLOPT_POST => 1,
                   CURLOPT_POSTFIELDS => json_encode($data)
                   ));
				   
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
             'Content-Type: application/json',
             "accept: application/json"
                ));
									
		// Send the request & save response to $resp
            $resp = curl_exec($curl);
        
		// Close request to clear up some resources
            $err = curl_error($curl);

			curl_close($curl);
						
		 if ($resp) 
		 {
            $response = json_decode($resp, true);
			
			if($response['saved'] == "true")
			{
				 $message = trans('redprint::core.model_added', ['name' => 'task']);
				return redirect()->route('task.frontend.index')->withMessage($message);
			}
		 else 
			{
              return redirect()->back()->with('error', 'Sorry, Try again');
             }
          }
		  else 
		  {
              return redirect()->back()->with('error', 'Sorry, Try again');
          }
	} 
	
	 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Task $task)
    {
    
	    $data = array (
						'id' =>	$task->id,
					  ); 
	  
	   //define API Endpoint
		$api_base_url ="http://taskmanager.rccg.org/api/v1/backend/tasks/{task}/delete";

		//initialize curl session
         $curl = curl_init();
		
		// Set some options
		curl_setopt_array($curl, array(
                   CURLOPT_RETURNTRANSFER => 1,
                   CURLOPT_URL => $api_base_url,
				   CURLOPT_POST => 1,
                   CURLOPT_POSTFIELDS => json_encode($data)
                   ));
				   
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
             'Content-Type: application/json',
             "accept: application/json"
                ));
									
		// Send the request & save response to $resp
            $resp = curl_exec($curl);
        
		// Close request to clear up some resources
            $err = curl_error($curl);
			
			curl_close($curl);
						
		 if ($resp) 
		 {
            $response = json_decode($resp, true);
			if($response['no_content'] == "true")
			{
				$message = trans('redprint::core.model_deleted', ['name' => 'task']);
				return redirect()->back()->withMessage($message);
			}
		 else 
			{
              return redirect()->back()->with('error', 'Sorry, Try again');
             }
          }
		  else 
		  {
              return redirect()->back()->with('error', 'Sorry, Try again');
          }
	}
}
