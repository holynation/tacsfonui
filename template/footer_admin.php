            <!-- Main Footer Start -->
            <footer class="main--footer main--footer-light">
                <p>Copyright &copy; <a href="#">TACSFON</a>. All Rights Reserved.</p>
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
                        <?php echo form_open(base_url("modelController/add_event"), array("class" => "form-horizonstal","id"=>"formCalendar","enctype"=>"multipart/form-data")); ?>
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
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="start_date" id="datetimepicker" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar" id="iconCalendar"></i></span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">End Date</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="end_date" id="datetimepicker1">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar" id="iconCalendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="label-heading col-md-4">Event Image</span>

                                <div class="col-md-12">
                                    <label class="custom-file">
                                        <input type="file" class="custom-file-input" name="events_path" id="events_path">
                                        <span class="custom-file-label">Choose File</span>
                                    </label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                        <?php echo form_close(); ?>
                    </div> <!-- end modal footer-->
                </div> <!-- end modal content -->
            </div> <!-- end modal dialog-->
        </div>
        <!-- end modal -->

        <!-- begin the edit modal form -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h4 class="modal-title" id="myModalLabel">Update Calendar Event</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <div class="modal-body">
                  <?php echo form_open(base_url("modelController/edit_event"), array("class" => "form-horizontal","enctype"=>"multipart/form-data")); ?>
                  <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Event Name</label>
                        <div class="col-md-12 ui-front">
                            <input type="text" class="form-control" name="name" value="" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Description</label>
                        <div class="col-md-12 ui-front">
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Start Date</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="start_date" id="start_date">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar" id="iconCalendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">End Date</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="end_date" id="end_date">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar" id="iconCalendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 label-heading"> Current Image</label>
                        <div class="col-md-12">
                            <img id="eventsImgPath" />
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="label-heading col-md-4">Update event Image</span>
                        <div class="col-md-10">
                            <label class="custom-file">
                                <input type="file" class="custom-file-input" name="events_path" id="events_path">
                                <span class="custom-file-label">Choose File</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-inline">
                        <label class="alert alert-danger form-check ml-3 mb-3">
                            <input type="checkbox" name="delete" value="1" class="form-check-input">
                            <span class="form-check-label"><div>Delete Event</div></span>
                        </label>
                    </div>
                    <input type="hidden" name="eventid" id="event_id" value="0" />
                    <input type="hidden" name="eventPath" id="event_path" value="" />
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Update Event">
                    <?php echo form_close(); ?>
                  </div>
                </div>
            </div>
        </div>
        <!-- end edit modal form -->
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
    <script src="<?php echo base_url(); ?>assets/private/libs/jquery-datetime-picker/jquery.datetimepicker.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/libs/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/custom.js"></script>

    <!-- Page Level Scripts -->
<?php //if(@$model == 'events'):?>
    <script src="<?php echo base_url(); ?>assets/private/libs/fullcalendar/fullcalendar.min.js"></script>
<?php //endif; ?>

<script>
/* ------------------------------------------------------------------------- *
         * SUMMERNOTE APP
    * ------------------------------------------------------------------------- */

$(document).ready(function(){
    $('#summernote_editor').summernote({
        height: 250,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                 // set focus to editable area after initializing summernote
    });
});

/* ------------------------------------------------------------------------- *
         * CALENDAR APP
         * ------------------------------------------------------------------------- */

$(document).ready(function() {
    $('#datetimepicker').datetimepicker({
        value: '',
        format:'Y-m-d H:m:s'
    });
    $('#datetimepicker1').datetimepicker({
        value: '',
        format:'Y-m-d H:m:s',
        defaultDate:false,
        defaultTime:false
    });
});

!function($) {
    "use strict";
    $('#calendarApp').fullCalendar({
        header: {
            left: '',
            center: 'prev next title',
            right: ''
        },
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
        eventClick: function(event, jsEvent, view) {
            $('#name').val(event.title);
            $('#description').val(event.description);
            $('#start_date').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
            if(event.end) {
                $('#end_date').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
            }else {
                $('#end_date').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
            }
            $('#event_id').val(event.id);
            var imgPath = "<?php echo base_url(); ?>"+event.events_path+" ";
            $("img#eventsImgPath").attr("src",imgPath).addClass('mb-2');
            $('#editModal').modal();
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