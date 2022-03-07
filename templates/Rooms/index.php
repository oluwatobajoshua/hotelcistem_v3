<style>
  div.dataTables_length,div.dataTables_info {
        color: #00a65a;
        padding-left: 10px;
  }

  div#rooms-table_filter, div#rooms-table_paginate{

    color: #00a65a;
    padding-right: 10px;

  }

</style>
<?php echo $this->Form->create(); ?>
<?php echo $this->Form->end(); ?>


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Rooms

    <div class="pull-right"><?php echo $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">




      
        <div class="box box-solid">
              <div class="box-header with-border">
                  <i class="fa fa-th"></i>
                  <h3 class="box-title"><?php echo __('Rooms'); ?></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body text-center">
                  <p>Rooms Dashboard</p>

                  <?php echo $this->element('room_grid'); ?>

              <!-- /.box-body -->
              </div>
              <!-- /.box -->
        </div>

      
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover" id="rooms-table" width="100%">
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
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>

<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {

      var formUrl = "<?php echo $this->Url->build(['controller' => 'Rooms', 'action' => 'index']); ?>";
      var roomsTable = $('#rooms-table').DataTable( {
          destroy : true,
          "processing" : true,
          ajax: {
              url: formUrl,
              dataSrc: 'rooms'
          },
          autoFill: true,
          columns: [
              { data : '_id' },
              { data : 'room_number' },
              { data : 'room_type.name' },
              { data : 'createdAt' },
              { data : 'updatedAt' },
              { data : 'status' },
              { data : null, render: function (data, type, row) {
                //console.log($(location).attr('pathname')+'/view/'+data.id) 
                //console.log($('[name="_csrfToken"]').val())
                var view = $(location).attr('pathname')+'/view/'+data.id
                var edit = $(location).attr('pathname')+'/edit/'+data.id
                var del = $(location).attr('pathname')+'/delete/'+data.id
                return "<a href=\""+view+"\" class=\"btn btn-info btn-xs\">View</a>&nbsp;<a href=\""+edit+"\" class=\"btn btn-warning btn-xs\">Edit</a>&nbsp;<form name=\"post_"+data.id+"\" style=\"display:none;\" method=\"post\" action=\""+del+"\"><input type=\"hidden\" name=\"_method\" value=\"POST\"><input type=\"hidden\" name=\"_csrfToken\" autocomplete=\"off\" value=\""+$('[name="_csrfToken"]').val()+"\"></form><a href=\"#\" class=\"btn btn-danger btn-xs\" data-confirm-message=\"Are you sure you want to delete # "+data.id+"?\" onclick=\"if (confirm(this.dataset.confirmMessage)) { document.post_"+data.id+".submit(); } event.returnValue = false; return false;\">Delete</a>"
              }, },                                            
          ],
          "columnDefs": [
            { className: "actions text-right", "targets": [ 6 ] }
          ]
      });
      /*
      setInterval( function () {
        roomsTable.ajax.reload( null, false ); // user paging is not reset on reload
      }, 30000 );*/

      $("#rooms-table_filter").click(function(){
        //alert("The paragraph was clicked.");
        roomsTable.ajax.reload( null, false ); // user paging is not reset on reload
      });

    })
</script>
<?php $this->end(); ?>