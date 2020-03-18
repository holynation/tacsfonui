<?php include_once 'template/header_admin.php'; ?>
<?php include_once 'template/sidebar.php'; ?>
<!-- this is the sidebar position -->
<?php
$exclude = ($configData && array_key_exists('exclude', $configData))?$configData['exclude']:array();
$has_upload = ($configData && array_key_exists('has_upload', $configData))?$configData['has_upload']:false;
$hidden = ($configData && array_key_exists('hidden', $configData))?$configData['hidden']:array();
$showStatus = ($configData && array_key_exists('show_status', $configData))?$configData['show_status']:false;
$showAddForm = ($configData && array_key_exists('show_add', $configData))?$configData['show_add']:true;
$submitLabel = ($configData && array_key_exists('submit_label', $configData))?$configData['submit_label']:"Save";
$extraLink = ($configData && array_key_exists('extra_link', $configData))?$configData['extra_link']:false;
$extraValue = ($configData && array_key_exists('extra_value', $configData))?$configData['extra_value']:"Add";
$tableAction = ($configData && array_key_exists('table_action', $configData))?$configData['table_action']:$model::$tableAction;
$tableExclude = ($configData && array_key_exists('table_exclude', $configData))?$configData['table_exclude']:array();
$query = ($configData && array_key_exists('query', $configData))?$configData['query']:array();
$tableTitle = ($configData && array_key_exists('table_title', $configData))?$configData['table_title']:"Table of ".removeUnderscore($model);
$icon = ($configData && array_key_exists('table_icon', $configData))?$configData['table_icon']:"";
$search = ($configData && array_key_exists('search', $configData))?$configData['search']:"";
$filter = ($configData && array_key_exists('filter', $configData))?$configData['filter']:"";
$where ='';
if ($filter) {
  foreach ($filter as $item) {
    $display = (isset($item['filter_display'])&&$item['filter_display'])?$item['filter_display']:$item['filter_label'];

    if (isset($_GET[$display]) && $_GET[$display]) {
      $value = $this->db->conn_id->escape_string($_GET[$display]);
      $where.= $where?" and {$item['filter_label']}='$value' ":"where {$item['filter_label']}='$value' ";
    }
  }
}

if ($search) {
 $val = isset($_GET['q'])?$_GET['q']:'';
 $val = $this->db->conn_id->escape_string($val);
 if (isset($_GET['q']) && $_GET['q']) {
   $temp=$where?" and (":" where (";
   $count =0;
     foreach ($search as $criteria) {
       $temp.=$count==0?" $criteria like '%$val%'":" or $criteria like '%$val%' ";
       $count++;
     }
     $temp.=')';
     $where.=$temp;
 }
}
  if (isset($_GET['export'])) {
    $this->queryHtmlTableModel->export=true;
    $this->tableViewModel->export=true;
   }
$tableData='';

$where .= ' order by ID desc ';
   if ($query || $model == 'configure_report') {
     $query.=' '.$where;
     $tableData= $this->queryHtmlTableModel->getHtmlTableWithQuery($query,array(),$count,$tableAction);
   }
   else{
     $tableData= $this->tableViewModel->getTableHtml($model,$count,$tableExclude,$tableAction,true,0,null,true,$where);
   }
?>

<div>
    <?php 
        $formContent= $this->modelFormBuilder->start($model.'_table')
        ->appendInsertForm($model,true,$hidden,'',$showStatus,$exclude)
        ->addSubmitLink()
        ->appendResetButton('Reset','btn-danger')
        ->appendSubmitButton($submitLabel,'btn btn-success')
        ->build();
    ?>
</div>

<main class="main--container">
  <!-- Page Header Start -->
    <section class="page--header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Page Title Start -->
                    <h2 class="page--title h5"><?php echo ucfirst(removeUnderscore($model)); ?></h2>
                    <!-- Page Title End -->

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><span>Administrative <small><?php echo removeUnderscore($model); ?></small></span></li>
                    </ul>
                </div>

              
                <div class="col-lg-6">
                    <!-- Create model -->
                    <div class="row">
                      <?php if($showAddForm): ?>
                        <div class="col-sm-3">
                            <a href="javascript:void(0);" class="btn btn-warning" data-toggle='modal' data-target='#modal-add'><i class="fa fa-plus"></i> Add <?php echo removeUnderscore($model); ?></a>
                        </div>

                        <div class="col-sm-3 ml-4">
                          <div>
                            <button type="button" class="btn btn-dark" data-toggle='modal' data-target='#modal-upload' data-animate-modal="zoomInDown">Batch Upload</button>
                          </div>
                        </div>
                      <?php endif; ?>

                        <?php if($extraLink): ?>
                        <div class="col-sm-3">
                            <a href="<?php echo base_url($extraLink); ?>" class="btn btn-warning"><i class="fa fa-plus"></i>  <?php echo $extraValue ." ". removeUnderscore($model); ?></a>
                        </div>
                      <?php endif; ?>

                    </div>
                    <!-- create model End -->
                </div>
            </div>
        </div>
    </section>
  <!-- Page Header End -->

    <div>
      <!-- this is the batch uploading section -->
        <?php if ($has_upload != ''): ?>
          <div class="modal modal-default fade" id="modal-upload">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><?php echo removeUnderscore($model) ?> Batch Upload</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div >
                      <a  class='btn btn-info' href="<?=base_url("mc/template/$model?exc=name")?>">Download Template</a>
                    </div>
                    <br/>
                    <h3>Upload <?php echo removeUnderscore($model) ?></h3>
                    <form method="post" action="<?php echo base_url('mc/sFile/'.$model) ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="file" name="bulk-upload" class="form-control">
                      <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                    </div>
                     <div class="form-group">
                        <input type="submit" class='btn btn-success' name="submit" value="Upload">
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endif; ?>

        <!-- this is the filter section -->
        <div class="row filter-row">
            <?php $where=''; ?>
            <form action="" class="filter_form">
                <?php if ($filter): ?>
                    <?php foreach ($filter as $item): ?>
                     <?php 
                      $display = (isset($item['filter_display'])&&$item['filter_display'])?$item['filter_display']:$item['filter_label'];
                    ?>
                    <?php 
                      if (isset($_GET[$display]) && $_GET[$display]) {
                        $value = $this->db->conn_id->escape_string($_GET[$display]);
                        $where.= $where?" and {$item['filter_label']}='$value' ":"where {$item['filter_label']}='$value' ";
                      }
                ?>
                    <select class="select floating <?php echo isset($item['child'])?'autoload':'' ?>" name="<?php echo $display; ?>" id="<?php echo $display; ?>"  <?php echo isset($item['child'])?"data-child='{$item['child']}'":""?> <?php echo isset($item['load'])?"data-load='{$item['load']}'":""?> >
                      <option value="">..select <?php echo removeUnderscore(rtrim($display,'_id')) ?>...</option>
                      <?php if (isset($item['preload_query'])&& $item['preload_query']): ?>
                        <?php echo buildOptionFromQuery($this->db,$item['preload_query'],null,isset($_GET[$display])?$_GET[$display]:''); ?>
                      <?php endif; ?>
                    </select>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if ($search): ?>
                    <?php 
                      $placeholder=" search by : ".implode(',', $search);
                      $val = isset($_GET['q'])?$_GET['q']:'';
                      $val = $this->db->conn_id->escape_string($val);
                    ?>
                    <input class="form-control floating" type="text" name="q" placeholder="<?php echo $placeholder; ?>" value="<?php echo $val; ?>" style="width:30%;">
           
                <?php endif; ?>
          
                <?php if ($search || $filter): ?>
                    <input type="submit" value="Filter" class="btn btn-success btn-block">
                <?php endif; ?>
            </form>
        </div>

        <br />
        <!-- this is the table to show the model -->
        <section class="main--contentss">
          <div class="panel">
            <div>
                <div class="col-md-12">
                    <h3><?php echo $tableTitle; ?></h3>
                    <?php echo $tableData;?>
                </div>
            </div>
          </div>
        </section>
        
        <!-- this is add modal -->
        <div class="modal fade" id="modal-add" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><?php echo removeUnderscore($model);  ?> Entry Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <p>
                  <?php echo $formContent; ?>
                </p>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- this is the edit modal -->
        <div class="modal fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <p id="edit-container">
                  
                </p>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
</main>
<script>
    var inserted=false;
    $(document).ready(function($) {
      $('.modal').on('hidden.bs.modal', function (e) {
        if (inserted) {
          inserted = false;
          location.reload();
        }
    });
    $('.close').click(function(event) {
      if (inserted) {
        inserted = false;
        location.reload();
      }
    });
      $('li[data-ajax-edit=1] a').click(function(event){
        event.preventDefault();
        var link = $(this).attr('href');
        var action = $(this).text();
        sendAjax(null,link,'','get',showUpdateForm);
      });
    });
    function showUpdateForm(target,data) {
      var data = JSON.parse(data);
      if (data.status==false) {
        showNotification(false,data.message);
        return;
      }
       var container = $('#edit-container');
       container.html(data.message);
       //rebind the autoload functions inside
       $('#modal-edit').modal();
    }
    function ajaxFormSuccess(target,data) {
      if (data.status) {
        inserted=true;
      }
      showNotification(data.status,data.message);
      if (typeof target ==='undefined') {
        location.reload();
      }
    }
  </script>

<?php include_once 'template/footer_admin.php'; ?>
