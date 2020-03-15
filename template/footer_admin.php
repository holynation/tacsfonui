            <!-- Main Footer Start -->
            <footer class="main--footer main--footer-light">
                <p>Copyright &copy; <a href="#">DAdmin</a>. All Rights Reserved.</p>
            </footer>
            <!-- Main Footer End -->
        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/private/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/jquery-jvectormap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/jquery-jvectormap-world-mill.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/horizontal-timeline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/jquery.steps.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/dropzone.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/custom.js"></script>

    <!-- Page Level Scripts -->

<script>
Dropzone.options.myDropzone= {
    url: '<?php echo base_url('mc/galleryUpload'); ?>',
    // paramName: 'fileGallery',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 20,
    maxFiles: 20,
    maxFilesize: 15,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("submitGallery").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            dzClosure.processQueue();
        });

        //send all the form data along with the files:
        dzClosure.on("sendingmultiple", function(data, xhr, formData) {
            $(":input[name]",$("form")).each(function(){
                formData.append($(this).attr('name'),$(this).val());
            })
        });

        dzClosure.on('success', function(response){
            var data = JSON.stringify(response),
                data = JSON.parse(data),
                message = (data.status) ? "image(s) successfuly uploaded...": "error occured while performing the operation...";
            showNotification(data.status,message);
            timeOutReload(3000);
        })
    }
}
</script>

</body>
</html>