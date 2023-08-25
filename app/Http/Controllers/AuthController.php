<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        $rule = [
            'email'     => 'required|email',
            'password'  => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if($validate->fails())
            return $this->json400($validate->errors()->first());

        if (!$token = auth()->attempt($validate->validated()))
            return $this->json400('Invalid credentials.');

        $data = $this->createNewToken($token);

        return $this->json200($data, 'Login successfully!');
    }


    public function logout() {
        auth()->logout();
        return $this->json200(null, 'Successfully logged out.');
    }

    public function get_profile() {
        $profile = auth()->user();
        $data   = (object)[
            'id'    => encrypt($profile->id),
            'name'  => $profile->name,
            'email' => $profile->email,
            'kode_role' => $profile->role,
            'role'      => config('main.role')[$profile->role],
        ];
        return $this->json200($data, 'Get profile successfully.');
    }

    public function refresh(){
        $data = $this->createNewToken(auth()->refresh());
        return $this->json200($data, 'Refresh token successfully.');
    }

    protected function createNewToken($token) {
        $user = Auth()->user();
        return [
            'id'            => encrypt($user->id),
            'email'         => $user->email,
            'token'         => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth()->factory()->getTTL() * 60,
        ];
    }
}
