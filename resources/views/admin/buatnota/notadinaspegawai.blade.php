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
							<input type="hidden" name="tipe" value="pegawai">
							<div class="border mr-5 ml-5 mt-2 p-5">
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
												<input type="text" style="width: 350px; height: 30px;" class="p-2" placeholder="Masukkan nama dokter/yakes" name="nama_dokter" required> <br>
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
															<input type="text" name="no_tagihan[]" class="form-control" id="no_tagihan" placeholder="Input nomor tagihan" required autocomplete="off" style="border: none;">
														</td>
														<td>
															<input type="number" name="jumlah_tagihan[]" class="form-control" id="jumlah1" placeholder="Input jumlah tagihan" required autocomplete="off" style="border: none;">
														</td>
														<td>
															<input type="text" name="keterangan[]" class="form-control" id="keterangan" placeholder="Input keterangan" autocomplete="off" style="border: none;">
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
											<div class="row mt-2">
												<div class="col-md-6" id="button">
													<button id="tambah" type="button" class="btn btn-sm btn-primary">Tambah pembayaran</button>
												</div>
												<div class="col-md-6 text-right">
													<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#kutansi">Lihat Kuitansi</button>
												</div>
											</div>
											<br>
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

<div class="modal fade" tabindex="-1" role="dialog" id="kutansi">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Kuitansi Pembayaran Rumah Sakit</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="card-body">
				<img src="{{ asset('images/foto_kuitansi/'.$datapengajuan->foto_kuitansi) }}" alt="" style="width: 100%;">
			</div>				
		</div>
	</div>
</div>
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
			$('#jumlah1').val('');
			$('#no_tagihan').val('');
			$('#keterangan').val('');
			$('#total').text('0');
			set = 1;
		});

		$('form').submit(function(event) {
			$('#total_tagihan').val($('#total').text());
		});
	});
</script>
@endsection