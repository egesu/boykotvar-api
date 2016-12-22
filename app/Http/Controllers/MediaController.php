<?php

namespace App\Http\Controllers;

use App\Model\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
    }

    public function show($id)
    {
        return Media::findOrFail($id);
    }

    public function store(Request $request)
    {
        if(
            !$request->hasFile('image') or
            !$request->file('image')->isValid() or
            $request->file('image')->getMimeType() !== 'image/jpeg' or
            !$request->has('related_to')
        ) {
            return response('', 400);
        }

        $storagePath = storage_path('images');
        $fileName = md5(microtime()) . '.jpg';
        $request->file('image')->move($storagePath, $fileName);
        $data = [
            'path' => $storagePath . '/' . $fileName,
            'related_to' => $request->input('related_to'),
        ];

        if($request->has('related_id')) {
            $data['related_id'] = $request->input('related_id');
        }

        $media = Media::create($data);

        return response()->json($media, 201);
    }

    public function update(Request $request, $id)
    {
        $input = $request->input();
        $model = Boycott::findOrFail($id);
        $model->fill($input)->save();
        return response()->json($model);
    }

    public function destroy($id)
    {
        $model = Boycott::findOrFail($id);
        $model->delete();
        return response('', 204);
    }
}
