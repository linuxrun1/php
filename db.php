<?php
date_default_timezone_set("Asia/Jakarta");

//MySQL Connection Database
$conn = mysqli_connect($_SERVER['MYSQLHOST'].':'.$_SERVER['MYSQLPORT'],$_SERVER['MYSQLUSER'],$_SERVER['MYSQLPASSWORD'],$_SERVER['MYSQLDATABASE']) or die(mysqli_error());

//Script Rest Api Url Shortener Database
function add($conn, $longUrl, $alias){
   
    if ($_POST['key'] === 'fw'){
        $datestring = '%d %m %Y - %h:%i %a %s';
		    $time = time();
		    $date = mdate($datestring, $time);
        $cc = time();
        $l = (!empty($_POST['al'])) ? $_POST['al'] : "5";
        $a = ($alias) ? $alias : substr(base64_encode($cc),0,$l);
        $code = $a;
        $longUrl = $longUrl;
        $shortUrl = $site.'/'.$a;
        $view = "0";
        
        if(!empty($longUrl)){
            $sql = "INSERT INTO url (longUrl, shortUrl, date, code, view) VALUES('".$longUrl."','".$shortUrl."','".$date."','".$code."','".$view."')";
            $simpan = mysqli_query($conn, $sql);
            if($simpan){
                $arr = array(
                  'longUrl' => $longUrl,
                  'shortUrl' => $shortUrl,
                  'date' => $date,
                  'code' => $code,
                  'view' => $view
                );
              return json_encode($arr);
            }
        } else {
            
                $arr = array(
                  'error' => 'failed',
                  'longUrl' => $longUrl,
                  'shortUrl' => $shortUrl,
                  'date' => $date,
                  'code' => $code,
                  'view' => $view
                );
              return json_encode($arr);
        }
}
echo add($conn, $_POST['longUrl']);
?>
