<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
//import auth facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Mime\Message;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    protected $jwt;
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }
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
        //validate incoming request
        $this->validate($request, [
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $phone = $request->input('phone');
        $password = $request->input('password');

        $member = Member::where('phone', $phone)->first();

        try {
            if (Hash::check($password, $member->password)) {
                $token = $this->jwt->attempt($request->only('phone', 'password'));

                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'data' => [
                        'member' => $member,
                        'token' => 'Bearer' . ' ' . $token,
                    ]
                ], 201);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], $e->getStatusCode());
        }
    }
}
