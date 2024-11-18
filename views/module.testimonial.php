<?php

/*
* Testimonial List Home page
*/
$restst = '';
$tstRec = Testimonial::get_alltestimonial(9);
if (!empty($tstRec)) {
    $restst .= '';
    foreach ($tstRec as $tstRow) {
        $slink = !empty($tstRow->linksrc) ? $tstRow->linksrc : 'javascript:void(0);';
        $target = !empty($tstRow->linksrc) ? 'target="_blank"' : '';
        $rating = '';
        for ($i = 0; $i < $tstRow->type; $i++){
            $rating.='<span class="fa fa-star"></span>';
        }
        $restst .= '';
        $restst .= '
        <!-- owl item -->
                            <div class="mad-grid-item">
                                <div class="mad-testimonial">
                                    <div class="mad-testimonial-info">
                                        <blockquote>
                                            <p>
                                                �' . strip_tags($tstRow->content) . '�
                                            </p>
                                        </blockquote>
                                    </div>

                                    <div class="mad-author">
                                        <div class="mad-author-info">
                                            <span class="mad-author-name">' . $tstRow->name . ' - ' . $tstRow->via_type . '</span>
                                              <a href="#"><img src="template/web/images/visor2.png" alt="" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
        <!-- / owl item -->
                    ';

        $restst .= '';
    }
    $restst .= '';
}

$result_last ='
<div class="mad-section mad-section--stretched mad-colorizer--scheme-color-3 with-svg-img mad-colorizer--scheme-light  content-element-main" data-bg-image-src="footer_4_bg_img.svg">
                    <!--================ Testimonials ================-->
                    <div class="mad-testimonials style-2">
                        <div class="mad-grid mad-grid--cols-1 owl-carousel no-dots nav-size-2">
                    '. $restst .'
                    </div>
                    </div>
                    <!--================ End of Testimonials ================-->
                </div>';


$jVars['module:testimonialList123'] = $result_last;



/*
* Testimonial Header Title
*/
$tstHtitle='';

if(defined('HOME_PAGE')) {
    $tstHtitle.='
                <div class="auto-container">
                <div class="sec-title text-center">
                    <h2>Client\'s Feedback</h2>
                </div>
                <div class="outer-box">
                    <div class="testimonial-carousel-three owl-carousel owl-theme default-nav">
    ';
    $tstRec = Testimonial::get_alltestimonial();
    if(!empty($tstRec)) {



        foreach($tstRec as $tstRow) {
            $rating = '';
            for ($i = 0; $i <$tstRow->rating; $i++){
                $rating.='<span class="fa fa-star"></span>';
            }
            $tstHtitle.='<div class="testimonial-block-three">
    <div class="inner-box ">
        <div class="content-column text-center">
            <div class="text"> '.strip_tags($tstRow->content).'</div>
            <div class="rating justify-content-center">
           '.$rating.'
            </div>
            <div
                class="testi_info d-flex justify-content-center gap-3 flex-column align-items-center">
                <figure class="image"><img src="'.IMAGE_PATH.'testimonial/'.$tstRow->image.'" alt="'.$tstRow->name.'"  width="50"></figure>
                <div class="testimo_info">
                    <h5 class="name">'.$tstRow->name.'</h5>
                    <span class="designation">'.$tstRow->via_type.'</span>
                </div>
            </div>
        </div>
    </div>
</div>';
        }
    $tstHtitle.='</div>
                </div>
            </div>';
 }
}
$jVars['module:testimonial-title'] = $tstHtitle;


/*
* Testimonial Rand
*/
$tstHead='';

$tstRand = Testimonial::get_by_rand();
if(!empty($tstRand)) {
	$tstHead.='<!-- Quote | START -->
	<div class="section quote fade">
		<div class="center">

	        <div class="col-1">
	        	<div class="thumb"><img src="'.IMAGE_PATH.'testimonial/'.$tstRand->image.'" alt="'.$tstRand->name.'"></div>
	            <h5><em>'.strip_tags($tstRand->content).'</em></h5>
	            <p><span><strong>'.$tstRand->name.', '.$tstRand->country.'</strong> (Via : '.$tstRand->via_type.')</span></p>
	        </div>

	    </div>
	</div>
	<!-- Quote | END -->';
}

$jVars['module:testimonial-rand'] = $tstHead;


/*
* Testimonial List
*/
$restst='';
$tstRec = Testimonial::get_alltestimonial(9);
if(!empty($tstRec)) {
	$restst.='<div class="clients_slider owl-carousel" id="testi-slider">';

        foreach($tstRec as $tstRow) {
            $slink = !empty($tstRow->linksrc)?$tstRow->linksrc:'javascript:void(0);';
            $target = !empty($tstRow->linksrc)?'target="_blank"':'';
            $restst.='<div class="item">
                        <div class="media">
                        <div class="col-md-3 col-sm-3">
                            <div class="test-img">
                                <a href="'.$slink.'" '.$target.'>
                                    <img src="'.IMAGE_PATH.'testimonial/'.$tstRow->image.'" alt="'.$tstRow->name.'" class="img-responsive">
                                </a>
                            </div>
                            </div>

                            <div class="col-md-9 col-sm-9">
                            <div class="media-body test">
                                <p><i>“</i>'.strip_tags($tstRow->content).'</p>
                                <a href="'.$slink.'" '.$target.'>
                                    <h4>'.$tstRow->name.'</h4>
                                </a>
                            </div>
                            </div>
                        </div>
                    </div>';
        }
    $restst.='</div>';
}

$jVars['module:testimonialList'] = $restst;
?>