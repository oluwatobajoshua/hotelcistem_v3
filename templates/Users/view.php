<section class="content-header">
  <h1>
    User
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
            <dt scope="row"><?= __('Role') ?></dt>
            <dd><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></dd>
            <dt scope="row"><?= __('Username') ?></dt>
            <dd><?= h($user->username) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($user->id) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($user->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($user->modified) ?></dd>
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
          <?php if (!empty($user->guests)): ?>
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
              <?php foreach ($user->guests as $guests): ?>
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
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('User Profiles') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($user->user_profiles)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Staff Code') ?></th>
                    <th scope="col"><?= __('Firstname') ?></th>
                    <th scope="col"><?= __('Lastname') ?></th>
                    <th scope="col"><?= __('Phone') ?></th>
                    <th scope="col"><?= __('Email') ?></th>
                    <th scope="col"><?= __('Sex') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Birthday') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($user->user_profiles as $userProfiles): ?>
              <tr>
                    <td><?= h($userProfiles->id) ?></td>
                    <td><?= h($userProfiles->staff_code) ?></td>
                    <td><?= h($userProfiles->firstname) ?></td>
                    <td><?= h($userProfiles->lastname) ?></td>
                    <td><?= h($userProfiles->phone) ?></td>
                    <td><?= h($userProfiles->email) ?></td>
                    <td><?= h($userProfiles->sex) ?></td>
                    <td><?= h($userProfiles->user_id) ?></td>
                    <td><?= h($userProfiles->birthday) ?></td>
                    <td><?= h($userProfiles->created) ?></td>
                    <td><?= h($userProfiles->modified) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'UserProfiles', 'action' => 'view', $userProfiles->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'UserProfiles', 'action' => 'edit', $userProfiles->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserProfiles', 'action' => 'delete', $userProfiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userProfiles->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
