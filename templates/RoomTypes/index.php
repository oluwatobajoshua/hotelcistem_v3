<?php 
use Cake\Routing\Router;

debug($this->request->getUri()->base);

$view = $this->request->getUri()->base.'/rooms/view';
$edit = Router::url(['_host'=>$this->request->getUri()->getHost(),'controller'=>'Rooms','action' => 'edit']);
$delete = Router::url(['_host'=>$this->request->getUri()->getHost(),'controller'=>'Rooms','action' => 'delete']);

debug($view);

//debug( $this->Html->link(__('View'), ['_host'=>$this->request->host(),'action' => 'view', 1], ['class'=>'btn btn-info btn-xs']));

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Room Types

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
          <table class="table table-hover" id="room-types">
            <thead>
              <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('deposit_rate') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('room_or_hall') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($roomTypes as $roomType): ?>
                <tr>
                  <td><?= $this->Number->format($roomType->id) ?></td>
                  <td><?= h($roomType->name) ?></td>
                  <td><?= $this->Number->format($roomType->rate) ?></td>
                  <td><?= $this->Number->format($roomType->deposit_rate) ?></td>
                  <td><?= h($roomType->room_or_hall) ?></td>
                  <td><?= h($roomType->created) ?></td>
                  <td><?= h($roomType->modified) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $roomType->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roomType->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $roomType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomType->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
    <thead>
              <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('room_number') ?></th>
                  <th class="sorting"><a>Room Type</a></th>
                  <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('status_id') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>

            <tfoot>
                <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('room_number') ?></th>
                  <th class="sorting"><a>Room Type</a></th>
                  <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('status_id') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                </tr>
            </tfoot>  
  </div>
</section>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {

      var formUrl = "<?php echo $this->Url->build(['controller' => 'Rooms', 'action' => 'index']); ?>";

      var roomsTable = $('#room-types').DataTable({
        destroy: true,
          searching: false,
          "order": [[ 3, "desc" ]]
        });

      ajaxRequest();

      $('#submit').on('click', function(e){
        e.preventDefault();

        $('#table_search').val('');
        ajaxRequest();

      });

      $('#table_search').keyup(function(e) {        
          e.preventDefault();            
          ajaxRequest();

      });
        
      function ajaxRequest(){        
          var table_search = $('#table_search').val();
          console.log('ajaxRequest Called');
          $.ajax({
              type: 'POST',
              dataType: 'json',
              url: '/rooms.json',
              data: {
                  data: table_search
              },
              beforeSend: function(xhr) { // Add this line
                  xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                  //console.log(xhr);
              },
              success: function(data) {

                console.log([data.rooms][0]);
                /*
                $('#rooms-table').DataTable( {
                    "processing": true,
                    data: [data.rooms][0],
                    columns: [
                        { data : 'id' },
                        { data : 'room_number' },
                        { data : 'room_type.name' },
                        { data : 'created' },
                        { data : 'modified' },
                        { data : 'status.name' },                                            

                    ]
                });*/
                
                
                  /*           
                  $.each(key, function(k, v) {

                    console.log(v)

                      $.each(value, function(key,value){
                                                
                        //table.row( 0 ).data([1,2.3] ).draw();
                        console.log(value.id)
                        table.row.add({});
                        table.draw();
                
                      });

                  });*/   
              },
              error: function(xhr, textStatus, error) {
                  console.log(xhr);
                  console.log(textStatus);
                  console.log(error);
              }
          });
      }

    })
</script>
<?php $this->end(); ?>