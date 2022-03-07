<section class="content-header">
  <h1>
    Country
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
            <dd><?= h($country->name) ?></dd>
            <dt scope="row"><?= __('Prefix Code') ?></dt>
            <dd><?= h($country->prefix_code) ?></dd>
            <dt scope="row"><?= __('Continent') ?></dt>
            <dd><?= h($country->continent) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($country->id) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Guests') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($country->guests)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Guest Title') ?></th>
                    <th scope="col"><?= __('First Name') ?></th>
                    <th scope="col"><?= __('Last Name') ?></th>
                    <th scope="col"><?= __('Gender Id') ?></th>
                    <th scope="col"><?= __('Occupation') ?></th>
                    <th scope="col"><?= __('Phone') ?></th>
                    <th scope="col"><?= __('Address') ?></th>
                    <th scope="col"><?= __('State Id') ?></th>
                    <th scope="col"><?= __('Email') ?></th>
                    <th scope="col"><?= __('Birthday') ?></th>
                    <th scope="col"><?= __('Idcard Number') ?></th>
                    <th scope="col"><?= __('Idcard Expiry') ?></th>
                    <th scope="col"><?= __('Account Balance') ?></th>
                    <th scope="col"><?= __('Guest Type Id') ?></th>
                    <th scope="col"><?= __('Country Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Status Id') ?></th>
                    <th scope="col"><?= __('Comments') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($country->guests as $guests): ?>
              <tr>
                    <td><?= h($guests->id) ?></td>
                    <td><?= h($guests->guest_title) ?></td>
                    <td><?= h($guests->first_name) ?></td>
                    <td><?= h($guests->last_name) ?></td>
                    <td><?= h($guests->gender_id) ?></td>
                    <td><?= h($guests->occupation) ?></td>
                    <td><?= h($guests->phone) ?></td>
                    <td><?= h($guests->address) ?></td>
                    <td><?= h($guests->state_id) ?></td>
                    <td><?= h($guests->email) ?></td>
                    <td><?= h($guests->birthday) ?></td>
                    <td><?= h($guests->idcard_number) ?></td>
                    <td><?= h($guests->idcard_expiry) ?></td>
                    <td><?= h($guests->account_balance) ?></td>
                    <td><?= h($guests->guest_type_id) ?></td>
                    <td><?= h($guests->country_id) ?></td>
                    <td><?= h($guests->user_id) ?></td>
                    <td><?= h($guests->status_id) ?></td>
                    <td><?= h($guests->comments) ?></td>
                    <td><?= h($guests->created) ?></td>
                    <td><?= h($guests->modified) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Guests', 'action' => 'view', $guests->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Guests', 'action' => 'edit', $guests->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Guests', 'action' => 'delete', $guests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $guests->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
