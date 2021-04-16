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
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Fulfillment'">Fulfillment</div>
        </div>
        <div class="row panel-card-container">
          <? foreach($OrderList as $key => $Order){ ?>
          <div class="col-sm-4 panel-card-outer">
            <div class="panel-card">
              <h4><strong>Order #<?=$Order['actor_id']?></strong><a class="inline-view" style="style:right;" onclick="window.location='<?=base_url();?>Fulfillment/Order/<?=$Order['actor_id']?>'">Update Fulfillment</a></h4>
              <div class="pf-c-divider" role="separator" style="margin-top:10px;"></div>
              <p class="order-summary-p"><b><?=$Order['event_name'];?></b></p>
              <p class="order-summary-p"><b><?=$Order['actor_name'];?></b></p>
              <p class="order-summary-p">Emptor: <?=$Order['Emptor']['first_name'];?> <?=$Order['Emptor']['last_name'];?></p>
              <p class="order-summary-p">Contact: <?=$Order['Contact']['first_name'];?> <?=$Order['Contact']['last_name'];?></p>
              <p class="order-summary-p">Line Items:</p>
              <div class="pf-c-divider" role="separator"></div>
              <div class="line-item-scrollable">
                <table style="width:100%;">
                  <thead>
                    <tr>
                      <th><center><p class="order-summary-p">Type</p></center></th>
                      <th><center><p class="order-summary-p">Product</p></center></th>
                      <th><p class="order-summary-p" style="float:right;">Status</p></th>
                    </tr>
                  </thead>
                  <tbody>
                      <? $fulfilled = true; ?>
                      <? foreach($Order['LineItemList'] as $key => $LineItem){ ?>
                      <? $fulfilled = $LineItem['fulfillment_status'] == 1 ? $fulfilled : false ?>
                      <tr>
                        <td><center><p class="order-summary-p"><b><?=$LineItem['product_type'];?></b></p></center></td>
                        <td><center><p class="order-summary-p"><?=$LineItem['product_name'];?></p></center></td>
                        <td><p class="order-summary-p" style="float:right;"><?=$LineItem['fulfillment_status'] == 1 ? "Fulfilled" : "Incomplete"?></p></td>
                      </tr>
                      <?}?>
                  </tbody>

                </table>
              </div>
              <div class="pf-c-divider" role="separator"></div>
              <p style="float:right;"><strong>Order Status: <?=$fulfilled ? "Fulfilled" : "Incomplete" ?></strong></p>
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