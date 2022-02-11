<form action="{{ action('JabatanController@store') }}" method="POST" id="kantorCabangForm">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		<div class="form-group row">
			<label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
			<div class="col-sm-12">
				<input required type="text" class="form-control" id="jabatan" value="" name="jabatan" autofocus>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="open" value="Y">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>

	</div>
</form>