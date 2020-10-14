@extends('admin.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Data Nota Dinas Keluar</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped text-center" id="table-1">
							<thead>                                 
								<tr>
									<th>No</th>
									<th>Nama Pegawai</th>
									<th>NIP</th>
									<th>No. Nota</th>
									<th>Tggl Nota</th>
									<th>Total Tagihan</th>
									<th>Preview</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach($datapengajuan as $i => $dta)                               
								<tr>
									@php
									$pgw = $pegawai->where('id', $dta->pegawai_id)->first();
									$ntd = $notadinas->where('pengajuan_id', $dta->id)->first();
									@endphp
									<td>{{ $i + 1 }}</td>
									<td>{{ $pgw->nama }}</td>
									<td>{{ $pgw->nip }}</td>
									<td>{{ $ntd->no_nota }}</td>
									<td>{{ date('d F Y', strtotime($ntd->tggl_nota)) }}</td>
									<td>Rp. {{ $ntd->total_tagihan }}</td>
									<td>
										<a href="#" data-toggle="modal" data-target="#notadinas{{ $dta->id }}">preview nota</a>
									</td>
									@php
									if ($dta->progres == 'Dalam Proses') {
										$text = 'text-warning';
										$status = 'Belum Diproses';
									}
									else if ($dta->progres == 'Selesai') {
										$text = 'text-success';
										$status = 'Disetujui';
									}
									else {
										$text = 'text-danger';
										$status = 'Ditolak';
									}
									@endphp
									<td class="{{ $text }}">{{ $status }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section-body">
	</div>
</section>

@foreach($datapengajuan as $view)
@php
$pgw = $pegawai->where('id', $view->pegawai_id)->first();
$ntd = $notadinas->where('pengajuan_id', $view->id)->first();
$datatagihan = $tagihan->where('notadinas_id', $ntd->id)->all();
$i = 1;
@endphp
<div class="modal fade" tabindex="-1" role="dialog" id="notadinas{{ $view->id }}">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Preview Nota Dinas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="card-body">
				<div class="container">
					<div class="border p-4">
						<div class="mb-5">
							<span>PT. PLN (PERSERO)</span><br>
							<span><u>PEMBANGKITAN DAN PENYULUHAN SULAWESI</u></span><br>
						</div>
						<div class="text-center mb-3">
							<h5><b><u>NOTA DINAS</u></b></h5>
							<span>Nomor : {{ $ntd->no_nota }}</span><br>
						</div>
						<div class="mb-3 ml-3">
							<div class="row">
								<span class="col-lg-1 p-0">Kepada</span>
								<span>: PLH. MANAJER KEU</span>
							</div>
							<div class="row">
								<span class="col-lg-1 p-0">Dari</span>
								<span>: DM PENGEMBANGAN SDM</span>
							</div>
							<div class="row">
								<span class="col-lg-1 p-0">Tanggal</span>
								<span>: {{ date('d F Y', strtotime($ntd->tggl_nota)) }}</span>
							</div>
							<div class="row">
								<span class="col-lg-1 p-0">Lampiran</span>
								<span>: 1 (Satu) Lembar</span>
							</div>
							<div class="row">
								<span class="col-lg-1 p-0">Prihal</span>
								<span>: Biaya Tagihan Kesehatan</span>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="col-lg-11">
								<p class="text-justify">
									Besamaan ini kami sampaikan tagihan biaya kesehatan 
									<b>{{ $ntd->nama_dokter }}</b> 
									priode {{ date('F Y', strtotime($ntd->tggl_nota)) }} untuk biaya pengobatan karyawan PT PLN (Persero) Pembangkitan dan Penyaluran Sulawesi beserta keluarga yang ditanggung oleh perusahaan <br>
									Terlampir dengan rincian sebagai berikut : <br>	
								</p>
								<table class="table table-bordered m-0 p-0">
									<thead class="">
										<tr>
											<th>No</th>
											<th>No. Tagihan</th>
											<th>Jumlah tagihan</th>
											<th>Keterangan</th>
										</tr>
									</thead>
									<tbody class="item">
										@foreach($datatagihan as $tgh)
										<tr>
											<td>{{ $i }}</td>
											<td>{{ $tgh->no_tagihan }}</td>
											<td>{{ $tgh->jumlah_tagihan }}</td>
											<td>{{ $tgh->keterangan }}</td>
										</tr>
										@php
										$i = $i + 1;
										@endphp
										@endforeach
									</tbody>
									<tfoot class="text-center">
										<tr>
											<td colspan="2"><b>Jumlah dibayar</b></td>
											<td colspan="2"><b>Rp. </b><b>{{ $ntd->total_tagihan }}</b></td>
										</tr>
									</tfoot>
								</table>
								<br>
								<p class="text-justify">
									Demikian kami sampaikan, atas perhaian dan kerja samanya diucapkan terima kasih.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>
	</div>
</div>
@endforeach

@endsection

@section('js')
<script>
	$(document).ready(function() {
		$('.pengajuankeluar').addClass('active');
	});
</script>

@if(session('msg'))
<script>
	iziToast.success({
		title: 'Sukses',
		message: '{{ session('msg') }}',
		position: 'topRight'
	});
</script>
@endif
@endsection