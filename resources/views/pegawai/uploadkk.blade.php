@extends('pegawai.template')
@section('content')
<section class="section">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header text-center">
					<h3>Upload Scane Kartu Keluarga</h3>
				</div>
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-md-7">
							<form method="POST" action="{{ route('storedatakeluarga') }}" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ Auth::user()->id }}">
								<input type="hidden" name="tipe" value="uploadkk">
								<div class="form-group">
									<label>Scane Kartu Keluarga (*.jpg, *.jpeg, *.png, *.img | max: 2mb)</label>
									<div id="image-preview" class="image-preview">
										<label for="image-upload" id="image-label">Pilih Fota</label>
										<input type="file" name="foto_kk" id="image-upload" />
									</div>
									@if ($errors->has('foto_kk'))
									<label class="text-danger">{{ $errors->first('foto_kk') }}</label>
									@endif
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Upload</button>
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
<link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
<script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.datakeluarga').addClass('active');
	});
</script>
@endsection