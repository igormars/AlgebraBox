@extends('layouts.index')

@section('title', 'AlgebraBox | The greatest cloud storage')

@section('content')
<div class="row">
@php print_r($errors->all()); @endphp
</div>
<div class="row">
  <ol class="breadcrumb">
    <li class="active">Home</li>
  </ol>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<a href="#" class="list-group-item active" data-toggle="modal" data-target="#myModal">
				Create New Directory
			</a>
			<a href="#" class="list-group-item list-group-item-info">Dapibus ac facilisis in</a>
			<a href="#" class="list-group-item list-group-item-info">Morbi leo risus</a>
			<a href="#" class="list-group-item list-group-item-info">Porta ac consectetur ac</a>
			<a href="#" class="list-group-item list-group-item-info">Vestibulum at eros</a>
		</div>
	</div>
	<div class="col-md-9">
	<table class="table table-hover">
         <thead>
            <tr>
               <th>..</th>
               <th>Name</th>
               <th>Type</th>
               <th>Size</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($directories as $directory)
               <tr>
                  <td><span class="glyphicon glyphicon-folder-open"></span></td>
                  <td>
                  	@php
						$dir_arr = explode("/",$directory);
						$name = end($dir_arr);
					@endphp
					<a href="{{ route('home.dir', $name ) }}">
						{{ $name }}
                  	</a>
                  </td>
                  <td>Directory</td>
                  <td></td>
               </tr>
            @endforeach
         </tbody>
      </table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<form action="{{ route('dir.create') }}" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create new directory</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="new-dir">Directory Name</label>
			<input type="text" class="form-control" id="new-dir" name="new_dir" placeholder="Enter directory name">
		</div>
      </div>
      <div class="modal-footer">
			{{ csrf_field() }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
	</form>
    </div>
  </div>
</div>
@stop
