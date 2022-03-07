<?php 
use Cake\I18n\FrozenTime;

?>

<style>
  .control-label{
    padding:5px;
  }
</style>

<div class="row">

  <div class="col-md-12">

    <div class="box box-solid">
        <div class="box-header with-border">
            <i class="fa fa-th"></i>
            <h3 class="box-title"><?php echo __('Rooms'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body text-center">
            <p>Select a room and complete details in the form below</p>

            <?php echo $this->element('room_grid'); ?>

        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="box box-solid">
        <div class="box-header with-border">
            <i class="fa fa-info"></i>
            <h3 class="box-title"><?php echo __('Room Availability'); ?></h3>
            <!-- /.box-header -->
        </div>
        
        <div class="box-body">
            <ol>
                <li>Selected rooms will appear below here. Apply any discounts to re-calculate the total</li>
                <li>Select check in and check out dates for the booking</li>
            </ol>

            <!-- form start -->
            <?php echo $this->Form->create($booking, ['role' => 'form']); ?>  
                <div class="box-body">
                    <?php
                        $this->Form->setTemplates([
                        'inputContainer' => '<div class="form-group input col-md-4 {{type}} {{required}}">{{content}}</div>'
                        ]);
                        echo $this->Form->input('check_availability', ['type' => 'hidden', 'value' => true]);
                        echo $this->Form->control('check_in_date', ['value' => FrozenTime::now(), 'disabled' => true]);
                        echo $this->Form->control('check_out_date', ['value' => FrozenTime::now()->modify('+1 day'), 'disabled' => true]);
                    ?>
                    <!-- /.box-header -->
                    <div id="selected-rooms-table" class="box-body table-responsive no-padding col-md-10">

                    </div>
                      <!--<table class="table table-hover" id="rooms-booking" width="100%">
                        <thead>
                          <tr>
                              <th class="sorting"><a>Room Number</a></th>
                              <th scope="col"><a>Rate</a></th>
                              <th scope="col"><a>Discount</a></th>
                              <th scope="col"><a>Total</a></th>
                              <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                              <th colspan="3"></th>
                              <th colspan="2">Sum Total</th>
                            </tr>
                            </tfoot>           
                      </table>-->
                    <!-- /.box-body -->
                    <div id="selected-rooms-form">
                        
                    </div>
                <!-- /.box-body -->
                </div>                 
            <?php echo $this->Form->submit(__('Confirm Availability'), ['id' => 'check-availability-button', 'disabled' => true]); ?>
            <?php echo $this->Form->end(); ?>
        
        <!-- /.box-body -->
        </div>
    <!-- /.box -->
    </div>

    <!-- /.col-md-12 -->
  </div>
<!-- /.row -->
</div>

<?php $this->start('scriptBottom'); ?>
<script>

$(function() {
    var tableDiv = $('#selected-rooms-table');
    drawTable();
    tableDiv.hide();
});
  
    var selectedRoomsMap = {};
    let count = 0;
    let rowCount = 0;
    let roomNumbers = [];
   
    function processRoomButtonClick(button, room_type, room_type_desc, room_rate, room_number, room_id){
      selectedRoomsMap[room_number] = {type: room_type, type_desc: room_type_desc, rate: room_rate, id: room_id, created:Date.now()}; //add the room to selectedRoomsMap
      if (button.classList.contains("active")) { //Manage the button's state
        button.classList.remove("active");
        delete selectedRoomsMap[room_number];
      } else { button.classList.add("active");
        
        
        
      }
      newTableRow(room_number);
      validate(button);
      //redrawForm(button,room_number);//render the form with all rooms
    }

    function removeRoom(room_num){
      console.log("#"+room_num)
      $("#"+room_num).remove();
      delete selectedRoomsMap[room_num];
      var button = document.getElementById('room_'+room_num);    
      if (button.classList.contains("active")) { //Manage the button's state
        button.classList.remove("active");
        delete selectedRoomsMap[room_num];
      } else button.classList.add("active");
      validate(button);
    }

    function drawTable(){
      console.log('DrawTable called...');
      var tableDiv = $('#selected-rooms-table');
      if(tableDiv.empty()){
        tableDiv.append('<table class="table table-hover" id="rooms-booking">'
          +'<thead>'
          +'  <tr>'
          +'      <th class="sorting"><a>Room Number</a></th>'
          +'      <th scope="col"><a>Rate</a></th>'
          +'      <th scope="col"><a>Discount</a></th>'
          +'      <th scope="col"><a>Total</a></th>'
          +'      <th scope="col" class="actions text-center"><?= __('Actions') ?></th>'
          +'  </tr>'
          +'</thead>'
          +'<tbody>'
          //+'<tr>'
          //+'</tr>'
          +'</tbody>'
          +'<tfoot>'
          + '<tr>'
          +   '<td colspan="3"></td>'
          +   '<th colspan="2">Sum Total: <input id="total" name="" type="text" class="form-control" placeholder="0.00"></th>'
          +'</tr>'        
          +'</tfoot>  '         
          +'</table>');
      }
    }

    function newTableRow(room_number){
      //console.log('newTableRow called');
      var room_num = room_number;
      var data = selectedRoomsMap[room_number];

      $('#rooms-booking tbody').append(
        '<tr id="'+room_num+'">'
          +'<td>'+room_num+'</td>'
          +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room]]" type="hidden" class="form-control" value="'+data.id+'"></td>'
          +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type]]" type="hidden" class="form-control" value="'+data.type+'"></td>'
          +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type_desc]]" type="hidden" class="form-control" value="'+data.type_desc+'"></td>'
          +'<td><input class="roomRate" id="booking_rooms-'+room_num+'-rate" readonly name="booking_rooms['+room_num+'][rate]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="Cost Per Night" value="'+data.rate+'"></td>'
          +'<td><input class="roomDiscount" id="booking_rooms-'+room_num+'-discount" name="booking_rooms['+room_num+'][discount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.00" value="'+0.0+'"></td>'
          +'<td><input class="roomAmount" id="booking_rooms-'+room_num+'-amount" name="booking_rooms['+room_num+'][amount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.0" value="'+(data.rate-0.0)+'"></td>'
          +'<td><button type="button" class="btn btn-danger" onClick="removeRoom('+room_num+');"><i class="fa fa-remove"></i></button></td>'
        +'</tr>'
      );
      
      //console.log($('#rooms-booking tbody tr').html());
    }

    function validate(button){
      var tableDiv = $('#selected-rooms-table');
      var submitButton = document.getElementById('check-availability-button');
      if(Object.keys(selectedRoomsMap).length > 0){
        tableDiv.show();
        checkDateChange(selectedRoomsMap,submitButton);
        checkDate(selectedRoomsMap,submitButton);         

      }else{ 
        tableDiv.empty();
        count = 0; 
        roomNumbers = [];      
        submitButton.disabled = true;
        $('#check-in-date').attr('disabled',true);
        $('#check-out-date').attr('disabled',true);
        $('#check-availability-button').removeClass('btn-danger');
        $('#check-availability-button').addClass('btn-success');
        $('#check-availability-button').prop("value","Confirm Availability");
      }
      //console.log(submitButton);

      bookingTotal(); 
      //dynamicTable(selectedRoomsMap);   

    }

    function redrawForm(button,number){
      
      var formDiv = document.getElementById('selected-rooms-form');
      var tableDiv = $('#selected-rooms-table');
      var tbody = $('#rooms-booking tbody');
      var submitButton = document.getElementById('check-availability-button');

      formDiv.innerHTML = '';
      //tableDiv.empty();
      //tbody.empty();

      if(Object.keys(selectedRoomsMap).length > 0){

        var room_num = number;
        var data = selectedRoomsMap[number]

            $('#rooms-booking tbody').append(
              '<tr id="'+room_num+'">'
                +'<td>'+room_num+'</td>'
                +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room]]" type="hidden" class="form-control" value="'+data.id+'"></td>'
                +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type]]" type="hidden" class="form-control" value="'+data.type+'"></td>'
                +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type_desc]]" type="hidden" class="form-control" value="'+data.type_desc+'"></td>'
                +'<td><input class="roomRate" id="booking_rooms-'+room_num+'-rate" readonly name="booking_rooms['+room_num+'][rate]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="Cost Per Night" value="'+data.rate+'"></td>'
                +'<td><input class="roomDiscount" id="booking_rooms-'+room_num+'-discount" name="booking_rooms['+room_num+'][discount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.00" value="'+0.0+'"></td>'
                +'<td><input class="roomAmount" id="booking_rooms-'+room_num+'-amount" name="booking_rooms['+room_num+'][amount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.0" value="'+(data.rate-0.0)+'"></td>'
                +'<td><button type="button" class="btn btn-danger" onClick="removeRoom('+room_num+');"><i class="fa fa-remove"></i></button></td>'
              +'</tr>'
            );              
        
        /*
        formDiv.innerHTML = '<div class="row col-md-12">'          
          +'<div class="col-md-2">Room Number</div>'
          +'<div class="col-md-3">Rate</div>'
          +'<div class="col-md-2">Discount</div>'
          +'<div class="col-md-3">Total</div>'
          +'<div class="col-md-2">Remove</div>'
          +'</div>';*/          

        for(const [room_num, data] of Object.entries(selectedRoomsMap)) { 
          
          //console.log($('#rooms-booking tbody').empty());

          /*if($('#rooms-booking tbody').empty()){
            $('#rooms-booking tbody').append(
              '<tr id="'+room_num+'">'
                +'<td>'+room_num+'</td>'
                +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room]]" type="hidden" class="form-control" value="'+data.id+'"></td>'
                +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type]]" type="hidden" class="form-control" value="'+data.type+'"></td>'
                +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type_desc]]" type="hidden" class="form-control" value="'+data.type_desc+'"></td>'
                +'<td><input class="roomRate" id="booking_rooms-'+room_num+'-rate" readonly name="booking_rooms['+room_num+'][rate]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="Cost Per Night" value="'+data.rate+'"></td>'
                +'<td><input class="roomDiscount" id="booking_rooms-'+room_num+'-discount" name="booking_rooms['+room_num+'][discount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.00" value="'+0.0+'"></td>'
                +'<td><input class="roomAmount" id="booking_rooms-'+room_num+'-amount" name="booking_rooms['+room_num+'][amount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.0" value="'+(data.rate-0.0)+'"></td>'
                +'<td><button type="button" class="btn btn-danger" onClick="removeRoom('+room_num+');"><i class="fa fa-remove"></i></button></td>'
              +'</tr>'
            );              
          }

          //console.log(selectedRoomsMap);
          //console.log(room_num);
          if(roomNumbers.indexOf(room_num) === -1) {
            console.log(room_num);
            roomNumbers.push(room_num)
            if(count == 0){
              console.log('table is empty')
              $('#rooms-booking tbody').append(
                '<tr id="'+room_num+'">'
                  +'<td>'+room_num+'</td>'
                  +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room]]" type="hidden" class="form-control" value="'+data.id+'"></td>'
                  +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type]]" type="hidden" class="form-control" value="'+data.type+'"></td>'
                  +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type_desc]]" type="hidden" class="form-control" value="'+data.type_desc+'"></td>'
                  +'<td><input class="roomRate" id="booking_rooms-'+room_num+'-rate" readonly name="booking_rooms['+room_num+'][rate]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="Cost Per Night" value="'+data.rate+'"></td>'
                  +'<td><input class="roomDiscount" id="booking_rooms-'+room_num+'-discount" name="booking_rooms['+room_num+'][discount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.00" value="'+0.0+'"></td>'
                  +'<td><input class="roomAmount" id="booking_rooms-'+room_num+'-amount" name="booking_rooms['+room_num+'][amount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.0" value="'+(data.rate-0.0)+'"></td>'
                  +'<td><button type="button" class="btn btn-danger" onClick="removeRoom('+room_num+');"><i class="fa fa-remove"></i></button></td>'
                +'</tr>'
              );              
            } 

          };
          //console.log(roomNumbers);

          
          formDiv.innerHTML +='<div class="row col-md-12 roomBooking">'
            +'<div class="col-md-2">'+room_num+'</div>'
            +'<div><input name="booking_rooms['+room_num+'][room]]" type="hidden" class="form-control" value="'+data.id+'"></div>'
            +'<div><input name="booking_rooms['+room_num+'][room_type]]" type="hidden" class="form-control" value="'+data.type+'"></div>'
            +'<div><input name="booking_rooms['+room_num+'][room_type_desc]]" type="hidden" class="form-control" value="'+data.type_desc+'"></div>'
            +'<div class="col-md-3"><input class="roomRate" id="booking_rooms-'+room_num+'-rate" disabled name="booking_rooms['+room_num+'][rate]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="Cost Per Night" value="'+data.rate+'"></div>'
            +'<div class="col-md-2"><input class="roomDiscount" id="booking_rooms-'+room_num+'-discount" name="booking_rooms['+room_num+'][discount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.00" value="'+0.0+'"></div>'
            +'<div class="col-md-3"><input class="roomAmount" id="booking_rooms-'+room_num+'-amount" name="booking_rooms['+room_num+'][amount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.0" value="'+(data.rate-0.0)+'"></div>'
            +'<div class="col-md-2"><button type="button" class="btn btn-danger" onClick="removeRoom('+room_num+');"><i class="fa fa-remove"></i></button></div>'
            +'<br>'
            +'<br>'
            +'</div>';
            
            //console.log(Object.keys(selectedRoomsMap).length);            
            if($('#rooms-booking tbody').empty()){
              $('#rooms-booking tbody').append(
                '<tr id="'+room_num+'">'
                  +'<td>'+room_num+'</td>'
                  +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room]]" type="hidden" class="form-control" value="'+data.id+'"></td>'
                  +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type]]" type="hidden" class="form-control" value="'+data.type+'"></td>'
                  +'<td style="display:none;"><input name="booking_rooms['+room_num+'][room_type_desc]]" type="hidden" class="form-control" value="'+data.type_desc+'"></td>'
                  +'<td><input class="roomRate" id="booking_rooms-'+room_num+'-rate" readonly name="booking_rooms['+room_num+'][rate]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="Cost Per Night" value="'+data.rate+'"></td>'
                  +'<td><input class="roomDiscount" id="booking_rooms-'+room_num+'-discount" name="booking_rooms['+room_num+'][discount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.00" value="'+0.0+'"></td>'
                  +'<td><input class="roomAmount" id="booking_rooms-'+room_num+'-amount" name="booking_rooms['+room_num+'][amount]]" onkeyup="roomBookingTotal('+room_num+');" type="text" class="form-control" placeholder="0.0" value="'+(data.rate-0.0)+'"></td>'
                  +'<td><button type="button" class="btn btn-danger" onClick="removeRoom('+room_num+');"><i class="fa fa-remove"></i></button></td>'
                +'</tr>'
              );              
            } */ 

            count=count+1; 
        }; 

        /*
        formDiv.innerHTML += '<div class="row col-md-12">'
          +'<div class="col-md-2">Sum Total: <input id="total1" name="" type="text" class="form-control" placeholder="0.00">'
          +'</div>';*/

        checkDateChange(selectedRoomsMap,submitButton);
        checkDate(selectedRoomsMap,submitButton);         

      }else{ 
        tableDiv.empty();
        count = 0; 
        roomNumbers = [];      
        submitButton.disabled = true;
        $('#check-in-date').attr('disabled',true);
        $('#check-out-date').attr('disabled',true);
        $('#check-availability-button').removeClass('btn-danger');
        $('#check-availability-button').addClass('btn-success');
        $('#check-availability-button').prop("value","Confirm Availability");
      }
      //console.log(submitButton);

      bookingTotal(); 
      //dynamicTable(selectedRoomsMap);     

    }        
    
    function checkDateChange(selectedRoomsMap,submitButton){
      $('#check-out-date').change(function(){
        checkDate(selectedRoomsMap,submitButton)                  
      });

      $('#check-in-date').change(function(){
        checkDate(selectedRoomsMap,submitButton)                  
      });

    }
    
    function checkDate(selectedRoomsMap,submitButton){
      $('#check-in-date').removeAttr('disabled');
      $('#check-out-date').removeAttr('disabled');
      var start = $('#check-in-date').val();
      var end  = $('#check-out-date').val();   
      var startDate = new Date(start);
      var endDate   = new Date(end);
      
      //check date must be valid
      if($('#check-in-date').val()){        

        if(endDate.getTime() >= startDate.getTime() && selectedRoomsMap){            
          $('#check-availability-button').removeClass('btn-danger');
          $('#check-availability-button').addClass('btn-success');
          $('#check-availability-button').prop("value", "Confirm Availability");
          submitButton.disabled = false; 

        }else{
          submitButton.disabled = true;
          $('#check-availability-button').prop("value", "Invalid date");
          $('#check-availability-button').addClass('btn-danger');
          //alert('Check-Out date must be greater than or equal to Check-in date');            
        }

      }else{
        alert('Please select check In date');
        $('#check-out-date').val('')
        $('#check-availability-button').value('Invalid Date')
      }            
    
    }

    function roomBookingTotal(room_num) {
      var rate = parseFloat($('#booking_rooms-' + room_num + '-rate').val())
      var discount = $('#booking_rooms-' + room_num + '-discount').val();
      var total = rate - discount
      $('#booking_rooms-' + room_num + '-amount').val(total.toFixed(2))
      bookingTotal();      
    }

    function bookingTotal(){
      var roomTotal = 0.00
      $('.roomAmount').each(function() {
        var checkval = parseFloat(this.value);
        if (!isNaN(checkval)) roomTotal += checkval;
      });
      $('#total').val(roomTotal.toFixed(2));
    }

    function dynamicTable(selectedRoomsMap){
      $('#rooms-booking').DataTable( {
        destroy : true,
        data: selectedRoomsMap,
        columns: [
          {data: "room_number"},
          {data: "rate"},
          {data: "discount"},
          {data: "total"},
          {data: null}
        ],
    } );

    }
    
    
</script>
<?php $this->end(); ?>