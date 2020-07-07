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
    $firstTitle = $slider[$i]['title'];
  }else if($i == 1){
  	$second = $slider[$i]['slider_path'];
  	$secondTitle = $slider[$i]['title'];
  }else if($i == 2){
  	$third = $slider[$i]['slider_path'];
  	$thirdTitle = $slider[$i]['title'];
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
</style>