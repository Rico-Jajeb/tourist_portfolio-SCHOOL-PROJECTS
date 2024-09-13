<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!--SESSION -->
<?php if ($this->session->userdata('connect') == true ){
      $sess = $this->session->userdata('user_name');
      $admin_level = $this->session->userdata('admin_level');

}?>
<!--END SESSION -->


<?php if($this->session->flashdata('status')) {?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Save Successfully',
                icon: 'success'
            });
        });
    </script>
<?php }?>
<?php if($this->session->flashdata('status2')) {?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Update Successfully',
                icon: 'success'
            });
        });
    </script>
<?php }?>

<?php if($this->session->flashdata('status3')) {?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Item set to INACTIVE',
                icon: 'success'
            });
        });
    </script>
<?php }?>

<?php if($this->session->flashdata('status4')) {?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Item set to ACTIVE',
                icon: 'success'
            });
        });
    </script>
<?php }?>




  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
      <img src="<?php echo base_url('assets/assets/img/logo-ct-dark.png')?>" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Inventory System</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  " href="<?php echo base_url('index.php/dashboard') ?>">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <img class="nav_icons" src="<?php echo base_url('assets/items_img/dashboard.gif') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1 itm_txt">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="<?php echo base_url('index.php/items') ?>">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <img class="nav_icons" src="<?php echo base_url('assets/items_img/item3.gif') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1 itm_txt">Items</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  active" href="<?php echo base_url('index.php/defective') ?>">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>credit-card</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(453.000000, 454.000000)">
                        <path class="color-background opacity-6" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"></path>
                        <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1 itm_txt">Defectives</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="<?php echo base_url('index.php/transaction') ?>">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <img class="nav_icons" src="<?php echo base_url('assets/items_img/transaction.gif') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1 itm_txt">Transactions</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="<?php echo base_url('index.php/supplier') ?>">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>settings</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(304.000000, 151.000000)">
                        <polygon class="color-background opacity-6" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                        <path class="color-background opacity-6" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"></path>
                        <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1 itm_txt">Suppliers</span>
          </a>
        </li>
        <br>
        <li class="nav-item">
          <a class="nav-link  " href="<?php echo base_url('index.php/display_messages') ?>">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <img class="nav_icons" src="<?php echo base_url('assets/items_img/chat2.gif') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1 itm_txt">events</span>
          </a>
        </li>

        <?php if($admin_level == "admin") {?>
          <li class="nav-item">
            <a class="nav-link" type="submit" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <img class="nav_icons" src="<?php echo base_url('assets/items_img/chat2.gif') ?>" alt="">
              </div>
              <span class="nav-link-text ms-1 itm_txt">Audit Logs</span>
            </a>
              <div class="collapse" id="collapseExample">
                <div class="audit_logs_btn">
                  <div class="audit_logs">
                    <a href="<?php echo base_url('index.php/admin_logs') ?>">admin logs</a>
                    <a href="<?php echo base_url('index.php/user_logs') ?>">user logs</a>
                  </div>

                </div>
              </div>
          </li>
          <li class="nav-item">
            <a class="nav-link  " href="<?php echo base_url('index.php/staff_creation') ?>">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <img class="nav_icons" src="<?php echo base_url('assets/items_img/chat2.gif') ?>" alt="">
              </div>
              <span class="nav-link-text ms-1 itm_txt">Staff Creation</span>
            </a>
          </li>
        <?php }else{ ?>
        <?php }?>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
        <div class="full-background" style="background-image: url('../assets/img/curved-images/white-curved.jpg')"></div>

      </div>
     
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Defectives</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Defectives</h6>
        </nav>
          <!--Quick create -->
          <div class="nav-item dropdown pe-2 d-flex align-items-center quick_create d-none d-sm-block">
                  <button class="item_add_btn2" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" >
                      <img class="plus_img " src="<?php echo base_url('assets/items_img') ?> /plus5.gif" alt="">
                  </button>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <h5>insert into: </h5>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="<?php echo base_url('assets/assets/img/team-2.jpg') ?>" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="<?php echo base_url('assets/assets/img/team-2.jpg') ?>" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
            </div>
          <!--END Quick create -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><img class="search_icon" src="<?php echo base_url('assets/items_img/search.gif') ?>" alt=""></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <span class="user_session"><?php echo $sess ?></span>
                <img class="user_icon fixed-plugin-button-nav cursor-pointer" src="<?php echo base_url('assets/items_img/user.gif') ?>" alt="">
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->



    <div class="container-fluid py-4 ">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class=" mt-4">
              <h4 class="text-center itm_txt">DEFECTIVE ITEMS</h4>
              <div class="d-flex  ">
                <div class="ps-4  d-flex  align-items-center">
                  <form method='post' action="<?= base_url('index.php/defective') ?>" >
                          <input type='text' name='search_defective_items' value='<?= $search ?>'>
                          <input type='submit' name='submit' value='search'>
                  </form>                  
                </div>
                <?php if($admin_level == "admin") {?>
                <div class="">
                  <a class="ms-3 btn btn-danger" href="<?php echo base_url('index.php/defective_inactive_table') ?>">inactive items</a>
                </div>   
                <?php }else{ ?>
                <?php }?>
                <div class="ms-5">
                  <button class="icon_btn add_btn" onclick="pop_modal()">
                      <div class="add_icon"></div>
                      <div class=" btn_txt ">Add Item</div>
                  </button>
                </div> 
               
              </div>
            </div>         
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive pt-4  ">
                <table class="table align-items-center mb-0 tbl_hover">
                  <thead>
                    <tr>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">NO.</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Image</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Name/Model</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Brand</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Category</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Quantity</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Status</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Date Found</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Supplier</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Notes</th>
                      <th class="text-uppercase table_title font-weight-bolder itm_txt ">Active?</th>
                      <?php if($admin_level == "admin") {?>
                        <th class="text-uppercase table_title font-weight-bolder itm_txt ">Action</th>
                      <?php }else{ ?>
                      <?php }?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sno = $row+1;  foreach ($result as $data): ?>
                      <?php
                        $status = $data['status'];
                        if ($status == 'Broken') {
                          $stat = "bg-danger";
                        } elseif ($status == 'Repair') {
                          $stat = "bg-warning";
                        } elseif ($status == 'Pending') {
                          $stat = "bg-info";
                        } elseif ($status == 'Replace') {
                          $stat = "bg-success";
                        } elseif ($status == 'Scrapped') {
                          $stat = "bg-dark";
                        } elseif ($status == 'Goods') {
                          $stat = "bg-info";
                        } else {
                          echo 'white';
                        } ?>

                      <tr>
                        <td>
                            <p class="mb-0 px-4 py-1 itm_txt text-sm font-weight-bold "><?php echo $sno ?></p>
                        </td>                       
                        <td>
                          <span class=" ps-3 text-sm font-weight-bold"> 
                            <img class="itm_imgs"  src="<?php echo base_url('assets/image/defective_item_img/' . $data['item_image']) ?>" alt="">
                          </span>
                        </td>

                        <td>
                          <p class="text-sm ps-4 font-weight-bold mb-0"><?php echo $data['item_name/model'] ?></p>
                        </td>
                        <td>
                          <span class=" ps-3 text-sm font-weight-bold"><?php echo $data['item_brand'] ?></span>
                        </td>
                        <td>
                          <span class=" ps-3 text-sm font-weight-bold"><?php echo $data['item_category'] ?></span>
                        </td>
                        <td>
                          <span class=" ps-3 text-sm font-weight-bold"><?php echo $data['item_quantity'] ?></span>
                        </td>
            
                        <td>
                          <span class="ms-2 badge badge-pill badge-md  <?= $stat ?>"><?php echo $data['status'] ?></span>
                        </td>
                        <td>
                          <span class=" ps-3 text-sm font-weight-bold"><?php echo $data['date_found'] ?></span>
                        </td>
                        <td>
                          <span class=" ps-3 text-sm font-weight-bold"><?php echo $data['item_supplier'] ?></span>
                        </td>
                        <td>
                          <span class=" ps-3 text-sm font-weight-bold"><?php echo $data['Notes'] ?></span>
                        </td>
                 
                        <td>
                          <?php if($admin_level == "admin") {?>
                            <div class="form-check">
                              <form class="myForm" action="<?php echo base_url('index.php/active_update') ?>" method="POST">
                                <input type="hidden" name="active" value="0">
                                <input type="hidden" name="defective_id" value="<?php echo $data['defective_id'] ?>">
                                <input class="form-check-input fcustomCheck1" type="checkbox" value="1" name="active" id="fcustomCheck1" <?php if($data['active'] == 1)echo "checked"?>>
                                <label class="custom-control-label" for="customCheck1">Active</label>                              
                              </form>
                            </div>
                          <?php }else{ ?>
                            <div class="form-check">
                              
                                <input type="hidden" name="active" value="0">
                                <input type="hidden" name="defective_id" value="<?php echo $data['defective_id'] ?>">
                                <input class="form-check-input fcustomCheck1" type="checkbox" value="1" name="active" id="fcustomCheck1" <?php if($data['active'] == 1)echo "checked"?>>
                                <label class="custom-control-label" for="customCheck1">Active</label>                              

                            </div>
                          <?php }?>
                        </td>



   

                        <?php if($admin_level == "admin") {?>
                          <td class="">
                            <div class="d-flex ">
                            <span class="ms-3">
                              <a href="<?php echo base_url('index.php/features/defectives_cont/Defective_controller/get_defective_Details/' .$data['defective_id']) ?>"  data-bs-toggle="tooltip" data-bs-placement="top" title="Update">
                                <div class="edit_container">
                                    <img class="edit_icon" src="<?php echo base_url('assets/items_img/edit.gif') ?>" alt="">
                                </div>
                              </a>
                            </span>
                            <!-- <span class="">
                                <a href="<?php echo base_url('index.php/features/defectives_cont/Defective_controller/delete_defective_data/' .$data['defective_id']) ?>" class="delete-link">
                                  <div class="edit_container">      
                                    <img class="edit_icon2" src="<?php echo base_url('assets/items_img/delete.gif') ?>" alt="">
                                  </div>
                                </a>
                            </span> -->
                            </div>
                          </td>
                        <?php }else{ ?>
                        <?php }?>
                      </tr>
                      <?php $sno++;?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                      <?php if(count($result) == 0){ ?>
                          <div class="d-flex justify-content-center align-items-center">
                            <h4 class="pt-2">No Result Found!</h4>
                          </div>
                      <?php }?>
                    <div class="">
                      <div class="ms-4 pt-2">
                         <?php echo $pagination ?>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <div class="pt-5">
            <a class="btn btn-gradient m-auto bg-danger text-light h5" href="<?php echo base_url('index.php/admin_logout') ?>">LOG-OUT</a>
        </div>
      </div>
    </div>
  </div>




      <!--CPU Modal-->

      <div class="popup_modal_container " id="modal1">
        <div class="popupModal  d-flex justify-content-center" id="modal2" >
            <div class="mt-1">  
              <div class=" modal_form_defective_cont shadow align-self-center ">
                      <div class="modal_box2 ">
                          <button class="modal_close_btn" type="submit"  onclick="close_pop_modal()" >
                            <img class="close_icon" src="<?php echo base_url('assets/items_img/close.gif') ?>" alt="">
                          </button>
                      </div>
                      <div class="modal_title">
                          <h5 class="itm_txt">ADD DEFECTIVE ITEM</h5>
                      </div>
                      <div class="  ">
                          <form  action="<?php echo base_url('index.php/insert_defective_item') ?>" method="POST" id="myform" class="ms-4 me-4  pb-3 " enctype="multipart/form-data">
                              <input class="d-none" type="number" value="1" name="active">
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /tag.png" alt=""></label>
                                  <input type="text" name="name_model" id="name_model" class="form-control name" placeholder="Name/Model" data-bs-toggle="tooltip" data-bs-placement="top" title="Name/Model" required>
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /brand.png" alt=""></label>
                                  <input type="text" name="brand" id="brand" class="form-control name" placeholder="Brand" data-bs-toggle="tooltip" data-bs-placement="top" title="Brand" required>
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /category5.png" alt=""></label>
                                  <select name="category" id="category" class="form-control" id="exampleFormControlSelect1" data-bs-toggle="tooltip" data-bs-placement="top" title="Category" required>
                                        <option value="" selected disabled>----Select category----</option>
                                        <?php foreach($categories as $category){ ?>
                                            <option value=""><?php echo $category['category_name']; ?></option>
                                        <?php } ?> 
                                    </select>


                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img/status.png') ?> " alt=""></label>
                                  <select name="status" id="status" class="form-control" id="exampleFormControlSelect1" data-bs-toggle="tooltip" data-bs-placement="top" title="Status" required>
                                    <option value="" selected disabled>----Select Status----</option>
                                    <option>Broken</option>
                                    <option>Repair</option>
                                    <option>Pending</option>
                                    <option>Replace</option>
                                    <option>Scrapped</option>
                                  </select>
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="supplier_error"><img class="general_icon " src="<?php echo base_url('assets/items_img') ?> /supplier.png" alt=""></label>
                                  <input type="text" name="supplier" id="supplier" class="form-control brnd" placeholder="Supplier" data-bs-toggle="tooltip" data-bs-placement="top" title="Supplier" required>
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="description_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /info.png" alt=""></label>
                                  <input type="text" name="description"  class="form-control" placeholder="Description" data-bs-toggle="tooltip" data-bs-placement="top" title="Description" required>
                              </div>

                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="description_error"><img class="general_icon" src="<?php echo base_url('assets/items_img/image.png') ?> " alt=""></label>
                                  <input type="file" name="userfile" id="userfile"  class="form-control" placeholder="image" data-bs-toggle="tooltip" data-bs-placement="top" title="Items Image" required>
                              </div>
                              <div class="row">
                                  <div class="d-flex justify-content-end mb-1 col item_mdal_inpt_container">
                                    <label class="me-3 mt-2 modal_label itm_pd" id="quantity_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /product.png" alt=""></label>
                                    <input type="number" name="quantity" id="quantity"  class="form-control" placeholder="Quantity" data-bs-toggle="tooltip" data-bs-placement="top" title="Quantity" required>
                                  </div>
                                  <div class="d-flex justify-content-end mb-1 col item_mdal_inpt_container">
                                    <label class="me-3 mt-2 modal_label itm_pd" id="brand_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /date_time.png" alt=""></label>
                                    <input type="datetime-local" name="date_found" id="date_found" class="form-control" placeholder="date" data-bs-toggle="tooltip" data-bs-placement="top" title="Date & Time" required>
                                  </div>
                              </div> 
                      

                              <div class="d-flex justify-content-center mt-4">
                                  <span>
                                    <div class="button-borders">
                                      <button type="submit"  class="primary-button" id="itm_ajax_sbmit_bttn">save </button>
                                    </div>
                                  </span>
                                
                              </div>
                          </form>
                      </div>
              </div>
            </div>
        </div>
      </div>
    <!-- end CPU modal-->









<script>
//<!-- THIS CODE IS FOR THE DELETE BUTTON  -->
class DeleteLink {
    constructor(linkElement) {
        this.linkElement = linkElement;
        this.addClickHandler();
    }

    addClickHandler() {
        this.linkElement.addEventListener('click', (event) => {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.executeLink();
                }
            });
        });
    }

    executeLink() {
        window.location.href = this.linkElement.getAttribute('href');
    }
}

const deleteLinks = document.querySelectorAll('.delete-link');
deleteLinks.forEach((link) => {
    new DeleteLink(link);
});
</script>



<!-- THIS CODE IS FOR THE ACTIVE STATUS UPDATE IF I CLICKED CHECK BOX IT WILL SEND 1 if it is check and 0 if it is uncheck -->

<!-- <script>

  const myForm = document.getElementById('myForm');
  const checkbox = document.getElementById('fcustomCheck1');

  checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
      myForm.querySelector('input[type="hidden"]').value = '1';
    } else {
      myForm.querySelector('input[type="hidden"]').value = '0';
    }
    myForm.submit();
  });
</script> -->

<script>
  const forms = document.querySelectorAll('.myForm');

  forms.forEach(form => {
    const checkbox = form.querySelector('.fcustomCheck1');

    checkbox.addEventListener('change', () => {
      if (checkbox.checked) {
        form.querySelector('input[type="hidden"]').value = '1';
      } else {
        form.querySelector('input[type="hidden"]').value = '0';
      }
      form.submit();
    });
  });
</script>





