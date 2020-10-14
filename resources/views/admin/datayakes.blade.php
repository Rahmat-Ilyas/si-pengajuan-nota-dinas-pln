@extends('admin.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Data Yakes</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<a href="{{ url('admin/datayakes/tambah') }}" class="btn btn-primary btn-lg">
						Tambah Yakes
					</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped" id="table-1">
							<thead>                                 
								<tr>
									<th>No</th>
									<th>ID Yakes</th>
									<th>Nama Yakes</th>
									<th>Alamat</th>
									<th>Telepon</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($yakes as $i => $dta)                               
								<tr>
									<td>{{ $i + 1 }}</td>
									<td>{{ $dta->id_yakes }}</td>
									<td>{{ $dta->nama_yakes }}</td>
									<td>{{ $dta->alamat }}</td>
									<td>{{ $dta->telpon }}</td>
									<td>
										<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{ $dta->id }}"><i class="fas fa-edit"></i></a>
										<a href="#" class="btn btn-danger btn-sm" data-confirm="Hapus data?|Lanjutkan menghapus data ini?" data-confirm-yes="document.location.href='{{ url("admin/datayakes/hapus/".$dta->id) }}';"><i class="fas fa-trash"></i></a>
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
@foreach($yakes as $edt)
<div class="modal fade" tabindex="-1" role="dialog" id="edit{{ $edt->id }}">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Yakes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{ route('editdatayakes') }}">
				{{ csrf_field() }}
				<div class="modal-body">
					<input type="hidden" name="id" value="{{ $edt->id }}">
					<div class="form-group">
						<label>ID Yakes</label>
						<input type="text" class="form-control" name="id_yakes" value="{{ $edt->id_yakes }}" required="" readonly="">
					</div>
					<div class="form-group">
						<label>Nama Yakes</label>
						<input type="text" class="form-control" name="nama_yakes" value="{{ $edt->nama_yakes }}" required="">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat" required="">{{ $edt->alamat }}</textarea>
					</div>
					<div class="form-group">
						<label>Telepon</label>
						<input type="text" class="form-control" name="telpon" value="{{ $edt->telpon }}" required="">
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
		$('.datayakes').attr('class', 'active');
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