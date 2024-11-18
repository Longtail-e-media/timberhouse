<?php
/*
* Contact form
*/
$rescont = $innerbred = '';
$img='';
if (defined('CONTACT_PAGE')) {


    $siteRegulars = Config::find_by_id(1);

    $tellinked = '';
    $telno = explode("/", $siteRegulars->contact_info);
    $lastElement = array_shift($telno);
    $tellinked .= '<a href="tel:' . $lastElement . '" target="_blank">' . $lastElement . '</a>/';
    foreach ($telno as $tel) {

        $tellinked .= '<a href="tel:+977-' . $tel . '" target="_blank">' . $tel . '</a>';
        if(end($telno)!= $tel){
        $tellinked .= '/';
        }
}
$imglink= $siteRegulars->contact_upload ;
if(!empty($imglink)){
    $img= IMAGE_PATH . 'preference/contact/' . $siteRegulars->contact_upload ;
}
else{
    $img='';
}
        // pr($siteRegulars);
    $rescont .= '
        <!--Page Title-->
    <section class="page-title" style="background-image:url('.$img.')">
        <div class="auto-container">
            <h2>Contact Us</h2>
        </div>
    </section>
    <!--End Page Title-->
    <!-- Contact Section-->
    <section class="contact-section contact_us_page">
        <div class="auto-container">
            <div class="row">
                <!--Column-->
                <div class="form-column col-lg-8 col-md-12 col-sm-12 order-2">
                    <div class="inner-column">
                        <!-- Contact Form -->
                        <div class="contact-form">
                            <!--Contact Form-->
                        <form method="post" action="" id="contact-form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="name" placeholder="First Name" required>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="lname" placeholder="Last Name" required>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="Your Email" required>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="phone" placeholder="Phone" required>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="message" placeholder="Massage"></textarea>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <button class="contact_ctc" type="submit" name="submit-form" id="submit">Send Message</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!--End Contact Form -->
                    </div>
                </div>

                <!--Column-->
                <div class="info-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="contact-block">
                            <div class="inner-box">
                                <span class="icon flaticon-phone-call"></span>
                                <h5>Phone</h5>
                                <p>'. $tellinked .'</p>
                            </div>

                        </div>

                        <div class="contact-block">
                            <div class="inner-box">
                                <span class="icon flaticon-envelope"></span>
                                <h5>Email</h5>
                                <p><a href="mailto:'.$siteRegulars->contact_info2.'">'.$siteRegulars->contact_info2.'</a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="form-column col-lg-8 col-md-12 col-sm-12 order-2">
                    <div class="map-outer">
                        <iframe src="'. $siteRegulars->location_map .'" width="100%" height="500px"></iframe>
                </div>
                </div>
                <div class="info-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <div class="timber_img">
                            <img src="'.BASE_URL.'/template/web/img/about.jpg"  alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Services Section-->

    ';
}

$jVars['module:contact-us'] = $rescont;
