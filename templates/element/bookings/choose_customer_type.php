<div id="select-customer-type-panel" class="row">

  <div class="col-md-6 center">


    <div class="col-md-6">
      <div class="box box-solid">
          <div class="box-header with-border">
              <i class="fa fa-info"></i>
              <h3 class="box-title"><?php echo __('New Customer'); ?></h3>
              <!-- /.box-header -->
          </div>
          
          <div class="box-body">
              <p>New Customer</p>   
              <button onClick="hideCustomerSelectPanel();">Continue</button>
              <script>
                function hideCustomerSelectPanel(){
                  document.getElementById('select-customer-type-panel').innerHTML = '';
                }
              </script>
          <!-- /.box-body -->
          </div>
      <!-- /.box -->
      </div>
    </div>
    



    <div class="col-md-6">
      <div class="box box-solid">
          <div class="box-header with-border">
              <i class="fa fa-info"></i>
              <h3 class="box-title"><?php echo __('Existing Customer'); ?></h3>
              <!-- /.box-header -->
          </div>
          
          <div class="box-body">
              <p>Existing Customer</p>        
              <button>Search Customer</button>
          <!-- /.box-body -->
          </div>
      <!-- /.box -->
      </div>
    </div>

    <!-- /.col-md-12 -->
  </div>
<!-- /.row -->
</div>


<script>
    var selectedRoomsMap = {};

    // function renderButtons(d){
    //   var buttonDiv = document.getElementById('room-buttons');
    //   buttonDiv.innerHTML+= '<div class="col-md-2">'
    //     +'<button type="button" class="btn btn-block btn-default" '
    //     +'id="room_'+d.room_number+'" onClick="addRoom(this, '+d.room_number+', '+d.room_type.rate+');">'
    //     + d.room_number+'</button></div>';
    // }

    function addRoom(button, room_number, rate){
      console.log(room_number);
      selectedRoomsMap[room_number] = rate; //add the room to selectedRoomsMap
      if (button.classList.contains("active")) { //Manage the button's state
        button.classList.remove("active");
        delete selectedRoomsMap[room_number];
      } else button.classList.add("active");
      redrawForm(button);//render the form with all rooms
    }


    function removeRoom(room){
      delete selectedRoomsMap[room];
      var button = document.getElementById('room_'+room);    
      if (button.classList.contains("active")) { //Manage the button's state
        button.classList.remove("active");
        delete selectedRoomsMap[room];
      } else button.classList.add("active");
      redrawForm(button);
    }


    function redrawForm(button){
      console.log(selectedRoomsMap);

      var formDiv = document.getElementById('selected-rooms-form');
      var submitButton = document.getElementById('check-availability-button');         

      formDiv.innerHTML = '';
      if(Object.keys(selectedRoomsMap).length > 0){
        formDiv.innerHTML = '<div class="row col-md-12">'
          +'<div class="col-md-2">Room Number</div>'
          +'<div class="col-md-3">Rate</div>'
          +'<div class="col-md-2">Discount</div>'
          +'<div class="col-md-3">Total</div>'
          +'<div class="col-md-2">Remove</div>'
          +'</div>';
        let count = 0;
        for(const [room, rate] of Object.entries(selectedRoomsMap)) {
          formDiv.innerHTML +='<div class="row col-md-12">'
            +'<div class="col-md-2">'+room+'</div>'
            +'<div class="col-md-3"><input name="BookingRooms['+room+'][rate]]" type="text" class="form-control" placeholder="Cost Per Night" value="'+rate+'"></div>'
            +'<div class="col-md-2"><input name="BookingRooms['+room+'][discount]]" type="text" class="form-control" placeholder="0.00" value="'+0.0+'"></div>'
            +'<div class="col-md-3"><input name="BookingRooms['+room+'][total]]" type="text" class="form-control" placeholder="0.0" value="'+(rate-0.0)+'"></div>'
            +'<div class="col-md-2"><button type="button" class="btn btn-danger" onClick="removeRoom('+room+');"><i class="fa fa-remove"></i></button></div>'
            +'</div>';         
            count=count+1; 
        };
        formDiv.innerHTML += '<div class="row col-md-12">'
          +'<div class="col-md-2">Sum Total: <input name="" type="text" class="form-control" placeholder="0.00">'
          +'</div>';   

        submitButton.disabled = false;          
      }else{
        submitButton.disabled = true;
      }
      console.log(submitButton);
    }
</script>