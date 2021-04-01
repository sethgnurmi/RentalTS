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
  </style>
<body>
<div style="padding-left: calc(100vw - 100%);">

<div class="modal" hidden>
    <div class="col-sm-12 modal-tile set-center" style="width:500px; height:150px;" id="StartOrderModal" hidden>
      <div class="panel-inner">
        <div class="panel-title">Start Order</div>
        <center><p style="font-size:18px; font-weight:bold;">Event form must be submitted before orders can be initiated</p></center>
      </div>
      <button class="modal-close" type="button" aria-label="Close">
        <i class="fas fa-times" aria-hidden="true"></i>
      </button>
    </div>
    
    <div class="col-sm-12 modal-tile set-center" style="width:500px; height:700px;" id="ActorDetailsModal" hidden>
      <div class="panel-inner">
        <div class="panel-title">Actor Details</div>
          <div class="scrollable-borderless" style="height:80%;">
            <div id="ActorDetailsModalInputs">
              <div class="col-sm-12">
                <label for="ActorNameModal">Actor Name: </label>
                <input class="pf-c-form-control" type="text" id="ActorNameModal" readonly/>
              </div>
              <div class="col-sm-12">
                <label for="ActorRoleModal">Role: </label>
                <input class="pf-c-form-control" type="text" id="ActorRoleModal" readonly/>
              </div>

              <div class="col-sm-12" style="margin-top:20px; margin-bottom:10px;">
                  <label >Measurements: </label>
                  <div class="pf-c-divider" role="separator"></div>
              </div>

              <div class="col-sm-6">
                <label for="MeasurementHeightDetailsModal">Height: </label>
                <input class="pf-c-form-control" type="text" id="MeasurementHeightDetailsModal" readonly/>
              </div>
              <div class="col-sm-6">
                <label for="MeasurementWaistDetailsModal">Waist: </label>
                <input class="pf-c-form-control" type="text" id="MeasurementWaistDetailsModal" readonly/>
              </div>
              <div class="col-sm-6">
                <label for="MeasurementChestDetailsModal">Chest: </label>
                <input class="pf-c-form-control" type="text" id="MeasurementChestDetailsModal" readonly/>
              </div>
              <div class="col-sm-6">
                <label for="MeasurementLengthDetailsModal">Length: </label>
                <input class="pf-c-form-control" type="text" id="MeasurementLengthDetailsModal" readonly/>
              </div>
              <div class="col-sm-6">
                <label for="MeasurementOutseamDetailsModal">Outseam: </label>
                <input class="pf-c-form-control" type="text" id="MeasurementOutseamDetailsModal" readonly/>
              </div>
              <div class="col-sm-6">
                <label for="MeasurementInseamDetailsModal">Inseam: </label>
                <input class="pf-c-form-control" type="text" id="MeasurementInseamDetailsModal" readonly/>
              </div>
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
    
    <div class="col-sm-12 modal-tile set-center" style="width:500px; height:150px;" id="RemoveActorModal" hidden>
      <div class="panel-inner">
        <div class="panel-title">Remove Actor</div>
        <center><p style="font-size:18px; font-weight:bold;">Event form must be submitted before orders can be initiated</p></center>
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
          <div class="panel-header-button">Actors</div>
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
                <input class="pf-c-form-control" type="text" id="EventName" name="EventName" placeholder="Event Name" value="<?=$Event['event_name'];?>" readonly/>
              </div>
              <div class="col-sm-3">
                <label for="EventType">Event Type:</label>
                <input class="pf-c-form-control" type="text" id="EventType" name="EventType" placeholder="Event Type" value="<?=$Event['event_type'];?>" readonly/>
              </div>
              <div class="col-sm-3">
                <label for="EventProductionDate">Production Date:</label>
                <input class="pf-c-form-control" type="text" value="<?=$Event['production_date'];?>" id="EventProductionDate" name="EventProductionDate" aria-label="Date picker" readonly/>
              </div>
              <div class="col-sm-3">
                <label for="EventFulfillmentDeadlineDate">Fulfillment Deadline:</label>
                <input class="pf-c-form-control" type="text" value="<?=$Event['fulfillment_deadline'];?>" id="EventFulfillmentDeadlineDate" name="EventFulfillmentDeadlineDate" aria-label="Date picker" readonly/>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-12">
                <label for="EventDescription">Event Description:</label>
                <textarea class="pf-c-form-control" style="max-width: 100%; min-width: 100%;" maxlength="250" id="EventDescription" name="EventDescription" placeholder="Event Description" readonly><?=$Event['event_description'];?></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" id="ActorsInfo">
            <div class="row">
              <div class="col-sm-12">
                <p class="form-heading-lg">Actors</p>
                <div class="pf-c-divider" role="separator"></div>
                <br>
              </div>
              <div class="col-sm-6">
                <p class="form-heading-md">Actor List</p>
                <div class="scrollable" style="height:590px" id="ActorList">
                <? foreach($ActorsList as $key => $actor){?>
                  <div class="row line-item-in-list" data-id="<?=$actor['actor_id'];?>">
                    <div class="col-sm-6 line-item-detail"><strong>Actor: </strong><?=$actor['actor_name'];?></div>
                    <div class="col-sm-6 line-item-detail"><strong>Role: </strong><?=$actor['actor_role'];?></div>
                    <div class="col-sm-4 line-item-detail"><center><p class="view-a startOrderButton">Go to Order</p></center></div>
                    <div class="col-sm-4 line-item-detail"><center><p class="view-a viewActorDetailsButton">Actor Details</p></center></div>
                    <div class="col-sm-4 line-item-detail"><center><p class="view-a removeActorButton">Remove Actor</p></center></div>
                  </div>
                <?}?>
                </div>
              </div>


              <form action="http://localhost/RentalTS/Staff/Actors/<?=$Event['event_id']?>" id="DeleteActorForm" method="post" accept-charset="utf-8">
                <input type="hidden" id="DeleteActorInput" name="DeleteActorInput" value=""/>
              </form>
              
              <form action="http://localhost/RentalTS/Staff/Actors/<?=$Event['event_id']?>" id="ActorForm" method="post" accept-charset="utf-8">
                <div class="col-sm-6">
                  <p class="form-heading-md">Add New Actor</p>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="LineItemType">Actor Name:</label>
                      <input type="text" class="pf-c-form-control" id="ActorName" name="ActorName"/>
                    </div>
                    <div class="col-sm-6">
                      <label for="LineItemType">Role:</label>
                      <input type="text" class="pf-c-form-control" id="ActorRole" name="ActorRole"/>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <label>Measurements:</label>
                      <div class="scrollable" style="height:400px">
                        <div class="col-sm-6">
                          <label for="MeasurementHeight">Height: </label>
                          <input class="pf-c-form-control" type="text" id="MeasurementHeight" name="MeasurementHeight"/>
                        </div>
                        <div class="col-sm-6">
                          <label for="MeasurementWaist">Waist: </label>
                          <input class="pf-c-form-control" type="text" id="MeasurementWaist" name="MeasurementWaist"/>
                        </div>
                        <div class="col-sm-6">
                          <label for="MeasurementChest">Chest: </label>
                          <input class="pf-c-form-control" type="text" id="MeasurementChest" name="MeasurementChest"/>
                        </div>
                        <div class="col-sm-6">
                          <label for="MeasurementLength">Length: </label>
                          <input class="pf-c-form-control" type="text" id="MeasurementLength" name="MeasurementLength"/>
                        </div>
                        <div class="col-sm-6">
                          <label for="MeasurementOutseam">Outseam: </label>
                          <input class="pf-c-form-control" type="text" id="MeasurementOutseam" name="MeasurementOutseam"/>
                        </div>
                        <div class="col-sm-6">
                          <label for="MeasurementInseam">Inseam: </label>
                          <input class="pf-c-form-control" type="text" id="MeasurementInseam" name="MeasurementInseam"/>
                        </div>
                        <div class="col-sm-12">
                          <label for="MeasurementAlterations">Alterations/Notes:</label>
                          <textarea class="pf-c-form-control" style="height:75px;" id="MeasurementAlterations" name="MeasurementAlterations"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="submit" class="pf-c-button pf-m-primary pf-m-block" id="AddActorButton" value="Add Actor"/>
                    </div>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:80px;" id="EventSubmit">
            <button type="button" name="ReturnToActorForm" class="pf-c-button pf-m-primary set-center" onclick="window.location='<?=base_url();?>Staff/Event/<?=$Event['event_id']?>'">Return to Event</button>
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

    $(document).on('click','.startOrderButton', function(){
      window.location='<?=base_url();?>Staff/Order/' + $(this).parents('.line-item-in-list').data('id');
    });

    $(document).on('click','.viewActorDetailsButton', function(){
      var id = $(this).parents('.line-item-in-list').data('id');
      $('#ActorDetailsModalInputs').find('.pf-c-form-control').val('');
      console.log(id);
      
      $.ajax({
        url: '<?=base_url();?>Staff/getActor',
        method: 'POST',
        data: {'actor_id': id},
        success: 
          function(data){
            data = JSON.parse(data);
            console.log(data);
            $('#ActorNameModal').val(data['actor_name']);
            $('#ActorRoleModal').val(data['actor_role']);

            $('#MeasurementHeightDetailsModal').val(data['height']);
            $('#MeasurementWaistDetailsModal').val(data['waist']);
            $('#MeasurementChestDetailsModal').val(data['chest']);
            $('#MeasurementLengthDetailsModal').val(data['length']);
            $('#MeasurementOutseamDetailsModal').val(data['outseam']);
            $('#MeasurementInseamDetailsModal').val(data['inseam']);
            $('#MeasurementAlterationsDetailsModal').val(data['alterations']);

          },
        error: 
          function(data){
            console.log(data);
          }
      });

      $('.modal-tile').hide();
      $('#ActorDetailsModal').show();
      $("body").toggleClass("dialogIsOpen");
    });

    $(document).on('click','.removeActorButton', function(){
      $('#DeleteActorInput').val($(this).parents('.line-item-in-list').data('id'));
      $('#DeleteActorForm').submit();
    });

    $(document).on('click','.modal-close', function(){
      $('.modal-tile').hide();
      $("body").toggleClass("dialogIsOpen");
    });
    
    <? if(isset($POST)){?>
      window.scrollTo(0,document.body.scrollHeight);
    <?}?>

  });

</script>
</body>
</html>