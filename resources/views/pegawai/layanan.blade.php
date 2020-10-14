@extends('pegawai.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Layanan</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4>Ajukan Nota Dinas</h4>
					</div>
					<div class="card-body">
						<div class="empty-state" data-height="300">
							<div class="empty-state-icon">
								<i class="far fa-file-alt"></i>
							</div>
							<h2>Nota Dinas Tagihan Kesehatan</h2>
							<p class="lead">
								Klik "Buat" untuk melanjutkan pengajuan nota dinas tagihan kesehatan anda!
							</p>
							<a href="{{ url('layanan/pengajuan/'.Auth::user()->id) }}" class="btn btn-primary mt-4">Buat</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4>Bantuan</h4>
					</div>
					<div class="card-body">
						<div class="empty-state" data-height="300">
							<div class="empty-state-icon">
								<i class="fas fa-question"></i>
							</div>
							<h2>Bantuan</h2>
							<p class="lead">
								We tried it, but failed when requesting data to the server, sorry. (Code: <a href="#" class="bb">14045</a>)
							</p>
							<a href="#" class="btn btn-primary mt-4">Buka</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('js')
<script>
	$(document).ready(function() {
		$('.layanan').addClass('active');
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

@if(session('err'))
<script>
	iziToast.warning({
		title: 'Gagal Mengajukan',
		message: '{{ session('err') }}',
		position: 'topRight'
	});
</script>
@endif
@endsection