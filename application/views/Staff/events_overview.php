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
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff/Events'">Events</div>
        </div>
        <div class="row panel-card-container">
          <? foreach($EventList as $key => $Event){ ?>
          <div class="col-sm-4 panel-card-outer">
            <div class="panel-card">
              <h4><strong>Event #<?=$Event['event_id']?></strong><a class="inline-view" style="style:right;" onclick="window.location='<?=base_url();?>Staff/Event/<?=$Event['event_id']?>'">View</a></h4>
              <div class="pf-c-divider" role="separator" style="margin-top:10px;"></div>
              <p class="order-summary-p"><b><?=$Event['event_name'];?></b></p>
              <p class="order-summary-p">Emptor: <?=$Event['Emptor']['first_name'];?> <?=$Event['Emptor']['last_name'];?></p>
              <p class="order-summary-p">Contact: <?=$Event['Contact']['first_name'];?> <?=$Event['Contact']['last_name'];?></p>
              <p class="order-summary-p">Orders Placed:</p>
              <div class="pf-c-divider" role="separator"></div>
              <div class="line-item-scrollable">
                <table style="width:100%;">
                  <thead>
                    <tr>
                      <th><center><p class="order-summary-p">Order #</p></center></th>
                      <th><center><p class="order-summary-p">Item Count</p></center></th>
                      <th><p class="order-summary-p" style="float:right;">Subtotal</p></th>
                    </tr>
                  </thead>
                  <tbody>
                      <? $total = 0; ?>
                      <? foreach($Event['ActorsList'] as $key => $Actor){ ?>
                      <? $total += $Actor['LineItemTotal'];?>
                      <tr>
                        <td><center><p class="order-summary-p">#<?=$Actor['actor_id'];?></p></center></td>
                        <td><center><p class="order-summary-p"><?=$Actor['LineItemCount'];?></p></center></td>
                        <td><p class="order-summary-p" style="float:right;">$<?=number_format($Actor['LineItemTotal'],2);?></p></td>
                      </tr>
                      <?}?>
                  </tbody>

                </table>
              </div>
              <div class="pf-c-divider" role="separator"></div>
              <p style="float:right;"><strong>Total: $<?=number_format($total, 2);?></strong></p>
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