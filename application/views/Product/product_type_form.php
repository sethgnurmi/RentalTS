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

    <form action="http://localhost/RentalTS/Products/Type" id="ProductTypeForm" method="post" accept-charset="utf-8">
    <input type="hidden" id="ProductTypeId" name="ProductTypeId" value="<?=$ProductType['ProductTypeId']?>">
    <input type="hidden" id="MeasurementDefaultsId" name="MeasurementDefaultsId" value="<?=$ProductType['MeasurementDefaultsId']?>">
    <div class="row">
      <div class="col-sm-12">
        <div class="row panel-header">
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff'">Staff Dashboard</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Products'">Products</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Products/Types'">Product Types</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <? if($ProductType['ProductTypeId'] <= 0){?>
          <div class="panel-header-button">New Product Type</div>
          <?}else{?>
          <div class="panel-header-button"><?=$ProductType['ProductTypeName'];?></div>
          <?}?>

        </div>

        <div class="row panel-container">
          <div class="col-sm-6 panel-tile" id="ProductInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Product Type</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <div class="col-sm-12">
                <label for="ProductTypeName">Product Type:</label>
                <input class="pf-c-form-control" type="text" id="ProductTypeName" name="ProductTypeName" placeholder="Product Type" value="<?=$ProductType['ProductTypeName'];?>"/>
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

              <? foreach($MeasurementList as $key=>$val){ ?>
              <div class="col-sm-4">
                <center>
                  <input type="checkbox" id="Measurement<?=$val?>" name="Measurement<?=$val?>" <? if($ProductType['Measurement'.$val] == 1){echo "checked";}?>>
                  <label for="Measurement<?=$val?>"><?=$val?></label>
                </center>
              </div>
              <?}?>
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