<?php 
/*** set the content type header ***/
/*** Without this header, it wont work ***/
// header("Content-type: text/css");
$first="";
$second="";
$third="";
$firstTitle="";
$secondTitle="";
$thirdTitle="";
$slider = getSliders();
for($i=0; $i < count($slider); $i++){
  if($i == 0){
    $first = $slider[$i]['slider_path'];
    $firstTitle = "";
  }else if($i == 1){
  	$second = $slider[$i]['slider_path'];
  	$secondTitle = "";
  }else if($i == 2){
  	$third = $slider[$i]['slider_path'];
  	$thirdTitle = "";
  }
}
?>
<style>
.slide-one {
	background:url(<?= $first ?>) no-repeat;
	background-size:cover;
}
.slide-two {
	background:url(<?= $second ?>) no-repeat;
	background-size:cover;
}
.slide-three {
	background:url(<?= $third ?>) no-repeat;
	background-size:cover;
}
@media only screen and (max-width:767px) {
.slide-one {
  background:url(<?= $first ?>) no-repeat;
   vertical-align: middle;
    background-size: 100%;
    background-position: 50% 50%;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
.slide-two {
  background:url(<?= $second ?>) no-repeat;
   vertical-align: middle;
    background-size: 100%;
    background-position: 50% 50%;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
.slide-three {
  background:url(<?= $third ?>) no-repeat;
   vertical-align: middle;
    background-size: 100%;
    background-position: 50% 50%;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
}
</style>