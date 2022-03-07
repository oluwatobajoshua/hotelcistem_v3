<div class="row">

  <div class="col-md-12">

      <div class="box box-solid">
          <div class="box-header with-border">
            <i class="fa fa-info"></i>
            <h3 class="box-title"><?php echo __('Summary'); ?></h3>
          <!-- /.box-header -->
          </div>
        
          <div class="box-body">  
            
                <p>The selected rooms are available for the chosen dates. Fill out the guest details to complete this booking</p>
            

            <!-- form start -->
            <?php echo $this->Form->create($booking, ['role' => 'form']); ?>  
              <div class="box-body col-md-12">
                <?php
                    echo '<div class="col-md-12">';
                    echo '<h4>Dates</h4>';
                    echo $this->Form->control('check_in_date', ['readonly' => true]);
                    echo $this->Form->control('check_out_date', ['readonly' => true]);
                    echo '</div>';
                    
                    echo '<div class="col-md-12">';
                    echo '<h4>Selected Rooms</h4>';
                    $count = 0;
                    foreach($booking['data']['booking_rooms'] as $key => $value){
                      echo '<div class="col-md-8">';
                      echo $this->Form->control('booking_rooms['.$count.'][room]', [
                        'value' => $value['room'], 'type' => 'hidden', 'readonly' => true,
                      ]);
                      echo $this->Form->control('booking_rooms['.$count.'][room_type]', [
                        'value' => $value['room_type'], 'type' => 'hidden', 'readonly' => true,
                      ]);
                      echo $this->Form->control('booking_rooms['.$count.'][room_desc]', [
                        'value' => $key, 'type' => 'hidden', 'readonly' => true,
                      ]);
                      echo $this->Form->control('booking_rooms['.$count.'][room_type_desc]', [
                        'value' => $value['room_type_desc'], 'type' => 'hidden', 'readonly' => true,
                      ]);
                      echo $this->Form->control('booking_rooms['.$count.'][rate]', [
                        'value' => $value['rate'], 'type' => 'text', 'readonly' => true, 'label' => 'Rate ['.$key.']',
                        'inputContainer' => '<div class="form-group input col-md-4 {{type}} {{required}}">{{content}}</div>'
                      ]);
                      echo $this->Form->control('booking_rooms['.$count.'][discount]', [
                        'value' => $value['discount'],'type' => 'text', 'readonly' => true, 'label' => 'Discount ['.$key.']',
                        'inputContainer' => '<div class="form-group input col-md-4 {{type}} {{required}}">{{content}}</div>'
                      ]);
                      echo $this->Form->control('booking_rooms['.$count.'][amount]', [
                        'value' => $value['amount'], 'type' => 'text', 'readonly' => true, 'label' => 'Total ['.$key.']',
                        'inputContainer' => '<div class="form-group input col-md-4 {{type}} {{required}}">{{content}}</div>'
                      ]);
                      echo '</div>';
                      $count++;
                    }


                    if ($guest != null) {
                        //Existing customer widget
                        echo '<div class="col-md-12">';
                        echo '<h4>Guest Details - Existing</h4>';
                        echo $this->Form->control('customer.id', ['type' => 'hidden']);
                        echo $this->Form->control('customer.accessToken', ['type' => 'hidden']);
                        ?>
                        <div class="box-body">
                            <dl class="dl-horizontal">                          
                              <dd><?= h(@$guest->group_flag) ?></dd>
                              <dt scope="row"><?= __('Account ID: ') ?></dt>
                              <dd><?= h(@$guest->accountid) ?></dd>
                              <dt scope="row"><?= __('Full Name: ') ?></dt>
                              <dd><?= h(@$guest->firstname." ".$guest->lastname) ?></dd>
                              <dt scope="row"><?= __('Phone: ') ?></dt>
                              <dd><?= h(@$guest->phone) ?></dd>
                              <dt scope="row"><?= __('Email: ') ?></dt>
                              <dd><?= h(@$guest->email) ?></dd>
                              <dt scope="row"><?= __('Status') ?></dt>
                              <dd><?= h(@$guest->status) ?></dd>
                              <dt scope="row"><?= __('Group Flag') ?></dt>
                              <dd><?= h(@$guest->group_flag) ?></dd>
                              <dt scope="row"><?= __('Created') ?></dt>
                              <dd><?= h(@$guest->createdAt) ?></dd>
                              <dt scope="row"><?= __('Modified') ?></dt>
                              <dd><?= h(@$guest->updatedAt) ?></dd>
                            </dl>
                        </div>
                        <?php
                        echo '</div>';
                    } else {
                        //New customer widget
                        echo '<div class="col-md-12">';
                        echo '<h4>Guest Details - New</h4>';
                        echo $this->Form->control('customer.firstname');
                        echo $this->Form->control('customer.lastname');
                        echo $this->Form->control('customer.email');
                        echo $this->Form->control('customer.phone');
                        echo $this->Form->control('customer.gender');
                        echo $this->Form->control('customer.nationality');
                        echo $this->Form->control('customer.occupation');
                        echo $this->Form->control('customer.branch_id');                
                        echo $this->Form->control('customer.billing_address.address_line_1');
                        echo $this->Form->control('customer.billing_address.address_line_2');
                        echo $this->Form->control('customer.billing_address.city');
                        echo $this->Form->control('customer.billing_address.state');
                        echo $this->Form->control('customer.billing_address.country');
                        echo $this->Form->control('customer.group_flag');
                        echo '</div>';
                    }
                ?>
              <!-- /.box-body -->
              </div>                 
            <?php echo $this->Form->submit(__('Submit'), ['id' => 'submit-button']); ?>
            <?php echo $this->Form->end(); ?>
        
          <!-- /.box-body -->
          </div>
      <!-- /.box -->
      </div>

  <!-- /.col-md-12 -->
  </div>
<!-- /.row -->
</div>


<script>


</script>