<?php include_once 'template/header.php'; ?>

<!--SUBPAGE HEAD-->
<?php if($param == 'many'): ?>
<div class="subpage-head has-margin-bottom">
  <div class="container">
    <h3>Audio</h3>
    <p class="lead"> God is faithful; he will not let you be tempted beyond what you can bear. </p>
  </div>
</div>
<!-- // END SUBPAGE HEAD -->

<!-- RELATED MINISTRIES -->
<div class="container">
	<div class="section-title">
	    <h4> Listen and be bless </h4>
	</div>
	<div class="row feature-block">
	<?php foreach($audios as $audio):  
			$audioID = $audio['ID'];
			$audioImage = ($audio['audios_directory'] != '') ? $audio['audios_directory'] : "uploads/audios/default_audio.jpeg";
		?>
	    <div class="col-md-4 col-sm-6 has-margin-bottom"> <img class="img-responsive" src="<?php echo base_url($audioImage); ?>" alt="audio image">
	      <h5><?php echo $audio['title']; ?></h5>
	      <p><?php echo $audio['caption']; ?> </p>
	      <p><a href="<?php echo base_url("broadcast/audio/$audioID"); ?>" role="button" class="btn btn-primary">View →</a></p>
	    </div>
	    <!-- /.col-md-4 -->
	<?php endforeach; ?>
	</div>
</div>
<!-- // END RELATED MINISTRIES-->
<?php endif; ?>

<?php if($param == 'single'): ?>
<div class="subpage-head has-margin-bottom">
  <div class="container">
    <h3>Audio</h3>
    <p class="lead">You cannot, but God Can. Rest in His work</p>
  </div>
</div>

<!-- // END SUBPAGE HEAD -->

<div class="container">
  <div class="row">
    <div class="col-md-9 has-margin-bottom"> 
     <?php foreach($audios as $audio):  
     		$audioImage = ($audio['audios_directory'] != '') ? $audio['audios_directory'] : "uploads/audios/default_music.jpeg";
     	?>
      <!-- 16:9 aspect ratio -->
      <div class="has-margin-xs-bottom">
      	<img src="<?php echo base_url($audioImage); ?>" alt="audio image" class="img-responsive center-block" style="margin-bottom: 10px;">
        <audio autobuffer autoloop loop controls>
        	<source src="<?php echo base_url($audio['audios_path']); ?>">
        	<!-- <source src="/media/audio.wav"> -->
        	<object type="audio/x-wav" data="/media/audio.wav" width="290" height="45">
        		<param name="src" value="<?php echo base_url($audio['audios_path']); ?>">
        		<param name="autoplay" value="false">
        		<param name="autoStart" value="0">
        		<p><a href="<?php echo base_url($audio['audios_path']); ?>" class="btn btn-primary">Download this audio file.</a></p>
        	</object>
        </audio>
      </div>
      <p> <?php echo $audio['caption']; ?> </p>
      <a href="<?php echo base_url($audio['audios_path']); ?>" class="btn btn-primary">Download this audio file.</a>
    </div>
    <!--// col md 9-->
	<?php endforeach; ?>
    
    <!--Latest Sermons-->
    <div class="col-md-3">
      <div class="well has-margin-bottom">
        <div class="section-title">
          <h4> RECENT Audio </h4>
        </div>
        <div class="list-group">
        <?php foreach($extraAudios as $exaudio): 
        		$exaudioID = $exaudio['ID'];
        	?>
        	<a href="<?php echo base_url("broadcast/audio/$exaudioID"); ?>" class="list-group-item">
	          <p class="list-group-item-heading" style="color:#fff;"><?php echo $exaudio['title']; ?></p>
	          <!-- <p class="list-group-item-text">24:15 mins</p> -->
	        </a>
      	<?php endforeach; ?>
      	</div>
      </div>
    </div>

  </div>
</div>
<?php endif; ?>

<?php include_once 'template/footer.php'; ?>