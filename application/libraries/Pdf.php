<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__.'/../third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Pdf extends Dompdf  {

	protected $CI;

	public function __construct()
	{	
		$this->CI =& get_instance();
	}

	public function toPdf($file,$html)
	{

		$filename = $file;
	    $dompdf = new DOMPDF();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->set_option('isRemoteEnabled', TRUE);
		
		$dompdf->render();
		 $dompdf->stream($filename, array("Attachment" => false));
	}

	

	public function toPdfPotrait($file,$html)
	{

		$filename = $file;
	    $dompdf = new DOMPDF();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->set_option('isRemoteEnabled', TRUE);
		
		$dompdf->render();
		 $dompdf->stream($filename, array("Attachment" => false));
	}

}