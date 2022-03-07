<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Guests

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
        <!-- /.box-header -->
        </div>
        
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover" id="guest-table" width="100%">
            <thead>
              <tr>
                  <th scope="col"><?= $this->Paginator->sort('accountid') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('firstname') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('lastname') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('group_flag') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('updatedAt') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
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

      console.log($('#guest-table th a').attr('href',''))

      var formUrl = "<?php echo $this->Url->build(['controller' => 'Guests', 'action' => 'index']); ?>";
      var roomsTable = $('#guest-table').DataTable( {
          destroy : true,
          ajax: {
              url: formUrl,
              dataSrc: 'guests'
          },
          "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, "All"]],
          columns: [
              { data : 'accountid' },
              { data : 'title' },
              { data : 'firstname' },
              { data : 'lastname' },
              { data : 'group_flag' },
              { data : 'status' },
              { data : 'updatedAt' },
              { data : null, render: function (data, type, row) {
                  //console.log($(location).attr('pathname')+'/view/'+data.id) 
                  //console.log($('[name="_csrfToken"]').val())
                  var view = $(location).attr('pathname')+'/view/'+data._id
                  var edit = $(location).attr('pathname')+'/edit/'+data._id
                  var del = $(location).attr('pathname')+'/delete/'+data._id
                  return "<a href=\""+view+"\" class=\"btn btn-info btn-xs\">View</a>&nbsp;<a href=\""+edit+"\" class=\"btn btn-warning btn-xs\">Edit</a>&nbsp;<form name=\"post_"+data.id+"\" style=\"display:none;\" method=\"post\" action=\""+del+"\"><input type=\"hidden\" name=\"_method\" value=\"POST\"><input type=\"hidden\" name=\"_csrfToken\" autocomplete=\"off\" value=\""+$('[name="_csrfToken"]').val()+"\"></form><a href=\"#\" class=\"btn btn-danger btn-xs\" data-confirm-message=\"Are you sure you want to delete # "+data.id+"?\" onclick=\"if (confirm(this.dataset.confirmMessage)) { document.post_"+data.id+".submit(); } event.returnValue = false; return false;\">Delete</a>"
                }, 
              },                                            
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
