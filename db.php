<?php
date_default_timezone_set("Asia/Jakarta");
error_reporting(-1);
ini_set('display_errors', 1);
//MySQL Connection Database
$conn = mysqli_connect($_SERVER['MYSQLHOST'].':'.$_SERVER['MYSQLPORT'],$_SERVER['MYSQLUSER'],$_SERVER['MYSQLPASSWORD'],$_SERVER['MYSQLDATABASE']) or die(mysqli_error());
$site = "https://url.vhost.my.id";
//Script Rest Api Url Shortener Database
    if ($_GET['key'] === 'fw'){
	$time = time();
        $a = substr(base64_encode($time),0,5);
        $longUrl = @$_POST['longUrl'];
        $shortUrl = $site.'/'.$a;
        if(!empty($longUrl)){
            $sql = "INSERT INTO url (longUrl, shortUrl, code, view) VALUES('".$longUrl."','".$shortUrl."','".$a."','0')";
            $simpan = mysqli_query($conn, $sql);
            if($simpan){
                $arr = array(
                  'longUrl' => $longUrl,
                  'shortUrl' => $shortUrl,
                  'code' => $a,
                  'view' => '0'
                );
              echo json_encode($arr, JSON_UNESCAPED_SLASHED);
            }
        } else {
            
                $arr = array(
                  'error' => 'failed',
                  'longUrl' => $longUrl,
                  'shortUrl' => $shortUrl,
                  'code' => $a,
                  'view' => '0'
                );
              echo json_encode($arr, JSON_UNESCAPED_SLASHED);
        }
}else{
    echo "No auth key";
    }
?>
