<form action="{{ action('IndikatorPenilaianController@update', $jenis_pelanggaran) }}" method="POST" >
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Edit Jenis Pelanggaran</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		@method('PUT')
		<div class="form-group row">
			<label for="jenis_pelanggaran" class="col-sm-4 col-form-label">Jenis Pelanggaran</label>
			<div class="col-sm-12">
				<input required type="text" class="form-control" id="jenis_pelanggaran" value="{{ $jenis_pelanggaran->jenis_pelanggaran }}" name="jenis_pelanggaran">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>

	</div>
</form>