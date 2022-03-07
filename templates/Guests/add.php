<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customer
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Guests
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
          <?php echo $this->Form->create($guest, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                $this->Form->setTemplates([
                  'inputContainer' => '<div class="form-group input col-md-6 {{type}} {{required}}">{{content}}</div>'
                ]);
                echo $this->Form->control('title');
                echo $this->Form->control('firstname');
                echo $this->Form->control('lastname');
                echo $this->Form->control('email');
                echo $this->Form->control('phone');
                echo $this->Form->control('gender');
                echo $this->Form->control('nationality');
                echo $this->Form->control('dob');                
                echo $this->Form->control('occupation');
                echo $this->Form->control('branch_id');                
                echo $this->Form->control('billing_address.address_line_1');
                echo $this->Form->control('billing_address.address_line_2');
                echo $this->Form->control('billing_address.city');
                echo $this->Form->control('billing_address.state');
                echo $this->Form->control('billing_address.country');
                echo $this->Form->control('group_flag');
                echo $this->Form->control('idcard_number');
                echo $this->Form->control('idcard_expiry');   
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

