<?php


namespace App\Http\Service\Slide;

use App\Models\Slide;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class SlideService
{
    public function insert($request)
    {
        try {
            $request->except('_token');
            Slide::create($request->input());
            Session::flash('success','Add new slide successful');
        } catch (\Exception $err) {
            Session::flash('error','Error');
             Log::info($err->getMessage());

             return false;
        }
        return true;
    }

    public function show()
    {
        return Slide::where('active',1)->orderByDesc('sort_by')->get();
    }

    public function get()
    {
        return Slide::orderByDesc('id')->paginate(10);
}

    public static function update($request, $slide)
    {
        try {
            $slide->fill($request->input());
            $slide->save();
            Session::flash('success','Update Successful');
        }catch (\Exception $err){
            Session::flash('error','Update Error');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $slide = Slide::where('id',$request->input('id'))->first();
        if ($slide){
            $slide->delete();
            return true;
        }
        return  false;
    }

}
