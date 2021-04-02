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
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href=""><center><i class="bi bi-inboxes-fill"></i> Order Fulfillment</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href=""><center><i class="bi bi-tools"></i> Alteration Requests</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href=""><center><i class="bi bi-envelope-open-fill"></i> Order Shipping</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Stock"><center><i class="bi bi-tags-fill"></i> Manage Stock</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Products"><center><i class="bi bi-archive-fill"></i> Manage Products</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href=""><center><i class="bi bi-handbag-fill"></i> Returns</a></center></div>
            </div>
          </div>
        </div>
        
        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:300px;">
            <div class="panel-inner">
              <div class="panel-title">Upcoming Events</div>
            </div>
          </div>
        </div>

        <div class="row panel-container-bottom"></div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/patternfly/3.24.0/js/patternfly.min.js"></script>
</body>
</html>