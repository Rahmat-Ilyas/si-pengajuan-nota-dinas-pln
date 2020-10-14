<?php

namespace App\Http\Controllers;

use App\Model\Yakes;
use App\Model\Pegawai;
use App\Model\Datakeluarga;
use App\Model\Datapengajuan;
use App\Model\Notadinas;
use App\Model\Nomorsurat;
use App\Model\Tagihan;

use Illuminate\Http\Request;

class KeuanganController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:keuangan');
	}

	public function index()
	{
		return view('keuangan.home');
	}

	public function notadiajukan()
	{
		$datapengajuan = Datapengajuan::where('proses', 1)->where('progres', 'Dalam Proses')->get();
		$pegawai = Pegawai::all();
		$notadinas = Notadinas::all();
		$tagihan = Tagihan::all();
		return view('keuangan.notadiajukan', compact('datapengajuan', 'pegawai', 'notadinas', 'tagihan'));
	} 

	public function prosesnota($val, $id)
	{
		$dp = Datapengajuan::findOrFail($id);

		if ($val == 'setujui') {
			$dp->progres = 'Selesai';
			$dp->save();
			return redirect('/keuangan/notadiajukan')->with('msg', 'Nota Dinas telah disetujui');
		}
		else if ($val == 'tolak') {
			$dp->progres = 'Ditolak';
			$dp->save();
			return redirect('/keuangan/notadiajukan')->with('msg', 'Nota Dinas telah ditolak');
		}
	}

	public function notadisetujui()
	{
		$datapengajuan = Datapengajuan::where('progres', 'Selesai')->get();
		$pegawai = Pegawai::all();
		$notadinas = Notadinas::all();
		return view('keuangan.notadisetujui', compact('datapengajuan', 'pegawai', 'notadinas'));
	}

	public function notaditolak()
	{
		$datapengajuan = Datapengajuan::where('progres', 'Ditolak')->get();
		$pegawai = Pegawai::all();
		$notadinas = Notadinas::all();
		return view('keuangan.notaditolak', compact('datapengajuan', 'pegawai', 'notadinas'));
	}
}
