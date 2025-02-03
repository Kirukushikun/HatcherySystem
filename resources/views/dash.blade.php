@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('content')
	<h3>Logged In</h3>
	<ul>
		<li>Fullname: <span id="fullname"></span></li>
		<li>Email: <span id="email"></span></li>
	</ul>
@endsection

@section('scripts')
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script>
		$.ajax({
			type: "GET",
			url: "{{ config('app.root_domain') . config('app.user_details_slug') . \Crypt::encryptString(Auth::user()->id) }}",
			dataType: 'json',
			success: function(response){
				document.getElementById('fullname').innerHTML = response['first_name'] + " " + response['last_name'];
				document.getElementById('email').innerHTML = response['email'];
			}
		});
	</script>
@endsection