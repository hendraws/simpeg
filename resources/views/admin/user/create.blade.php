<form action="{{ action('IndikatorPenilaianController@store') }}" method="POST">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Tambah Indikator Penilaian</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		<div class="form-group row">
			<label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
			<div class="col-sm-12">
				<select class="form-control" id="jabatan" name="jabatan_id">
					@foreach($jabatan as $key => $val)
					<option value="{{ $key }}">{{ $val }}</option>
					@endforeach
				</select>
			</div>
		</div>	
		<div class="form-group row">
			<label for="indikator" class="col-sm-4 col-form-label">Indikator</label>
			<div class="col-sm-12">
				<input required type="text" class="form-control" id="indikator" value="" name="indikator" autofocus>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>

	</div>
</form>