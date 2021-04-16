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
              <div class="col-sm-4" style="margin-bottom:20px;">
                <label for="StockItemProductType">Product Type:</label>
                <select class="pf-c-form-control" id="StockItemProductType" name="StockItemProductType" <? if($StockItem['StockItemId'] > 0){?>disabled<?}?>>
                  <? foreach($ProductTypeList as $key=>$productType){ ?>
                  <option value="<?=$productType['product_type_id']?>"><?=$productType['product_type']?></option>
                  <?}?>
                </select>
              </div>
              <div class="col-sm-8" style="margin-bottom:20px;">
                <label for="StockItemProductName">Product:</label>
                <select class="pf-c-form-control" id="StockItemProductName" name="StockItemProductName" <? if($StockItem['StockItemId'] > 0){?>disabled<?}?>>
                </select>
              </div>
              <div class="col-sm-4" style="margin-bottom:20px;">
                <label for="StockItemStatus">Status:</label>
                <select class="pf-c-form-control" id="StockItemStatus" name="StockItemStatus" disabled>
                  <? foreach($StatusList as $key=>$status){ ?>
                  <option value="<?=$status['status_id']?>"><?=$status['status_name']?></option>
                  <?}?>
                </select>
              </div>
              <div class="col-sm-5" style="margin-bottom:20px;">
                <label for="StockItemCondition">Condition:</label>
                <select class="pf-c-form-control" id="StockItemCondition" name="StockItemCondition" <? if($StockItem['StockItemId'] <= 0){?>disabled<?}?>>
                  <? foreach($ConditionList as $key=>$condition){ ?>
                  <option value="<?=$condition['condition_id']?>"><?=$condition['condition_name']?></option>
                  <?}?>
                </select>
              </div>
              <div class="col-sm-3" style="margin-bottom:20px;">
                <label for="StockItemQuantity">Quantity:</label>
                <input class="pf-c-form-control" type="number" id="StockItemQuantity" name="StockItemQuantity" min="1" value="<?=$StockItem['StockItemQuantity'];?>" <? if($StockItem['StockItemId'] > 0){?>disabled<?}?>>
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
              <div class="col-sm-4 MeasurementInput <?=$key?>MeasurementInput" style="margin-bottom:20px;">
                <label for="Measurement<?=$val?>"><?=$val?>:</label>
                <input class="pf-c-form-control" type="number" id="Measurement<?=$val?>" name="Measurement<?=$val?>" value="<?=$StockItem['Measurement'.$val]?>">
              </div>
              <?}?>
            </div>
          </div>
        </div>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:80px;" id="StockItemSubmit">
            <div class="row" style="height:100%;">
              <div class="col-sm-3"><p></p></div>
              <div class="col-sm-6" style="height:100%;">
                <center>
                  <button type="submit" name="SubmitStockItemButton" class="pf-c-button pf-m-primary set-center">Submit Stock Item</button>
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
    
    function updateProductInfo()
    {

      $.ajax({
        url: '<?=base_url();?>Stock/getProductsByType',
        method: 'POST',
        data: {'product_type': $('#StockItemProductType').val()},
        success: 
          function(data){
            data = JSON.parse(data);
            
            $('#StockItemProductName').html('');
            $.each(data, function(key, product){
              if(key != 'MeasurementDefaults')
              {
                $('#StockItemProductName').append(
                  '<option value="' + product['product_id'] + '">' + product['product_name'] + '</option>'
                  );
              }
            });

            $('.MeasurementInput').show();
            $.each(data['MeasurementDefaults'], function(key, val){
              if(val != 1)
                $('.' + key + 'MeasurementInput').hide();
            });

            $('#StockItemProductName').val('<?=$StockItem['StockItemProductName']?>');


          },
        error: 
          function(data){
            console.log(data);
          }
      });
    }

    $(document).on('change', '#StockItemProductType', function(){
      updateProductInfo();
    });

    updateProductInfo();
    
    $('#StockItemProductType').val('<?=$StockItem['StockItemProductType']?>');
    $('#StockItemStatus').val('<?=$StockItem['StockItemStatus']?>');
    $('#StockItemCondition').val('<?=$StockItem['StockItemCondition']?>');

  });

</script>
</body>
</html>