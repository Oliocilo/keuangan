$("#formajax").submit(function(){
    var mydata = new FormData(this);
    var notif;
    $.ajax({
      type: "POST",
      url: mydata.get("rtc_url"),
      data: mydata,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend : function(){
        notif = new PNotify({
            title: 'Success notice',
            text: '<p id="notifText"></p>\
            <div class="progress progress-striped active" style="margin:0">\
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0">\
            <span class="sr-only">0%</span>\
            </div>\
            </div>',
            icon: 'icofont icofont-info-circle',
            type: 'success'
        });

      },
      success: function(response, textStatus, xhr) {
        var str = JSON.parse(response);
        if (str.status == 'success'){
            var cur_value = 1,
            progress;
            $("#notifText").html(str.text)
            progress = $("div.progress-bar");
            progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find("span").html(cur_value + "%");

            // Pretend to do something.
            var timer = setInterval(function() {
                if (cur_value >= 100) {

                    // Remove the interval.
                    window.clearInterval(timer);
                    notif.remove();
                    return;
                }
                cur_value += 1;
                progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find("span").html(cur_value + "%");
            }, xhr.readystate);

            if(str.modalclose != 0){
                $("#default-Modal").modal("toggle");
            }

            if(str.reload == 1){
                setTimeout(function(){ 
                    location.reload();
                }, 2000);
            }
        }else{
            notif.update({
                title: 'Oh No!',
                text: str.text,
                type: str.status
            });
       }
     },
     error: function(xhr, textStatus, errorThrown) {

     }
    });
    return false;
  });