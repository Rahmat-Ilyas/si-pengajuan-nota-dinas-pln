@extends('pegawai.template')
@section('content')
<section class="section">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header text-center">
					<h3>Progres Nota Dinas Diajukan</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped text-center" id="table-1">
							<thead>                                 
								<tr>
									<th>No</th>
									<th>Nama Pasien</th>
									<th>Hubungan Keluarga</th>
									<th>Tggl Pengajuan</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@php 
								$pengaju = $datapengajuan->where('pegawai_id', Auth::user()->id)->where('pengaju', 'Pegawai');
								$i = 1;
								@endphp
								@foreach($pengaju as $dta)                               
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $dta->nama_pasien }}</td>
									<td>{{ $dta->hub_keluarga }}</td>
									<td>{{ date('d F Y', strtotime($dta->created_at)) }}</td>
									@php
									if ($dta->progres == 'Dalam Proses') $text = 'text-warning';
									else if ($dta->progres == 'Selesai') $text = 'text-success';
									else $text = 'text-danger';
									$i = $i +1;
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
		$('.progres').addClass('active');
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