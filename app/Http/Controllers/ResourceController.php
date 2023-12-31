<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;

/*
 *
 *  działa git, tylko popraw cssy
 *  i zrób coś z usuwaniem plików z aplikacji
 *
 */

class ResourceController extends Controller
{
    // add pagination
    public function index(int $id){
        $course = Course::find($id);
        return view('course/resources', ['course' => $course]);
    }

    public function store(Request $request, int $id){
        $form = $request->validate([
            'name' => ['required']
        ]);

        if($request->hasFile('file')){
            $file = $request->file('file');
            $filePath = $file->store('resources', 'public');
        }

        $resource = new Resource([
            'course_id' => $id,
            'name' => $form['name'],
            'file_path' => $filePath
        ]);
        $resource->save();

        return back();
    }

    public function update(Request $request, int $id, int $resourceId){
        $form = $request->validate(['name' => ['required']]);
        $resource = Resource::find($resourceId);
        $resource->name = $form['name'];
        $resource->save();

        return back();
    }

    public function destroy(int $id, int $resourceId){
        $resource = Resource::find($resourceId);
        $filePath = "storage/" . $resource->file_path;

        // method behaves like file doesn't exist
        if(Storage::exists($filePath)){
            Storage::delete($filePath);
        }
        $resource->delete();

        return back();
    }
}
