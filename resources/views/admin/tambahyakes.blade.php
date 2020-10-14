@extends('admin.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Tambah Data Yakes</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center mt-4">
						<div class="col-md-6">
							<form method="POST" action="{{ route('storedatayakes') }}">
								{{ csrf_field() }}
								<div class="form-group">
									<label>ID Yakes</label>
									<input type="text" class="form-control" name="id_yakes" required="" value="{{ 'yks'.date('dis') }}" readonly="">
								</div>
								<div class="form-group">
									<label>Nama Yakes</label>
									<input type="text" class="form-control" name="nama_yakes" required="">
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea  class="form-control" name="alamat" required=""></textarea>
								</div>
								<div class="form-group">
									<label>Telepon</label>
									<input type="text" class="form-control" name="telpon" required="">
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
		$('.datayakes').attr('class', 'active');
	});
</script>
@endsection