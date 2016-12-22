<?php

namespace App\Http\Controllers;

use App\Model\Concern;
use Illuminate\Http\Request;

class ConcernController extends Controller
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

    public function index(Request $request)
    {
        $query = Concern::with([
            'image',
        ]);

        if($request->has('q')) {
            $q = $request->input('q');
            $query->where('name', 'ilike', $q . '%');
        }

        return response()->json($query->limit(20)->get(), 200);
    }

    public function show($id)
    {
        return Concern::findOrFail($id);
    }
}
