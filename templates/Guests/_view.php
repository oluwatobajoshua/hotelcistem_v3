<section class="content-header">
  <h1>
    Guest
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
            <dt scope="row"><?= __('Guest Type') ?></dt>
            <dd><?= h($customer->group_flag) ?></dd>
            <dt scope="row"><?= __('Email') ?></dt>
            <dd><?= h($customer->email) ?></dd>
            <dt scope="row"><?= __('Phone') ?></dt>
            <dd><?= h($customer->phone) ?></dd>
            <dt scope="row"><?= __('Status') ?></dt>
            <dd><?= h($customer->status) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($customer->_id) ?></dd>
            <dt scope="row"><?= __('Accountid') ?></dt>
            <dd><?= $this->Number->format($customer->accountid) ?></dd>
            <dt scope="row"><?= __('Branch Id') ?></dt>
            <dd><?= $this->Number->format($customer->branch_id) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($customer->createdAt) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($customer->updatedAt) ?></dd>
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
          <h3 class="box-title"><?= __('Remarks') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $this->Text->autoParagraph($customer->remarks); ?>
        </div>
      </div>
    </div>
  </div>
</section>
