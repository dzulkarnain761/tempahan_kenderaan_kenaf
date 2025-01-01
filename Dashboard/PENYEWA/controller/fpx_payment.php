<?php

require_once '../../../Models/Database.php';
require_once '../../../Models/Tempahan.php';
require_once '../../../Models/Quotation.php';
require_once '../../../Models/Admin.php';

$conn = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $quotation_id = filter_input(INPUT_POST, 'quotation_id', FILTER_VALIDATE_INT);

    if (!$quotation_id) {
        echo json_encode(['success' => false, 'message' => 'Invalid quotation ID provided.']);
        exit();
    }

    $quotation = new Quotation();
    $quotations = $quotation->getDetail($quotation_id);

    if (!$quotations) {
        echo json_encode(['success' => false, 'message' => 'Quotation not found.']);
        exit();
    }

    $total_bayaran = htmlspecialchars($quotations['total']);
    $reference_number = htmlspecialchars($quotations['reference_number']);
    $jenis_pembayaran = htmlspecialchars($quotations['jenis_pembayaran']);
    $tempahan_id = htmlspecialchars($quotations['tempahan_id']);

    // Construct the form as hidden inputs
    echo '
    <!DOCTYPE html>
    <html>
    <head><title>Redirecting to Payment</title></head>
    <body>
        <form id="paymentForm" action="https://e-payment.lktn.gov.my/v4/req2pay_tempahan.php" method="post">
            <input type="hidden" name="req_appid" value="LKTN">
            <input type="hidden" name="req_amount" value="' . $total_bayaran . '">
            <input type="hidden" name="req_orderid" value="' . $reference_number . '">
            <input type="hidden" name="req_email" value="">
            <input type="hidden" name="req_rtnurl" value="https://apps.lktn.gov.my/ejentera/Dashboard/PENYEWA/complete_payment_fpx_page.php">
            <input type="hidden" name="hash_key" value="">
        </form>
        <script>
            document.getElementById("paymentForm").submit();
        </script>
    </body>
    </html>
';

    exit();
}

?>
