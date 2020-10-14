@extends('pegawai.template')
@section('content')
<section class="section">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header text-center">
					<h3>Data Keluarga</h3>
				</div>
				<div class="card-body">
					<a href="{{ url('datakeluarga/tambah') }}" class="btn btn-primary btn-sm mb-4">
						Tambah Data Keluarga
					</a> &nbsp;
					<a href="{{ url('datakeluarga/uploadkk') }}" class="btn btn-primary btn-sm mb-4">
						Upload Kartu Keluarga
					</a>
					<div class="table-responsive">
						<table class="table table-striped text-center" id="table-1">
							<thead>                                 
								<tr>
									<th>No</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Status</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@php
								$id = Auth::user()->id;
								$dtkl = $datakeluarga->where('pegawai_id', $id)->all();
								@endphp
								@foreach($dtkl as $i => $dta)                               
								<tr>
									<td>{{ $i + 1}}</td>
									<td>{{ $dta->nik }}</td>
									<td>{{ $dta->nama }}</td>
									<td>{{ $dta->status }}</td>
									<td>{{ $dta->keterangan }}</td>
									<td>
										<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{ $dta->id }}"><i class="fas fa-edit"></i></a>
										<a href="{{ url('#') }}" class="btn btn-danger btn-sm" data-confirm="Hapus data?|Lanjutkan menghapus data ini?" data-confirm-yes="document.location.href='{{ url("datakeluarga/hapus/".$dta->id) }}';"><i class="fas fa-trash"></i></a>
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
@foreach($datakeluarga as $edt)
<div class="modal fade" tabindex="-1" role="dialog" id="edit{{ $edt->id }}">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Keluarga</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{ route('editdatakeluarga') }}">
				{{ csrf_field() }}
				<div class="modal-body">
					<input type="hidden" name="id" value="{{ $edt->id }}">
					<div class="form-group">
						<label>NIK</label>
						<input type="number" class="form-control" name="nik" value="{{ $edt->nik }}" required="">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama" value="{{ $edt->nama }}" required="">
					</div>
					<div class="form-group">
						<label>Status Keluarga</label>
						<select class="form-control" name="status" required="">
							@php
							$status = ['Ibu', 'Ayah', 'Istri', 'Suami', 'Anak', 'Saudara', 'Lainnya'];
							foreach($status as $sts) {
								if ($edt->status == $sts) $set = 'selected';
								else $set = '';
								echo '<option value="'.$sts.'" '.$set.'>'.$sts.'</option>';
							}
							if ($edt->keterangan == '-') $keterangan = '';
							@endphp
						</select>
					</div>
					<div class="form-group mb-0">
						<label>Keterangan</label>
						<input type="text" class="form-control" name="keterangan"value="{{ $keterangan }}" >
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
		$('.datakeluarga').addClass('active');
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