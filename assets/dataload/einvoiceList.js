$(document).ready(function() {

	var newcs = $('#example').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": true,
		"order": [[0, 'desc']],
		"ajax": {
			"url": baseUrl+"alat/einvoice/json",
			"type": "POST"
		},
		"aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
		"pageLength": 10,
		"language": { 
			"processing": '<div class="lds-hourglass"></div>'
		},
		"columns": [
			{"data": "id"},
			{"data": "no_invoice"},
			{"data": "tanggal"},
			{"data": "tanggal_jatuh_tempo"},
			{"data": "nama_pelanggan"},
			{"data": "total"},
			{"data": "view","orderable":false},


			],

		'columnDefs': [
			{ "className": "text-center", "targets": [0] },
			{ "orderable": false, "targets": [0] },
			{ "searchable": false, "targets": [0] },
			],
		rowCallback: function(row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		}
	});



} );

$('#add').click(function(){
	$('#titlemodal').removeClass('bg-danger bg-primary').addClass('bg-success').html('<i class="fa fa-plus"></i> Buat Pelanggan Baru');
	$('.loadformModal').load(baseUrl+'alat/einvoice/addPelanggan');
})

$(document).on("click", ".edit", function () {
	$('#default-Modal').modal('show');
	var id = $(this).attr('data-id');
	$('#titlemodal').removeClass('bg-danger bg-primary bg-success').addClass('bg-primary').html('<i class="fa fa-edit"></i> Edit Pelanggan');
	$('.loadformModal').load(baseUrl + 'alat/einvoice/editPelanggan/'+id);
});

