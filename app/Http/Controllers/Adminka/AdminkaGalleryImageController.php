<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\GalleryImage;

class AdminkaGalleryImageController extends AdminkaController
{
    public function index(Request $request)
    {
        $gallery_image = GalleryImage::all();
        return response()->json($gallery_image, 200);
    }

    public function show(Request $request)
    {
        $gallery_image = GalleryImage::find($request->gallery_image);

        //if gallery_image with such id exists
        if($gallery_image != null)
        {
            return response()->json($gallery_image, 200);
        }

        return response()->json(["result" => false, "message" => "Not found gallery_image with id {$request->gallery_image}"], 404);
    }

    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        GalleryImage::create($request->except('password'));
        return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $gallery_image = GalleryImage::find($request->gallery_image);

        //if gallery_image with such id exists
        if($gallery_image != null)
        {
            $gallery_image->update($request->except('password'));
            return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found gallery_image with id {$request->gallery_image}"], 404);

        
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $gallery_image = GalleryImage::find($request->gallery_image);

        //if gallery_image with such id exists
        if($gallery_image != null)
        {
            $gallery_image->delete();
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found gallery_image with id {$request->gallery_image}"], 404);
    }
}
