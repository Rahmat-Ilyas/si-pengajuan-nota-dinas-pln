@extends('keuangan.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Nota Dinas yang Ditolak</h1>
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
		$('.datanota').addClass('active');
		$('.notaditolak').addClass('active');
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