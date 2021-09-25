<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <h5>ABOUT THE FELLOWSHIP</h5>
        <p>TACSFON UI is a place where men are made, formed and built from lively stones before taken to build lively stones. The watchword of the fellowship is 1 Timothy 4:12; Let no man despise your youth but be thou an example of the belivers, in word, in conversation, in charity in spirit, in faith, in purity..</p>
      </div>
      <div class="col-sm-6 col-md-3">
        <h5>QUICK LINKS</h5>
        <ul class="footer-links">
          <li><a href="<?php echo base_url('broadcast/events'); ?>">Upcoming events</a></li>
          <li><a href="<?php echo base_url('broadcast/audio'); ?>">Recent Audios</a></li>
          <li><a href="<?php echo base_url('broadcast/contact'); ?>">Contact us</a></li>
        </ul>
      </div>
      <div class="col-sm-6 col-md-3">
        <h5>OUR ADDRESS</h5>
        <p> TACSFON UI,<br>
          Abadina Primary School III, <br>
          University Of Ibadan,<br>
          Ibadan, Oyo State, Nigeria.
          <br>
          Phone: +234 816 824 8585<br>
          Email: <a href="mailto:mail@tacsfonui.org">mail@tacsfonui.org</a></p>
      </div>
      <div class="col-sm-6 col-md-3">
        <h5>CONNECT</h5>
        <div>
          <a href="https://m.facebook.com/ui.tacsfon.7?ref=bookmarks" class="ml-3" target="_blank"><span class="fa fa-facebook-official fa-3x rounded"></i>
          </a> 
          <!-- <a href="#">
            <span class="fa fa-twitter fa-3x rounded"></i>
          </a>  -->
          <a href="https://www.instagram.com/tacsfonui/" class="ml-3" target="_blank">
            <span class="fa fa-instagram fa-3x rounded"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="copyright">
    <div class="container">
      <p class="text-center">Copyright © <?php echo date('Y'); ?> All rights reserved</p>
    </div>
  </div>
</footer>
<!-- // END FOOTER --> 

<!-- // END --> 

<!-- Bootstrap core JavaScript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="<?php echo base_url(); ?>assets/public/js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>assets/public/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/public/js/owl.carousel.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/public/js/ketchup.all.js"></script> 
<script src="<?php echo base_url(); ?>assets/public/js/fancybox.js"></script> 
<script src="<?php echo base_url(); ?>assets/public/js/script.js"></script>
<script type="text/javascript">
  $(function(){
    $('#nav a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active');
  });
</script>

</body>
</html>