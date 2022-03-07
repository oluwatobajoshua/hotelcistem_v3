<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Widgets
        <small>Preview page</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Widgets</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
              <div class="widget-user-image">
                <?php echo $this->Html->image('user7-128x128.jpg', ['alt' => 'User Avatar', 'class' => 'img-circle']); ?>
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Nadia Carmichael</h3>
              <h5 class="widget-user-desc">Lead Developer</h5>
            </div>
          </div>
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('../dist/img/photo1.png') center center;">
              <h3 class="widget-user-username">Elizabeth Pierce</h3>
              <h5 class="widget-user-desc">Web Designer</h5>
              <div class="widget-user-image">
                <?php echo $this->Html->image('user3-128x128.jpg', ['alt' => 'User Avatar', 'class' => 'img-circle']); ?>
              </div>
            </div>
            
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">3,200</h5>
                    <span class="description-text">SALES</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">13,000</h5>
                    <span class="description-text">FOLLOWERS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">35</h5>
                    <span class="description-text">PRODUCTS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-sm-6">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Projects <span class="pull-left badge bg-blue">31</span></a></li>
                        <li><a href="#">Tasks <span class="pull-left badge bg-aqua">5</span></a></li>
                        <li><a href="#">Completed Projects <span class="pull-left badge bg-green">12</span></a></li>
                        <!-- <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li> -->
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                        <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                        <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                        <!-- <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li> -->
                    </ul>
                </div>     
              </div>              
            </div>

          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
