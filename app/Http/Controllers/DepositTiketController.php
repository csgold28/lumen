<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\DepositTiket;
use App\Helpers\Autonumber;

class DepositTiketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deposittiket(Request $request, $id)
    {
        $this->validate($request, [
            'nominal' => 'required|integer'
        ]);

        $unik = rand(1000, 9999);
        $nominal = $request->input('nominal');
        $subnominal = substr($nominal, 0, -4);
        $nominalunik = $subnominal . $unik;
        // return $nominalunik;

        $invoice = Autonumber::autonumber();

        $member = Member::find($id);

        $reqdeposit = new DepositTiket([
            'invoice' => 'TOPUP/' . $invoice,
            'tipe' => 1,
            'metode' => 1,
            'notes' => 'Request Top Up',
            'nominal' => $nominalunik,
            'status' => 2

        ]);

        $member->tiketdeposit()->save($reqdeposit);

        if ($member) {
            return response()->json([
                'success' => true,
                'message' => 'Permintaan Tiket Deposit Berhasil!',
                'member' => $member,
                'tiketdeposit' => $reqdeposit
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Permintaan Tiket Deposit GAGAL!',
            ], 400);
        }
    }

    public function showTopUp($id)
    {
        $member = Member::find($id);

        $topups = $member->tiketdeposit()->get();

        foreach ($topups as $topup) {
            $data[] = [
                'name' => $topup->member->name,
                'invoice' => $topup->invoice,
                'tipe' => $topup->tipe,
                'metode' => $topup->metode,
                'notes' => $topup->notes,
                'nominal' => $topup->nominal,
                'status' => $topup->status

            ];
        }

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan!',
                'data' => $data,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan!',
            ], 400);
        }
    }
}
