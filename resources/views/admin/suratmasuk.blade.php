@extends('admin.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Data Pengajuan Nota Dinas</h1>
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
									<th>NIK</th>
									<th>Nama Pasien</th>
									<th>Status</th>
									<th>Hubungan Keluarga</th>
									<th>Pengaju</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($datapengajuan as $i => $dta)                               
								<tr>
									@php
									$pgw = $pegawai->where('id', $dta->pegawai_id)->first();
									@endphp
									<td>{{ $i + 1}}</td>
									<td>{{ $pgw->nama }}</td>
									<td>{{ $pgw->nip }}</td>
									<td>{{ $dta->nama_pasien }}</td>
									<td>{{ $dta->status }}</td>
									<td>{{ $dta->hub_keluarga }}
										@if($dta->hub_keluarga != '-')
										<a href="javascript:;" data-toggle="modal" data-target="#kk{{ $dta->id }}">|<i class="fas fa-eye"></i></a> 
										@endif
									</td>
									<td>
										{{ $dta->pengaju }} 
										@if ($dta->pengaju == 'Pegawai')
										(<a href="#" data-toggle="modal" data-target="#kutansi{{ $dta->id }}">lihat kitansi</a>)
										@endif
									</td>
									<td>
										@php
										if ($dta->pengaju == 'Pegawai') $link = 'notadinaspegawai';
										else $link = 'notadinasyakes';
										@endphp
										<a href="{{ url('admin/'.$link.'/'.$dta->id) }}" class="btn btn-success btn-sm">Buat Nota</a>
									</td>
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
<div class="modal fade" tabindex="-1" role="dialog" id="kutansi{{ $view->id }}">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Kuitansi Pembayaran Rumah Sakit</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="card-body">
				<img src="{{ asset('images/foto_kuitansi/'.$view->foto_kuitansi) }}" alt="" style="width: 100%;">
			</div>				
		</div>
	</div>
</div>

@if($view->hub_keluarga != '-')
@php
$pgw1 = $pegawai->where('id', $view->pegawai_id)->first();
$dk = $keluarga->where('nama', $view->nama_pasien)->where('pegawai_id', $view->pegawai_id)->first();
@endphp

<div class="modal fade" tabindex="-1" role="dialog" id="kk{{ $view->id }}">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Keluarga</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="card-body">
				<label>Nama : {{ $view->nama_pasien }}</label><br>
				<label>NIK : {{ $dk->nik }}</label><br>
				<label>Hubungan Keluarga : {{ $view->hub_keluarga }}</label><br>
				<hr>
				<h5>Kartu Keluarga</h5>
				<img src="{{ asset('images/foto_kk/'.$pgw1->foto_kk) }}" alt="" style="width: 100%;">
			</div>
		</div>
	</div>
</div>
@endif
@endforeach

@endsection

@section('js')
<script>
	$(document).ready(function() {
		$('.pengajuanmasuk').addClass('active');
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