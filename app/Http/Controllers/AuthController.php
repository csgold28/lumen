<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
//import auth facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Mime\Message;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|unique:members',
            'password' => 'required'
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $password = Hash::make($request->input('password'));

        $register = Member::create([
            'name' => $name,
            'phone' => $phone,
            'password' => $password
        ]);

        if ($register) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran Member berhasil!',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran Member GAGAL!',
                'data' => ''
            ], 400);
        }
    }

    public function login(Request $request)
    {
        // //validate incoming request
        // $this->validate($request, [
        //     'phone' => 'required|string',
        //     'password' => 'required|string',
        // ]);

        // $phone = $request->input('phone');
        // $password = $request->input('password');

        // $member = Member::where('phone', $phone)->first();

        // if (Hash::check($password, $member->password)) {
        //     $token = app('auth')->attempt($request->only('phone', 'password'));

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Login berhasil!',
        //         'data' => [
        //             'member' => $member,
        //             'api_token' => 'Bearer' . ' ' . $token
        //         ]
        //     ], 201);
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Login Gagal!',
        //         'data' => ''
        //     ], 400);
        // }

        $this->validate($request, [
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $token = app('auth')->attempt($request->only('phone', 'password'));

        if ($token) {
            return response()->json([
                'success' => true,
                'message' => 'Login Sukses!',
                'data' => $this->respondWithToken($token)
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran Member GAGAL!',
                'data' => ''
            ], 400);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 1440
        ]);
    }
}
