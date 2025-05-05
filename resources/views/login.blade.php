@extends('layouts.app')

@section('title')
	Login
@endsection

@section('content')
	<h3>Login Using BGC Authenticator. :)</h3>
	<script>
		function redirectAfter3Seconds() {
			setTimeout(function() {
				window.location.href = '/home';
			}, 2000); // 3000 milliseconds = 3 seconds
		}
		redirectAfter3Seconds();
	</script>
@endsection