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
          <p><a class="btn btn-giant btn-primary" href="charity-donation.html" role="button">JOIN US &rarr;</a></p>
        </div>
      </div>
    </div>
    <div class="item slide-two">
      <div class="container">
        <div class="carousel-caption">
          <h2><?= $secondTitle; ?></h2>
          <p><a class="btn btn-lg btn-primary" href="ministry.html" role="button">Learn more &rarr;</a></p>
        </div>
      </div>
    </div>
    <div class="item slide-three">
      <div class="container">
        <div class="carousel-caption">
          <h2><?= $thirdTitle; ?></h2>
          <p><a class="btn btn-lg btn-primary" href="image-gallery.html" role="button">Browse gallery &rarr;</a></p>
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
    <a class="btn btn-lg btn-primary" href="<?php echo base_url("broadcast/event_single/$currentEventID"); ?>" role="button">Program details →</a> </div>
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
        $audioID = $audio['ID'];
        ?>
    <div class="col-md-4 col-sm-6 has-margin-bottom">
      <img class="img-responsive" src="<?php echo base_url($audio['audios_directory']); ?>" alt="audio image" width="300" height="300">
      <h5><?php echo $audio['title']; ?></h5>
      <p><?php echo $audio['caption']; ?> </p>
      <p><a href="<?php echo base_url("broadcast/sermon/$audioID"); ?>" class="btn btn-primary" role="button">View details →</a></p>
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
            <span class="el-dated"><?php echo formatDay($event['start']) ." ". localTimeRead($event['start']); ?></span>
            <p class="el-cta"><a class="btn btn-primary" href="<?php echo base_url("broadcast/event_single/$eventID") ?>" role="button">Details &rarr;</a></p>
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

<!-- BLOG LIST / LATEST SERMONS -->
<div class="container has-margin-bottom">
  <div class="row">
    <div class="col-md-9 has-margin-bottom">
      <div class="section-title left-align-desktop">
        <h4> LATEST BULLETIN </h4>
      </div>
      
      <!--Blog list-->
      
      <div class="row has-margin-bottom">
        <div class="col-md-4 col-sm-4"> <img class="img-responsive center-block" src="<?php echo base_url('assets/public/'); ?>images/blog-thumb-1.jpg" alt="bulletin blog"> </div>
        <div class="col-md-8 col-sm-8 bulletin">
          <h4 class="media-heading">Perseverance of the Saints </h4>
          <p>on 17th June 2014 by <a href="#" class="link-reverse">Vincent John</a></p>
          <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet...</p>
          <a class="btn btn-primary" href="blog-single.html" role="button">Read Article →</a> </div>
      </div>
      
      <!--Blog list-->
      
      <div class="row">
        <div class="col-md-4 col-sm-4"> <img class="img-responsive center-block" src="<?php echo base_url('assets/public/'); ?>images/blog-thumb-2.jpg" alt="bulletin blog"> </div>
        <div class="col-md-8 col-sm-8 bulletin">
          <h4 class="media-heading">Lord is Sufficient for all of our needs </h4>
          <p>on 17th June 2014 by <a href="#" class="link-reverse">Jose Mathew</a></p>
          <p class="media-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet...</p>
          <a class="btn btn-primary" href="blog-single.html" role="button">Read Article →</a> </div>
      </div>
    </div>
    <!--// col md 9--> 
    
    <!--Latest Sermons-->
    <div class="col-md-3">
      <div class="well">
        <div class="section-title">
          <h4> RECENT SERMONS </h4>
        </div>
        <a href="#"><img src="images/video-thumb.jpg" class="img-responsive center-block" alt="video thumb"></a>
        <div class="list-group"> 
          <a href="sermons.html" class="list-group-item">
            <p class="list-group-item-heading" id="st-topic">Heavens and the earth</p>
            <p class="list-group-item-text st-dated">24:15 mins</p>
          </a> 
          <a href="sermons.html" class="list-group-item">
            <p class="list-group-item-heading" id="st-topic">Prayer and petition</p>
            <p class="list-group-item-text st-dated">12:00 mins</p>
          </a> 
          <a href="sermons.html" class="list-group-item">
            <p class="list-group-item-heading" id="st-topic">Fruit of the Spirit</p>
            <p class="list-group-item-text st-dated">30:25 mins</p>
          </a> 
          <a href="sermons.html" class="list-group-item">
            <p class="list-group-item-heading" id="st-topic">Do not be afraid; keep on...</p>
            <p class="list-group-item-text st-dated">17:00 mins</p>
          </a> 
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
    <?php if(isset($galleries) && $galleries): ?>
      <?php foreach($galleries as $gallery){ ?>
    <div class="col-sm-4 col-md-3">
      <a class="fancybox" href="<?php echo base_url($gallery['gallery_path']); ?>" data-fancybox-group="gallery" title="<?php echo $gallery['title']; ?>">
        <img src="<?php echo base_url($gallery['gallery_path']); ?>" class="img-responsive" width="270" height="270" alt="church image gallery">
      </a> 
    </div>
    <?php }else: ?>
      <div class="alert alert-info">
        <p>There is no Gallery Images at the moment...</p>
      </div>
  <?php endif; ?>
    <div class="col-sm-4 col-md-3"> <a class="fancybox" href="images/gallery/img_gallery_2.jpg" data-fancybox-group="gallery" title="church image gallery"> <img src="images/gallery/thumb/gallery_thumb_2.jpg" class="img-responsive" width="270" height="270" alt="church image gallery"> </a> </div>
    <div class="col-sm-4 col-md-3"> <a class="fancybox" href="images/gallery/img_gallery_3.jpg" data-fancybox-group="gallery" title="church image gallery"> <img src="images/gallery/thumb/gallery_thumb_3.jpg" class="img-responsive" width="270" height="270" alt="church image gallery"> </a> </div>
    <div class="col-sm-4 col-md-3"> <a class="fancybox" href="images/gallery/img_gallery_4.jpg" data-fancybox-group="gallery" title="church image gallery"> <img src="images/gallery/thumb/gallery_thumb_4.jpg" class="img-responsive" width="270" height="270" alt="church image gallery"> </a> </div>
    <div class="col-sm-4 col-md-3"> <a class="fancybox" href="images/gallery/img_gallery_5.jpg" data-fancybox-group="gallery" title="church image gallery"> <img src="images/gallery/thumb/gallery_thumb_5.jpg" class="img-responsive" width="270" height="270" alt="church image gallery"> </a> </div>
    <div class="col-sm-4 col-md-3"> <a class="fancybox" href="images/gallery/img_gallery_6.jpg" data-fancybox-group="gallery" title="church image gallery"> <img src="images/gallery/thumb/gallery_thumb_6.jpg" class="img-responsive" width="270" height="270" alt="church image gallery"> </a> </div>
    <div class="col-sm-4 col-md-3"> <a class="fancybox" href="images/gallery/img_gallery_7.jpg" data-fancybox-group="gallery" title="church image gallery"> <img src="images/gallery/thumb/gallery_thumb_7.jpg" class="img-responsive" width="270" height="270" alt="church image gallery"> </a> </div>
    <div class="col-sm-4 col-md-3"> <a class="fancybox" href="images/gallery/img_gallery_8.jpg" data-fancybox-group="gallery" title="church image gallery"> <img src="images/gallery/thumb/gallery_thumb_8.jpg" class="img-responsive" width="270" height="270" alt="church image gallery"> </a> </div>
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
        <div class="owl-carousel2">
          <div class="item">
            <blockquote class="blockquote-centered"> For God so loved the world that he gave his one and only begotten Son, that who ever believes in him shall not perish but have eternal life. <small>John 3:16 (KJV)</small> 
            </blockquote>
          </div>
          <div class="item">
            <blockquote class="blockquote-centered"> For if, by the trespass of the one man, death reigned through that one man, how much more will those who receive God's abundant provision of grace!
              <small>Romans 5:17 (NIV)</small> 
            </blockquote>
          </div>
          <div class="item">
            <blockquote class="blockquote-centered">For God did not send his Son into the world to condemn the world, but to save the world through him. <small>John 3:17</small> </blockquote>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- // END BIBLE QUOTES -->  

<!-- SUBSCRIBE -->
<div class="highlight-bg">
  <div class="container">
    <div class="row">
      <form action="subscribe.php" method="post" class="form subscribe-form" role="form" id="subscribeForm">
        <div class="form-group col-md-3 hidden-sm">
          <h5 class="susbcribe-head"> SUBSCRIBE <span>TO OUR NEWSLETTER</span></h5>
        </div>
        <div class="form-group col-sm-8 col-md-6">
          <label class="sr-only">Email address</label>
          <input type="email" class="form-control input-lg" placeholder="Enter email" name="email" id="address" data-validate="validate(required, email)" required>
          <span class="help-block" id="result"></span> </div>
        <div class="form-group col-sm-4 col-md-3">
          <button type="submit" class="btn btn-lg btn-primary btn-block">Subscribe Now →</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END SUBSCRIBE --> 

<?php include_once 'template/footer.php'; ?>