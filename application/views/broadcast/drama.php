<?php include_once 'template/header.php'; ?>

<!--SUBPAGE HEAD-->

<div class="subpage-head has-margin-bottom">
  <div class="container">
    <h3>Video Gallery</h3>
    <p class="lead">A collection of our church related drama videos</p>
  </div>
</div>

<!-- // END SUBPAGE HEAD --> 

<!--OUR GALLERY-->
<div class="container has-margin-bottom">
  <?php if(isset($videos)): 
     // $track = bin2hex(random_bytes(11)); // this is just a dummy track
    ?>
  <div class="row">
    <?php foreach($videos as $video): ?>
    <div class="col-sm-6 has-margin-xs-bottom">
      <div class="embed-responsive embed-responsive-4by3">
        <video controls class="embed-responsive-item" src="<?php echo (base_url($video['videos_path'])); ?>">Sorry, your browser doesn't support <code>embedded videos.</code></video>
      </div>
      <h4><?php echo $video['title']; ?></h4>
      <p><?php echo $video['caption']; ?> </p>
    </div>
    <?php endforeach; ?>
  </div>
  <?php else: ?>
    <div class="alert alert-danger">
      <p>No drama video posted yet...</p>
    </div>
  <?php endif; ?>
</div>
<!--// END OUR GALLERY --> 

<?php include_once 'template/footer.php'; ?>