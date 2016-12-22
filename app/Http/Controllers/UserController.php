<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $authRequiredMethods = [
        'index',
        'show',
        'update',
        'destroy',
        'getCurrentUser',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $methodRequested = explode('@', $request->route()[1]['uses'])[1];

        if(in_array($methodRequested, $this->authRequiredMethods) !== false) {
            $this->middleware('auth');
        }
    }

    public function index()
    {
        return User::paginate(20);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $id = User::create($input)->id;
        $token = User::forceLogin($id);
        return response()->json([
            'id' => $id,
            'token' => $token,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if($id !== 'me') {
            return response('', 403);
        }

        $input = $request->input();
        $model = $request->user();
        $model->fill($input)->save();
        return response()->json($model);
    }

    public function destroy($id)
    {
        if($id !== 'me') {
            return response('', 403);
        }

        $model = $request->user();
        $model->delete();
        return response('', 204);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if(!$email or !$password) {
            return response('', 400);
        }

        $accessToken = User::login($email, $password);

        if(!$accessToken) {
            return response('', 400);
        }

        $data = [
            'token' => $accessToken,
        ];

        return response($data, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->logout();
        return response('', 204);
    }

    public function getCurrentUser(Request $request)
    {
        $user = $request->user();
        return response()->json($user, 200);
    }
}
