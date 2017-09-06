<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\CreateDirRequest;
use App\Http\Controllers\Controller;
use Sentinel;
use App\Models\UserRoot;
use Storage;

class HomeController extends Controller
{
  /**
   * Set middleware to quard controller.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('sentinel.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if (session()->has('root')) {
			$root_dir = session('root');
		} else {
			$user_id = Sentinel::getUser()->id;
			$root_dir = UserRoot::where('user_id', $user_id)->get(['name'])->first();
			$root_dir = $root_dir->name;
		
			session(['root' => $root_dir]);
		}
			
		$directories = Storage::disk('public')->directories($root_dir);
		
        return view('user.home', ['directories' => $directories]);
    }
	
	public function directories($dir = null)
	{
		$directories = Storage::disk('public')->directories(session('root').'/'.$dir);
		
		return view('user.home', ['directories' => $directories]);
		
	}
	
	public function create(CreateDirRequest $request)
	{
		$input = $request->all();
		dd($input);
	}
}
