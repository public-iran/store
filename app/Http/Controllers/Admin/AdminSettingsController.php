<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Setting;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AdminSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('setting'),403,'شما به این بخش دسترسی ندارید');
        $settings=Setting::all();
        return view('adminbizness.settings.index',compact(['settings']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->input() as $key => $value) {
            if ($key!="logo"){
                if($key == 'theme'){
                    Setting::where('setting',$key)->update(['orgv'=>$value]);
                }else{
                    Setting::where('setting',$key)->update(['value'=>$value]);
                }
            }

        }
        if (!empty($request->logo)){
            $file = $request->file('logo');
            if($file){
                $imgsetting=Setting::where('setting','logo')->first();
                if ($imgsetting->value!=""){
                    unlink(public_path($imgsetting->value));
                }
                $name = rand(1,99999).time().'_'.$file->getClientOriginalName();
                $image = Image::make($file);
                $image->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                if(!is_dir('images')){
                    mkdir("images");
                }
                $image->save('images/'. $name);

                ///////////// save image in table /////////////
                ///

                $imgsetting->value = "images/".$name;
                $imgsetting->save();
            }

        }
        session()->put('change_setting','با موفقیت ذخیره شده');
        return redirect('/admin/settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
