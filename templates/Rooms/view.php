<section class="content-header">
  <h1>
    Room
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
          <h3 class="box-title"><?php echo __('Information'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('Room Number') ?></dt>
            <dd><?= h($room->room_number) ?></dd>
            <dt scope="row"><?= __('Room Type') ?></dt>
            <dd><?= $room->has('room_type') ? $this->Html->link($room->room_type->name, ['controller' => 'RoomTypes', 'action' => 'view', $room->room_type->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($room->id) ?></dd>
            <dt scope="row"><?= __('Status Id') ?></dt>
            <dd><?= $this->Number->format($room->status_id) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($room->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($room->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title"><?= __('Description') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $this->Text->autoParagraph($room->description); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Room Activities') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($room->room_activities)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Activity Start') ?></th>
                    <th scope="col"><?= __('Activity Start Datetime') ?></th>
                    <th scope="col"><?= __('Activity End') ?></th>
                    <th scope="col"><?= __('Activity End Datetime') ?></th>
                    <th scope="col"><?= __('Booking Id') ?></th>
                    <th scope="col"><?= __('Room Id') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Status Id') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($room->room_activities as $roomActivities): ?>
              <tr>
                    <td><?= h($roomActivities->id) ?></td>
                    <td><?= h($roomActivities->activity_start) ?></td>
                    <td><?= h($roomActivities->activity_start_datetime) ?></td>
                    <td><?= h($roomActivities->activity_end) ?></td>
                    <td><?= h($roomActivities->activity_end_datetime) ?></td>
                    <td><?= h($roomActivities->booking_id) ?></td>
                    <td><?= h($roomActivities->room_id) ?></td>
                    <td><?= h($roomActivities->created) ?></td>
                    <td><?= h($roomActivities->status_id) ?></td>
                    <td><?= h($roomActivities->modified) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'RoomActivities', 'action' => 'view', $roomActivities->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'RoomActivities', 'action' => 'edit', $roomActivities->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'RoomActivities', 'action' => 'delete', $roomActivities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomActivities->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
