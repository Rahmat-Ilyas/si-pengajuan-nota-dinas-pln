@extends('pegawai.template')
@section('content')
<section class="section">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header text-center">
					<h3>Pengajuan Nota Dinas</h3>
				</div>
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-md-6">
							<form method="POST" action="{{ route('storepengajuan') }}" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ Auth::user()->id }}">
								<input type="hidden" name="nama" value="{{ Auth::user()->nama }}">
								<div class="form-group">
									<label>Status Pengaju Nota Dinas</label>
									<select class="form-control" required="" id="status">
										<option value="1">Pegawai PLN</option>
										<option value="2">Anggota Keluarga</option>
									</select>
								</div>
								<div hidden="" id="set" class="form-group">
									<label>Anggota Keluarga</label>
									<select class="form-control" name="keluarga" required="" id="kel" disabled="">
										@php
										$id = Auth::user()->id;
										$dtakel = $datakeluarga->where('pegawai_id', $id);
										@endphp
										@foreach($dtakel as $dta)
										<option value="{{ $dta->id }}">{{ $dta->nama.' ('.$dta->status.')' }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Scane Kuitansi Pembayaran Rumah Sakit</label>
									<div class="custom-file">
										<input type="file" name="foto_kuitansi" class="custom-file-input" id="site-favicon" required="">
										<label class="custom-file-label">Choose File</label>
									</div>
									<div class="form-text text-muted">*.jpg, *.jpeg, *.png, *.img | max: 2mb</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Ajukan</button>
									<a href="{{ url('layanan') }}" role="button" class="btn btn-danger">Batal</a>
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
		$('.layanan').addClass('active');

		$('#status').change(function(event) {
			var val = $('#status').val();
			if (val == 1) {
				$('#set').attr('hidden', '');
				$('#kel').attr('disabled', '');
			}
			else if (val == 2) {
				$('#set').removeAttr('hidden', '');
				$('#kel').removeAttr('disabled', '');
			}
		});
	});
</script>
@endsection