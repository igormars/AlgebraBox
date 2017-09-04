@extends('layouts.index')

@section('title', 'AlgebraBox | The greatest cloud storage')

@section('content')
<div class="row">
  <ol class="breadcrumb">
    <li class="active">Home</li>
  </ol>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<a href="#" class="list-group-item active">
				Create New Directory
			</a>
			<a href="#" class="list-group-item list-group-item-info">Dapibus ac facilisis in</a>
			<a href="#" class="list-group-item list-group-item-info">Morbi leo risus</a>
			<a href="#" class="list-group-item list-group-item-info">Porta ac consectetur ac</a>
			<a href="#" class="list-group-item list-group-item-info">Vestibulum at eros</a>
		</div>
	</div>
	<div class="col-md-9">
	{{ print_r($directories->name) }}
	</div>
</div>
@stop
