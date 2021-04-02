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


  <div class="container" id="ContentWrapper">

    <form action="http://localhost/RentalTS/Stock/New" id="StockItemForm" method="post" accept-charset="utf-8">
    <input type="hidden" id="StockItemId" name="StockItemId" value="<?=$StockItem['StockItemId']?>">
    <div class="row">
      <div class="col-sm-12">
        <div class="row panel-header">
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff'">Staff Dashboard</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Stock'">Stock</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <? if($StockItem['StockItemId'] <= 0){?>
          <div class="panel-header-button">New Stock Item</div>
          <?}else{?>
          <div class="panel-header-button">Stock Item #<?=$StockItem['StockItemId'];?></div>
          <?}?>

        </div>

        <div class="row panel-container">
          <div class="col-sm-6 panel-tile" id="StockItemInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Stock Item</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <div class="col-sm-6">
                <label for="ProductTypeName">Product:</label>
                <input class="pf-c-form-control" type="text" id="ProductTypeName" name="ProductTypeName" placeholder="Product Type" value="<?=$ProductType['ProductTypeName'];?>"/>
              </div>
              <div class="col-sm-6">
                <label for="ProductPurchasePrice">Stock Quantity:</label>
                <input class="pf-c-form-control" type="number" id="ProductPurchasePrice" name="ProductPurchasePrice" value="<?=$Product['ProductPurchasePrice'];?>"/>
              </div>
            </div>
          </div>

          <div class="col-sm-6 panel-tile" id="MeasurementInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Measurement Options</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <div class="col-sm-4">
                <center>
                  <input type="checkbox" id="MeasurementHeight" name="MeasurementHeight">
                  <label for="MeasurementHeight">Height</label>
                </center>
              </div>
              <div class="col-sm-4">
                <center>
                <input type="checkbox" id="MeasurementWaist" name="MeasurementWaist">
                <label for="MeasurementWaist">Waist</label>
                </center>
              </div>
              <div class="col-sm-4">
                <center>
                <input type="checkbox" id="MeasurementChest" name="MeasurementChest">
                <label for="MeasurementChest">Chest</label>
                </center>
              </div>
              <div class="col-sm-4">
                <center>
                <input type="checkbox" id="MeasurementLength" name="MeasurementLength">
                <label for="MeasurementLength">Length</label>
                </center>
              </div>
              <div class="col-sm-4">
                <center>
                <input type="checkbox" id="MeasurementOutseam" name="MeasurementOutseam">
                <label for="MeasurementOutseam">Outseam</label>
                </center>
              </div>
              <div class="col-sm-4">
                <center>
                <input type="checkbox" id="MeasurementInseam" name="MeasurementInseam">
                <label for="MeasurementInseam">Inseam</label>
                </center>
              </div>
            </div>
          </div>
        </div>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:80px;" id="ProductTypeSubmit">
            <div class="row" style="height:100%;">
              <div class="col-sm-3"><p></p></div>
              <div class="col-sm-6" style="height:100%;">
                <center>
                  <button type="submit" name="SubmitProductTypeButton" class="pf-c-button pf-m-primary set-center">Submit Product Type</button>
                </center>
              </div>
              <div class="col-sm-3" style="height:100%;">
              </div>
            </div>

          </div>
        </div>

        <div class="row panel-container-bottom"></div>
      </div>
    </div>
  </div>
  </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/patternfly/3.24.0/js/patternfly.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    
  });

</script>
</body>
</html>