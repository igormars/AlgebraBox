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
			session(['curr_dir' => '']);
		} else {
			$user_id = Sentinel::getUser()->id;
			$root_dir = UserRoot::where('user_id', $user_id)->get(['name'])->first();
			$root_dir = $root_dir->name;

			session(['root' => $root_dir]);
		}

		$directories = Storage::disk('public')->directories($root_dir);

		return view('user.home')
							 ->with('directories', $directories)
							 ->with('curr_dir', '')
							 ->with('level_up', '');
	}

	/**
	* Browse directory.
	*
	* @return void
	*/
	public function directories($dir = null)
	{
		$dir = ltrim($dir, '/');
		session(['curr_dir' => $dir]);
		$directories = Storage::disk('public')->directories(session('root').'/'.$dir);
		$levels = explode('/', $dir);
		array_pop($levels);
		$level_up = implode('/', $levels);
		return view('user.home')
					 ->with('directories', $directories)
					 ->with('curr_dir', $dir)
					 ->with('level_up', $level_up);
	}

	/**
	* Create new directory.
	*
	* @return void
	*/
	public function create(CreateDirRequest $request)
	{
		if($request->new_dir){
			$new_dir = ('public/'.session('root').'/'.session('curr_dir').'/'.$request->new_dir);
			Storage::makeDirectory($new_dir);

			return redirect()->back()->with(['success' => 'Folder <strong>( ' . $request->new_dir . ' )</strong> is created.']);
		}

      return redirect()->back()->with(['warning' => 'Define Folder name!']);
	}

	 /**
	 * Delete directory.
	 *
	 * @return void
	 */
	 public function delete($dir)
	 {
			$dir_for_del = 'public/' . session('root') .'/'. session('curr_dir') .'/'. $dir;

			if(Storage::deleteDirectory($dir_for_del))
			{
				 return redirect()->back()->with(['success' => 'Folder <strong>( ' . $dir . ' )</strong> is deleted.']);
			}

			return redirect()->back()->with(['error' => 'Whoops, looks like something went wrong']);
	 }
}
