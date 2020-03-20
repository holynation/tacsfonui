            <!-- Main Footer Start -->
            <footer class="main--footer main--footer-light">
                <p>Copyright &copy; <a href="#">DAdmin</a>. All Rights Reserved.</p>
            </footer>
            <!-- Main Footer End -->
        </main>
        <!-- Main Container End -->

        <!-- BEGIN MODAL -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h4 class="modal-title" id="myModalLabel">Add New Event</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open(base_url("modelController/add_event"), array("class" => "form-horizonstal","id"=>"formCalendar")); ?>
                          <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Event Name</label>
                                <div class="col-md-12 ui-front">
                                    <input type="text" class="form-control" name="name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Description</label>
                                <div class="col-md-12 ui-front">
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Start Date</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="start_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">End Date</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="end_date">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                        <?php echo form_close(); ?>
                        <!-- <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button> -->
                    </div> <!-- end modal footer-->
                </div> <!-- end modal content -->
            </div> <!-- end modal dialog-->
        </div>
        <!-- end modal -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/private/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/select2.min.js"></script>
    <!-- <script src="<?php //echo base_url(); ?>assets/private/js/jquery-jvectormap.min.js"></script> -->
    <!-- <script src="<?php //echo base_url(); ?>assets/private/js/jquery-jvectormap-world-mill.min.js"></script> -->
    <!-- <script src="<?php //echo base_url(); ?>assets/private/js/horizontal-timeline.min.js"></script> -->
    <!-- <script src="<?php //echo base_url(); ?>assets/private/js/jquery.validate.min.js"></script> -->
    <!-- <script src="<?php //echo base_url(); ?>assets/private/js/jquery.steps.min.js"></script> -->
    <!-- <script src="<?php //echo base_url(); ?>assets/private/js/datatables.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/private/js/dropzone.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/custom.js"></script>

    <!-- Page Level Scripts -->
<?php //if(@$model == 'events'):?>
    <script src="<?php echo base_url(); ?>assets/private/js/fullcalendar.min.js"></script>
<?php //endif; ?>

<script>
// this is for calendar js

/* ------------------------------------------------------------------------- *
         * CALENDAR APP
         * ------------------------------------------------------------------------- */

!function($) {
    "use strict";
    $('#calendarApp').fullCalendar({
        eventSources: [
             {
                events: function(start, end, timezone, callback) {
                     $.ajax({
                     url: '<?php echo base_url() ?>modelController/calendarLoad',
                     dataType: 'json',
                     data: {
                     // our hypothetical feed requires UNIX timestamps
                     start: start.unix(),
                     end: end.unix()
                     },
                     success: function(msg) {
                         var events = msg.events;
                         callback(events);
                     }
                    });
                }
             },
        ],
        dayClick: function(date, jsEvent, view) {
            var date_last_clicked = $(this);
            $(this).css('background-color', '#bed7f3');
            // var dateClicked = new Date(date._d, "d");
            // var start_date = $("form input[name='start_date']").val(dateClicked);
            $('#addModal').modal();
        },
    });


}(window.jQuery);

/* end calendar app  */


// this is for dropzone uploading
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