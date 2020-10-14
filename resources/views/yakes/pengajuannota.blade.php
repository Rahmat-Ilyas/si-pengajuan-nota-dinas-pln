@extends('yakes.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Pengajuan Nota Dinas</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center mt-4">
						<div class="col-md-6">
							<form method="POST" action="{{ route('storepengajuannota') }}">
								{{ csrf_field() }}
								<input type="hidden" name="pengaju" value="{{ Auth::user()->nama_yakes }}">
								<div class="form-group">
									<label>Status Pengaju Nota Dinas</label>
									<select class="form-control" required="" id="status">
										<option value="1">Pegawai PLN</option>
										<option value="2">Anggota Keluarga</option>
									</select>
								</div>
								<div class="form-group">
									<label>Nama Pegawai</label>
									<select class="form-control select2" required="" id="pegawai" name="pegawai_id">
										<option value="">Pilih Nama / Nip Pegawai</option>
										@foreach($pegawai as $pgw)
										<option value="{{ $pgw->id }}">{{ $pgw->nama." / ".$pgw->nip }}</option>
										@endforeach
									</select>
								</div>
								<div hidden="" id="set" class="form-group">
									<label>Anggota Keluarga</label>
									<select class="form-control" name="keluarga" required="" id="kel" disabled="">
									</select>
								</div>
								<div class="form-group">
									<label>Nama Dokter</label>
									<select class="form-control select2" required="" name="nama_dokter" id="dokter">
										<option value="">Pilih Dokter</option>
										@php
										$id = Auth::user()->id;
										$dokter = $datadokter->where('yakes_id', $id);
										@endphp
										@foreach($dokter as $dr)
										<option value="{{ $dr->nama_dokter }}">{{ $dr->nama_dokter }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>No. Tagihan</label>
									<input type="text" class="form-control" name="no_tagihan" required="">
								</div>
								<div class="form-group">
									<label>Jumlah Tagihan</label>
									<input type="number" class="form-control" name="jumlah_tagihan" required="">
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
		<div class="tess">
			hfjvfjvhjfhjvjh
		</div>
	</div>
</section>
@endsection

@section('js')
<script>
	$(document).ready(function() {
		$('.pengajuannota').attr('class', 'active');
		$('.layanan').addClass('active');

		$('#pegawai').select2({
			placeholder: 'Pilih Nama / Nip Pegawai'
		});

		$('#dokter').select2({
			placeholder: 'Pilih Dokter'
		});

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

		$(document).on('change', '#pegawai', function() {
			var pegawai_id = $('#pegawai').val();

			$.ajaxSetup({
				headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }
			});		

			$.ajax({
				url			: "{{ url('/yakes/getkeluarga') }}",
				method		: "POST",
				data 		: { pegawai_id : pegawai_id },
				success		: function(data) {
					$('#kel').html(data);
				}
			});
		});
	});
</script>
@endsection