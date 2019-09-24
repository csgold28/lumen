<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Member;
use App\Profile;

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

    public function showProfile($id)
    {
        $member = Member::find($id);

        $data = [
            'name' => $member->name,
            'phone' => $member->phone,
            'gender' => $member->profile->gender,
            'noktp' => $member->profile->noktp,
            'provinsi' => $member->profile->provinsi,
            'kota' => $member->profile->kota,
            'kecamatan' => $member->profile->kecamatan,
            'desa' => $member->profile->desa

        ];

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Profile ditemukan!',
                'member' => $data,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile tidak ditemukan!',
            ], 400);
        }
    }

    public function createprofile(Request $request, $id)
    {
        $this->validate($request, [
            'noktp' => 'required|string',
            'gender' => 'required|integer',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string'

        ]);

        $noktp = $request->input('noktp');
        $gender = $request->input('gender');
        $alamat = $request->input('alamat');
        $provinsi = $request->input('provinsi');
        $kota = $request->input('kota');
        $kecamatan = $request->input('kecamatan');
        $desa = $request->input('desa');

        $member = Member::find($id);

        $profile = new Profile([
            'noktp' => $noktp,
            'gender' => $gender,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'desa' => $desa
        ]);

        $member->profile()->save($profile);
        if ($member) {
            return response()->json([
                'success' => true,
                'message' => 'Penambahan Profile berhasil!',
                'member' => $member,
                'Profile' => $profile
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Penambahan Profile GAGAL!',
            ], 400);
        }
    }
}
