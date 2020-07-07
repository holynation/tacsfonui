<?php $contactMsg = ($this->webSessionManager->getFlashMessage('contactMsg')) ? $this->webSessionManager->getFlashMessage('contactMsg') : ""; ?>
<?php include_once 'template/header.php'; ?>

<!--SUBPAGE HEAD-->

<div class="subpage-head has-margin-bottom">
  <div class="container">
    <h3>CONTACT US</h3>
  </div>
</div>

<!-- // END SUBPAGE HEAD -->

<div class="container">
  	<div class="row">
	    <div class="col-md-6 has-margin-bottom">
    	<?php
    		if(isset($message)){
    			$class = ($message) ? "success" : "danger"; ?>
	    	<div class="alert alert-<?php echo $class; ?>">
	    		<p><?php echo $contactMsg; ?></p>
	    	</div>
	    <?php } ?>
	      <form method="post" role="form" action="<?php echo base_url('broadcast/contact'); ?>">
	        <div class="form-group">
	        	<h4>Contact Form</h4>
	          <label>Full Name</label>
	          <input type="text" class="form-control" name="name" id="name">
	        </div>
	        <div class="form-group">
	          <label>Email Address</label>
	          <input type="email" class="form-control" name="email" id="email">
	        </div>
	        <div class="form-group">
	          <label>Phone Number</label>
	          <input type="text" class="form-control" name="mobile" id="mobile">
	        </div>
	        <div class="form-group">
	          <label>Message</label>
	          <textarea class="form-control" rows="5" name="message" id="message"></textarea>
	        </div>
	        <input type="submit" class="btn btn-primary btn-lg" name="btnContact" id="btnContact" value="Send Message">
	        <span class="help-block loading"></span>
	      </form>
	    </div>
	    <!--// col md 9-->
	    <div class="col-md-6 has-margin-bottom">
	      <h5>OUR ADDRESS</h5>
	      	<div class="row">
		        <div class="col-lg-6">TACSFON UI<br>
		          Abadina Primary School III, <br>
		          University Of Ibadan<br> 
		      		Ibadan, Oyo State, Nigeria.
		      	</div>
		        <div class="col-lg-6">Phone: +234 816 824 8585<br>Email: <a href="mailto:mail@tacsfonui.org">mail@tacsfonui.org</a>
		        </div>
	      	</div>
	       <hr>
	      	<h5>OUR SERVICES</h5>
	      	<div class="row">
		        <div class="col-lg-6">
		        	<ul>
		        		<li>Tuesday: Tacsfon Freshers' Forum - 5:30pm</li>
		        		<li>Thursday: Bible Study - 7pm</li>
		        		<li>Sunday: Sunday School - 8am <br>
		        		Sunday: Sunday Service - 9am<</li>
		        	</ul>
		      	</div>
	    	</div>
	  	</div>
	</div>
</div>
<!-- LOCATION MAP -->
<div class="location-map" style="margin-bottom: 10px;">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3317.380372459554!2d3.8980704142283966!3d7.450797094624888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1039f29b7602d543%3A0xbdb1c8977543ef2a!2sAbadina%20Primary%20School%2C%20Ibadan!5e1!3m2!1sen!2sng!4v1585833471421!5m2!1sen!2sng" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<!-- // END LOCATION MAP  --> 

<?php include_once 'template/footer.php'; ?>