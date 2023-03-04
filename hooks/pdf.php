<?php

	include(dirname(__FILE__) . '/../../../lib.php');
	require(dirname(__FILE__) . 'fpdf/fpdf.php');
	require('fpdf/fpdf.php');


	/* grant access to the groups 'Admins' and 'Editor' */
	$mi = getMemberInfo();
		if(in_array($mi['group'], array('Admins'))){
		$id = max(0, intval($_REQUEST['id']));
		if(!$id){
			header('Location: ' . PREPEND_PATH . 'pqr_view.php');
			exit;
		}

		$results = print_item_query($id);

		$pdf = new PDF_HTML();
		$pdf->AddPage();
		$pdf->SetFont('Times','B',14);
		$pdf->Cell(0,10,'Item: '. $results['id'],1,1);
		$pdf->Cell(0,10,'Description: '. $results['description'],1,1);
		$pdf->Output();
		exit;
	}