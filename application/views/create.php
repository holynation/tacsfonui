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

                        <!-- <div class="col-sm-3 ml-4">
                          <div>
                            <button type="button" class="btn btn-dark" data-toggle='modal' data-target='#modal-upload' data-animate-modal="zoomInDown">Batch Upload</button>
                          </div>
                        </div> -->
                      <?php endif; ?>

                        <?php if($extraLink): ?>
                        <div class="col-sm-3">
                            <a href="<?php echo base_url($extraLink); ?>" class="btn btn-warning"><i class="fa fa-plus"></i> <?php echo  $extraValue." ".removeUnderscore($model); ?></a>
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
        <!-- this is the table to show the model -->
        <section class="main--contentss">
          <div class="panel">
            <div>
                <div class="col-md-12">
                    <?php echo $formContent;?>
                </div>
            </div>
          </div>
        </section>

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
