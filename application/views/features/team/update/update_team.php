
<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

<?php if ($this->session->userdata('connect') == true ){
      $sess = $this->session->userdata('admin_username');
      $sess2 = $this->session->userdata('admin_id');}
      // $image_path = base_url('image/user_img/' . $this->session->userdata('image'));
      if(empty($sess)){
        redirect('sign_in');
}?>
    



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

<div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header d-flex align-items-center ">
        <img src="<?php echo base_url('assets/image/system_logo/' . $data2['result']['system_logo']) ?>" class="ms-4  system_logo2" alt="main_logo">
        <span class="ms-1 font-weight-bold"><?php echo $data2['result']['system_tittle'] ?></span>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('index.php/Dashboard') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <img class="icon_img_db" src="<?php echo base_url('assets/items_img/dashboard2.png') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>  
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('index.php/portfolio') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
             <img class="icon_img_db" src="<?php echo base_url('assets/items_img/image.png') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1 ">IMAGE
              
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('index.php/port_video') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <img class="icon_img_db" src="<?php echo base_url('assets/items_img/video-player.png') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1">VIDEO</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('index.php/services_table') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img class="icon_img_db" src="<?php echo base_url('assets/items_img/customer-service.png') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1">Services</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('index.php/about_table') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img class="icon_img_db" src="<?php echo base_url('assets/items_img/about-us.png') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1">About Us</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-primary text-light" href="<?php echo base_url('index.php/team_table') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img class="icon_img_db" src="<?php echo base_url('assets/items_img/group.png') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1">Team</span>
          </a>
        </li>
        <br>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('index.php/Customize') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img class="icon_img_db" src="<?php echo base_url('assets/items_img/custom.png') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1">Customization</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('index.php/admin_sign_up') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img class="icon_img_db" src="<?php echo base_url('assets/items_img/team.png') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1">Admin Creation</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('index.php/audit_logs_table') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img class="icon_img_db" src="<?php echo base_url('assets/items_img/documents.png') ?>" alt="">
            </div>
            <span class="nav-link-text ms-1">Audit Logs</span>
          </a>
        </li>
      </ul>
    </div>

  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Team</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Team</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none"><?= $sess ?></span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="<?php echo base_url('assets/assets/img/team-2.jpg') ?>" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
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
                        <img src="<?php echo base_url('assets/dashboard_assets/assets/img/small-logos/logo-spotify.svg') ?>" class="avatar avatar-sm bg-gradient-dark  me-3 ">
        
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
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
                        <p class="text-xs text-secondary mb-0">
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
    <div class="container-fluid mt-5 py-4">
      <div class="row">
        <div class="col-12">
          <div class=" row mb-4 p-3">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 m-auto card shadow">
              <h2 class="text-center pt-4">Update team info</h2>
              <form  action="<?php echo base_url('index.php/update_team') ?>" method="POST" id="myform" class="ms-4 me-4  pb-3 " enctype="multipart/form-data">
                        <input class="d-none" type="number" value="<?php echo $sess2 ?>" name="admin_id">
                        <input class="d-none" type="text" value="<?php echo $sess ?>" name="admin_name2">
                    <input class="d-none" name="team_id" type="text" value="<?php echo $data1['result']['team_id'] ?>">  
                    <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /tag.png" alt=""></label>
                                  <input type="text" name="name" id="name_model" value="<?php echo $data1['result']['team_name'] ?>" class="form-control name" placeholder="Name" data-bs-toggle="tooltip" data-bs-placement="top" title="Name" >
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /tag.png" alt=""></label>
                                  <input type="text" name="role" id="name_model" value="<?php echo $data1['result']['team_role'] ?>" class="form-control name" placeholder="Role" data-bs-toggle="tooltip" data-bs-placement="top" title="Role" >
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /caption.png" alt=""></label>
                                  <input type="text" name="twitter_link" value="<?php echo $data1['result']['team_twitter_link'] ?>" id="brand" class="form-control name" placeholder="Twitter Link" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter Link" >
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /caption.png" alt=""></label>
                                  <input type="text" name="facebook_link" value="<?php echo $data1['result']['team_facebook_link'] ?>" id="brand" class="form-control name" placeholder="Facebook Link" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook Link" >
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /caption.png" alt=""></label>
                                  <input type="text" name="instagram_link" value="<?php echo $data1['result']['team_instagram_link'] ?>" id="brand" class="form-control name" placeholder="Instagram Link" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram Link" >
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="description_error"><img class="general_icon" src="<?php echo base_url('assets/items_img/image.png') ?> " alt=""></label>
                                  <input type="file" name="userfile" id="userfile"  class="form-control" placeholder="image" data-bs-toggle="tooltip" data-bs-placement="top" title="About us Image" >
                              </div>
                  
                  <div class="d-flex justify-content-center mt-4">
                      <span>
                        <div class="button-borders">
                          <button type="submit"  class="primary-button">Update </button>
                        </div>
                      </span>
                    
                  </div>
              </form>
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
                          <h5 class="itm_txt">ADD New Portfolio</h5>
                      </div>
                      <div class="  ">
                          <form  action="<?php echo base_url('index.php/insert_portfolio_img') ?>" method="POST" id="myform" class="ms-4 me-4  pb-3 " enctype="multipart/form-data">
                              <input class="d-none" type="number" value="1" name="active">
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /tag.png" alt=""></label>
                                  <input type="text" name="image_title" id="name_model" class="form-control name" placeholder="Image Title" data-bs-toggle="tooltip" data-bs-placement="top" title="Image" required>
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="name_error"><img class="general_icon" src="<?php echo base_url('assets/items_img') ?> /caption.png" alt=""></label>
                                  <input type="text" name="image_caption" id="brand" class="form-control name" placeholder="Image Caption" data-bs-toggle="tooltip" data-bs-placement="top" title="Image Caption" required>
                              </div>
                              <div class="d-flex justify-content-end mb-2 item_mdal_inpt_container">
                                  <label class="me-4 mt-2 modal_label itm_pd" id="description_error"><img class="general_icon" src="<?php echo base_url('assets/items_img/image.png') ?> " alt=""></label>
                                  <input type="file" name="userfile" id="userfile"  class="form-control" placeholder="image" data-bs-toggle="tooltip" data-bs-placement="top" title="Items Image" required>
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






    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
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
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
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
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <div class="">
          <a class="btn btn-danger" href="<?php echo base_url('index.php/admin_logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>


