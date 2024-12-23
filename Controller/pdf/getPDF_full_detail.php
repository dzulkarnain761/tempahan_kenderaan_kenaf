<?php
	require '../../dompdf/autoload.inc.php';

	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	use Dompdf\Options;

	// Setup the Dompdf options
	$options = new Options();
	$options->set('isRemoteEnabled', TRUE);

	// instantiate the dompdf class with options
	$dompdf = new Dompdf($options);

	ob_start();
	require('../../PDF/detailPDF_fullDetail.php');
	$html = ob_get_clean();
	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream('Borang Butiran', ['Attachment'=>0]);
?>