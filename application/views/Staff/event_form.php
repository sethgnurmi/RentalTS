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
    
    <div class="col-sm-12 modal-tile set-center" style="width:500px; height:150px;" id="ActorDetailsModal" hidden>
      <div class="panel-inner">
        <div class="panel-title">Actor Details</div>
        <center><p style="font-size:18px; font-weight:bold;">Event form must be submitted before orders can be initiated</p></center>
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

    <form action="http://localhost/RentalTS/Staff/New" id="EventForm" method="post" accept-charset="utf-8">
    <input type="hidden" id="EventId" name="EventId" value="<?=$Event['EventId']?>">
    <div class="row">
      <div class="col-sm-12">
        <div class="row panel-header">
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff'">Staff Dashboard</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <div class="panel-header-button" onclick="window.location='<?=base_url();?>Staff/Events'">Events</div>
          <i class="fas fa-angle-right fa-1x"></i>
          <? if($Event['EventId'] <= 0){?>
          <div class="panel-header-button">New</div>
          <?}else{?>
          <div class="panel-header-button">Event <?=$Event['EventId'];?></div>
          <?}?>

        </div>
        <div class="row panel-container">

          <div class="col-sm-6 panel-tile" style="height:610px" id="EmptorInfo">
            <p class="form-heading-lg">Emptor</p>
            <div class="pf-c-divider" role="separator"></div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <label for="EmptorFirstName">First Name:</label>
                <input class="pf-c-form-control" id="EmptorFirstName" name="EmptorFirstName" placeholder="First Name" value="<?=$Event['EmptorFirstName'];?>"/>
              </div>
              <div class="col-sm-6">
                <label for="EmptorLastName">Last Name:</label>
                <input class="pf-c-form-control" id="EmptorLastName" name="EmptorLastName" placeholder="Last Name" value="<?=$Event['EmptorLastName'];?>"/>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-8">
                <label for="EmptorEmailAddress">Email Address:</label>
                <input class="pf-c-form-control" id="EmptorEmailAddress" name="EmptorEmailAddress" placeholder="Email Address" value="<?=$Event['EmptorEmailAddress'];?>"/>
              </div>
              <div class="col-sm-4">
                <label for="EmptorPhoneNumber">Phone Number:</label>
                <input class="pf-c-form-control" id="EmptorPhoneNumber" name="EmptorPhoneNumber" placeholder="Phone Number" value="<?=$Event['EmptorPhoneNumber'];?>"/>
              </div>
            </div>
            <br>
            <div class="emptor-shipping-div">
              <p class="form-heading-md">Shipping Address</p>
              <div class="pf-c-divider" role="separator"></div>
              <br>
              <div class="row">
                <div class="col-sm-8">
                  <label for="EmptorStreetAddressShipping">Street Address:</label>
                  <input class="pf-c-form-control" id="EmptorStreetAddressShipping" name="EmptorStreetAddressShipping" placeholder="Street Address" value="<?=$Event['EmptorStreetAddressShipping'];?>"/>
                </div>
                <div class="col-sm-4">
                  <label for="EmptorCityShipping">City:</label>
                  <input class="pf-c-form-control" id="EmptorCityShipping" name="EmptorCityShipping" placeholder="City" value="<?=$Event['EmptorCityShipping'];?>"/>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-4">
                  <label for="EmptorStateShipping">State:</label>
                  <select class="pf-c-form-control" id="EmptorStateShipping" name="EmptorStateShipping" value="<?=$Event['EmptorStateShipping'];?>">
                    <option value="-1">Select State</option>
                    <option value="GA">Georgia</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="EmptorZIPCodeShipping">ZIP Code:</label>
                  <input class="pf-c-form-control" id="EmptorZIPCodeShipping" name="EmptorZIPCodeShipping" placeholder="ZIP Code" value="<?=$Event['EmptorZIPCodeShipping'];?>"/>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <input type="checkbox" id="EmptorBillingIsSame" name="EmptorBillingIsSame" checked>
                  <label for="EmptorBillingIsSame">Billing Address is same as Shipping Address</label>
                </div>
              </div>
            </div>
            <div class="emptor-billing-div" hidden>
              <br>
              <p class="form-heading-md">Billing Address</p>
              <div class="pf-c-divider" role="separator"></div>
              <br>
              <div class="row">
                <div class="col-sm-8">
                  <label for="EmptorStreetAddressBilling">Street Address:</label>
                  <input class="pf-c-form-control" id="EmptorStreetAddressBilling" name="EmptorStreetAddressBilling" placeholder="Street Address" value="<?=$Event['EmptorStreetAddressBilling'];?>"/>
                </div>
                <div class="col-sm-4">
                  <label for="EmptorCityBilling">City:</label>
                  <input class="pf-c-form-control" id="EmptorCityBilling" name="EmptorCityBilling" placeholder="City" value="<?=$Event['EmptorCityBilling'];?>"/>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-4">
                  <label for="EmptorStateBilling">State:</label>
                  <select class="pf-c-form-control" id="EmptorStateBilling" name="EmptorStateBilling" value="<?=$Event['EmptorStateBilling'];?>">
                    <option value="-1">Select State</option>
                    <option value="GA">Georgia</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="EmptorZIPCodeBilling">ZIP Code:</label>
                  <input class="pf-c-form-control" id="EmptorZIPCodeBilling" name="EmptorZIPCodeBilling" placeholder="ZIP Code" value="<?=$Event['EmptorZIPCodeBilling'];?>"/>
                </div>
              </div>
            </div>
            <br>
          </div>

          <div class="col-sm-6 panel-tile" style="height:610px" id="ContactInfo">
            <p class="form-heading-lg">Contact</p>
            <div class="pf-c-divider" role="separator"></div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <label for="ContactFirstName">First Name:</label>
                <input class="pf-c-form-control" id="ContactFirstName" name="ContactFirstName" placeholder="First Name" value="<?=$Event['ContactFirstName'];?>"/>
              </div>
              <div class="col-sm-6">
                <label for="ContactLastName">Last Name:</label>
                <input class="pf-c-form-control" id="ContactLastName" name="ContactLastName" placeholder="Last Name" value="<?=$Event['ContactLastName'];?>"/>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-8">
                <label for="ContactEmailAddress">Email Address:</label>
                <input class="pf-c-form-control" id="ContactEmailAddress" name="ContactEmailAddress" placeholder="Email Address" value="<?=$Event['ContactEmailAddress'];?>"/>
              </div>
              <div class="col-sm-4">
                <label for="ContactPhoneNumber">Phone Number:</label>
                <input class="pf-c-form-control" id="ContactPhoneNumber" name="ContactPhoneNumber" placeholder="Phone Number" value="<?=$Event['ContactPhoneNumber'];?>"/>
              </div>
            </div>
            <br>
            <div class="contact-shipping-div">
              <p class="form-heading-md">Shipping Address</p>
              <div class="pf-c-divider" role="separator"></div>
              <br>
              <div class="row">
                <div class="col-sm-8">
                  <label for="ContactStreetAddressShipping">Street Address:</label>
                  <input class="pf-c-form-control" id="ContactStreetAddressShipping" name="ContactStreetAddressShipping" placeholder="Street Address" value="<?=$Event['ContactStreetAddressShipping'];?>"/>
                </div>
                <div class="col-sm-4">
                  <label for="ContactCityShipping">City:</label>
                  <input class="pf-c-form-control" id="ContactCityShipping" name="ContactCityShipping" placeholder="City" value="<?=$Event['ContactCityShipping'];?>"/>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-4">
                  <label for="ContactStateShipping">State:</label>
                  <select class="pf-c-form-control" id="ContactStateShipping" name="ContactStateShipping" value="<?=$Event['ContactStateShipping'];?>">
                    <option value="-1">Select State</option>
                    <option value="GA">Georgia</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="ContactZIPCodeShipping">ZIP Code:</label>
                  <input class="pf-c-form-control" id="ContactZIPCodeShipping" name="ContactZIPCodeShipping" placeholder="ZIP Code" value="<?=$Event['ContactZIPCodeShipping'];?>"/>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <input type="checkbox" id="ContactBillingIsSame" name="ContactBillingIsSame" checked>
                  <label for="ContactBillingIsSame">Billing Address is same as Shipping Address</label>
                </div>
              </div>
            </div>
            <div class="contact-billing-div" hidden>
              <br>
              <p class="form-heading-md">Billing Address</p>
              <div class="pf-c-divider" role="separator"></div>
              <br>
              <div class="row">
                <div class="col-sm-8">
                  <label for="ContactStreetAddressBilling">Street Address:</label>
                  <input class="pf-c-form-control" id="ContactStreetAddressBilling" name="ContactStreetAddressBilling" placeholder="Street Address" value="<?=$Event['ContactStreetAddressBilling'];?>"/>
                </div>
                <div class="col-sm-4">
                  <label for="ContactCityBilling">City:</label>
                  <input class="pf-c-form-control" id="ContactCityBilling" name="ContactCityBilling" placeholder="City" value="<?=$Event['ContactCityBilling'];?>"/>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-4">
                  <label for="ContactStateBilling">State:</label>
                  <select class="pf-c-form-control" id="ContactStateBilling" name="ContactStateBilling">
                    <option value="-1">Select State</option>
                    <option value="GA">Georgia</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="ContactZIPCodeBilling">ZIP Code:</label>
                  <input class="pf-c-form-control" id="ContactZIPCodeBilling" name="ContactZIPCodeBilling" placeholder="ZIP Code" value="<?=$Event['ContactZIPCodeBilling'];?>"/>
                </div>
              </div>
            </div>
            <br>
          </div>
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
                <input class="pf-c-form-control" type="text" id="EventName" name="EventName" placeholder="Event Name" value="<?=$Event['EventName'];?>"/>
              </div>
              <div class="col-sm-3">
                <label for="EventType">Event Type:</label>
                <input class="pf-c-form-control" type="text" id="EventType" name="EventType" placeholder="Event Type" value="<?=$Event['EventType'];?>"/>
              </div>
              <div class="col-sm-3">
                <label for="EventProductionDate">Production Date:</label>
                <br>
                <div class="pf-c-date-picker">
                  <div class="pf-c-date-picker__input">
                    <div class="pf-c-input-group">
                      <input class="pf-c-form-control" type="text" id="EventProductionDate" name="EventProductionDate" aria-label="Date picker"  value="<?=$Event['EventProductionDate'];?>"/>
                      <button class="pf-c-button pf-m-control" type="button" aria-label="Toggle date picker">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <label for="EventFulfillmentDeadlineDate">Fulfillment Deadline:</label>
                <br>
                <div class="pf-c-date-picker">
                  <div class="pf-c-date-picker__input">
                    <div class="pf-c-input-group">
                      <input class="pf-c-form-control" type="text" id="EventFulfillmentDeadlineDate" name="EventFulfillmentDeadlineDate" aria-label="Date picker"  value="<?=$Event['EventFulfillmentDeadlineDate'];?>"/>
                      <button class="pf-c-button pf-m-control" type="button" aria-label="Toggle date picker">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-12">
                <label for="EventDescription">Event Description:</label>
                <textarea class="pf-c-form-control" style="max-width: 100%; min-width: 100%;" maxlength="250" id="EventDescription" name="EventDescription" placeholder="Event Description"><?=$Event['EventDescription'];?></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="row panel-container">
          <div class="col-sm-12 panel-tile" style="height:80px;" id="EventSubmit">
            <div class="row" style="height:100%;">
              <div class="col-sm-3"><p></p></div>
              <div class="col-sm-6" style="height:100%;">
                <center>
                  <button type="submit" name="SubmitEventButton" class="pf-c-button pf-m-primary set-center">Submit Event</button>
                </center>
              </div>
              <div class="col-sm-3" style="height:100%;">
                <? if($Event['EventId'] > 0){?>
                <button type="button" name="SubmitEventButton" class="pf-c-button pf-m-primary set-center"  style="float:right;" onclick="window.location='<?=base_url();?>Staff/Actors/<?=$Event['EventId']?>'">Continue to Actors</button>
                <?}?>
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
    var itemCounter = 0;
    var actorCounter = 0;
    $('#EmptorBillingIsSame').change(function(){
      if(this.checked)
      {
        $('.emptor-billing-div').hide();
      }  
      else
      {
        $('.emptor-billing-div').show();
        $("#EmptorInfo").animate({ scrollTop: $('#EmptorInfo').prop("scrollHeight")}, 1000);
      }
      
    });

    $('#ContactBillingIsSame').change(function(){
      if(this.checked)
      {
        $('.contact-billing-div').hide();
      }  
      else
      {
        $('.contact-billing-div').show();
        $("#ContactInfo").animate({ scrollTop: $('#ContactInfo').prop("scrollHeight")}, 1000);
      }
      
    });

    $(document).on('click','.startOrderButton', function(){
      $('.modal-tile').hide();
      $('#StartOrderModal').show();
      $("body").toggleClass("dialogIsOpen");
    });

    $(document).on('click','.viewActorDetailsButton', function(){
      $('.modal-tile').hide();
      $('#ActorDetailsModal').show();
      $("body").toggleClass("dialogIsOpen");
    });

    $(document).on('click','.removeActorButton', function(){
      $('.modal-tile').hide();
      $('#RemoveActorModal').show();
      $("body").toggleClass("dialogIsOpen");
    });

    $(document).on('click','.modal-close', function(){
      $('.modal-tile').hide();
      $("body").toggleClass("dialogIsOpen");
    });
    
    $('#AddActorButton').click(function(){
      actorCounter++;
      console.log($('#ActorName').val());
      console.log($('#ActorRole').val());
      var html = '';
       html += '<div class="row line-item-in-list">';
       html += '<input type="hidden" name="li_Name' + actorCounter + '" value="' + $('#ActorName').val() + '"/>';
       html += '<input type="hidden" name="li_Role' + actorCounter + '" value="' + $('#ActorRole').val() + '"/>';
       html += '<div class="col-sm-6 line-item-detail"><strong>Actor:</strong> ' + $('#ActorName').val() + '</div>'; 
       html += '<div class="col-sm-6 line-item-detail"><strong>Role:</strong> ' + $('#ActorRole').val() + '</div>';
       html += '<div class="col-sm-4 line-item-detail"><center><p class="view-a startOrderButton">Start Order</p></center></div>';
       html += '<div class="col-sm-4 line-item-detail"><center><p class="view-a viewActorDetailsButton">Actor Details</p></center></div>';
       html += '<div class="col-sm-4 line-item-detail"><center><p class="view-a removeActorButton">Remove Actor</p></center></div>';
       html += '</div>';
      $('#ActorList').append(html);
    });

  });

</script>
</body>
</html>