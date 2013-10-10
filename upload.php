<?php
session_start();	

function bytesToSize1024($bytes, $precision = 2) {
    $unit = array('B','KB','MB');
    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
}



$sFileName = $_FILES['file']['name'];
$sFileType = $_FILES['file']['type'];
$sFileSize = bytesToSize1024($_FILES['file']['size'], 1);

move_uploaded_file($_FILES['file']['tmp_name'],"./user_content/".$_SESSION['user_name']."/".$_FILES['file']['name']);


echo <<<EOF
<p>Your file: {$sFileName} has been successfully received.</p>
<p>Type: {$sFileType}</p>
<p>Size: {$sFileSize}</p>$
./user_content/{$_SESSION['user_name']}/{$_FILES['file']['name']}
EOF;




?>
