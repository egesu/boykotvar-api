<?php

namespace App\Http\Controllers;

use App\Model\Boycott;
use App\Model\BoycottUser;
use Illuminate\Http\Request;

class BoycottUserController extends Controller
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

    public function index($boycottId)
    {
        return Boycott::findOrFail($boycottId)
            ->boycottUsers()
            ->with([
                'user' => function($query) {
                    $query->select([
                        'id',
                        'name',
                    ]);
                }
            ])
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function store(Request $request, $boycottId)
    {
        $input = ['userId' => $request->input('userId')];
        $id = BoycottUser::create($input)->id;
        return response()->json([
            'id' => $id,
        ], 201);
    }

    public function destroy($boycottId, $id)
    {
        $model = BoycottUser::findOrFail($id);
        $model->delete();
        return response('', 204);
    }
}
