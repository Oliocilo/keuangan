<form action="<?=base_url('conf/premium/store')?>" id="formajaxaw">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Durasi</label>
				<input type="text" class="form-control" name="durasi">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
		<label>Type</label>
		<select class="form-control" name="satuan">
			<option value="BULAN">BULAN</option>
			<option value="TAHUN">TAHUN</option>
		</select>
	</div>
		</div>
	</div>
	
	<div class="form-group">
		<label>Harga</label>
		<input type="text" class="form-control" id="amountInput" name="harga">
	</div>

	<hr>
	<div class="text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btnSubmitaw">Simpan</button>
      </div>
</form>

<script>
	var rupiah = document.getElementById("amountInput");
	rupiah.addEventListener("keyup", function(e) {
		rupiah.value = formatRupiah(this.value, "Rp. ");
	});

	function formatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		if (ribuan) {
			separator = sisa ? "." : "";
			rupiah += separator + ribuan.join(".");
		}

		rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
		return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
	}    
</script>