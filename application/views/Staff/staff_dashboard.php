<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/patternfly/3.24.0/css/patternfly.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/patternfly/3.24.0/css/patternfly-additions.min.css">
  <?php echo link_tag('assets/patternfly/node_modules/@patternfly/patternfly/patternfly.css'); ?>
  <?php echo link_tag('assets/fontawesome/css/all.css'); ?>
  <?php echo link_tag('assets/bootstrap/node_modules/bootstrap-icons/font/bootstrap-icons.css'); ?>
  <?php echo link_tag('assets/css/styles.css'); ?>
</head>
<body>
<div style="padding-left: calc(100vw - 100%);">

  <div class="container">

    <div class="row">
      <div class="col-sm-12">
        <div class="row panel-header">
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff'">
            Staff Dashboard
          </div>
        </div>
        
        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:175px;">
            <div class="panel-inner">
              <div class="panel-title">Staff Department Dashboard</div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Staff/New"><center><i class="bi bi-check-square-fill"></i> New Event </a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Staff/Events"><center><i class="bi bi-calendar2-event-fill"></i> Manage Events</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Staff/Orders"><center><i class="bi bi-stack"></i> Manage Orders</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Fulfillment"><center><i class="bi bi-inboxes-fill"></i> Order Fulfillment</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Alterations"><center><i class="bi bi-tools"></i> Alteration Requests</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Shipping"><center><i class="bi bi-envelope-open-fill"></i> Order Shipping</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Stock"><center><i class="bi bi-tags-fill"></i> Manage Stock</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Products"><center><i class="bi bi-archive-fill"></i> Manage Products</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Returns"><center><i class="bi bi-handbag-fill"></i> Returns</a></center></div>
            </div>
          </div>
        </div>
        
        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:100px;">
            <div class="panel-inner">
              <div class="panel-title">Task Scheduler - Departments</div>
              <div class="col-sm-3" style="margin-top:10px; margin-bottom:10px;">
                <center>
                <input type="checkbox" class="departmentCheckbox" id="FulfillmentCheckbox" data-department="1" checked>
                <label for="FulfillmentCheckbox">Fulfillment</label>
                </center>
              </div>
              <div class="col-sm-3" style="margin-top:10px; margin-bottom:10px;">
                <center>
                <input type="checkbox" class="departmentCheckbox" id="AlterationsCheckbox" data-department="2" checked>
                <label for="AlterationsCheckbox">Alterations</label>
                </center>
              </div>
              <div class="col-sm-3" style="margin-top:10px; margin-bottom:10px;">
                <center>
                <input type="checkbox" class="departmentCheckbox" id="ShippingCheckbox" data-department="3" checked>
                <label for="ShippingCheckbox">Shipping</label>
                </center>
              </div>
              <div class="col-sm-3" style="margin-top:10px; margin-bottom:10px;">
                <center>
                <input type="checkbox" class="departmentCheckbox" id="ReturnsCheckbox" data-department="4" checked>
                <label for="ReturnsCheckbox">Returns</label>
                </center>
              </div>
            </div>
          </div>
        </div>

        <div class="row panel-card-container">
          <? foreach($TaskList as $key => $Task){ ?>
          <div class="col-sm-3 panel-card-outer task-card" department="<?=$Task['Department']?>">
            <div class="panel-card">
              <h4><strong><?=$Task['TaskTitle']?></strong><a class="inline-view" style="style:right;" onclick="window.location='<?=$Task['ViewURL']?>'">View</a></h4>
              <div class="pf-c-divider" role="separator" style="margin-top:10px;"></div>
              <p class="order-summary-p"><b>Department: <span style="float:right;"><?=$Task['DepartmentName'];?></span></b></p>
              <? if(isset($Task['IsReturns'])){?>
              <p class="order-summary-p"><b>Expected Return Date: <span style="float:right;"><?=$Task['ReturnDeadline'];?></span></b></p>
              <?}else{?>
              <p class="order-summary-p"><b>Fulfillment Deadline: <span style="float:right;"><?=$Task['FulfillmentDeadline'];?></span></b></p>
              <?}?>
              <p class="order-summary-p"><b>Days Remaining: <span style="float:right;"><?=$Task['DaysRemaining'];?></span></b></p>
              <br>
            </div>
          </div>
          <?}?>
        </div>

      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/patternfly/3.24.0/js/patternfly.min.js"></script>
<script>
  $(document).ready(function(){
    function updateTasks()
    {
      console.log('happening');
      $('.task-card').hide();
      $('.departmentCheckbox').each(function(key, val){
        if(val.checked)
        {
          $('.task-card[department="' + $(val).data('department') + '"]').show();
        }
      });
    }

    $('.departmentCheckbox').change(function(){
      updateTasks();
    });

    updateTasks();

  });
</script>
</body>
</html>