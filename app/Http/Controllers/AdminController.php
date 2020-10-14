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

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function index()
	{
		return view('admin.home');
	}

	public function suratmasuk() 
	{
		$datapengajuan = Datapengajuan::where('proses', 0)->get();
		$pegawai = Pegawai::all();
		$keluarga = Datakeluarga::all();
		return view('admin.suratmasuk', compact('datapengajuan', 'pegawai', 'keluarga'));
	}

	public function suratkeluar()
	{
		$datapengajuan = Datapengajuan::where('proses', 1)->get();
		$pegawai = Pegawai::all();
		$notadinas = Notadinas::all();
		$tagihan = Tagihan::all();
		return view('admin.suratkeluar', compact('datapengajuan', 'pegawai', 'notadinas', 'tagihan'));
	}

	public function datapegawai($val = null) 
	{
		if (empty($val)) {
			$pegawai = Pegawai::all();
			return view('admin.datapegawai', compact('pegawai'));
		}
		else if ($val == 'tambah') {
			return view('admin.tambahpegawai');	
		}
	}

	public function storedatapegawai(Request $request) 
	{
		$pegawai = new Pegawai;
		$pegawai->nip = $request->nip;
		$pegawai->nama = $request->nama;
		$pegawai->email = $request->email;
		$pegawai->jenis_kelamin = $request->jenis_kelamin;
		$pegawai->tggl_lahir = $request->tggl_lahir;
		$pegawai->jabatan = $request->jabatan;
		$pegawai->unit = $request->unit;
		$pegawai->status = $request->status;
		$pegawai->foto_kk = '';
		$pegawai->password = bcrypt($request->nip);
		$pegawai->save();

		return redirect('/admin/datapegawai')->with('msg', 'Data pegawai berhasil ditambah');
	}

	public function editdatapegawai(Request $request)
	{
		$pegawai = Pegawai::findOrFail($request->id);
		$pegawai->nip = $request->nip;
		$pegawai->nama = $request->nama;
		$pegawai->email = $request->email;
		$pegawai->jenis_kelamin = $request->jenis_kelamin;
		$pegawai->tggl_lahir = $request->tggl_lahir;
		$pegawai->jabatan = $request->jabatan;
		$pegawai->unit = $request->unit;
		$pegawai->status = $request->status;
		$pegawai->save();

		return redirect('/admin/datapegawai')->with('msg', 'Data pegawai berhasil diedit');
	}

	public function hapusdatapegawai($id)
	{
		$pegawai = Pegawai::findOrFail($id);
		$pegawai->delete();

		return redirect('/admin/datapegawai')->with('msg', 'Data pegawai berhasil dihapus');
	}

	public function datayakes($val = null) 
	{
		if (empty($val)) {
			$yakes = Yakes::all();
			return view('admin.datayakes', compact('yakes'));			
		}
		else if ($val == 'tambah') {
			return view('admin.tambahyakes');	
		}
	}

	public function storedatayakes(Request $request) 
	{
		$yakes = new Yakes;
		$yakes->id_yakes = $request->id_yakes;
		$yakes->nama_yakes = $request->nama_yakes;
		$yakes->alamat = $request->alamat;
		$yakes->telpon = $request->telpon;
		$yakes->username = $request->id_yakes;
		$yakes->password = bcrypt($request->id_yakes);
		$yakes->save();

		return redirect('/admin/datayakes')->with('msg', 'Data yakes berhasil ditambah');
	}

	public function editdatayakes(Request $request)
	{
		$yakes = Yakes::findOrFail($request->id);
		$yakes->nama_yakes = $request->nama_yakes;
		$yakes->alamat = $request->alamat;
		$yakes->telpon = $request->telpon;
		$yakes->save();

		return redirect('/admin/datayakes')->with('msg', 'Data yakes berhasil diedit');
	}

	public function hapusdatayakes($id)
	{
		$yakes = Yakes::findOrFail($id);
		$yakes->delete();

		return redirect('/admin/datayakes')->with('msg', 'Data yakes berhasil dihapus');
	}

	public function notadinaspegawai($id)
	{
		$nomorsurat = Nomorsurat::findOrFail(2);
		$no_surat = $nomorsurat->no_surat;
		$datapengajuan = Datapengajuan::findOrFail($id);
		return view('admin.buatnota.notadinaspegawai', compact('datapengajuan', 'no_surat'));	
	}

	public function notadinasyakes($id)
	{
		$nomorsurat = Nomorsurat::findOrFail(2);
		$no_surat = $nomorsurat->no_surat;
		$datapengajuan = Datapengajuan::findOrFail($id);
		$notadinas = Notadinas::where('pengajuan_id', $datapengajuan->id)->first();
		$tagihan = Tagihan::where('notadinas_id', $notadinas->id)->first();
		return view('admin.buatnota.notadinasyakes', compact('datapengajuan', 'notadinas', 'tagihan', 'no_surat'));	
	}

	public function storenotadinas(Request $request)
	{
		$dp = Datapengajuan::findOrFail($request->id);
		$dp->proses = 1;
		$dp->save();

		$ns = Nomorsurat::findOrFail(2);
		$ns->no_surat = $request->no_surat+1;
		$ns->save();
		$no_surat = $request->no_surat."/KEU.00.02/KSA/".date('Y');

		if ($request->tipe == 'pegawai') {
			$nd = new Notadinas;
			$nd->pengajuan_id = $request->id;
			$nd->no_nota = $no_surat;
			$nd->tggl_nota = $request->tggl_nota;
			$nd->nama_dokter = $request->nama_dokter;
			$nd->total_tagihan = $request->total_tagihan;
			$nd->save();

			foreach ($request->no_tagihan as $i => $no_tagihan) {
				$tg = new Tagihan;
				$tg->notadinas_id = $nd->id;
				$tg->no_tagihan = $nd->no_tagihan;
				$tg->no_tagihan = $no_tagihan;
				$tg->jumlah_tagihan = $request->jumlah_tagihan[$i];
				$tg->keterangan = $request->keterangan[$i];
				$tg->save();
			}

		}
		else if ($request->tipe == 'yakes') {
			$nd = Notadinas::where('pengajuan_id', $dp->id)->first();;
			$nd->no_nota = $no_surat;
			$nd->tggl_nota = $request->tggl_nota;
			$nd->total_tagihan = $request->total_tagihan;
			$nd->save();

			$ntg = Tagihan::where('notadinas_id', $nd->id)->first();
			foreach ($request->no_tagihan as $i => $no_tagihan) {
				if ($ntg->no_tagihan != $no_tagihan) {
					$tg = new Tagihan;
					$tg->notadinas_id = $nd->id;
					$tg->no_tagihan = $nd->no_tagihan;
					$tg->no_tagihan = $no_tagihan;
					$tg->jumlah_tagihan = $request->jumlah_tagihan[$i];
					$tg->keterangan = $request->keterangan[$i];
					$tg->save();
				}
			}
		}

		return redirect('/admin/suratmasuk')->with('msg', 'Nota Dinas berhasil dibuat');
	}
}
