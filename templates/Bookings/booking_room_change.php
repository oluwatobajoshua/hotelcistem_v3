<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
//pr($room);
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Booking Room
      <small><?php echo __('Change'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'view', $room['data']['booking']]); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Back'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Change Booking Room'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($room, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                $this->Form->setTemplates([
                  'inputContainer' => '<div class="form-group input col-md-2 {{type}} {{required}}">{{content}}</div>'
                ]);

                echo $this->Form->control('booking', ['readonly' => true, 'label' => 'Booking ID']);
                echo $this->Form->control('room_type', ['type' => 'hidden']);
                echo $this->Form->control('room', ['type' => 'hidden']);
                echo $this->Form->control('room_type_desc', ['readonly' => true, 'label' => 'Room Type']);
                echo $this->Form->control('room_desc', ['readonly' => true, 'label' => 'Current Room']);                
                echo $this->Form->control('new_room_type', ['label' => 'Select New Room Type', 'onChange' => 'refreshRoomList(this);', 'options' => [null =>'Select One']]);    
                echo $this->Form->control('new_room_type_desc', ['type' => 'hidden']);
                echo $this->Form->control('new_room', ['label' => 'Select New Room', 'onChange' => 'setNewRoom(this);', 'options' => [null =>'Select One']]);
                echo $this->Form->control('new_room_desc', ['type' => 'hidden']);
                echo $this->Form->submit(__('Submit'));
              ?>
            </div>
            <!-- /.box-body -->

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>


<script>
  var roomTypesMap = {};
  var roomTypeSelectList = document.getElementById('new-room-type');
  var roomSelectList = document.getElementById('new-room');
  

  //fetch('http://localhost:3000/room-types')
  fetch('http://ec2-3-145-118-240.us-east-2.compute.amazonaws.com:3000/room-types')
      .then(response => response.json())
      .then(data => {             console.log(data);
      data.forEach(d => {
        //console.log(d);
        roomTypesMap[d._id] = d;      
        
        
        var option = document.createElement('option');

        option.value = d._id;
        option.text = d.name;
        roomTypeSelectList.appendChild(option);
          //renderButtons(d);                
      });
      //refreshRoomList(roomTypeSelectList);
  });

  function refreshRoomList(selectList){
    var empty = roomSelectList.childNodes[0];
    roomSelectList.innerHTML = "";
    roomSelectList.appendChild(empty);
    rooms = roomTypesMap[selectList.value].rooms;
    rooms.forEach(room => {
      var option = document.createElement('option');
      option.value = room._id;
      option.text = room.room_number;     
      
      roomSelectList.appendChild(option);
    });    
    var roomTypeText = $("#new-room-type option:selected").text();      
    $("#new-room-type-desc").val(roomTypeText);
  }


  function setNewRoom(list){
    var roomText = $("#new-room option:selected").text();
      $("#new-room-desc").val(roomText);
      
   }

        //document.getElementById('new-type').getTagName('option')
        //console.log(roomTypesMap);
</script>