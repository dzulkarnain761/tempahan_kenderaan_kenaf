<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  //   die("Connection failed: " . mysqli_connect_error());
  echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}



$tempahan_id = $_GET['tempahan_id'];


// Ensure you escape the ID to prevent SQL injection
$id = mysqli_real_escape_string($conn, $tempahan_id);

$sqlTempahan = "SELECT * FROM `tempahan` WHERE tempahan_id = $tempahan_id";
$resultTempahan = mysqli_query($conn, $sqlTempahan);

// Fetch the Pemandu member's data
if ($resultTempahan && mysqli_num_rows($resultTempahan) > 0) {
  $tempahan = mysqli_fetch_assoc($resultTempahan);
} else {
  // Handle the case where no Pemandu member is found
  echo "Tiada Tempahan Dijumpai";
  exit;
}

// Convert image to base64
$imageData2 = base64_encode(file_get_contents('../../assets/images/logo.jpeg'));

// Prepare base64 image source
$imgSrc2 = 'data:image/jpeg;base64,' . $imageData2;

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <title></title>
  <!--[if !mso]><!-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--<![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <style type="text/css">
    #outlook a {
      padding: 0;
    }

    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      border-collapse: collapse;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    p {
      display: block;
      margin: 13px 0;
    }
  </style>
  <!--[if mso]>
      <noscript>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG />
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
      </noscript>
    <![endif]-->
  <!--[if lte mso 11]>
      <style type="text/css">
        .mj-outlook-group-fix {
          width: 100% !important;
        }
      </style>
    <![endif]-->
  <style type="text/css">
    @media only screen and (min-width: 480px) {
      .mj-column-per-100 {
        width: 100% !important;
        max-width: 100%;
      }
    }
  </style>
  <style media="screen and (min-width:480px)">
    .moz-text-html .mj-column-per-100 {
      width: 100% !important;
      max-width: 100%;
    }
  </style>
  <style type="text/css"></style>
  <style type="text/css">
    .invoice-word {
      font-size: 30px;
    }

    @media only screen and (max-width: 480px) {
      .invoice-word {
        font-size: 24px;
        text-align: right;
      }
    }
  </style>
</head>

<body style="word-spacing: normal">
  <div>
    <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="margin: 0px auto; max-width: 600px">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
        <tbody>
          <tr>
            <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-bottom: 10px; padding-top: 40px; text-align: center">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                  <tbody>
                    <tr>
                      <td align="left" style="font-size: 0px; padding: 10px 25px; padding-bottom: 5px; word-break: break-word">
                        <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color: #000000; font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto; width: 100%; border: none">
                          <tr>
                            <td style="width: 50%">


                              <img align="left" src="<?php echo $imgSrc2 ?>" width="50%" style="max-width: 160px" />
                            </td>
                            <td style="width: 50%">
                              <div class="invoice-word" style="font-family: helvetica; color: #333; font-weight: bold"> SEBUT HARGA </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="margin: 0px auto; max-width: 600px">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
        <tbody>
          <tr>
            <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-bottom: 0; padding-top: 0; text-align: center">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                  <tbody>
                    <tr>
                      <td align="center" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                        <p style="border-top: solid 1px #dddddd; font-size: 1px; margin: 0px auto; width: 100%"></p>
                        <!--[if mso | IE
                            ]><table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top: solid 1px #dddddd; font-size: 1px; margin: 0px auto; width: 550px" role="presentation" width="550px">
                              <tr>
                                <td style="height: 0; line-height: 0">&nbsp;</td>
                              </tr>
                            </table><!
                          [endif]-->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="margin: 0px auto; max-width: 600px">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
        <tbody>
          <tr>
            <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-bottom: 0; padding-top: 0; text-align: center">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                  <tbody>
                    <tr>
                      <td align="left" style="font-size: 0px; padding: 10px 25px; padding-top: 5px; padding-bottom: 5px; word-break: break-word">
                        <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color: #000000; font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto; width: 100%; border: none">
                          <tr>
                            <td>
                              <div style="font-family: helvetica">
                                <span style="color: #333"><strong> Tempahan ID:</strong></span>
                                <span style="color: #555; white-space: nowrap"><?php echo sprintf('%05d', $tempahan['tempahan_id']); ?></span>
                              </div>
                            </td>
                            <td width="50%">
                              <div style="font-family: helvetica">
                                <span style="color: #333"><strong>Tarikh Dikeluarkan:</strong></span>
                                <span style="color: #555; white-space: nowrap"><?php echo date('d/m/Y', strtotime($tempahan['updated_at'])); ?></span>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="margin: 0px auto; max-width: 600px">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
        <tbody>
          <tr>
            <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-bottom: 0; padding-top: 0; text-align: center">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                  <tbody>
                    <tr>
                      <td align="center" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                        <p style="border-top: solid 1px #dddddd; font-size: 1px; margin: 0px auto; width: 100%"></p>
                        <!--[if mso | IE
                            ]><table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top: solid 1px #dddddd; font-size: 1px; margin: 0px auto; width: 550px" role="presentation" width="550px">
                              <tr>
                                <td style="height: 0; line-height: 0">&nbsp;</td>
                              </tr>
                            </table><!
                          [endif]-->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="margin: 0px auto; max-width: 600px">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
        <tbody>
          <tr>
            <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-top: 10px; text-align: center">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                  <tbody>
                    <tr>
                      <td align="left" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                        <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color: #000000; font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto; width: 100%; border: none">
                          <tr>
                            <?php
                            $penyewaID = $tempahan['penyewa_id'];
                            $sqlPenyewa = "SELECT * FROM `penyewa` WHERE id = $penyewaID";
                            $resultPenyewa = mysqli_query($conn, $sqlPenyewa);

                            // Fetch the Pemandu member's data
                            if ($resultPenyewa && mysqli_num_rows($resultPenyewa) > 0) {
                              $penyewa = mysqli_fetch_assoc($resultPenyewa);
                            } else {
                              // Handle the case where no Pemandu member is found
                              echo "Tiada Penyewa Dijumpai";
                              exit;
                            }
                            ?>
                            <td style="vertical-align: top">
                              <div class="company-info-header" style="color: #333; font-family: helvetica"><strong>Bil Kepada:</strong></div>

                              <div class="company-info" style="color: #555; font-family: helvetica"><?php echo $penyewa['nama'] ?></div>
                              <div class="company-info" style="color: #555; font-family: helvetica"><?php echo $penyewa['alamat'] ?></div>
                              <div class="company-info" style="color: #555; font-family: helvetica"><?php echo $penyewa['contact_no'] ?></div>

                            </td>

                            <td width="50%" v-align="top" style="vertical-align: top">
                              <div class="company-info-header" style="color: #333; font-family: helvetica"><strong>Bil Daripada:</strong></div>

                              <div class="company-info" style="color: #555; font-family: helvetica">Lembaga Kenaf dan Tembakau Negara</div>
                              <div class="company-info" style="color: #555; font-family: helvetica">Kubang Kerian,</div>
                              <div class="company-info" style="color: #555; font-family: helvetica">16150 Kota Bharu,</div>
                              <div class="company-info" style="color: #555; font-family: helvetica">Kelantan Darul Naim.</div>
                              <div class="company-info" style="color: #555; font-family: helvetica">admin@lktn.gov.my</div>
                              <div class="company-info" style="color: #555; font-family: helvetica">+609-766 8000
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td align="left" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                        <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color: #000000; font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto; width: 100%; border: none">
                          <tr>
                            <td style="vertical-align: top">
                              <div class="company-info-header" style="color: #333; font-family: helvetica"><strong>Maklumat Tempahan :</strong></div>
                              <div class="company-info" style="color: #555; font-family: helvetica">Lokasi : <?php echo $tempahan['lokasi_kerja'] ?></div>
                              <div class="company-info" style="color: #555; font-family: helvetica">Keluasan : <?php echo $tempahan['luas_tanah'] ?> Hektar</div>
                              <div class="company-info" style="color: #555; font-family: helvetica">Tarikh Kerja : <?php echo date('d/m/Y', strtotime($tempahan['tarikh_kerja'])); ?></div>

                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="margin: 0px auto; max-width: 600px">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
        <tbody>
          <tr>
            <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-top: 5px; text-align: center">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                  <tbody>
                    <tr>
                      <td align="left" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                        <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color: #000000; font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto; width: 100%; border: none">
                          <tr>
                            <td style="max-width: 50%; width: 50%; border-bottom: 1px solid #777; padding: 0 0 10px 0; color: #333; font-family: helvetica"><strong>SERVIS</strong></td>
                            <td style="border-bottom: 1px solid #777; padding: 0 0 10px 0; color: #333; font-family: helvetica; white-space: nowrap" align="right"><strong>JAM</strong></td>
                            <td style="border-bottom: 1px solid #777; padding: 0 0 10px 0; color: #333; font-family: helvetica; white-space: nowrap" align="right"><strong>MINIT</strong></td>
                            <td style="border-bottom: 1px solid #777; padding: 0 0 10px 0; color: #333; font-family: helvetica; white-space: nowrap" align="right"><strong>HARGA</strong></td>
                          </tr>
                          <?php
                          // SQL query to select all tasks for the booking
                          $sqlKerja = "SELECT * FROM `tempahan_kerja` 
                                      WHERE tempahan_id = $tempahan_id ";
                          $resultKerja = mysqli_query($conn, $sqlKerja);

                          // Loop through the result set
                          while ($rowKerja = mysqli_fetch_assoc($resultKerja)) {
                          ?>
                            <tr>
                              <td class="td-line-item" style="color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd"><?php echo $rowKerja['nama_kerja'] ?></td>
                              <td class="td-line-item nowrap" align="right" style="color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap"><?php echo $rowKerja['total_jam'] ?></td>
                              <td class="td-line-item nowrap" align="right" style="color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap"><?php echo $rowKerja['total_minit'] ?></td>
                              <td class="td-line-item nowrap" align="right" style="color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap">RM <?php echo $rowKerja['total_harga'] ?></td>
                            </tr>
                          <?php

                          }
                          ?>

                          <tr>
                            <td><strong>Total Harga</strong></td>
                            <td></td>
                            <td></td>
                            <td style="border-top: 1px solid #555; color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap" align="right">RM <?php echo number_format($tempahan['total_harga_sebenar'], 2) ?></td>
                          </tr>
                          <tr>
                            <td><strong>Sudah Dibayar</strong></td>
                            <td></td>
                            <td></td>
                            <td style="border-top: 1px solid #555; color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap" align="right">- RM <?php echo number_format($tempahan['total_harga_anggaran'], 2) ?></td>
                          </tr>
                          <tr>
                            <td><strong>Bayaran Tambahan</strong></td>
                            <td></td>
                            <td></td>
                            <td style="border-top: 1px solid #555; color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap" align="right">RM <?php echo number_format($tempahan['total_baki'], 2) ?></td>
                          </tr>


                        </table>

                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    
    <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="margin: 0px auto; max-width: 600px">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
        <tbody>
          <tr>
            <td style="direction: ltr; font-size: 0px; padding: 20px 0; text-align: center">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                  <tbody>
                    <tr>
                      <td align="left" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                        <div style="font-family: helvetica; font-size: 13px; line-height: 1; text-align: left; color: #000000">

                          <span style="color: #333"><strong>Tarikh Tamat Tempoh : </strong></span>
                          <span style="color: #555; white-space: nowrap">
                            <?php echo date('d/m/Y', strtotime($tempahan['updated_at'] . ' +7 days')); ?>
                          </span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td align="left" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                        <div style="font-family: helvetica; font-size: 13px; line-height: 1; text-align: left; color: #555555"></div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><![endif]-->
  </div>
</body>

</html>