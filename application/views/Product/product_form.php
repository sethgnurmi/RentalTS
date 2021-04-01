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

    <form action="http://localhost/RentalTS/Products/New" id="ProductForm" method="post" accept-charset="utf-8">
    <input type="hidden" id="ProductId" name="ProductId" value="<?=$Product['ProductId']?>">
    <div class="row">
      <div class="col-sm-12">
        <div class="row panel-header">
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff'">Staff Dashboard</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Products'">Products</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <? if($Product['ProductId'] <= 0){?>
          <div class="panel-header-button">New Product</div>
          <?}else{?>
          <div class="panel-header-button">Product #<?=$Product['ProductId'];?></div>
          <?}?>

        </div>

        <div class="row panel-container">
          <div class="col-sm-6 panel-tile" id="ProductInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Product</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <div class="col-sm-6">
                <label for="ProductName">Product:</label>
                <input class="pf-c-form-control" type="text" id="ProductName" name="ProductName" placeholder="Product Name" value="<?=$Product['ProductName'];?>"/>
              </div>
              <div class="col-sm-6">
                <label for="ProductType">Product Type:</label>
                <select class="pf-c-form-control" id="ProductType" name="ProductType" value="<?=$Product['ProductType'];?>">
                  <? foreach($ProductTypeList as $key=>$productType){?>
                  <option value="<?=$productType['product_type_id']?>"><?=$productType['product_type']?></option>
                  <?}?>
                </select>
              </div>
              <div class="col-sm-12" style="margin-top:20px;"></div>
              <div class="col-sm-6">
                <label for="ProductPurchasePrice">Purchase Price:</label>
                <input class="pf-c-form-control" type="number" id="ProductPurchasePrice" name="ProductPurchasePrice" value="<?=$Product['ProductPurchasePrice'];?>"/>
              </div>
              <div class="col-sm-6">
                <label for="ProductRentalPrice">Rental Price:</label>
                <input class="pf-c-form-control" type="number" id="ProductRentalPrice" name="ProductRentalPrice" value="<?=$Product['ProductRentalPrice'];?>"/>
              </div>
            </div>
          </div>

          <div class="col-sm-6 panel-tile" id="MeasurementInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Inventory</p>
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
          <div class="col-sm-12 panel-tile" style="height:80px;" id="ProductSubmit">
            <div class="row" style="height:100%;">
              <div class="col-sm-3"><p></p></div>
              <div class="col-sm-6" style="height:100%;">
                <center>
                  <button type="submit" name="SubmitProductButton" class="pf-c-button pf-m-primary set-center">Submit Product</button>
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
    $('#ProductType').val('<?=$Product['ProductType'];?>');
  });

</script>
</body>
</html>