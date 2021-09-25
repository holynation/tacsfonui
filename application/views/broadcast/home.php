<?php include_once 'template/header.php'; ?>

<!-- BANNER SLIDER
    ================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel"> 
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="item slide-one active">
      <div class="container">
        <div class="carousel-caption">
          <h3><?= $firstTitle; ?></h3>
          <!-- <p><a class="btn btn-giant btn-primary" href="charity-donation.html" role="button">JOIN US &rarr;</a></p> -->
        </div>
      </div>
    </div>
    <div class="item slide-two">
      <div class="container">
        <div class="carousel-caption">
          <h2><?= $secondTitle; ?></h2>
          <!-- <p><a class="btn btn-lg btn-primary" href="ministry.html" role="button">Learn more &rarr;</a></p> -->
        </div>
      </div>
    </div>
    <div class="item slide-three">
      <div class="container">
        <div class="carousel-caption">
          <h2><?= $thirdTitle; ?></h2>
          <!-- <p><a class="btn btn-lg btn-primary" href="image-gallery.html" role="button">Browse gallery &rarr;</a></p> -->
        </div>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> </div>
<!-- // Banner Slider --> 


<!--UPCOMING EVENT-->
<div class="highlight-bg has-margin-bottom">
  <div class="container event-cta">
    <?php if(isset($currentEvents)): ?>
      <?php $currentEvent = $currentEvents[0];$currentEventID = $currentEvent['ID']; ?>
    <div class="ec-txt"> <span>UPCOMING EVENT</span>
      <p><?php echo $currentEvent['title']; ?></p>
    </div>
    <a class="btn btn-lg btn-primary" href="javascript:void(0);" role="button">Anticipate</a>
    <!-- <a class="btn btn-lg btn-primary" href="<?php //echo base_url("broadcast/event_single/$currentEventID"); ?>" role="button">Program details →</a> -->
  </div>
    <?php else: ?>
      <div class="ec-txt"> <span>UPCOMING EVENT</span>
        <p>There is no current event at the moment...</p>
      </div>
  <?php endif; ?>
</div>

<!-- // UPCOMING EVENT --> 
<!--FEATURED BLOCK-->
<div class="container">
  <div class="row feature-block">
    <?php if(isset($audios)): ?>
      <?php foreach($audios as $audio){ 
        $audioName = urlencode($audio['title']);
        $audioImage = ($audio['audios_directory'] != '') ? $audio['audios_directory'] : "uploads/audios/default_music.jpeg";
        ?>
    <div class="col-md-4 col-sm-6 has-margin-bottom">
      <img class="img-responsive" src="<?php echo base_url($audioImage); ?>" alt="audio image" width="300" height="300">
      <h5><?php echo $audio['title']; ?></h5>
      <p><?php echo $audio['caption']; ?> </p>
      <p><a href="<?php echo base_url("audio/$audioName"); ?>" class="btn btn-primary" role="button">View details →</a></p>
    </div>
    <!-- /.col-md-4 -->
  <?php } endif; ?>
  </div>
</div>
<!-- // END FEATURED BLOCK--> 

<!--EVENT LISTS-->
<div class="highlight-bg has-margin-bottom">
  <div class="container event-list">
    <div class="section-title">
      <h4> PROGRAMS &amp; EVENTS </h4>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel">
          <?php if(isset($events) && $events): ?>
            <?php foreach($events as $event){ 
                $eventID = $event['ID'];
              ?>
          <div class="el-block item">
            <h4> <?php echo formatMonthDay($event['start']); ?> </h4>
            <p class="el-head"><?php echo $event['title']; ?></p>
            <img src="<?php echo base_url($event['events_path']); ?>" class="img-fluid img-responsive" style="width:30rem;height:20rem;margin-bottom:10px;margin:0 auto;" />
            <span class="el-dated"><?php echo formatDay($event['start']) ." ". localTimeRead($event['start']); ?></span>
            <!-- <p class="el-cta"><a class="btn btn-primary" href="<?php //echo base_url("broadcast/event_single/$eventID") ?>" role="button">Details &rarr;</a></p> -->
          </div>
          <?php }else: ?>
            <div class="alert alert-info">
              <p>There is no any event yet scheduled...</p>
            </div>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- // END EVENT LISTS --> 
<?php
    // print_r($articles);exit;
?>

<!-- BLOG LIST / LATEST SERMONS -->
<div class="container has-margin-bottom">
  <div class="row">
    <div class="col-md-9 has-margin-bottom">
      <div class="section-title left-align-desktop">
        <h4> LATEST BULLETIN </h4>
      </div>
      
      <!--Blog list-->
      <?php foreach($articles as $article): ?>
      <div class="row has-margin-bottom">
        <div class="col-md-4 col-sm-4"> <img class="img-responsive center-block" src="<?php echo base_url(); ?>assets/article_default.jpg" alt="bulletin blog">
        </div>
        <div class="col-md-8 col-sm-8 bulletin">
          <h4 class="media-heading"><?php echo $article['title']; ?></h4>
          <p>on <?php echo dateFormatter($article['date_created']); ?> by <a href="#" class="link-reverse">admin</a></p>
          <a class="btn btn-primary" href="<?php echo base_url($article['article_path']); ?>" role="button">Download</a>
        </div>
      </div>
      <!--Blog list-->
      <?php endforeach; ?>
    </div>
    <!--// col md 9--> 

    <!--Latest Sermons-->
    <div class="col-md-3">
      <div class="well has-margin-bottom">
        <div class="section-title">
          <h4> RECENT Audio </h4>
        </div>
        <div class="list-group">
        <?php foreach($extraAudios as $exaudio): 
          $audioName = urlencode($exaudio['title']);
          ?>
          <a href="<?php echo base_url("audio/$audioName"); ?>" class="list-group-item">
            <p class="list-group-item-heading" style="color:#fff;"><?php echo $exaudio['title']; ?></p>
            <!-- <p class="list-group-item-text">24:15 mins</p> -->
          </a>
        <?php endforeach; ?>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- END BLOG LIST / LATEST SERMONS --> 

<!--OUR GALLERY-->
<div class="container has-margin-bottom">
  <div class="section-title">
    <h4> OUR GALLERY </h4>
  </div>
  <div class="img-gallery row">
    <?php 
      // print_r($galleries);exit;
    foreach($galleries as $gallery): ?>
    <div class="col-sm-4 col-md-3"> <a class="fancybox" href="<?php echo base_url($gallery['gallery_path']); ?>" data-fancybox-group="gallery" title="<?php echo $gallery['title']; ?>"> <img src="<?php echo base_url($gallery['gallery_path']); ?>" class="img-responsive" width="270" height="270" alt="<?php echo $gallery['title']; ?>"> </a>
    </div>
  <?php endforeach; ?>
  </div>
</div>
<!--// END OUR GALLERY --> 

<!-- BIBLE QUOTES -->
<div class="highlight-bg has-margin-bottom">
  <div class="container event-list">
    <div class="section-title">
      <h4> BIBLE VERSES </h4>
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="item">
            <blockquote class="blockquote-centered" id="dailyVersesWrapper"></blockquote>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- // END BIBLE QUOTES -->

<?php include_once 'template/footer.php'; ?>
<script>
   $(document).ready(function(){
      $.ajax({
         url:'https://dailyverses.net/get/verse?language=niv&isdirect=1&url=' + window.location.hostname,
         dataType: 'JSONP',
         success:function(json){
            $("#dailyVersesWrapper").prepend(json.html);
         }
      });
   });
</script>