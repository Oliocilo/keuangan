$(document).ready(function() {

    if($('#tipenya').val() === "Custom"){
        $('.hideCustom').show();
        $('.hideBulanan').hide();
        $('.showTahunan').hide();
    } else { 
        $('.hideCustom').hide();

        if($('#tipenya').val() === "Harian"){
            $('.hideBulanan').hide();
            $('.showTahunan').hide();
        } else if($('#tipenya').val() == "Tahunan"){
            $('.hideBulanan').hide();
            $('.showTahunan').show();
        } else if($('#tipenya').val() === "Bulanan") $('.hideBulanan').show();
    }

    $('.chartDataPie').each(function(){
        var attr = $(this).val().split(",");
        var data4={labels:["Pemasukan","Pengeluaran"],datasets:[{data:[attr[1],attr[2]],backgroundColor:["#0ac282","#fe5d70"]}]};
      
        var ctx = document.getElementById(attr[0]).getContext("2d");
        window.myDoughnut = new Chart(ctx, {
            type: "pie",
            data: data4,
            options: { maintainAspectRatio: false, responsive: true, legend: { position: "bottom", labels: { usePointStyle: true  } }, title: { display: true, text: "Grafik Pemasukan vs Pengeluaran" }, animation: { animateScale: true, animateRotate: true } },
        });
    });

    $('.chartDataBar').each(function(){
        var attr = $(this).val().split(",");
        $.ajax({
          type: "POST",
          url: baseUrl+'laporan/chartRekapTransfer?buku='+$('#getBuku').val()+'&tanggal_awal='+$('#tanggalAwal').val()+'&tanggal_akhir='+$('#tanggalAkhir').val(),
          dataType:'JSON',
          success: function(response, textStatus, xhr) {
            console.log(response);
            var data1=response;
            var ctx = document.getElementById(attr[0]).getContext("2d");
            window.myDoughnut = new Chart(ctx, {
                type: "bar",
                data: data1,
                options: { maintainAspectRatio: false, responsive: true, legend: { position: "bottom", labels: { usePointStyle: true  } }, title: { display: true, text: "" }, animation: { animateScale: true, animateRotate: true } },
            });
        },
        error: function(xhr, textStatus, errorThrown) {

        }
    });
    });



    $('.chartData').each(function(){
        var chartContainer = $(this).val();
        var tipe = $(this).attr('data-tipe');
        $.ajax({
          type: "POST",
          url: baseUrl+'laporan/chartData/'+tipe+"/"+$('#tanggalAwal').val()+"/"+$('#tanggalAkhir').val()+"/"+$('#getBuku').val(),
          dataType:'JSON',
          success: function(response, textStatus, xhr) {
            var ctx = document.getElementById(chartContainer).getContext("2d");
            window.myDoughnut = new Chart(ctx, {
                type: "doughnut",
                data: { datasets: [{ data: response.val, backgroundColor: response.color, label: "Dataset 1" }], labels: response.label },
                options: { maintainAspectRatio: false, responsive: true, legend: false, title: { display: true, text: tipe }, animation: { animateScale: true, animateRotate: true } },
            });


            var legendContainer = document.getElementById('legend'+tipe);
            var legendHTML = '<b>'+tipe+'</b> : ';

            for (var i = 0; i < response.label.length; i++) {
                legendHTML += '<li style="display: inline-block; margin-right: 10px;">';
                legendHTML += '<span class="legend-color" style="background-color:' + response.color[i] + '; width: 20px; height: 10px; display: inline-block; margin-right: 5px;"></span>';
                legendHTML += '<span class="legend-text" style="display: inline-block;">' + response.label[i] + '</span>';
                legendHTML += '</li>';
            }

            legendContainer.innerHTML = legendHTML;
          },
          error: function(xhr, textStatus, errorThrown) {

          }
      });
        
    });
    
} );

function gantiTipe(tipe = ""){
    let d = new Date();
    let hariPerBulan = new Date(d.getFullYear(), d.getMonth(), 0).getDate();
    if(tipe === "Custom"){
        $('.hideBulanan').hide();
        $('.showTahunan').hide();
        $('.hideCustom').show();
    }
    else $('.hideCustom').hide();

    if(tipe === "Harian"){
        $('#tanggalAwal').val(d.getDate()+"-"+(d.getMonth()+1)+"-"+d.getFullYear());
        $('#tanggalAkhir').val((d.getDate()+1)+"-"+(d.getMonth()+1)+"-"+d.getFullYear());
        $('.hideBulanan').hide();
        $('.showTahunan').hide();
    }else if(tipe === "Bulanan"){
        $('#tanggalAwal').val("01-"+$('#filterBulan').val()+"-"+$('#filterTahun').val());
        $('#tanggalAkhir').val(hariPerBulan+"-"+$('#filterBulan').val()+"-"+$('#filterTahun').val());
        $('.hideBulanan').show();
    }else if(tipe == "Tahunan"){
        $('#tanggalAwal').val("01-01-"+$('#filterTahun').val());
        $('#tanggalAkhir').val("01-01-"+(parseInt($('#filterTahun').val())+1));
        $('.hideBulanan').hide();
        $('.showTahunan').show();
    }
}

function renderExcel(){
    location.href = baseUrl+'render/exportLaporanKasExcel/'+$('#tanggalAwal').val()+'/'+$('#tanggalAkhir').val()+'/'+$('#getBuku').val();
}

function renderPdf(){
    var url = baseUrl + 'render/exportLaporanKasPDF/'+$('#tanggalAwal').val()+'/'+$('#tanggalAkhir').val()+'/'+$('#getBuku').val();
    window.open(url, '_blank');
}

function renderNeracaExcel(){
    location.href = baseUrl+'render/exportLaporanNeracaExcel/'+$('#filterBulan').val()+'/'+$('#filterTahun').val();

}

function renderNeracaPdf(){
    var url = baseUrl + 'render/exportLaporanNeracaPDF/'+$('#filterBulan').val()+'/'+$('#filterTahun').val();
    window.open(url, '_blank');
}

function renderLRExcel(){
    location.href = baseUrl+'render/exportLaporanLRExcel/'+$('#filterBulan').val()+'/'+$('#filterTahun').val();

}

function renderLRPdf(){
    var url = baseUrl + 'render/exportLaporanLRPDF/'+$('#filterBulan').val()+'/'+$('#filterTahun').val();
    window.open(url, '_blank');
}





