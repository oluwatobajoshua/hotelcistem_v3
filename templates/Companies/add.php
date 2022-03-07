<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customer
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Company
      <small><?php echo __('Add'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Form'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($company, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('business_name');
                echo $this->Form->control('contact_person.firstname');
                echo $this->Form->control('contact_person.lastname');
                echo $this->Form->control('email');
                echo $this->Form->control('phone');
                echo $this->Form->control('registered_address.address_line_1');
                echo $this->Form->control('registered_address.address_line_2');
                echo $this->Form->control('registered_address.city');
                echo $this->Form->control('registered_address.state', ['options' => $states]);
                echo $this->Form->control('registered_address.country', ['options' => $countries]);
                echo $this->Form->control('branch_id');
                echo $this->Form->control('remarks');
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

