@extends('yakes.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Tambah Data Dokter</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center mt-4">
						<div class="col-md-6">
							<form method="POST" action="{{ route('storedatadokter') }}">
								{{ csrf_field() }}
								<input type="hidden" name="yakes_id" value="{{ Auth::user()->id }}">
								<div class="form-group">
									<label>NIP</label>
									<input type="number" class="form-control" name="nip" required="">
								</div>
								<div class="form-group">
									<label>Nama Dokter</label>
									<input type="text" class="form-control" name="nama_dokter" required="">
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status">
										<option value="Aktif">Aktif</option>
										<option value="Tidak Aktif">Tidak Aktif</option>
									</select>
								</div>
								<div class="form-group">
									<label>Keterangan</label>
									<input type="text" class="form-control" name="keterangan" required="">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Simpan</button>
									<a href="{{ url('yakes/datadokter') }}" role="button" class="btn btn-danger">Batal</a>
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
		$('.datadokter').attr('class', 'active');
	});
</script>
@endsection