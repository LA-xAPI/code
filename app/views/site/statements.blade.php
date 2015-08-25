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
		@foreach($statements as $statement)
		<tr>
			<td>{{$statement->timestamp}}</td>
			<td>{{$statement->verb_id}}</td>
			<td>{{$statement->verb_value}}</td>
			<td>{{$statement->verb_description}}</td>
			<td>{{$statement->activity_name}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{ $statements->links() }}
@stop
@section('scripts')

@stop
