<?php
  require './../includes/conn.php';
?>

<ul
  class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
  id="accordionSidebar"
>
  <!-- Sidebar - Brand -->
  <a
    class="sidebar-brand d-flex align-items-center justify-content-center"
    href="index.php"
  >
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-shopping-bag"></i>
    </div>
    <div class="sidebar-brand-text mx-3">EShopper</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0" />

  <?php
    $proactive = '';
    if($pgname == 'home'){
      $proactive = 'active';
    }
  ?>
  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?php echo $proactive; ?>">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a
    >
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" />

  <!-- Heading -->
  <div class="sidebar-heading">Functionality</div>

  <!-- Nav Item - Charts -->

  <!-- Sliders  -->
  <?php
    $proactive = '';
    if($pgname == 'sliders'){
      $proactive = 'active';
    }
  ?>
  <li class="nav-item <?php echo $proactive; ?>">
    <a class="nav-link" href="list_home_sliders.php">
      <i class="fas fa-fw fa-image"></i>
      <span>Home Sliders</span></a
    >
  </li>

  <!-- Category -->
  <?php
    $proactive = '';
    if($pgname == 'category'){
      $proactive = 'active';
    }
  ?>
  <li class="nav-item <?php echo $proactive; ?>">
    <a class="nav-link" href="list_category.php">
      <i class="fas fa-fw fa-list"></i>
      <span>Category</span></a
    >
  </li>

  <!-- Brand -->
  <?php
    $proactive = '';
    if($pgname == 'brand'){
      $proactive = 'active';
    }
  ?>
  <li class="nav-item <?php echo $proactive; ?>">
    <a class="nav-link" href="list_brand.php">
      <i class="fas fa-fw fa-cube"></i>
      <span>Brand</span></a
    >
  </li>

  <!-- Product -->
  <?php
    $proactive = '';
    if($pgname == 'product'){
      $proactive = 'active';
    }
  ?>
  <li class="nav-item <?php echo $proactive; ?>">
    <a class="nav-link" href="list_product.php">
      <i class="fas fa-fw fa-cubes"></i>
      <span>Product</span></a
    >
  </li>

  <!-- Variant -->
  <?php
    $proactive = '';
    if($pgname == 'variant'){
      $proactive = 'active';
    }
  ?>
  <li class="nav-item <?php echo $proactive; ?>">
    <a class="nav-link" href="list_variant.php">
      <i class="fas fa-fw fa-layer-group"></i>
      <span>Variant</span></a
    >
  </li>

  <!-- Contact -->
  <?php
    $proactive = '';
    if($pgname == 'contact'){
      $proactive = 'active';
    }
  ?>
  <li class="nav-item <?php echo $proactive; ?>">
    <a class="nav-link" href="contact.php">
      <i class="fas fa-fw fa-address-book"></i>
      <span>Contact</span></a
    >
  </li>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
