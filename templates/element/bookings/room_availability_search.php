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
    //get table instance
    var tableDiv = $('#selected-rooms-table');

    //add table onload
    drawTable();

    //hide table onload
    tableDiv.hide();
});
  
    var selectedRoomsMap = {};

    function processRoomButtonClick(button, room_type, room_type_desc, room_rate, room_number, room_id){
      selectedRoomsMap[room_number] = {type: room_type, type_desc: room_type_desc, rate: room_rate, id: room_id, created:Date.now()}; //add the room to selectedRoomsMap
      if (button.classList.contains("active")) { //Manage the button's state
        button.classList.remove("active");
        delete selectedRoomsMap[room_number];
        $("#"+room_number).remove();//add remove row function
      } else button.classList.add("active");
      redrawForm(button,room_number);//render the form with the selected room
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
      redrawForm(button);
    }    

    //table scaphold
    function drawTable(){
      console.log('DrawTable called...');
      var tableDiv = $('#selected-rooms-table');
      if(tableDiv.empty()){
        tableDiv.append(
          '<table class="table table-hover" id="rooms-booking">'
          + '<thead>'
          +'  <tr>'
          +'   <th class="sorting"><a>Room Number</a></th>'
          +'   <th scope="col"><a>Rate</a></th>'
          +'   <th scope="col"><a>Discount</a></th>'
          +'   <th scope="col"><a>Total</a></th>'
          +'   <th scope="col" class="actions text-center"><?= __('Actions') ?></th>'
          +'  </tr>'
          +'</thead>'
          +'<tbody>'          
          +'</tbody>'
          +'<tfoot>'
          + '<tr>'
          +   '<td colspan="3"></td>'
          +   '<th colspan="2">Sum Total: <input id="total" name="" type="text" class="form-control" placeholder="0.00"></th>'
          +'</tr>'        
          +'</tfoot>  '         
          +'</table>'
        );
      }
    }

    function redrawForm(button,room_number){

      var tableDiv = $('#selected-rooms-table');
      var submitButton = document.getElementById('check-availability-button');

      if(Object.keys(selectedRoomsMap).length > 0){
        //display the table
        tableDiv.show();

        for(const [room_num, data] of Object.entries(selectedRoomsMap)) { 
            
          //Append select room only
          if(room_num === room_number){
            console.log(room_num,room_number);
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

        checkDateChange(selectedRoomsMap,submitButton);
        checkDate(selectedRoomsMap,submitButton);         

      }else{
        tableDiv.hide();        
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
        
</script>
<?php $this->end(); ?>