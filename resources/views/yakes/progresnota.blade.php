@extends('yakes.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Progres Nota Dinas</h1>
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
									<th>No Tagihan</th>
									<th>Nama Dokter</th>
									<th>Nama Pegawai</th>
									<th>Nama Pasien</th>
									<th>Hubungan Keluarga</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@php 
								$pengaju = $datapengajuan->where('pengaju', Auth::user()->nama_yakes);
								$i = 1;
								@endphp
								@foreach($pengaju as $dta)
								@php                               
								$nd = $notadinas->where('pengajuan_id', $dta->id)->first();
								$tg = $tagihan->where('notadinas_id', $nd->id)->first();
								$pgw = $pegawai->where('id', $dta->pegawai_id)->first();
								@endphp                               
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $tg->no_tagihan }}</td>
									<td>{{ $nd->nama_dokter }}</td>
									<td>{{ $pgw->nama }}</td>
									<td>{{ $dta->nama_pasien }}</td>
									<td>{{ $dta->hub_keluarga }}</td>
									@php
									if ($dta->progres == 'Dalam Proses') $text = 'text-warning';
									else if ($dta->progres == 'Selesai') $text = 'text-success';
									else $text = 'text-danger';
									$i = $i + 1;
									@endphp
									<td class="{{ $text }}">{{ $dta->progres }}</td>
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

@endsection

@section('js')
<script>
	$(document).ready(function() {
		$('.progresnota').attr('class', 'active');
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