<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use File;

class AdminkaImagesController extends AdminkaController
{
    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $file = $request->file('image');

        //forming url for image
        $url = "images";
        if($request->is_gallery_image != null && $request->is_gallery_image) //if it`s image for gallery, and needs to store at gallery folder
        {
            $url .= "\\gallery";
        }
        else if($request->is_achievment_image != null && $request->is_achievment_image)//if it`s image for achievement, and needs to store at achievement folder
        {
            $url .= "\\achievements";
        }   

        //saving file to temp folder
        $file->move(public_path("downloads"), $file->getClientOriginalName());

        //moving file
        File::move(public_path("downloads")."\\".$file->getClientOriginalName(), public_path($url)."\\".$file->getClientOriginalName());

        return response()->json(["result" => true, "message" => "File {$file->getClientOriginalName()} uploaded successfuly!"], 201);
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        //if delete was successful
        if(File::delete(public_path("images")."\\".$request->image))
        {
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Something went wrong"], 404);
    }
}
