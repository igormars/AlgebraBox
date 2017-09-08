@extends('layouts.index')

@section('title', 'AlgebraBox | The greatest cloud storage')

@section('content')
<div class="row">
   @php print_r($errors->all()); @endphp
</div>
<div class="row">
  <ol class="breadcrumb">
     <li class="active"><a href="{{ route('home.dir', '' ) }}">Home</a></li>
     <li class="active"></li>
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

   </div>
</div>
<div class="row">
	<form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
		<input type="file" name="gallery[]" multiple><br>
		{{ csrf_field() }}
		<button type="submit">Upload</button>
	</form>
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
         <input type="text" class="form-control" id="new-dir" name="pero" placeholder="Enter directory name" value="" autofocus>
      </div>
	  <div class="form-group">
         <label for="content">Content</label>
         <textarea name="content" id="content" class="form-control" rows="10"></textarea>
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
