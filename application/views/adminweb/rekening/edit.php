<form action="<?=base_url('conf/rekening/update')?>" id="formajaxaw">
	<input type="hidden" name="id" value="<?=$rtcdata['id']?>">
	
		<div class="form-group">
			<label>Logo Bank</label>
			<input type="file" name="file" id="fileInput" style="display: none;">
			<div style="border: 1px solid #ddd;text-align: center;">
				<label style="width:100%;cursor: pointer;">
				<?php 
				if (file_exists($rtcdata['logo_bank'])) {
					$logo = $rtcdata['logo_bank'];
				} else {
					$logo = 'assets/images/file-upload-icon.jpg';
				}
				?>
				<img src="<?=base_url($logo)?>" alt="Preview" id="previewImage" style="width: 140px;" onclick="uploadFile()">
				</label>
			</div>
		</div>

	
	<div class="form-group">
		<label>Nama Bank</label>
		<input type="text" class="form-control" name="nama_bank" value="<?=$rtcdata['nama_bank']?>">
	</div>
	<div class="form-group">
		<label>Nomor Rekening</label>
		<input type="text" class="form-control" name="nomor_rekening" value="<?=$rtcdata['nomor_rekening']?>">
	</div>
	<div class="form-group">
		<label>Nama Rekening</label>
		<input type="text" class="form-control" name="nama_rekening" value="<?=$rtcdata['nama_rekening']?>">
	</div>

	<hr>
	<div class="text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btnSubmitaw">Simpan</button>
      </div>
</form>

<script>
	function uploadFile() {
		var fileInput = document.getElementById('fileInput');
		var previewImage = document.getElementById('previewImage');
		fileInput.click();
		fileInput.addEventListener('change', function() {
			var file = fileInput.files[0];
			if (file) {
				if (file.type.startsWith('image/')) {
					var reader = new FileReader();
					reader.onload = function(e) {
						previewImage.src = e.target.result;

					};
					reader.readAsDataURL(file);
				} else {
					alert('File bukan gambar. Pilih file gambar.');
					fileInput.value = '';
				}
			}
		});
	}
</script>
