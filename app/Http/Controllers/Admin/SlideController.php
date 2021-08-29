<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Service\Slide\SlideService;

class SlideController extends Controller
{
    protected $slideService;

    public function __construct(SlideService $slide)
    {
        $this->slideService = $slide;
    }

    public function create()
    {
        return view('admin.slide.add',[
            'title' => 'Create Slider'
        ]);
    }

    public function store(Request  $request)
    {
        $request->validate([
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required'
        ]);

        $this->slideService->insert($request);

        return redirect()->route('slide.index');

    }

    public function index()
    {
        return view('admin.slide.list',[
            'title' => 'List Slide',
            'slides' => $this->slideService->get()
        ]);
    }

    public function show(Slide $slide){
    return view('admin.slide.edit',[
        'title' => 'Edit Slide',
        'slide' => $slide
    ]);

    }

    public function update( Request $request , Slide $slide){
        $result = $this->slideService->update($request, $slide);
        if ($result){
            return redirect()->route('slide.index');
        }else{
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $result = $this->slideService->delete($request);
        if ($result){
            return response()->json([
                'error' => false,
                'message' => 'Delete Successful'
            ]);
        }
        return response()->json([
            'error' => true,
            'message' => 'Delete Error'
        ]);
    }
}
