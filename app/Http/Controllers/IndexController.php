<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateDirRequest;
use Image;
use Storage;

class IndexController extends Controller
{
  /**
   * Set middleware to quard controller.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('sentinel.guest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }
	
	public function create(CreateDirRequest $request)
	{
		if($request->new_dir){
			$new_dir = ('public/'.session('root').'/'.session('curr_dir').'/'.$request->new_dir);
			Storage::makeDirectory($new_dir);

			return redirect()->back()->with(['success' => 'Folder <strong>( ' . $request->new_dir . ' )</strong> is created.']);
		}

      return redirect()->back()->with(['warning' => 'Define Folder name!']);
	}
	
	public function upload(Request $request)	
	{
		$input = $request->all();
		
		$dir = 'images/';	
		$exist_dirs = Storage::disk('public')->allDirectories();
		if( ! in_array($dir, $exist_dirs) ) {
			Storage::disk('public')->makeDirectory($dir);
		}
		
		if(! empty($input['gallery'])) {
			foreach ($input['gallery'] as $file) {
				
				$img = Image::make($file);
				
				$img->resize(600, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				
				$img->encode('jpg', 60);
				
				$new_name = md5(uniqid());
				
				$img->save(storage_path('app/public/'.$dir) . $new_name . '.jpg', 60);
				
			}
		}
		
		$msg = session()->flash('success', 'You have successfully added a new images!');
		return redirect()->back()->withFlashMessage($msg);
	}
}
