<section class="content-header">
  <h1>
    User Profile
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
            <dt scope="row"><?= __('Staff Code') ?></dt>
            <dd><?= h($userProfile->staff_code) ?></dd>
            <dt scope="row"><?= __('Firstname') ?></dt>
            <dd><?= h($userProfile->firstname) ?></dd>
            <dt scope="row"><?= __('Lastname') ?></dt>
            <dd><?= h($userProfile->lastname) ?></dd>
            <dt scope="row"><?= __('Phone') ?></dt>
            <dd><?= h($userProfile->phone) ?></dd>
            <dt scope="row"><?= __('Email') ?></dt>
            <dd><?= h($userProfile->email) ?></dd>
            <dt scope="row"><?= __('Sex') ?></dt>
            <dd><?= h($userProfile->sex) ?></dd>
            <dt scope="row"><?= __('User') ?></dt>
            <dd><?= $userProfile->has('user') ? $this->Html->link($userProfile->user->id, ['controller' => 'Users', 'action' => 'view', $userProfile->user->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($userProfile->id) ?></dd>
            <dt scope="row"><?= __('Birthday') ?></dt>
            <dd><?= h($userProfile->birthday) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($userProfile->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($userProfile->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
