<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends CI_Controller  {

	protected $CI;

	public function __construct()
	{	
		$this->CI =& get_instance();
	}
	public function notifSukses($status=null)
	{
		?>
		<div class="alert alert-success alert-solid" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="d-flex align-items-center justify-content-start">
				<i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
				<span><strong>Well done!</strong> <?=$status?></span>
			</div>
		</div>

		<?php
	}

	public function notifGagal($error=null)
	{
		?>
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="d-flex align-items-center justify-content-start">
				<i class="icon ion-ios-close alert-icon tx-32"></i>
				<span><strong>Oh snap!</strong> <?=$error?>.</span>
			</div><!-- d-flex -->
		</div>
		<?php
	}

}