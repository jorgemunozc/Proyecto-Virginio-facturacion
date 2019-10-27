<?php 
require_once dirname(__file__)."/TCPDF/tcpdf.php";
	class PDF_report extends TCPDF
	{
		public function __construct()
		{
			parent::__construct();
		}
	}
?>