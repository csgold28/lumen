<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Member;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $member = Member::find($id);

        if ($member) {
            return response()->json([
                'success' => true,
                'message' => 'Data Member ditemukan!',
                'data' => $member
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan!',
                'data' => ''
            ], 404);
        }
    }
}
