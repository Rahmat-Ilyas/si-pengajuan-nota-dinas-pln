@extends('yakes.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Data Dokter</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<a href="{{ url('yakes/datadokter/tambah') }}" class="btn btn-primary btn-lg">
						Tambah Dokter
					</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped" id="table-1">
							<thead>                                 
								<tr>
									<th>No</th>
									<th>NIP</th>
									<th>Nama Dokter</th>
									<th>Status</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@php
								$id = Auth::user()->id;
								$dokter = $datadokter->where('yakes_id', $id);
								@endphp
								@foreach($dokter as $i => $dta)                               
								<tr>
									<td>{{ $i + 1 }}</td>
									<td>{{ $dta->nip }}</td>
									<td>{{ $dta->nama_dokter }}</td>
									<td>{{ $dta->status }}</td>
									<td>{{ $dta->keterangan }}</td>
									<td>
										<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{ $dta->id }}"><i class="fas fa-edit"></i></a>
										<a href="#" class="btn btn-danger btn-sm" data-confirm="Hapus data?|Lanjutkan menghapus data ini?" data-confirm-yes="document.location.href='{{ url("yakes/datadokter/hapus/".$dta->id) }}';"><i class="fas fa-trash"></i></a>
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

{{-- Modal Edit --}}
@foreach($datadokter as $edt)
<div class="modal fade" tabindex="-1" role="dialog" id="edit{{ $edt->id }}">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Dokter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{ route('editdatadokter') }}">
				{{ csrf_field() }}
				<div class="modal-body">
					<input type="hidden" name="id" value="{{ $edt->id }}">
					<div class="form-group">
						<label>NIP</label>
						<input type="number" class="form-control" name="nip" value="{{ $edt->nip }}" required="">
					</div>
					<div class="form-group">
						<label>Nama Dokter</label>
						<input type="text" class="form-control" name="nama_dokter" value="{{ $edt->nama_dokter }}" required="">
					</div>
					<div class="form-group">
						<label>Status</label>
						@php
						$status = ['Aktif', 'Tidak Aktif'];
						@endphp
						<select class="form-control" name="status">
							@foreach($status as $sts)
							@php
							if ($sts == $edt->status) $select = 'selected';
							else $select = '';
							@endphp
							<option value="{{ $sts }}" {{ $select }}>{{ $sts }}</option>
							@endforeach							
						</select>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<input type="text" class="form-control" name="keterangan" value="{{ $edt->keterangan }}" required="">
					</div>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endforeach
@endsection

@section('js')
<script>
	$(document).ready(function() {
		$('.datadokter').attr('class', 'active');
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