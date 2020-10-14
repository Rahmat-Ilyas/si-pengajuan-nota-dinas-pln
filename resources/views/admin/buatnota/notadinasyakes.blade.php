@extends('admin.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Buat Nota Dinas Tagihan Kesehatan</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="container">
						<form action="{{ route('storenotadinas') }}" method="POST">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $datapengajuan->id }}">
							<input type="hidden" name="no_surat" value="{{ $no_surat }}">
							<input type="hidden" name="tggl_nota" value="{{ date('Y-m-d') }}">
							<input type="hidden" name="total_tagihan" id="total_tagihan">
							<input type="hidden" name="tipe" value="yakes">
							<div class="border mr-5 ml-5 mt-5 p-5">
								<div class="mb-5">
									<span>PT. PLN (PERSERO)</span><br>
									<span><u>PEMBANGKITAN DAN PENYULUHAN SULAWESI</u></span><br>
								</div>
								<div class="text-center mb-3">
									<h5><b><u>NOTA DINAS</u></b></h5>
									<span>Nomor : {{ $no_surat }}/KEU.00.02/KSA/{{ date('Y') }}</span><br>
								</div>
								<div class="mb-3">
									<div class="row">
										<span class="col-lg-1 p-0">Kepada</span>
										<span>: PLH. MANAJER KEU</span>
									</div>
									<div class="row">
										<span class="col-lg-1 p-0">Dari</span>
										<span>: DM PENGEMBANGAN SDM</span>
									</div>
									<div class="row">
										<span class="col-lg-1 p-0">Tanggal</span>
										<span>: {{ date('d F Y') }}</span>
									</div>
									<div class="row">
										<span class="col-lg-1 p-0">Lampiran</span>
										<span>: 1 (Satu) Lembar</span>
									</div>
									<div class="row">
										<span class="col-lg-1 p-0">Prihal</span>
										<span>: Biaya Tagihan Kesehatan</span>
									</div>
								</div>
								<div class="mb-3">
									<div class="row">
										<div class="col-lg-1"></div>
										<div class="col-lg-11">
											<p class="text-justify">
												Besamaan ini kami sampaikan tagihan biaya kesehatan 
												<b>{{ $notadinas->nama_dokter }}</b> 
												priode {{ date('F Y') }} untuk biaya pengobatan karyawan PT PLN (Persero) Pembangkitan dan Penyaluran Sulawesi beserta keluarga yang ditanggung oleh perusahaan <br>
												Terlampir dengan rincian sebagai berikut : <br>	
											</p>
											<table class="table table-bordered m-0 p-0">
												<thead class="">
													<tr>
														<th>No</th>
														<th>No. Tagihan</th>
														<th>Jumlah tagihan</th>
														<th>Keterangan</th>
													</tr>
												</thead>
												<tbody class="item">
													<tr>
														<td>1</td>
														<td>
															<input type="text" name="no_tagihan[]" class="form-control" id="no_tagihan" value="{{ $tagihan->no_tagihan }}" placeholder="Input nomor tagihan" required autocomplete="off" readonly="" style="border: none; background: #fff">
														</td>
														<td>
															<input type="number" name="jumlah_tagihan[]" class="form-control" id="jumlah1" value="{{ $tagihan->jumlah_tagihan }}" placeholder="Input jumlah tagihan" required autocomplete="off" readonly="" style="border: none; background: #fff">
														</td>
														<td>
															<input type="text" name="keterangan[]" class="form-control" id="keterangan" value="{{ $tagihan->keterangan }}" placeholder="Input keterangan" autocomplete="off" style="border: none;">
														</td>
													</tr>
												</tbody>
												<tfoot class="text-center">
													<tr>
														<td colspan="2"><b>Jumlah dibayar</b></td>
														<td colspan="2"><b>Rp. </b><b id="total">0</b></td>
													</tr>
												</tfoot>
											</table>
											<div class="mt-2" id="button">
												<button href="javascript:;" id="tambah" role="button" class="btn btn-sm btn-primary m-t-10">Tambah pembayaran</button>
											</div><br>
											<p class="text-justify">
												Demikian kami sampaikan, atas perhaian dan kerja samanya diucapkan terima kasih.
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="ml-5 mt-2">
								<button type="submit" id="tombol" class="btn btn-success btn-lg">Buat Nota Dinas</button>
							</div>
						</form>
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
		$('.pengajuanmasuk').addClass('active');

		var set = 1;
		$('#tambah').click(function(event) {
			event.preventDefault();
			var no = set;
			var no=parseInt(no) + 1;
			set = no;
			$('.item').append('<tr class="clear"><td>'+no+'</td> <td> <input type="text" name="no_tagihan[]" class="form-control" placeholder="Input nomor tagihan" required autocomplete="off" style="border: none;"> </td> <td> <input type="number" name="jumlah_tagihan[]" class="form-control" id="jumlah'+no+'" placeholder="Input jumlah tagihan" required autocomplete="off" style="border: none;"> </td> <td> <input type="text" name="keterangan[]" class="form-control" placeholder="Input keterangan" autocomplete="off" style="border: none;"> </td></tr>');
			if (no <= 2) {
				$('#button').append('<a href="javascript:;" id="reset" role="button" class="btn btn-sm btn-danger m-t-10">Reset</a>');
			}

			if (no == 3) {
				$('#tambah').attr('disabled', '');
			}
		});

		$(document).on('keyup', '#jumlah1', function() {
			var jumlah1 = parseInt($('#jumlah1').val());
			var jumlah2 = parseInt($('#jumlah2').val());
			var jumlah3 = parseInt($('#jumlah3').val());
			if (isNaN(jumlah2)) jumlah2 = 0;
			if (isNaN(jumlah3)) jumlah3 = 0;
			var total = jumlah1 + jumlah2 + jumlah3;
			$('#total').text(total);
		});

		$(document).on('keyup', '#jumlah2', function() {
			var jumlah1 = parseInt($('#jumlah1').val());
			var jumlah2 = parseInt($('#jumlah2').val());
			var jumlah3 = parseInt($('#jumlah3').val());
			if (isNaN(jumlah1)) jumlah1 = 0;
			if (isNaN(jumlah3)) jumlah3 = 0;
			var total = jumlah1 + jumlah2 + jumlah3;
			$('#total').text(total);
		});

		$(document).on('keyup', '#jumlah3', function() {
			var jumlah1 = parseInt($('#jumlah1').val());
			var jumlah2 = parseInt($('#jumlah2').val());
			var jumlah3 = parseInt($('#jumlah3').val());
			if (isNaN(jumlah1)) jumlah1 = 0;
			if (isNaN(jumlah2)) jumlah2 = 0;
			var total = jumlah1 + jumlah2 + jumlah3;
			$('#total').text(total);
		});

		// Reset
		$(document).on('click', '#reset', function() {
			$('.clear').remove();
			$('#reset').remove();
			$('#tambah').removeAttr('disabled');
			$('#total').text($('#jumlah1').val());
			set = 1;
		});
		$('#total').text($('#jumlah1').val());

		$('form').submit(function(event) {
			$('#total_tagihan').val($('#total').text());
		});
	});
</script>
@endsection