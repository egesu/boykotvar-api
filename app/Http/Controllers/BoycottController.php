<?php

namespace App\Http\Controllers;

use App\Boycott;
use App\Media;
use Illuminate\Http\Request;

class BoycottController extends Controller
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
        return Boycott::with([
                'boycottUsersCount',
                'coverImage',
            ])->orderBy('id', 'DESC')->paginate(20);
    }

    public function show($id)
    {
        return Boycott::findOrFail($id);
    }

    public function store(Request $request)
    {
        $input = $request->input();

        if(isset($input['media_ids'])) {
            $mediaIds = $input['media_ids'];
            unset($input['media_ids']);
        }

        $input['created_by_id'] = $request->user()->id;

        $id = Boycott::create($input)->id;

        if(isset($mediaIds)) {
            Media::whereIn('id', $mediaIds)
                ->update(['related_id' => $id]);
        }

        return response()->json([
            'id' => $id,
        ], 201);
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
