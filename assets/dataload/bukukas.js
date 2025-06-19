$(document).ready(function() {
	$('.chartData').each(function(){
		var attr = $(this).val().split(",");
		var ctx = document.getElementById(attr[0]).getContext("2d");
		window.myDoughnut = new Chart(ctx, {
			type: "doughnut",
			data: { datasets: [{ data: [attr[1], attr[2]], backgroundColor: ["#0ac282", "#eb3422"], label: "Dataset 1" }], labels: ["Pemasukan", "Pengeluaran"] },
			options: { maintainAspectRatio: false, responsive: true, legend: { position: "bottom", labels: { usePointStyle: true  } }, title: { display: true, text: "" }, animation: { animateScale: true, animateRotate: true } },
		});
	});


	$('#addBukuKas').click(function(){
         $('#titlemodal').removeClass('bg-danger').addClass('bg-primary').html('<i class="fa fa-book"></i> Buat Buku Kas');
        $('.loadformModal').load(baseUrl+'master/bukukas/add/1');
    })


} );

function editForm(id){
	$('#titlemodal').removeClass('bg-danger').addClass('bg-primary').html('<i class="fa fa-book"></i> Ubah Buku Kas');
	   $('.loadformModal').load(baseUrl+'master/bukukas/edit/'+id);
}