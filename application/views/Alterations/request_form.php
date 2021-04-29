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

    <input type="hidden" id="StockItemId" name="StockItemId" value="<?=$StockItem['StockItemId']?>">
    <div class="row">
      <div class="col-sm-12">
        <div class="row panel-header">
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff'">Staff Dashboard</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Alterations'">Alterations</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button">Request - Stock Item #<?=$StockItem['StockItemId'];?></div>

        </div>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" id="StockItemInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Stock Item</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <div class="col-sm-2" style="margin-bottom:20px;">
                <label for="StockItemProductType">Product Type:</label>
                <input type="text" class="pf-c-form-control" id="StockItemProductType" name="StockItemProductType" value="<?=$StockItemProductType?>" disabled>
              </div>
              <div class="col-sm-4" style="margin-bottom:20px;">
                <label for="StockItemProductName">Product:</label>
                <input type="text" class="pf-c-form-control" id="StockItemProductType" name="StockItemProductType" value="<?=$StockItemProductName?>" disabled>
              </div>
              <div class="col-sm-3" style="margin-bottom:20px;">
                <label for="StockItemStatus">Status:</label>
                <select class="pf-c-form-control" id="StockItemStatus" name="StockItemStatus" disabled>
                  <? foreach($StatusList as $key=>$status){ ?>
                  <option value="<?=$status['status_id']?>"><?=$status['status_name']?></option>
                  <?}?>
                </select>
              </div>
              <div class="col-sm-3" style="margin-bottom:20px;">
                <label for="StockItemCondition">Condition:</label>
                <select class="pf-c-form-control" id="StockItemCondition" name="StockItemCondition" disabled>
                  <? foreach($ConditionList as $key=>$condition){ ?>
                  <option value="<?=$condition['condition_id']?>"><?=$condition['condition_name']?></option>
                  <?}?>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row panel-container">
          <div class="col-sm-6 panel-tile" id="MeasurementInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Current Measurements</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <? foreach($MeasurementList as $key=>$val){ ?>
              <? if($MeasurementDefaults[$key] == 1){ ?>
              <div class="col-sm-4 MeasurementInput <?=$key?>MeasurementInput" style="margin-bottom:20px;">
                <label for="Measurement<?=$val?>"><?=$val?>:</label>
                <input class="pf-c-form-control" type="number" id="Measurement<?=$val?>" name="Measurement<?=$val?>" value="<?=$StockItem['Measurement'.$val]?>" disabled>
              </div>
              <?}}?>
            </div>
          </div>

          <div class="col-sm-6 panel-tile" id="MeasurementInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Requested Measurements</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <? foreach($MeasurementList as $key=>$val){ ?>
              <? if($MeasurementDefaults[$key] == 1){ ?>
              <div class="col-sm-4 MeasurementInput <?=$key?>MeasurementInput" style="margin-bottom:20px;">
                <label for="Measurement<?=$val?>"><?=$val?>:</label>
                <input class="pf-c-form-control" type="number" id="Measurement<?=$val?>" name="Measurement<?=$val?>" value="<?=$LineItem[$key]?>" disabled>
              </div>
              <?}}?>
            </div>
          </div>
        </div>

        <form action="http://localhost/RentalTS/Alterations/Request/<?=$StockItem['StockItemId'];?>" id="StockItemForm" method="post" accept-charset="utf-8">
        <input type="hidden" id="StockItemInput" name="StockItemInput" value="<?=$StockItem['StockItemId'];?>">
        <input type="hidden" id="LineItemInput" name="LineItemInput" value="<?=$LineItem['line_item_id']?>">
        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:80px;" id="StockItemSubmit">
            <div class="row" style="height:100%;">
              <div class="col-sm-3"><p></p></div>
              <div class="col-sm-6" style="height:100%;">
                <center>
                  <button type="submit" name="SubmitUpdatedAlterationsButton" class="pf-c-button pf-m-primary set-center">Update Measurements and Fulfill</button>
                </center>
              </div>
              <div class="col-sm-3" style="height:100%;">
              </div>
            </div>
          </div>
        </div>
        </form>

        <div class="row panel-container-bottom"></div>
      </div>
    </div>
  </div>
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
    
    $('#StockItemStatus').val('<?=$StockItem['StockItemStatus']?>');
    $('#StockItemCondition').val('<?=$StockItem['StockItemCondition']?>');

  });

</script>
</body>
</html>