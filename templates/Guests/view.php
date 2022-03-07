<?php //pr($customer); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Guest
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <div class="btn-group">
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Manage Guest</button>
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'bookings', 'action' => 'new', $customer->_id]) ?></li>
        <li><a href="#">Make Payment</a></li>
        <li><a href="#">Create Refund</a></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('Edit Guest'), ['controller' => 'guests', 'action' => 'edit', $customer->_id]) ?></li>
        <li><?= $this->Html->link(__('Set Group Flag'), ['controller' => 'guests', 'action' => 'change_type', $customer->_id]) ?></li>
      </ul>
    </div>
  </ol>

</section>
    <!-- Main content -->
    <section class="content">
      <div class="row">    
        <!-- /.col -->
        <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
              <div class="widget-user-image">
                <?php echo $this->Html->image('user7-128x128.jpg', ['alt' => 'User Avatar', 'class' => 'img-circle']); ?>
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?= h($customer->firstname." ".$customer->lastname) ?></h3>
              <h5 class="widget-user-desc"><span><?= __('Account ID: ') ?></span><?= h($customer->accountid) ?></h5>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Check-In Status</h5>
                    <span class="description-text">IN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Current Bill</h5>
                    <span class="description-text">XXXXX</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">Account Balance</h5>
                    <span class="description-text">N100,000.00</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-sm-9">
                    <div class="box-header with-border">
                      <i class="fa fa-info"></i>
                      <h3 class="box-title"><?php echo __('Details'); ?></h3>
                    </div>
                    <div class="box-body">
                        <dl class="dl-horizontal">
                          <dt scope="row"><?= __('Phone') ?></dt>
                          <dd><?= h(@$customer->phone) ?></dd>
                          <dt scope="row"><?= __('Email') ?></dt>
                          <dd><?= h(@$customer->email) ?></dd>
                          <dt scope="row"><?= __('Address') ?></dt>
                          <dd><?= h(@$customer->billing_address['address_line_1']) ?></dd>
                          <dt scope="row"><?= __('Status') ?></dt>
                          <dd><?= h(@$customer->status) ?></dd>
                          <dt scope="row"><?= __('Group Flag') ?></dt>
                          <dd><?= h(@$customer->group_flag) ?></dd>
                          <dt scope="row"><?= __('Branch Id') ?></dt>
                          <dd><?= $this->Number->format(@$customer->branch_id) ?></dd>
                          <dt scope="row"><?= __('Created') ?></dt>
                          <dd><?= h(@$customer->createdAt) ?></dd>
                          <dt scope="row"><?= __('Modified') ?></dt>
                          <dd><?= h(@$customer->updatedAt) ?></dd>
                        </dl>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box-header with-border">
                      <i class="fa fa-info"></i>
                      <h3 class="box-title"><?php echo __('Statistics'); ?></h3>
                    </div>
                    <ul class="nav nav-stacked">
                        <li><a href="#">Occupied Rooms <span class="pull-right badge bg-blue">31</span></a></li>
                        <li><a href="#">Bils <span class="pull-right badge bg-aqua">5</span></a></li>
                        <li><a href="#">Payments <span class="pull-right badge bg-green">12</span></a></li>
                        <!-- <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li> -->
                    </ul>
                </div>     
              </div>                         
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>
              <h3 class="box-title"><?= __('Remarks') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= $this->Text->autoParagraph(@$customer->remarks); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
