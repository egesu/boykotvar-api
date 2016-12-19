<?php

namespace App\Http\Controllers;

use App\Boycott;
use App\BoycottPost;
use Illuminate\Http\Request;

class BoycottPostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //
    }

    public function index($boycottId)
    {
        $this->middleware('auth');
        return Boycott::findOrFail($boycottId)
            ->posts()
            ->orderBy('created_at', 'DESC')
            ->paginate();
    }

    public function show($boycottId, $id)
    {
        return BoycottPost::findOrFail($id);
    }

    public function store(Request $request, $boycottId)
    {
        $input = $request->input();
        $input['boycott_id'] = $boycottId;
        $id = BoycottPost::create($input)->id;
        return response()->json([
            'id' => $id,
        ], 201);
    }

    public function update(Request $request, $boycottId, $id)
    {
        $input = $request->input();
        $model = BoycottPost::findOrFail($id);
        $model->fill($input)->save();
        return response()->json($model);
    }

    public function destroy($id)
    {
        $model = BoycottPost::findOrFail($id);
        $model->delete();
        return response('', 204);
    }
}
