<form action="{{ action('PemberhentianController@upload', $id) }}" method="POST" id="kantorCabangForm" enctype="multipart/form-data">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Upload Berkas</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		@method('PUT')
		<div class="form-group row">
			<label for="jabatan" class="col-sm-4 col-form-label">Upload Berkas</label>
			<div class="col-sm-12">
				 <input type="file" class="form-control-file" name="file">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="open" value="Y">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>

	</div>
</form>