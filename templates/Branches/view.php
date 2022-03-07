<section class="content-header">
  <h1>
    Branch
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
            <dt scope="row"><?= __('Name') ?></dt>
            <dd><?= h($branch->name) ?></dd>
            <dt scope="row"><?= __('Address') ?></dt>
            <dd><?= h($branch->address) ?></dd>
            <dt scope="row"><?= __('Company') ?></dt>
            <dd><?= $branch->has('company') ? $this->Html->link($branch->company->name, ['controller' => 'Companies', 'action' => 'view', $branch->company->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($branch->id) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($branch->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($branch->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
