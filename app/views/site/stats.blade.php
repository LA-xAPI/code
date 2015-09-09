@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')

@parent
@stop
{{-- Content --}}

@section('content')
<div class="page-header" style="margin-top: 0px">
	<h1 style="margin-top: 0px">Activity Graph</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<form class="form-inline" method="GET" action="">
			<div class="input-group col-sm-4">
				<input type="text" id="date-range" class="form-control" name="date-range" placeholder="Select dateRange" style="border-radius: 5px" value="{{$range}}" />
			</div>
			<button type="submit" id="updateGraph" class="btn btn-default" style="vertical-align: top">
				Update Chart
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
@stop
@section('scripts')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/daterangepicker.css')}}">
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/daterangepicker.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() 
    {
    $('#date-range').daterangepicker({ locale: {format: 'YYYY/MM/DD'} });

    $('.chart-section').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
            },
        title: {
            text: 'Activity Name Count by Date Range'
            },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
        series: [{
            name: "Percentage",
            colorByPoint: true,
            data: {{$popular_activities}}
            }],
        credits: false
        });
    });
</script>
@stop
