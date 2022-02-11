<form action="{{ action('PersusController@store') }}" method="POST">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Tambah Persus</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		<div class="form-group row">
			<label for="judul" class="col-sm-4 col-form-label">Persus</label>
			<div class="col-sm-12">
				<input required type="text" class="form-control" id="judul" value="" name="judul" autofocus>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>

	</div>
</form>