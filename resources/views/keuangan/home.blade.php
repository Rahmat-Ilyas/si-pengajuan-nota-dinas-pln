@extends('keuangan.template')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Home</h1>
	</div>

	<div class="hero bg-primary text-white">
		<div class="hero-inner">
			<h2>Welcome, {{ Auth::user()->nama }}</h2>
			<p class="lead">You almost arrived, complete the information about your account to complete registration.</p>
			<div class="mt-4">
				<a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Setup Account</a>
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
		$('.home').addClass('active');
	});
</script>
@endsection