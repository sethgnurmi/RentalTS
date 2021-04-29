
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
<style>
  [disabled] {
    pointer-events: none;
  }
</style>
<body>
<div style="padding-left: calc(100vw - 100%);">
  <div class="modal" hidden>
    <div class="col-sm-12 modal-tile set-center" style="width:500px; height:550px;" id="ActorMeasurements" hidden>
      <div class="panel-inner">
        <div class="panel-title">Actor Measurements</div>
        <div class="scrollable-borderless" style="height:80%;">
          <div id="ActorMeasurementsInputs">
          
            <? foreach($MeasurementList as $key=>$val){?>
            <div class="col-sm-6">
              <label for="Measurement<?=$val?>"><?=$val?>: </label>
              <input class="pf-c-form-control" type="text" name="Measurement<?=$val?>" value="<?=$Measurements[$key]?>" readonly/>
            </div>
            <?}?>
            
            <div class="col-sm-12">
              <label for="MeasurementAlterations">Alterations/Notes:</label>
              <textarea class="pf-c-form-control" name="MeasurementAlterations" style="max-width: 100%; min-width: 100%; height:75px;" readonly><?=$Measurements['alterations']?></textarea>
            </div>
          </div>
        </div>

      </div>
      <button class="modal-close" type="button" aria-label="Close">
        <i class="fas fa-times" aria-hidden="true"></i>
      </button>
    </div>
    
    <div class="col-sm-12 modal-tile set-center" style="width:500px; height:550px;" id="LineItemMeasurements" hidden>
      <div class="panel-inner">
        <div class="panel-title">Line Item Measurements</div>
        <div class="scrollable-borderless" style="height:80%;">
          <div id="LineItemMeasurementsModalInputs">
          
            <? foreach($MeasurementList as $key=>$val){?>
            <div class="col-sm-6 <?=$key?>MeasurementDisplay MeasurementDisplay">
              <label for="Measurement<?=$val?>Modal"><?=$val?>: </label>
              <input class="pf-c-form-control" type="text" id="Measurement<?=$val?>Modal" readonly/>
            </div>
            <?}?>
            
            <div class="col-sm-12">
              <label for="MeasurementAlterationsModal">Alterations/Notes:</label>
              <textarea class="pf-c-form-control" id="MeasurementAlterationsModal" style="max-width: 100%; min-width: 100%; height:75px;" readonly></textarea>
            </div>
          </div>
        </div>

      </div>
      <button class="modal-close" type="button" aria-label="Close">
        <i class="fas fa-times" aria-hidden="true"></i>
      </button>
    </div>
    
    <div class="col-sm-12 modal-tile set-center" style="width:500px; height:650px;" id="LineItemDetails" hidden>
      <div class="panel-inner">
        <div class="panel-title">Line Item Details</div>
        <div class="scrollable-borderless" style="height:80%;">
          <div id="LineItemDetailsModalInputs">
            <div class="col-sm-6">
              <label for="ProductTypeDetailsModal">Product Type: </label>
              <input class="pf-c-form-control" type="text" id="ProductTypeDetailsModal" readonly/>
            </div>
            <div class="col-sm-6">
              <label for="ProductNameDetailsModal">Product: </label>
              <input class="pf-c-form-control" type="text" id="ProductNameDetailsModal" readonly/>
            </div>
            <div class="col-sm-6">
              <label for="EventIdDetailsModal">Event Id: </label>
              <input class="pf-c-form-control" type="text" id="EventIdDetailsModal" readonly/>
            </div>
            <div class="col-sm-6">
              <label for="OrderIdDetailsModal">Order Id: </label>
              <input class="pf-c-form-control" type="text" id="OrderIdDetailsModal" readonly/>
            </div>
            <div class="col-sm-6">
              <label for="ActorIdDetailsModal">Actor Id: </label>
              <input class="pf-c-form-control" type="text" id="ActorIdDetailsModal" readonly/>
            </div>
            <div class="col-sm-6">
              <label for="ProductIdDetailsModal">Product Id: </label>
              <input class="pf-c-form-control" type="text" id="ProductIdDetailsModal" readonly/>
            </div>
            <div class="col-sm-6">
              <label for="PurchaseDetailsModal">Transaction: </label>
              <input class="pf-c-form-control" type="text" id="PurchaseDetailsModal" readonly/>
            </div>
            <div class="col-sm-6">
              <label for="PriceDetailsModal">Price: </label>
              <input class="pf-c-form-control" type="text" id="PriceDetailsModal" readonly/>
            </div>

            <div class="col-sm-12" style="margin-top:20px; margin-bottom:10px;">
                <label >Measurements: </label>
                <div class="pf-c-divider" role="separator"></div>
            </div>

            <? foreach($MeasurementList as $key=>$val){?>
            <div class="col-sm-6 <?=$key?>MeasurementDisplay MeasurementDisplay">
              <label for="Measurement<?=$val?>DetailsModal"><?=$val?>: </label>
              <input class="pf-c-form-control" type="text" id="Measurement<?=$val?>DetailsModal" readonly/>
            </div>
            <?}?>
            
            <div class="col-sm-12">
              <label for="MeasurementAlterationsDetailsModal">Alterations/Notes:</label>
              <textarea class="pf-c-form-control" id="MeasurementAlterationsDetailsModal" style="max-width: 100%; min-width: 100%; height:75px;" readonly></textarea>
            </div>
          </div>
        </div>

      </div>
      <button class="modal-close" type="button" aria-label="Close">
        <i class="fas fa-times" aria-hidden="true"></i>
      </button>
    </div>
  </div>

  <div class="container" id="ContentWrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="row panel-header">
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff'">Staff Dashboard</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff/Events'">Events</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff/Event/<?=$Event['event_id']?>'">Event <?=$Event['event_id']?></div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff/Actors/<?=$Event['event_id']?>'">Actors</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button">Order</div>
        </div>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" id="EventInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Event</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <div class="col-sm-3">
                <label for="EventName">Event:</label>
                <input class="pf-c-form-control" type="text" id="EventName" placeholder="Event Name" value="<?=$Event['event_name']?>" disabled/>
              </div>
              <div class="col-sm-3">
                <label for="EventType">Event Type:</label>
                <input class="pf-c-form-control" type="text" id="EventType" placeholder="Event Type" value="<?=$Event['event_type']?>" disabled/>
              </div>
              <div class="col-sm-3">
                <label for="EventType">Production Date:</label>
                <input class="pf-c-form-control" type="text" id="EventProductionDate" value="<?=$Event['production_date']?>" disabled/>
              </div>
              <div class="col-sm-3">
                <label for="EventType">Fulfillment Deadline:</label>
                <input class="pf-c-form-control" type="text" id="EventFulfillmentDeadlineDate" value="<?=$Event['fulfillment_deadline']?>" disabled/>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-12">
                <label for="EventDescription">Event Description:</label>
                <textarea class="pf-c-form-control" style="resize:none;" maxlength="250" id="EventDescription" name="EventDescription" placeholder="Event Description" disabled></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile panel-tile-md" id="EventInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Actor</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <div class="col-sm-4">
                <label for="ActorName">Actor Name:</label>
                <input class="pf-c-form-control" type="text" id="ActorName" placeholder="Actor Name" value="<?=$Actor['actor_name']?>" disabled/>
              </div>
              <div class="col-sm-4">
                <label for="ActorRole">Role:</label>
                <input class="pf-c-form-control" type="text" id="ActorRole" placeholder="Role" value="<?=$Actor['actor_role']?>" disabled/>
              </div>
              <div class="col-sm-4">
                <label for="ActorMeasurements">Measurements:</label>
                <center><p class="view-a" id="ViewActorMeasurements">View Measurements</p></center>
              </div>
            </div>
          </div>
        </div>

        <form action="http://localhost/RentalTS/Staff/Order/<?=$Actor['actor_id']?>" id="DeleteLineItemForm" method="post" accept-charset="utf-8">
          <input type="hidden" id="DeleteLineItemInput" name="DeleteLineItemInput" value=""/>
        </form>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile panel-tile-xl" id="LineItemsInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Line Items</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <div class="col-sm-7">
                <p class="form-heading-md">Item List</p>
                <div class="col-sm-12" hidden>
                  <div class="col-sm-2"></div>
                  <div class="col-sm-6" style="white-space: nowrap; display: inline-block;">
                    <label for="TemplateSelect" style="padding-right: 5px;">Template:</label>
                    <select class="pf-c-form-control" id="TemplateSelect">
                      <option value="1">Scottish Regalia</option>
                      <option value="2">Highlander</option>
                      <option value="3">Welshman</option>
                    </select>
                  </div>
                </div>
                <div class="scrollable" style="height:550px" id="LineItemList">
                  <? $totalPrice = 0; ?>
                  <? foreach($LineItemsList as $key => $lineItem){?>
                    <div class="row line-item-in-list" data-id="<?=$lineItem['line_item_id'];?>">
                      <div class="col-sm-3 line-item-detail"><strong><?=$lineItem['product_type'];?>:</strong></div>
                      <div class="col-sm-6 line-item-detail"><strong></strong><?=$lineItem['product_name'];?></div>
                      <div class="col-sm-3 line-item-detail"><strong>Price:</strong> $<?=number_format($lineItem['purchase'] == 1 ? $lineItem['purchase_price'] : $lineItem['rental_price'], 2)?></div>
                      <div class="pf-c-divider" role="separator"></div>
                      <div class="col-sm-4 line-item-detail"><center><p class="view-a viewLineItemMeasurementsButton">Measurements</p></center></div>
                      <div class="col-sm-4 line-item-detail"><center><p class="view-a viewCompleteDetailsButton">Complete Details</p></center></div>
                      <div class="col-sm-4 line-item-detail"><center><p class="view-a removeLineItemButton">Remove Line Item</p></center></div>
                    </div>
                    <? $totalPrice += $lineItem['purchase'] == 1 ? $lineItem['purchase_price'] : $lineItem['rental_price'] ?>
                  <?}?>
                </div>
                <br>
                <br>
                <div class="pf-c-divider" role="separator"></div>
                <br>
                <div class="row">
                  <div class="col-sm-12">
                    <p class="form-heading-md">Total Order Cost: $<?=number_format($totalPrice); ?></p>
                  </div>
                </div>
              </div>
              <div class="col-sm-5">
                <form action="http://localhost/RentalTS/Staff/Order/<?=$Actor['actor_id']?>" id="AddLineItemForm" method="post" accept-charset="utf-8">
                  <p class="form-heading-md">Add New Line Item</p>
                  <div class="row">
                    <div class="col-sm-4">
                      <label for="LineItemType">Item Type:</label>
                      <select class="pf-c-form-control" id="LineItemType" name="LineItemType">
                        <? foreach($ProductTypes as $key=>$productType){ ?>
                        <option value="<?=$productType['product_type_id']?>"><?=$productType['product_type']?></option>
                        <?}?>
                      </select>
                    </div>
                    <div class="col-sm-8">
                      <label for="LineItemProduct">Item:</label>
                      <select class="pf-c-form-control" id="LineItemProduct" name="LineItemProduct" disabled>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="checkbox" id="LineItemPurchase" name="LineItemPurchase">
                      <label for="LineItemPurchase">Purchase Line Item</label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12" id="LineItemMeasurements">
                      <label>Measurements:</label>
                      <div class="scrollable" style="height:400px">
                        <div id="LineItemMeasurementsInputs">
                        
                          <? foreach($MeasurementList as $key=>$val){?>
                          <div class="col-sm-6 <?=$key?>MeasurementInput MeasurementInput">
                            <label for="Measurement<?=$val?>"><?=$val?>: </label>
                            <input class="pf-c-form-control" type="text" name="Measurement<?=$val?>" value="<?=$Measurements[$key]?>" readonly/>
                          </div>
                          <?}?>
                          
                          <div class="col-sm-12">
                            <label for="MeasurementAlterations">Alterations/Notes:</label>
                            <textarea class="pf-c-form-control" name="MeasurementAlterations" style="max-width: 100%; min-width: 100%; height:75px;" readonly><?=$Measurements['alterations']?></textarea>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <input type="button" class="pf-c-button pf-m-primary pf-m-block" id="ModifyMeasurementsButton" value="Modify Measurements"/>
                          <input type="button" class="pf-c-button pf-m-primary pf-m-block" id="ResetMeasurementsButton" value="Reset Measurements" style="display:none;"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <br>
                  <div class="pf-c-divider" role="separator"></div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="form-heading-md" id="ItemCost">Item Cost: $9.00</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="submit" class="pf-c-button pf-m-primary pf-m-block" id="AddLineItemButton" value="Add Line Item"/>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:80px;" id="EventSubmit">
            <button type="button" name="ReturnToActorForm" class="pf-c-button pf-m-primary set-center" onclick="window.location='<?=base_url();?>Staff/Actors/<?=$Event['event_id']?>'">Return to Actors</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    var itemCounter = 0;

    function updateProductInfo()
    {

      $.ajax({
        url: '<?=base_url();?>Staff/getProductsByType',
        method: 'POST',
        data: {'product_type': $('#LineItemType').val()},
        success: 
          function(data){
            data = JSON.parse(data);
            
            $('#LineItemProduct').html('');
            $.each(data, function(key, product){
              if(key != 'MeasurementDefaults')
              {
                $('#LineItemProduct').append(
                  '<option value="' + product['product_id'] + '" data-rental="' + product['rental_price'] + '" data-purchase="' + product['purchase_price'] + '">' + product['product_name'] + '</option>'
                  );
              }
            });

            $('.MeasurementInput').show();
            $.each(data['MeasurementDefaults'], function(key, val){
              if(val != 1)
                $('.' + key + 'MeasurementInput').hide();
            });
            



            var price = 0;
            if($('#LineItemPurchase').is(':checked'))
            {
              price = $('#LineItemProduct option:selected').data('purchase');
            }
            else
            {
              price = $('#LineItemProduct option:selected').data('rental');
            }

            $('#ItemCost').html('Item Cost : $' + parseFloat(price).toFixed(2));
            
            $('#LineItemProduct').attr('disabled', false);


          },
        error: 
          function(data){
            console.log(data);
          }
      });
    }

    $(document).on('click','#ViewActorMeasurements', function(){
      $('.modal-tile').hide();
      $('#ActorMeasurements').show();
      $("body").toggleClass("dialogIsOpen");
    });

    $(document).on('click','.viewLineItemMeasurementsButton', function(){
      var id = $(this).parents('.line-item-in-list').data('id');
      $('#LineItemMeasurementsModalInputs').find('.pf-c-form-control').val('');
      $('.MeasurementDisplay').show();


      $.ajax({
        url: '<?=base_url();?>Staff/getLineItemDetails',
        method: 'POST',
        data: {'line_item_id': id},
        success: 
          function(data){
            console.log(data);
            data = JSON.parse(data);
            console.log(data);
            
            <? foreach($MeasurementList as $key=>$val){?>
            $('#Measurement<?=$val?>Modal').val(data['<?=$key?>']);
            <?}?>
            

            $.each(data['MeasurementDefaults'], function(key, val){
              if(val != 1)
                $('.' + key + 'MeasurementDisplay').hide();
            });




            $('#MeasurementAlterationsModal').val(data['alterations']);

          },
        error: 
          function(data){
            console.log(data);
          }
      });

      $('.modal-tile').hide();
      $('#LineItemMeasurements').show();
      $("body").toggleClass("dialogIsOpen");
    });

    $(document).on('click','.viewCompleteDetailsButton', function(){
      var id = $(this).parents('.line-item-in-list').data('id');
      $('#LineItemDetailsModalInputs').find('.pf-c-form-control').val('');
      $('.MeasurementDisplay').show();


      $.ajax({
        url: '<?=base_url();?>Staff/getLineItemDetails',
        method: 'POST',
        data: {'line_item_id': id},
        success: 
          function(data){
            data = JSON.parse(data);
            
            $('#ProductTypeDetailsModal').val(data['product_type']);
            $('#ProductNameDetailsModal').val(data['product_name']);
            $('#EventIdDetailsModal').val(data['event_id']);
            $('#OrderIdDetailsModal').val(data['order_id']);
            $('#ActorIdDetailsModal').val(data['actor']);
            $('#ProductIdDetailsModal').val(data['product_id']);
            $('#PurchaseDetailsModal').val((data['purchase'] == 0 ? 'Rental' : 'Purchase'));
            $('#PriceDetailsModal').val((data['purchase'] == 0 ? '$' + parseFloat(data['rental_price']).toFixed(2) : '$' + parseFloat(data['purchase_price']).toFixed(2)));


            <? foreach($MeasurementList as $key=>$val){?>
            $('#Measurement<?=$val?>DetailsModal').val(data['<?=$key?>']);
            <?}?>

            $.each(data['MeasurementDefaults'], function(key, val){
              if(val != 1)
                $('.' + key + 'MeasurementDisplay').hide();
            });
            
            $('#MeasurementAlterationsDetailsModal').val(data['alterations']);
          },
        error: 
          function(data){
            console.log(data);
          }
      });

      $('.modal-tile').hide();
      $('#LineItemDetails').show();
      $("body").toggleClass("dialogIsOpen");
    });

    $(document).on('click','.modal-close', function(){
      $('.modal-tile').hide();
      $("body").toggleClass("dialogIsOpen");
    });

    $(document).on('click','.removeLineItemButton', function(){
      $('#DeleteLineItemInput').val($(this).parents('.line-item-in-list').data('id'));
      console.log($('#DeleteLineItemForm'));
      $('#DeleteLineItemForm').submit();
    });

    $(document).on('click','#ModifyMeasurementsButton', function(){
      $(this).parents('#LineItemMeasurements').find('.pf-c-form-control').attr('readonly', false);
      $('#ModifyMeasurementsButton').hide();
      $('#ResetMeasurementsButton').show();
    });

    $(document).on('click','#ResetMeasurementsButton', function(){
      $('#LineItemMeasurementsInputs').html($('#ActorMeasurementsInputs').html());
      $('#ResetMeasurementsButton').hide();
      $('#ModifyMeasurementsButton').show();
    });

    $(document).on('change', '#LineItemType', function(){
      updateProductInfo();
    });

    $(document).on('change', '#LineItemProduct', function(){
      var price = 0;
      if($('#LineItemPurchase').is(':checked'))
      {
        price = $('#LineItemProduct option:selected').data('purchase');
      }
      else
      {
        price = $('#LineItemProduct option:selected').data('rental');
      }

      $('#ItemCost').html('Item Cost : $' + parseFloat(price).toFixed(2));
    });

    $(document).on('change', '#LineItemPurchase', function(){
      var price = 0;
      if($('#LineItemPurchase').is(':checked'))
      {
        price = $('#LineItemProduct option:selected').data('purchase');
      }
      else
      {
        price = $('#LineItemProduct option:selected').data('rental');
      }

      $('#ItemCost').html('Item Cost : $' + parseFloat(price).toFixed(2));
    });

    updateProductInfo();
    
    <? if(isset($POST)){?>
      window.scrollTo(0,document.body.scrollHeight);
    <?}?>

  });

</script>
</body>
</html>