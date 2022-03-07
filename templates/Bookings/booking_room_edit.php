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
      <small><?php echo __('Edit'); ?></small>
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
            <h3 class="box-title"><?php echo __('Edit Booking Room'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($room, ['role' => 'form']); ?> 
            <div class="box-body">
              <?php
              
                //echo $this->Form->control('room', ['options' => $options, 'onChange' => 'setRoomNum(this);']);
                echo $this->Form->control('room_type_desc', ['readonly' => true]);
                echo $this->Form->control('room_desc', ['readonly' => true]);
                echo $this->Form->control('start_date');
                echo $this->Form->control('end_date');
                echo $this->Form->control('rate', ['disabled' => true]);
                echo $this->Form->control('discount');
                echo $this->Form->control('amount');
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

<?php $this->start('scriptBottom'); ?>
<script>

  $(function() {
    $('#discount').keyup(function(e){
      //console.log($('#discount').val());
      var rate = parseFloat($('#rate').val());
      var discount = $('#discount').val();
      var total = rate - discount;
      $('#amount').val(total.toFixed(2));
    });
  });

</script>
<?php $this->end(); ?>