$(document).ready(function() {
});

    function addForm(){
        $('#titlemodal').css('color', '#000');
        $('#default-Modal').modal('show');
        $('#titlemodal').html('<i class="fa fa-book"></i> Tambah Catatan');
        $('.loadformModal').load('alat/catatan/add/');
    }

    function editForm(id, bgColor, color){
        $('#default-Modal').modal('show');
        $('#titlemodal').css('background-color',bgColor).css('color',color).html('<i class="fa fa-book"></i> Ubah Catatan');
        $('.loadformModal').load('alat/catatan/edit/'+id);
    }

    function gantiWarna(tipe, warna){
        if(tipe == 'Latar'){
            $('#titlemodal').css('background-color', warna);
            $('#parentCatatan').css('background-color', warna);
            $('.j-footer').css('background-color', warna);
        } else {
            $('#titlemodal').css('color', warna);
            $('.inputCatatan').css('color', warna);
        }
    }