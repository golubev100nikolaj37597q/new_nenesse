<?php 

function create_aside(){
  return '
  <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
  <!-- Collapse -->
  <div class="nav-item">
    <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuDashboards" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuDashboards" aria-expanded="true" aria-controls="navbarVerticalMenuDashboards">
      <i class="bi-house-door nav-icon"></i>
      <span class="nav-link-title">Menu</span>
    </a>
                  <div id="navbarVerticalMenuDashboards" class="nav-collapse collapse show" data-bs-parent="#navbarVerticalMenu">
  <a class="nav-link " href="./index.php">Main</a>
  <a class="nav-link " href="./account-settings.php">Settings</a>
  <a class="nav-link" href="./ecommerce-products.php">Products</a>
</div>
</div>';

}
