<section class="content-header">
  <h1>
    Payment
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
            <dt scope="row"><?= __('User') ?></dt>
            <dd><?= $payment->has('user') ? $this->Html->link($payment->user->id, ['controller' => 'Users', 'action' => 'view', $payment->user->id]) : '' ?></dd>
            <dt scope="row"><?= __('Guest') ?></dt>
            <dd><?= $payment->has('guest') ? $this->Html->link($payment->guest->id, ['controller' => 'Guests', 'action' => 'view', $payment->guest->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($payment->id) ?></dd>
            <dt scope="row"><?= __('Amount') ?></dt>
            <dd><?= $this->Number->format($payment->amount) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= $this->Number->format($payment->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= $this->Number->format($payment->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
