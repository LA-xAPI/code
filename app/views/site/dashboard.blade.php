@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')

@parent
@stop
{{-- Content --}}

@section('content')
<div class="page-header" style="margin-top: 0px">
	<h1 style="margin-top: 0px">Dashboard</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<p><strong>SID: </strong>{{$sid}} <strong style="padding-left: 20px;">Auth: </strong>{{$auth}}
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form class="form-inline" method="GET" action="">
			<div class="input-group col-sm-4">
				<input type="text" id="date-range" class="form-control" name="date-range" placeholder="Select dateRange" style="border-radius: 5px" value="{{$range}}" />
			</div>
			<button type="submit" id="updateGraph" class="btn btn-default" style="vertical-align: top">
				Update graph
			</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default section-margin-top">
			<div class="panel-body">
				<div class="chart-section" style="height: 350px; position: relative;width:100%"></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<!--
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-default" style="min-height:400px;">
			<div class="panel-heading">
				Most active users
			</div>
			<div class="panel-body">
				<ul class="list-group">
					@foreach($user_count as $user)
					<li class="list-group-item">
						<span class="badge">{{$user['count']}}</span>
						<b>SID</b>: {{$user['email']}}
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	-->
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-default" style="min-height:400px;">
			<div class="panel-heading">
				Popular Activities
			</div>
			<div class="panel-body">
				<ul class="list-group">
					@foreach($popular_activities as $user)
					<li class="list-group-item">
						<span class="badge">{{$user['count']}}</span>
						<b>{{$user['email']}}<b>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@stop
@section('scripts')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/daterangepicker.css')}}">
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/daterangepicker.js')}}"></script>
<script type="text/javascript">
$(function () 
	{
	$('#date-range').daterangepicker({ locale: {format: 'YYYY/MM/DD'} });	
	
    $('.chart-section').highcharts({
        title: {
            text: 'Statements count by Day',
            x: -20 //center
        },
        xAxis: {
            categories: {{$date_array}}
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
			name: 'Statements Per Day',
            data: {{$date_counts}}
        }]
    });
});
</script>
@stop