 <?php



    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'includes/qr/temp' . DIRECTORY_SEPARATOR;

    //html PNG location prefix
    $PNG_WEB_DIR = 'includes/qr/temp/';

    include "includes/qr/qrlib.php";

    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);




    $filename = $PNG_TEMP_DIR . 'test.png';

    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';



    $matrixPointSize = 10;


    //if (isset($_REQUEST['data'])) {





    // user data
    $filename = $PNG_TEMP_DIR . 'test' . md5($_POST['link'] . '|' . 'H' . '|' . 10) . '.png';
    QRcode::png($_POST['link'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);

    echo '<center><img style="" src="' . $PNG_WEB_DIR . basename($filename) . '" /></center>';


    ?>