@extends('pegawai.template')
@section('content')
<section class="section">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header text-center">
					<h3>Tambah Data Keluarga</h3>
				</div>
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-md-6">
							<form method="POST" action="{{ route('storedatakeluarga') }}">
								{{ csrf_field() }}
								<input type="hidden" name="pegawai_id" value="{{ Auth::user()->id }}">
								<div class="form-group">
									<label>NIK</label>
									<input type="number" class="form-control" name="nik" required="">
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" class="form-control" name="nama" required="">
								</div>
								<div class="form-group">
									<label>Status Keluarga</label>
									<select class="form-control" name="status" required="">
										<option value="">--Pilih--</option>
										<option value="Ibu">Ibu</option>
										<option value="Ayah">Ayah</option>
										<option value="Istri">Istri</option>
										<option value="Suami">Suami</option>
										<option value="Anak">Anak</option>
										<option value="Saudara">Saudara</option>
										<option value="Lainnya">Lainnya</option>
									</select>
								</div>
								<div class="form-group">
									<label>Keterangan</label>
									<input type="text" class="form-control" name="keterangan">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Simpan</button>
									<a href="{{ url('datakeluarga') }}" role="button" class="btn btn-danger">Batal</a>
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
		$('.datakeluarga').addClass('active');
	});
</script>
@endsection