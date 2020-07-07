<?php include_once 'template/header.php'; ?>

<!--SUBPAGE HEAD-->

<div class="subpage-head has-margin-bottom">
  <div class="container">
    <h3>Programs &amp; Events </h3>
    <p class="lead">List of Upcoming Events and Programs</p>
  </div>
</div>

<!-- // END SUBPAGE HEAD -->

<div class="container">
  <div class="row">
    <div class="col-md-9 has-margin-bottom"> 
      <!--Event list-->
     <?php foreach($events as $event): ?>
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="highlight-bg has-padding-xs event-details">
            <div class="ed-title">EVENT DETAILS</div>
            <div class="ed-content"> <span class="glyphicon glyphicon-calendar"></span> <?php echo dateFormatter($event['start']); ?> <br>
              <span class="glyphicon glyphicon-time"></span> <?php echo localTimeRead($event['start']); ?> <br>
              <span class="glyphicon glyphicon-map-marker"></span> <!-- Melbourne --></div>
          </div>
        </div>
        <div class="col-md-8 col-sm-8 bulletin">
          <h4 class="media-heading"><?php echo $event['title']; ?> </h4>
          <p class="media-content"><?php echo $event['description']; ?></p>
          <a class="btn btn-primary" href="#" role="button">Anticipate</a>
      	</div>
      </div>
      <hr>
      <!--Event list-->
  <?php endforeach; ?>
      <!--Event list-->
      
      <!-- PAGINATION -->
      
      <!-- <div class="text-center center-block">
        <ul class="pagination">
          <li class="disabled"><a href="#">«</a></li>
          <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">»</a></li>
        </ul>
      </div> -->
    </div>
    <!--// col md 9--> 
    
    <!--Sidebar-->
  </div>
</div>

<?php include_once 'template/footer.php'; ?>