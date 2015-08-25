@extends('site.layouts.login')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.login') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row" style="text-align:center">
	<img src="https://go-xapi.com/demopdl/assets/images/!logged-pdl.jpg" class="login-page-image" />
	<h2>Personal Data Locker</h2>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="site-login-block" style="border-width:1px">
			<h1>Welcome to Personal Data Locker</h1>
			<div class="creds">
				<h3>Login details</h3>
				<p><b>Username:</b> demouser</p>
				<p><b>Password:</b> demouser</p>
				<h3>LRS Endpoint</h3>
				<p><b>URL:</b> https://code.personal-data-locker.org/</p>
				<p><b>SID:</b> 91017d590a69dc49807671a51f10ab7f </p>
				<p><b>AUTH:</b> dd07852b0edaf71b39e415c395ec054a</p>
				<br /><br />
				<p><a href="http://code.personal-data-locker.org/chromeExt" target="_blank">Click Here</a> to get our Chrome Extension</p>
				<p><a href="http://www.cnet.com/how-to/how-to-install-chrome-extensions-manually/" target="_blank">How to Install Chrome Extension</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="site-login-block">
			<div class="page-header">
				<h3>Personal Data Locker Login</h3>
			</div>
			{{ Confide::makeLoginForm()->render() }}
		</div>
	</div>
</div>
@stop
