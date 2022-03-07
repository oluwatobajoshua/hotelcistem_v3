<section class="content-header">
  <h1>
    Booking
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('Details'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('Booking Id') ?></dt>
            <dd><?= h($booking->_id) ?></dd>
            <dt scope="row"><?= __('Checkin Date') ?></dt>
            <dd><?= $this->Time->format($booking->check_in_date, 'dd/MM/YYYY hh:mm') ?></dd>
            <dt scope="row"><?= __('Checkout Date') ?></dt>
            <dd><?= $this->Time->format($booking->check_out_date, 'dd/MM/YYYY hh:mm') ?></dd>
            <dt scope="row"><?= __('Status') ?></dt>
            <dd><?= h($booking->status) ?></dd>
            <dt scope="row"><?= __('Customer Account ID') ?></dt>
            <dd><?= h($booking->customer['accountid']) ?></dd>
            <dt scope="row"><?= __('Phone') ?></dt>
            <dd><?= h($booking->customer['phone']) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= $this->Time->format($booking->createdAt, 'dd/MM/YYYY') ?></dd>
            <dt scope="row"><?= __('Last Updated') ?></dt>
            <dd><?= $this->Time->format($booking->updatedAt, 'dd/MM/YYYY') ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Booking Rooms') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <?php if (!empty($booking->booking_rooms)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Room Type') ?></th>
                    <th scope="col"><?= __('Room Num') ?></th>
                    <th scope="col"><?= __('Start Date') ?></th>
                    <th scope="col"><?= __('End Date') ?></th>
                    <th scope="col"><?= __('Rate') ?></th>
                    <th scope="col"><?= __('Discount') ?></th>
                    <th scope="col"><?= __('Amount') ?></th>
                    <th scope="col"><?= __('Status') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($booking->booking_rooms as $room): //debug($branches)?>
              <tr>
                    <td><?= h($room['room_type_desc']) ?></td>
                    <td><?= h($room['room_desc']) ?></td>
                    <td><?= $this->Time->format($room['start_date'], 'dd/MM/YYYY') ?></td>
                    <td><?= $this->Time->format($room['end_date'], 'dd/MM/YYYY') ?></td>
                    <td><?= h(@$room['rate']) ?></td>
                    <td><?= h(@$room['discount']) ?></td>
                    <td><?= h($room['amount']) ?></td>
                    <td><?= h($room['status']) ?></td>
                      <td class="actions text-right">
                        <?php  
                          //Only available to rooms that have status [reserved, checkin]
                          if (in_array($room['status'], ['reserve', 'checkin'])): ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Bookings', 'action' => 'booking_room_edit', $booking->_id, $room['_id']], ['class'=>'btn btn-info btn-xs']) ?>
                            <?= $this->Html->link(__('Change'), ['controller' => 'Bookings', 'action' => 'booking_room_change', $booking->_id, $room['_id']], ['class'=>'btn btn-warning btn-xs']) ?>
                            <?php if ($room['status'] == "reserve") { 
                              if (empty($room['room'])) {
                                ?> 
                                  <?= $this->Html->link(__('Allocate'), ['controller' => 'Bookings', 'action' => 'booking_room_allocate', $booking->_id, $room['_id']], ['class'=>'btn btn-warning btn-xs']) ?>
                                <?php
                              } else {
                                ?>
                                  <?= $this->Form->postLink(__('Check In'), ['controller' => 'Bookings', 'action' => 'booking_room_checkin', $booking->_id, $room['_id']], ['confirm' => __('Are you sure you want to checkin # {0}?', $room['room_desc']), 'class'=>'btn btn-warning btn-xs']) ?>
                                <?php
                              }
                              ?>                              
                              
                              <?= $this->Form->postLink(__('Cancel'), ['controller' => 'Bookings', 'action' => 'booking_room_cancel', $booking->_id, $room['_id']], ['confirm' => __('Are you sure you want to cancel # {0}?', $room['room_desc']), 'class'=>'btn btn-danger btn-xs']) ?>
                            <?php } else if ($room['status'] == "checkin") { ?>
                              <?= $this->Form->postLink(__('Check Out'), ['controller' => 'Bookings', 'action' => 'booking_room_checkout', $booking->_id, $room['_id']], ['confirm' => __('Are you sure you want to checkout # {0}?', $room['room_desc']), 'class'=>'btn btn-warning btn-xs']) ?>
                          <?php }; 
                        endif; ?>

                  </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title"><?= __('Bill') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $this->Text->autoParagraph(@$booking->remark); ?>
        </div>
      </div>
    </div>
  </div>
</section>
