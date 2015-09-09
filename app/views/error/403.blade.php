@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')

@parent
@stop
{{-- Content --}}

@section('content')
	<div class="wrapper" style="min-height: 468px;">
		<div class="error-spacer"></div>
		<div role="main" class="main">
			<?php $messages = array('We need a map.', 'I think we\'re lost.', 'We took a wrong turn.'); ?>

			<h1>Unn</h1>

			<h2>Server Error: 403 (Forbidden)</h2>

			<hr>

			<h3>What does this mean?</h3>

			<p>
				We couldn't find the page you requested on our servers. We're really sorry
				about that. It's our fault, not yours. We'll work hard to get this page
				back online as soon as possible.
			</p>

			<p>
				Perhaps you would like to go to our <a href="{{{ URL::to('/') }}}">home page</a>?
			</p>
		</div>
	</div>
@stop
@section('scripts')

@stop