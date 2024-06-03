<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Review;
use Illuminate\Http\Request;
use Image;
use File;

class ReviewController extends Controller
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $review = Review::where('review', 'LIKE', "%$keyword%")
                ->orWhere('rating', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $review = Review::paginate($perPage);
            }

            return view('review.review.index', compact('review'));
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('review.review.create');
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'review' => 'required',
			'rating' => 'required',
			'name' => 'required'
		]);

            $review = new Review($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $review_path = 'uploads/reviews/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($review_path) . DIRECTORY_SEPARATOR. $profileImage);

                $review->image = $review_path.$profileImage;
            }
            
            $review->save();
            return redirect()->back()->with('message', 'Review added!');
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $review = Review::findOrFail($id);
            return view('review.review.show', compact('review'));
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $review = Review::findOrFail($id);
            return view('review.review.edit', compact('review'));
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'review' => 'required',
			'rating' => 'required',
			'name' => 'required'
		]);
            $requestData = $request->all();
            

        if ($request->hasFile('image')) {
            
            $review = Review::where('id', $id)->first();
            $image_path = public_path($review->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/reviews/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/reviews/'.$fileNameToStore;               
        }


            $review = Review::findOrFail($id);
            $review->update($requestData);
            return redirect()->back()->with('message', 'Review updated!');
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Review::destroy($id);
            return redirect()->back()->with('message', 'Review deleted!');
        }
        return response(view('403'), 403);

    }
}
