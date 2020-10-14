<?php

namespace App\Http\Controllers;

use App\Model\Yakes;
use App\Model\Pegawai;
use App\Model\Datakeluarga;
use App\Model\Datapengajuan;
use App\Model\Notadinas;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:pegawai');
	}

	public function index()
	{
		return view('pegawai.home');
	}

	public function datakeluarga($val = null)
	{
		if ($val == 'tambah') {
			return view('pegawai.tambahkeluarga');
		}
		else if ($val == 'uploadkk') {
			return view('pegawai.uploadkk');
		}
		else {
			$datakeluarga = Datakeluarga::all();
			return view('pegawai.datakeluarga', compact('datakeluarga'));
		}
	}

	public function storedatakeluarga(Request $request)
	{
		if (empty($request->keterangan)) $request->keterangan = "-";

		if (!isset($request->tipe)) {
			$dk = new Datakeluarga;
			$dk->pegawai_id = $request->pegawai_id;
			$dk->nik = $request->nik;
			$dk->nama = $request->nama;
			$dk->status = $request->status;
			$dk->keterangan = $request->keterangan;
			$dk->save();
			return redirect('/datakeluarga')->with('msg', 'Data keluarga berhasil ditambahkan');
		}
		else {
			$this->validate($request, [
				'foto_kk' => 'mimes:jpg,jpeg,png,img|max:2048|required', 
			]);
			
			$namafile = "foto_kk_id_".$request->id.".jpg";
			$pgw = Pegawai::findOrFail($request->id);
			$pgw->foto_kk = $namafile;
			$pgw->save();
			$request->file('foto_kk')->move('images/foto_kk', $namafile);
			return redirect('/datakeluarga')->with('msg', 'Scane Kartu Keluarga berhasil di upload');
		}

	}

	public function editdatakeluarga(Request $request)
	{
		if (empty($request->keterangan)) $request->keterangan = "-";
		$dk = Datakeluarga::findOrFail($request->id);
		$dk->nik = $request->nik;
		$dk->nama = $request->nama;
		$dk->status = $request->status;
		$dk->keterangan = $request->keterangan;
		$dk->save();

		return redirect('/datakeluarga')->with('msg', 'Data keluarga berhasil diedit');
	}

	public function hapusdatakeluarga($id)
	{
		$dk = Datakeluarga::findOrFail($id);
		$dk->delete();

		return redirect('/datakeluarga')->with('msg', 'Data keluarga berhasil dihapus');
	}

	public function layanan($val = null, $id = null)
	{
		if (empty($val)) {
			return view('pegawai.layanan');
		}
		else if ($val == 'pengajuan') {
			$datakeluarga = Datakeluarga::all();
			$pegawai = Pegawai::findOrFail($id);
			if ($pegawai->foto_kk == null) {
				return redirect('/layanan')->with('err', 'Kartu Keluarga belum di upload. Silahkan upload terlebih dahulu');
			}
			return view('pegawai.pengajuan', compact('datakeluarga'));
		}
	}

	public function storepengajuan(Request $request)
	{
		$this->validate($request, [
			'foto_kuitansi' => 'mimes:jpg,jpeg,png,img|max:2048|required', 
		]);
		
		if (isset($request->keluarga)) {
			$dk = Datakeluarga::findOrFail($request->keluarga);
			$nama_pasien = $dk->nama;
			$hub_keluarga = $dk->status;
			$status = 'Anggota Keluarga';
		}
		else {
			$nama_pasien = $request->nama;
			$hub_keluarga = "-";
			$status = 'Pegawai';
		}

		$namafile = "foto_kuitansi_".date('ymdis').".jpg";

		$dp = new Datapengajuan;
		$dp->pegawai_id = $request->id;
		$dp->nama_pasien = $nama_pasien;
		$dp->status = $status;
		$dp->hub_keluarga = $hub_keluarga;
		$dp->pengaju = "Pegawai";
		$dp->foto_kuitansi = $namafile;
		$dp->save();

		$request->file('foto_kuitansi')->move('images/foto_kuitansi', $namafile);
		return redirect('/layanan')->with('msg', 'Nota dinas berhasil diajukan');
	}

	public function progres() 
	{
		$datapengajuan = Datapengajuan::all();
		return view('pegawai.progres', compact('datapengajuan'));
	}
}
