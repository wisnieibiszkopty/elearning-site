<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;

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

            $filesize = filesize($file);
            $formattedSize = Helper::formatSizeUnits($filesize);

            $resource = new Resource([
                'course_id' => $id,
                'name' => $form['name'],
                'file_path' => $filePath,
                'file_size' => $formattedSize
            ]);

            if($resource->save()){
                return back()->with([
                   'message' => 'Resource created successfully!',
                   'success' => true
                ]);
            }
        }

        return back()->with([
            'message' => 'Cannot creat resource!',
            'success' => false
        ]);
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
        $filePath = $resource->file_path;
        if($filePath){
            Storage::delete('public/' . $filePath);
        }

        $resource->delete();

        return back()->with([
            'message' => 'Deleted resource successfully!',
            'success' => true
        ]);
    }
}
