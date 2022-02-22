<style type="text/css">
	input[type='radio'] {
    transform: scale(1.5);
}
</style>
<form action="{{ action('MutasiController@verifikasi', $id) }}" method="POST" id="kantorCabangForm" enctype="multipart/form-data">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Verifikasi Berkas</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		@method('PUT')
		<div class="form-group row">
			<label for="jabatan" class="col-sm-4 col-form-label">Verifikasi Berkas</label>
			<div class="col-sm-12">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="status"  checked id="flexRadioDefault1" value="sukses">
					<label class="form-check-label" for="flexRadioDefault1">
						Sukses
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"  value="sukes">
					<label class="form-check-label" for="flexRadioDefault2">
						Gagal
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="open" value="Y">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>

	</div>
</form>