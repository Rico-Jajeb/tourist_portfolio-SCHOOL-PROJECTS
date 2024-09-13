


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


        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <div class="cont-het d-flex align-items-center">
                    <img class="me-2 system_logo2" src="<?php echo base_url('assets/image/system_logo/' . $data2['result']['system_logo']) ?>" alt="..." />
                    <a class="navbar-brand text_shadow2" href="#page-top"><?php echo $data2['result']['system_tittle'] ?></a>
                </div>
                <!-- <a class="navbar-brand cont-het text_shadow2" href="#page-top"><?php echo $data2['result']['system_tittle'] ?></a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link text_shadow2" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link text_shadow2" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link text_shadow2" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link text_shadow2" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link text_shadow2" href="#contact">Contact</a></li>
                        <li class="ms-5 nav-item"><a class="nav-link text_shadow2" href="<?php echo base_url('sign_in') ?>">login</a></li>
                        
                    </ul>
                    
                </div>

            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead blurr page_header" style="background-image: url('<?php echo base_url('assets/image/system_background_img/' . $data2['result']['system_background_image']) ?>')">
            <div class="container cont_dis">
                <div class="masthead-subheading text_shadow">Welcome To  <?php echo $data2['result']['system_tittle'] ?></div>
                <div class="masthead-heading text-uppercase cont_dis"> <h1 class="text_shadow"><?php echo $data2['result']['system_quote'] ?></h1> </div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase pb-4">Services</h2>
                    <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
                <div class="row text-center d-flex justify-content-center ">
                    <?php foreach($data3['result']  as $service){ ?>

                    <div class="col-md-4 ">
                        <span class="fa-stack fa-4x ">
                            <div class="services_cont m-auto"><img class=" system_logo2 " src="<?php echo base_url('assets/image/services/' . $service['services_img']) ?>" alt="..." /></div>
                        </span>
                        <h4 class="my-3"><?php echo $service['services_title'] ?></h4>
                        <p class="text-muted"><?php echo $service['services_description'] ?></p>                            
                    </div>
                    <?php }?>
                </div>
            </div>
        </section>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase " >Portfolio</h2>
                    <div class="debuff  mb-5">
                        <button type="button" class="portfolio_btn2 debuff" onclick="image()"><b id="img_bg">Image</b> </button>
                        <button type="button" class="portfolio_btn2 debuff"  onclick="video()"> <b id="vid_bg">Video</b>   </button>
                    </div>
                    <!-- <h3 class="section-subheading text-muted">Image</h3> -->
                </div>
                <div class="row" id="imagee">

                    <?php foreach ($data1['result'] as $row) { ?>
                        <div class="card_img col-lg-4 col-sm-6 mb-5 m-auto">
                            <div class="content_img">
                                <img class="img_fit" src="<?php echo base_url('assets/image/portfolio_image/' . $row['image']) ?>" alt="..." />
                                <div class="portfolio-caption">
                                    <div class="portfolio_caption_heading"><?php echo $row['image_title'] ?></div>
                                    <div class="portfolio-caption-subheading text-muted mt-2">
                                        <?php
                                        $caption = $row['image_caption'];
                                        if (strlen($caption) > 40) {
                                            $visibleCaption = substr($caption, 0, 40);
                                            $hiddenCaption = substr($caption, 40);
                                            echo $visibleCaption;
                                        ?>
                                            <span class="dropdownButton" onclick="toggleCaption(this)" style="cursor: pointer;">...</span>
                                            <span class="hiddenCaption" style="display: none;"><?php echo $hiddenCaption; ?></span>
                                        <?php
                                        } else {
                                            echo $caption;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <div class="row video_container"  id="video0">
                    <?php foreach($data6['result'] as $video){  ?>
                        <div class="col-lg-4 col-sm-6 mb-4 m-auto " >
                            <!-- Portfolio item-->
                            <div class="portfolio-item">
                                <a class="portfolio-link debuff2" data-bs-toggle="modal" href="#">
                                    <?php
                                        $video_url = $video['video_yt_link'];
                                        // Extract the video ID from the YouTube link
                                        $video_id = ''; // Initialize the video ID variable
                                        $url_parts = explode('/', $video_url); // Split the URL by '/'
                                        $last_part = end($url_parts); // Get the last part of the URL
                                        if (strpos($last_part, 'watch?v=') !== false) {
                                        // If the last part contains 'watch?v=', extract the video ID
                                        $video_id = substr($last_part, strpos($last_part, 'watch?v=') + 8);
                                        } else {
                                        // If the last part doesn't contain 'watch?v=', consider it as the video ID
                                        $video_id = $last_part;
                                        }
                                        $embed_url = "https://www.youtube.com/embed/{$video_id}";
                                    ?>
                                        <iframe width="100%" height="250" src="<?php echo $embed_url ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading"><?php echo $video['video_title'] ?></div>
                                    <!-- <div class="portfolio-caption-subheading text-muted"><?php echo $video['video_description'] ?></div> -->
                                    <div class="portfolio-caption-subheading text-muted  debuff">
                                        <?php
                                        $caption = $video['video_description'];
                                        if (strlen($caption) > 40) {
                                            $visibleCaption = substr($caption, 0, 40);
                                            $hiddenCaption = substr($caption, 40);
                                            echo $visibleCaption;
                                        ?>
                                            <span class="dropdownButton" onclick="toggleCaption(this)" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Show more">...</span>
                                            <span class="hiddenCaption" style="display: none;"><?php echo $hiddenCaption; ?></span>
                                        <?php
                                        } else {
                                            echo $caption;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </section>


        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase" id="abt">About</h2>
                    <h3 class="section-subheading text-muted">In the humble embrace of our journey, a thousand stories unfolded, forever etching their magic into the tapestry of time</h3>
                </div>
                <ul class="timeline">

                <?php
                $counter = 0;

                foreach ($data4['result'] as $about) {
                    $counter++;

                    // Check if the counter is odd or even to determine the li design
                    $isOdd = $counter % 2 !== 0;
                    $liClass = $isOdd ? '' : 'timeline-inverted';

                    // Output the li element based on the design
                    ?>
                    <li class="<?php echo $liClass; ?>">
                        <?php if ($isOdd) { ?>
                            <div class="timeline-image d-flex align-items-center justify-content-center">
                                <img class="img_about" src="<?php echo base_url('assets/image/about_us/' . $about['about_image']); ?>" alt="..." />
                            </div>
                        <?php } else { ?>
                            <div class="timeline-image d-flex align-items-center justify-content-center">
                                <img class="img_about" src="<?php echo base_url('assets/image/about_us/' . $about['about_image']); ?>" alt="..." />
                            </div>
                        <?php } ?>
                        
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4><?php echo $about['about_year']; ?></h4>
                                <h4 class="subheading"><?php echo $about['about_title']; ?></h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted"><?php echo $about['about_story']; ?></p>
                            </div>
                        </div>
                    </li>
                <?php } ?>
                </ul>
            </div>
        </section>
 
                

        
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase pb-5">Our Amazing Team</h2>
                    <!-- <h3 class="section-subheading ">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
                <div class="row">
                    <?php foreach($data5['result'] as $team){ ?>
                    <div class="col-lg-4 m-auto">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle object_fit" src="<?php echo base_url('assets/image/team/' . $team['team_img']); ?>" alt="..." />
                            <h4><?php echo $team['team_name'] ?></h4>
                            <p class=""><?php echo $team['team_role'] ?></p>
                            <ul class="debuff">
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $team['team_twitter_link'] ?>" aria-label="Parveen Anand Twitter Profile" target="_blank"><i class="fab fa-twitter"></i></a>
                         
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $team['team_facebook_link'] ?>" aria-label="Parveen Anand Facebook Profile" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $team['team_instagram_link'] ?>" aria-label="Parveen Anand Facebook Profile" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                            </ul>
                        </div>
                    </div>
                    <?php }?>
                </div>

            </div>
        </section>


        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="row align-items-stretch mb-5 debuff">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="text-center "><button class="btn btn-primary debuff btn-xl text-uppercase disabled" id="submitButton" type="submit">Send Message</button></div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2022</div>
                    <div class="col-lg-4 my-3 my-lg-0 debuff">
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $data2['result']['twitter_link'] ?>" aria-label="Twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $data2['result']['facebook_link'] ?>" aria-label="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $data2['result']['instagram_link'] ?>" aria-label="LinkedIn" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <!-- <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="<?php echo base_url('assets/assets/img/close-icon.svg')?>" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    
                                    <h2 class="text-uppercase">Project Name2</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="<?php echo base_url('assets/assets/img/portfolio/1.jpg')?>" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Threads
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Illustration
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        
<script>

    let img_bg = document.getElementById('img_bg'); 
    let vid_bttn = document.getElementById('vid_bg');
    let abt = document.getElementById('abt');
// adi an section
  let video0 = document.getElementById('video0');
  let imagee = document.getElementById('imagee');


  function image() {
  imagee.style.display = "flex";
  video0.style.display = "none";

 }

  function video() {
      imagee.style.display = "none";
      video0.style.display = "flex";
  }
</script>


<!--         
<script>

  let img_bg = document.getElementById('img_bg'); 
  let vid_bttn = document.getElementById('vid_bg');
 

// adi an section
    let video0 = document.getElementById('video0');
    let imagee = document.getElementById('imagee');

    // function image(){
    //     imagee.style.display = "block";
    //     video0.style.display = "none";
    //     delivered.style.display = "none";
    //     vid_bttn.style.borderBottom = "none";
    //     img_bg.style.borderBottom = "2px solid red";
    // }
    // function video(){
    //     imagee.style.display = "none";
    //     video0.style.display = "block";
    //     delivered.style.display = "none";
    //     vid_bttn.style.borderBottom = "2px solid red";
    //     img_bg.style.borderBottom = "none";
   
    // }



</script> -->

<script>
    function toggleCaption(button) {
        var parent = button.parentNode;
        var hiddenCaption = parent.getElementsByClassName("hiddenCaption")[0];

        if (hiddenCaption.style.display === "none") {
            hiddenCaption.style.display = "inline";
            button.innerHTML = " &#x25B2;"; // Upwards arrow
        } else {
            hiddenCaption.style.display = "none";
            button.innerHTML = " &#x25BC;"; // Downwards arrow
        }
    }
</script>










