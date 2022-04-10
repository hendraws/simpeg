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
		<div class="form-group row">
			<label for="jabatan" class="col-sm-12 col-form-label">Dibuka Untuk Pelamar</label>
			<div class="col-sm-12">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="open" id="exampleRadios1" value="Y" >
					<label class="form-check-label" for="exampleRadios1">
						Iya
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="open" id="exampleRadios2" value="N" checked>
					<label class="form-check-label" for="exampleRadios2">
						Tidak
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>

	</div>
</form>