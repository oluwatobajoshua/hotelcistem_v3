<section class="content-header">
  <h1>
    Company
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
            <dt scope="row"><?= __('Customer Type') ?></dt>
            <dd><?= h($company->customer_type) ?></dd>
            <dt scope="row"><?= __('Email') ?></dt>
            <dd><?= h($company->email) ?></dd>
            <dt scope="row"><?= __('Phone') ?></dt>
            <dd><?= h($company->phone) ?></dd>
            <dt scope="row"><?= __('Status') ?></dt>
            <dd><?= h($company->status) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($company->_id) ?></dd>
            <dt scope="row"><?= __('Accountid') ?></dt>
            <dd><?= $this->Number->format($company->accountid) ?></dd>
            <dt scope="row"><?= __('Branch Id') ?></dt>
            <dd><?= $this->Number->format($company->branch_id) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($company->createdAt) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($company->updatedAt) ?></dd>
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
            <?= $this->Text->autoParagraph($company->remarks); ?>
        </div>
      </div>
    </div>
  </div>
</section>
