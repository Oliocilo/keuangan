$(document).ready(function() {

 $('#forgotPassword').click(function(){
     $('#default-Modal').modal('show');
     $('#titlemodal').removeClass('bg-danger').addClass('bg-secondary').html('<i class="fa fa-book"></i> Forgot Password');
     $('.loadformModal').load(baseUrl+'login/reset');
 })

} );