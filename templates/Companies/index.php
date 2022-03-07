<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Company

    <div class="pull-right"><?php echo $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?php echo __('List'); ?></h3>

          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="<?php echo __('Search'); ?>">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('accountid') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('business_name') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('firstname') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('lastname') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($companies as $c): $customer = (object)$c;  ?>
                <tr>
                  <td><?= $this->Number->format($customer->_id) ?></td>
                  <td><?= $this->Number->format($customer->accountid) ?></td>
                  <td><?= h($customer->business_name) ?></td>
                  <td><?= h($customer->contact_person['firstname']) ?></td>
                  <td><?= h($customer->contact_person['lastname']) ?></td>
                  <td><?= h($customer->email) ?></td>
                  <td><?= h($customer->phone) ?></td>
                  <td><?= h($customer->status) ?></td>
                  <td><?= h($customer->createdAt) ?></td>
                  <td><?= h($customer->updatedAt) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $customer->_id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->_id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->_id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->_id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>