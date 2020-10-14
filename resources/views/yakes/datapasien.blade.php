@extends('yakes.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Data Pasien</h1>
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
									<th>Nama Pasien</th>
									<th>Jumlah Tagihan</th>
									<th>Tggl Pengajuan Nota</th>
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
								@endphp                               
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $tg->no_tagihan }}</td>
									<td>{{ $nd->nama_dokter }}</td>
									<td>{{ $dta->nama_pasien }}</td>
									<td>{{ $tg->jumlah_tagihan }}</td>
									<td>{{ date('d F Y', strtotime($dta->created_at)) }}</td>
								</tr>
								@php
								$i = $i + 1;
								@endphp
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
		$('.datapasien').attr('class', 'active');
	});
</script>
@endsection