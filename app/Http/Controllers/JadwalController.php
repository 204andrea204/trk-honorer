<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Jadwal;
use DB;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('master.jadwal.index', compact('jadwals'));
    }

    public function add_guru()
    {
        $users = User::where('role', 3)->get();
        return view('master.jadwal.add-guru', compact('users'));
    }

    public function add_karyawan()
    {
        $users = User::where('role', 4)->get();
        return view('master.jadwal.add-karyawan', compact('users'));
    }

    public function process_add_guru(Request $request)
    {
        $cek = Jadwal::where('tipe', "guru")->first();

            $id = Jadwal::create($request->all())->id;

            $user1 = User::find($request->penilai_1);
            $user1->jadwal_id = $id;
            $user1->save();

            $user2 = User::find($request->penilai_2);
            $user2->jadwal_id = $id;
            $user2->save();

            $user3 = User::find($request->penilai_3);
            $user3->jadwal_id = $id;
            $user3->save();

            $user4 = User::find($request->penilai_4);
            $user4->jadwal_id = $id;
            $user4->save();

            $user5 = User::find($request->penilai_5);
            $user5->jadwal_id = $id;
            $user5->save();

            // $cek->update($request->all());
            // DB::table('users')->update(array('status_penilaian' => "Kosong"));

        return redirect('/master/jadwal');
    }

    public function process_add_karyawan(Request $request)
    {
        $cek = Jadwal::where('tipe', "karyawan")->first();
        if ($cek) {
            $cek->update($request->all());
        } else {
            Jadwal::create($request->all());
        }
        return redirect('/master/jadwal');
    }
}
