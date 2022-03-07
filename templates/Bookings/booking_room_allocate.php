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
      <small><?php echo __('Allocate Roomm'); ?></small>
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
            <h3 class="box-title"><?php echo __('Allocate Booking Room'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($room, ['role' => 'form']); ?> 
            <div class="box-body">
              <?php
                echo $this->Form->control('room_type',['type' => 'hidden']);
                echo $this->Form->control('room_type_desc',['disabled' => true]);
                echo $this->Form->control('room', ['options' => $options, 'onChange' => 'setRoomNum(this);']);
                echo $this->Form->control('room_desc', ['readonly' => true]);
              ?>
            </div>
            <!-- /.box-body -->

          <?php echo $this->Form->submit(__('Submit')); ?>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>

<script>
   function setRoomNum(list){
      var text = $("#room option:selected").text();
      $("#room-desc").val(text);
   }
</script>