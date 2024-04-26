<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Video;
use Illuminate\Http\Request;
use Image;
use File;

class VideoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $video = Video::where('title', 'LIKE', "%$keyword%")
                ->orWhere('video', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $video = Video::paginate($perPage);
            }

            return view('video.video.index', compact('video'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('video.video.create');
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'video' => 'required'
		]);

            $video = new Video($request->all());

            if ($request->hasFile('video')) {

                $file = $request->file('video');
                
                //make sure yo have video folder inside your public
                $video_path = 'uploads/videos/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($video_path) . DIRECTORY_SEPARATOR. $profileImage);

                $video->video = $video_path.$profileImage;
            }
            
            $video->save();
            return redirect()->back()->with('message', 'Video added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $video = Video::findOrFail($id);
            return view('video.video.show', compact('video'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $video = Video::findOrFail($id);
            return view('video.video.edit', compact('video'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'video' => 'required'
		]);
            $requestData = $request->all();
            

        if ($request->hasFile('video')) {
            
            $video = Video::where('id', $id)->first();
            $video_path = public_path($video->video);
            
            if(File::exists($video_path)) {
                File::delete($video_path);
            }

            $file = $request->file('video');
            $fileNameExt = $request->file('video')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('video')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/videos/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['video'] = 'uploads/videos/'.$fileNameToStore;
        }


            $video = Video::findOrFail($id);
            $video->update($requestData);
            return redirect()->back()->with('message', 'Video updated!');
        }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Video::destroy($id);
            return redirect()->back()->with('message', 'Video deleted!');
        }
        return response(view('403'), 403);

    }
}
