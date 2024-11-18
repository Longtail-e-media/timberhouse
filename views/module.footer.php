<?php
$siteRegulars = Config::find_by_id(1);
$lastElement='';
$phonelinked='';
$whatsapp='';
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
$phoneno = explode("/", $siteRegulars->whatsapp);
$lastElement = array_shift($phoneno);
$phonelinked .= '<a href="tel:+977-' . $lastElement . '" target="_blank">' . $lastElement. '</a>/';
foreach ($phoneno as $phone) {

    $phonelinked .= '<a href="tel:+977-' . $phone . '" target="_blank">' . $phone . '</a>';
    if(end($phoneno)!= $phone){
    $phonelinked .= '/';
    }
}


$footer = '
    <footer class="main-footer">
        <!--Widgets Section-->
        <div class="widgets-section footer_padding">
            <div class="auto-container">
                <div class="row">
                    <!--Footer Column-->
                    <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                        <!--Footer Column-->
                        <div class="footer-widget contact-widget">
                            <!--Footer Column-->
                            <div class="widget-content">
                                <ul class="contact-list">
                                    <li><i class="fa fa-map-marker"></i> '. $siteRegulars->fiscal_address .'</li>
                                    <li><i class="fa fa-mobile"></i> '. $tellinked .'</li>
                                    <li><i class="fa fa-envelope"></i> <a href="mailto:'.$siteRegulars->contact_info2.'">'.$siteRegulars->contact_info2.'</a></li>
                                </ul>
                                <ul class="social-icon-one mt-4">
                                    ' . $jVars['module:socilaLinkbtm'] .'
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Footer Column-->
                    <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                        <div class="footer-widget">
                            <ul class="user-links quick_links d-flex ">
                                '. $jVars['module:res--menu1'] .'
                            </ul>
                        </div>
                        <div class="user-links quick_links d-flex">
                       <h6 class="color-grey">We Accept</h6><img src="'.BASE_URL.'template/web/img/card.png" alt="" width="180">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Footer Bottom-->
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="inner-container">
                     <div class="copyright-text">
                        '. $jVars['site:copyright'] .'
                    </div>
                    <div class="footer-nav">
                        <ul class="clearfix">
                           <li><a href="#">Privacy Policy</a></li>
                           <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
           ';


$jVars['module:footer'] = $footer;

if(!empty($siteRegulars->whatsapp_a)){
$whatsapp='
<div class="messenger">
<a href="'.$siteRegulars->whatsapp_a.'" target="_blank"><img src="'.BASE_URL.'template/web/images/whatsapp.png"></a>
</div>';
}
else{
    $whatsapp='';
}

$jVars['module:footer-whatsapp'] = $whatsapp;
