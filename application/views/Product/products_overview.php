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
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Products'">Products</div>
        </div>
        
        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:90px;">
            <div class="panel-inner">
              <div class="panel-title">Product Management</div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Products/New"><center><i class="bi bi-check-square-fill"></i> New Product </a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Products/Types"><center><i class="bi bi-tags-fill"></i> Manage Product Types</a></center></div>
              <div class="col-sm-4" style="margin-bottom:20px;"><a class="view-a" href="Products/Type"><center><i class="bi bi-tags-fill"></i> New Product Type</a></center></div>
            </div>
          </div>
        </div>

        <div class="row panel-card-container">
          <? foreach($ProductList as $key => $Product){ ?>
          <div class="col-sm-3 panel-card-outer">
            <div class="panel-card">
              <h4><strong>Product #<?=$Product['product_id']?></strong><a class="inline-view" style="style:right;" onclick="window.location='<?=base_url();?>Products/Product/<?=$Product['product_id']?>'">View</a></h4>
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