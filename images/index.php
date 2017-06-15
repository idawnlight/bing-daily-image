<?php
$api=file_get_contents("http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1");
$data=json_decode($api);
$data=(array)$data;
$pic=$data["images"];
$pic=(array)$pic[0];
$picsd=$pic[startdate];
$filename="./".date("Y-m-d").".jpg";
$jsonname="./".date("Y-m-d").".json";
if (file_get_contents("date.txt")==$picsd) {
    header("Location:$filename");
} else {
    $picurl="http://cn.bing.com".$pic[url];
    $picc=file_get_contents($picurl);
    file_put_contents("../date.txt",$picsd);
    file_put_contents($filename,$picc);
    file_put_contents("./latest.jpg",$picc);
    file_put_contents($jsonname,$api);
    header("Location:$filename");
}
