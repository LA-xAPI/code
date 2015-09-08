<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Personal Data Locker
			@show
		</title>
		@section('meta_keywords')
		<meta name="keywords" content="your, awesome, keywords, here" />
		@show
		@section('meta_author')
		<meta name="author" content="Jon Doe" />
		@show
		@section('meta_description')
		<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />
                @show
		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        <!-- Latest compiled and minified CSS -->
		<link rel="shortcut icon" href="https://personal-data-locker.org/assets/img/favicon.ico" type="image/x-icon">
		
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap-theme.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

		<style>
        body {
            padding: 60px 0;
        }
		@section('styles')
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
		<link rel="shortcut icon" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
	</head>

	<body>
		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">
		<!-- Navbar -->
		
		<div class="navbar navbar-default navbar-inverse navbar-fixed-top" style="background-image:linear-gradient(to bottom,#3C3D45 0,#335 119%);font-stretch: semi-expanded;">
		
		<div class="container">
                <div class="navbar-header">
				<img style="float:left" src="{{{ URL::to('https://go-xapi.com/demopdl/assets/images/!logged-pdl.jpg') }}}" , width=52px , height=52px />
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
						
						
					</ul>

                    <ul class="nav navbar-nav pull-right"    style=" color: #D8F9AE; text-align:right">
                        @if (Auth::check())
                        @if (Auth::user()->hasRole('admin'))
                        <!-- <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li> -->
                        @endif
                        <li><a href="{{{ URL::to('dashboard') }}}">Dashboard</a></li>
                        
						<li><a href="{{{ URL::to('statements') }}}">Reporting</a></li>
						<li><a href="{{{ URL::to('stats') }}}">Stats</a></li>
                        <li><a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a></li>
                        <li><a href="{{{ URL::to('user/logout') }}}">Logout</a></li>
                        @else
                        <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                        <li {{ (Request::is('user/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                        @endif
                    </ul>
					<!-- ./ nav-collapse -->
				</div>
			</div>
		</div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container default-container" style="margin-bottom:-60px; padding-top:0px">
			<div class="row">
				<!-- Content -->
				<div class="col-md-12 " style="">
					@yield('content')
				</div>
				<!-- ./ content -->
				
				<div id="footer">

	      <div class="panel-footer col-xs-12 col-centered pull-center ">
							<div class="row "style="text-align:center ; padding-left:5px;padding-right:5px;">Copyright (C) 2015  personal-data-locker.org<br>

    
    This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or any later version.
	<a href="http://www.gnu.org/licenses/agpl" target="_blank" title="AGPLv3 license">AGPL</a>
				</div>		
	      </div>
	    </div>
			</div>
		</div>
		<!-- ./ container -->
		<!-- the following div is needed to make a sticky footer -->
		<!-- ./wrap -->

		<!-- Javascripts
		================================================== -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/datatables-bootstrap.js')}}"></script>
        <script src="{{asset('assets/js/datatables.fnReloadAjax.js')}}"></script>
		<script src="{{asset('assets/js/highcharts.js')}}"></script>
		<script src="{{asset('assets/js/exporting.js')}}"></script>
		@yield('scripts')
	</body>
</html>
