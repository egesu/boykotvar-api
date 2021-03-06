<?php

namespace App\Http\Controllers;

use App\Model\Boycott;
use App\Model\BoycottConcern;
use App\Model\Concern;
use App\Model\Media;
use Illuminate\Http\Request;

class BoycottController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * @api {get} /boycott Get question detail with options
     * @apiName Get Boycott List
     * @apiGroup Boycott
     *
     * @throws \InvalidArgumentException
     */
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

        if(isset($input['concern_ids'])) {
            $concernIds = $input['concern_ids'];
        } else {
            return response('', 400);
        }

        $input['created_by_id'] = $request->user()->id;

        $id = Boycott::create($input)->id;

        if(isset($mediaIds)) {
            Media::whereIn('id', $mediaIds)
                ->update(['related_id' => $id]);
        }

        foreach($concernIds as $concernId) {
            if(is_string($concernId)) {
                $concern = Concern::create(['name' => $concernId]);
            } else {
                $concern = Concern::find($concernId);
            }

            BoycottConcern::create([
                'boycott_id' => $id,
                'concern_id' => $concern->id,
            ]);
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
