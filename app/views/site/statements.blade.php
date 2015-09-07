@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')

@parent
@stop
{{-- Content --}}

@section('content')
<div class="page-header" style="margin-top: 0px">
	<h1 style="margin-top: 0px">Reporting</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-inline">
            <div class="form-group">
                <label for="exampleInputName2">Filter By Activity Name</label>
                <select name="activityName" class="form-control" style="margin-left: 20px;" id="activityName">
                    <option value="all">All Statements</option>
                    @foreach($activityNames as $activityName)
                    <option value="{{$activityName->activity_name}}">{{$activityName->activity_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<table id="statements" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Generated Date</th>
			<th>Verb Id</th>
			<th>Verb Value</th>
			<th>Verb Description</th>
			<th>Activity</th>
		</tr>
	</thead>
    <tbody>
    </tbody>
</table>

@stop
@section('scripts')
<script type="text/javascript">
var oTable;
$(document).ready(function() 
    {
    var activityName = $("#activityName option:selected").val();
    
    $("#activityName").change(function()
        {
        activityName = $("#activityName option:selected").val();
        
        oSettings.sAjaxSource  = "{{ URL::to('statements/data?activityName="+activityName+"') }}";
        oTable.fnDraw();
        });
    
    oTable = $('#statements').dataTable( 
        {
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
            },
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "{{ URL::to('statements/data?activityName="+activityName+"') }}",
        "fnInitComplete": function (oSettings, json) {
            $("[name='statements_length']").addClass("form-control");
            $("#statements_filter [type='text']").addClass("form-control");
            },
        "fnDrawCallback": function ( oSettings ) {
            }
        });
    var oSettings = oTable.fnSettings(); 
    });
</script>
@stop
