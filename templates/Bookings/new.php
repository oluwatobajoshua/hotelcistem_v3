<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    New Booking
    <small><?php echo __('Add '.$guestIdString); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

  <!-- Main content -->
<section class="content">

    <?php echo $this->element('bookings/choose_customer_type'); ?>

    <?php echo $this->element('bookings/room_availability_search'); ?>

    
    <?php 
    if(@$availability == true) {
      echo $this->element('bookings/guest_details'); 
    }
    ?>
    
</section>

