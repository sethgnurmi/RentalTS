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
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff'">Staff Dashboard</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Stock'">Stock</div>
        </div>
        
        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:90px;">
            <div class="panel-inner">
              <div class="panel-title">Stock Management</div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Stock/New"><center><i class="bi bi-check-square-fill"></i> New Stock Item </a></center></div>
            </div>
          </div>
        </div>

        <div class="row panel-card-container">
          <? foreach($StockList as $key => $StockItem){ ?>
          <div class="col-sm-3 panel-card-outer">
            <div class="panel-card">
              <h4><strong>Stock Item #<?=$StockItem['product_id']?></strong><a class="inline-view" style="style:right;" onclick="window.location='<?=base_url();?>Stock/Item/<?=$StockItem['stock_item_id']?>'">View</a></h4>
              <div class="pf-c-divider" role="separator" style="margin-top:10px;"></div>
              <p class="order-summary-p"><b><?=$Product['product_type'];?></b></p>
              <p class="order-summary-p"><b><?=$Product['product_name'];?></b></p>
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
</body>
</html>