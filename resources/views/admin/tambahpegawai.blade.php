@extends('admin.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Tambah Data Pegawai</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center mt-4">
						<div class="col-md-6">
							<form method="POST" action="{{ route('storedatapegawai') }}">
								{{ csrf_field() }}
								<div class="form-group">
									<label>NIP</label>
									<input type="number" class="form-control" name="nip" required="">
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" class="form-control" name="nama" required="">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="email" required="">
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<select class="form-control" name="jenis_kelamin" required="">
										<option value="Laki-laki">Laki-laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label>Tanggal Lahir</label>
									<input type="date" class="form-control" name="tggl_lahir" required="">
								</div>
								<div class="form-group">
									<label>Jabatan</label>
									<input type="text" class="form-control" name="jabatan" required="">
								</div>
								<div class="form-group">
									<label>Unit</label>
									<input type="text" class="form-control" name="unit" required="">
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status" required="">
										<option value="Lajang">Lajang</option>
										<option value="Menikah">Menikah</option>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Simpan</button>
									<a href="{{ url('admin/datapegawai') }}" role="button" class="btn btn-danger">Batal</a>
								</div>
							</form>
						</div>
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
		$('.masterdata').attr('class', 'active');
		$('.datapegawai').attr('class', 'active');
	});
</script>
@endsection