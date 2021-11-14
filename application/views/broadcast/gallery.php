<?php include_once 'template/header.php'; ?>

<!--SUBPAGE HEAD-->

<div class="subpage-head has-margin-bottom">
  <div class="container">
    <h3>Gallery</h3>
    <p class="lead">Curated images of our church programs and events</p>
  </div>
</div>

<!-- // END SUBPAGE HEAD --> 

<!--OUR GALLERY-->
<div class="container has-margin-bottom">
  <?php if(isset($galleries)): 
     $track = bin2hex(random_bytes(11)); // this is just a dummy track
    ?>
  <div class="img-gallery row">
    <?php foreach($galleries as $gallery): ?>
    <div class="col-sm-4 col-md-3">
      <a class="fancybox" href="<?php echo base_url($gallery['gallery_path']); ?>?track=<?php echo $track; ?>" data-fancybox-group="gallery" title="<?php echo base_url($gallery['title']); ?>"> <img src="<?php echo base_url($gallery['gallery_path']); ?>" class="img-responsive" width="270" height="270" alt="<?php echo base_url($gallery['title']); ?>">
      </a>
    </div>
  <?php endforeach; ?>
  </div>
  <?php else: ?>
    <div class="alert alert-danger">
      <p>No gallery image posted yet...</p>
    </div>
  <?php endif; ?>
</div>
<!--// END OUR GALLERY --> 

<?php include_once 'template/footer.php'; ?>