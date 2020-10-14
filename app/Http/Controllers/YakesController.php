<?php

namespace App\Http\Controllers;

use App\Model\Yakes;
use App\Model\Pegawai;
use App\Model\Datakeluarga;
use App\Model\Datapengajuan;
use App\Model\Notadinas;
use App\Model\Datadokter;
use App\Model\Tagihan;

use Illuminate\Http\Request;

class YakesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:yakes');
	}

	public function index()
	{
		return view('yakes.home');
	}

	public function pengajuannota()
	{
		$datakeluarga = Datakeluarga::all();
		$pegawai = Pegawai::all();
		$datadokter = Datadokter::all();
		return view('yakes.pengajuannota', compact('datakeluarga', 'pegawai', 'datadokter'));
	}

	public function getkeluarga(Request $request)
	{
		$datakeluarga = Datakeluarga::where('pegawai_id', $request->pegawai_id)->get();
		foreach ($datakeluarga as $dta) {
			echo "<option value='".$dta->id."'>".$dta->nama." (".$dta->status.")"."</option>";
		}
	}

	public function storepengajuannota(Request $request)
	{
		if (isset($request->keluarga)) {
			$dk = Datakeluarga::findOrFail($request->keluarga);
			$nama_pasien = $dk->nama;
			$hub_keluarga = $dk->status;
			$status = 'Anggota Keluarga';
		}
		else {
			$pegawai = Pegawai::findOrFail($request->pegawai_id);
			$nama_pasien = $pegawai->nama;
			$hub_keluarga = "-";
			$status = 'Pegawai';
		}

		$dp = new Datapengajuan;
		$dp->pegawai_id = $request->pegawai_id;
		$dp->nama_pasien = $nama_pasien;
		$dp->status = $status;
		$dp->hub_keluarga = $hub_keluarga;
		$dp->pengaju = $request->pengaju;
		$dp->foto_kuitansi = "";
		$dp->save();

		$nd = new Notadinas;
		$nd->pengajuan_id = $dp->id;
		$nd->nama_dokter = $request->nama_dokter;
		$nd->save();

		$tg = new Tagihan;
		$tg->notadinas_id = $nd->id;
		$tg->no_tagihan = $request->no_tagihan;
		$tg->jumlah_tagihan = $request->jumlah_tagihan;
		$tg->save();

		return redirect('yakes/progresnota')->with('msg', 'Nota dinas berhasil diajukan');
	}

	public function progresnota()
	{
		$datapengajuan = Datapengajuan::all();
		$notadinas = Notadinas::all();
		$pegawai = Pegawai::all();
		$tagihan = Tagihan::all();
		return view('yakes.progresnota', compact('datapengajuan', 'notadinas', 'pegawai', 'tagihan'));
	}

	public function datapasien()
	{
		$datapengajuan = Datapengajuan::all();
		$notadinas = Notadinas::all();
		$tagihan = Tagihan::all();
		return view('yakes.datapasien', compact('datapengajuan', 'notadinas', 'tagihan'));
	}

	public function datadokter($val = null)
	{
		if (empty($val)) {
			$datadokter = Datadokter::all();
			return view('yakes.datadokter', compact('datadokter'));			
		}
		else if ($val == 'tambah') {
			return view('yakes.tambahdokter');	
		}		
	}

	public function storedatadokter(Request $request)
	{
		$dokter = new Datadokter;
		$dokter->yakes_id = $request->yakes_id;
		$dokter->nama_dokter = $request->nama_dokter;
		$dokter->nip = $request->nip;
		$dokter->status = $request->status;
		$dokter->keterangan = $request->keterangan;
		$dokter->save();

		return redirect('/yakes/datadokter')->with('msg', 'Data dokter berhasil ditambah');
	}

	public function editdatadokter(Request $request)
	{
		$dokter = Datadokter::findOrFail($request->id);
		$dokter->nip = $request->nip;
		$dokter->nama_dokter = $request->nama_dokter;
		$dokter->status = $request->status;
		$dokter->keterangan = $request->keterangan;
		$dokter->save();

		return redirect('/yakes/datadokter')->with('msg', 'Data dokter berhasil diedit');
	}

	public function hapusdatadokter($id)
	{
		$dokter = Datadokter::findOrFail($id);
		$dokter->delete();

		return redirect('/yakes/datadokter')->with('msg', 'Data dokter berhasil dihapus');
	}
}
