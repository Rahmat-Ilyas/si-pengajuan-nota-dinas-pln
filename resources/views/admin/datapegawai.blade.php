@extends('admin.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Data Pegawai</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<a href="{{ url('admin/datapegawai/tambah') }}" class="btn btn-primary btn-lg">
						Tambah Pegawai Baru
					</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped" id="table-1">
							<thead>                                 
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Jns Kelamin</th>
									<th>Tggl Lahir</th>
									<th>Jabatan</th>
									<th>Unit</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($pegawai as $dta)                               
								<tr>
									<td>{{ $dta->nip }}</td>
									<td>{{ $dta->nama }}</td>
									<td>{{ $dta->email }}</td>
									<td>{{ $dta->jenis_kelamin }}</td>
									<td>{{ date('d-m-Y', strtotime($dta->tggl_lahir)) }}</td>
									<td>{{ $dta->jabatan }}</td>
									<td>{{ $dta->unit }}</td>
									<td>{{ $dta->status }}</td>
									<td>
										<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{ $dta->id }}"><i class="fas fa-edit"></i></a>
										<a href="#" class="btn btn-danger btn-sm" data-confirm="Hapus data?|Lanjutkan menghapus data ini?" data-confirm-yes="document.location.href='{{ url("admin/datapegawai/hapus/".$dta->id) }}';"><i class="fas fa-trash"></i></a>
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
@foreach($pegawai as $edt)
<div class="modal fade" tabindex="-1" role="dialog" id="edit{{ $edt->id }}">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{ route('editdatapegawai') }}">
				{{ csrf_field() }}
				<div class="modal-body">
					<input type="hidden" name="id" value="{{ $edt->id }}">
					<div class="form-group">
						<label>NIP</label>
						<input type="number" class="form-control" name="nip" value="{{ $edt->nip }}" required="">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama" value="{{ $edt->nama }}" required="">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="{{ $edt->email }}" required="">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select class="form-control" name="jenis_kelamin" required="">
							@php
							$jnsklmn = ['Laki-laki', 'Perempuan'];
							foreach($jnsklmn as $jk) {
								if ($edt->jenis_kelamin == $jk) $set = 'selected';
								else $set = '';
								echo '<option value="'.$jk.'" '.$set.'>'.$jk.'</option>';
							}
							@endphp
						</select>
					</div>
					<div class="form-group mb-0">
						<label>Tanggal Lahir</label>
						<input type="date" class="form-control" name="tggl_lahir" value="{{ $edt->tggl_lahir }}" required="" >
					</div>
					<div class="form-group">
						<label>Jabatan</label>
						<input type="text" class="form-control" name="jabatan" value="{{ $edt->jabatan }}" required="">
					</div>
					<div class="form-group">
						<label>Unit</label>
						<input type="text" class="form-control" name="unit" value="{{ $edt->unit }}" required="">
					</div>
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" name="status" required="">
							@php
							$status = ['Lajang', 'Menikah'];
							foreach($status as $sts) {
								if ($edt->status == $sts) $set = 'selected';
								else $set = '';
								echo '<option value="'.$sts.'" '.$set.'>'.$sts.'</option>';
							}
							@endphp
						</select>
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
		$('.masterdata').attr('class', 'active');
		$('.datapegawai').attr('class', 'active');
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