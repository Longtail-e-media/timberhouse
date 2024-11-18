<?php
$booking_code = Config::getField('hotel_code', true);


/*
* Home accmodation list
*/
$reshmpkg = '';
$imageList = '';

if (defined('HOME_PAGE')) {
    $acid = Package::get_accommodationId();
    $pkgRec = Package::find_by_id($acid);
    if (!empty($pkgRec)) {
        $subRec = Subpackage::getPackage_limit($acid);

        if (!empty($subRec)) {
            $imglink = '';
            $reshmpkg .= '';

            $reshmpkg .= "";
            foreach ($subRec as $subRow) {

                $features_of_rooms = '';
                if ($subRow->class_room_style == 'best_deal') {
                    $features_of_rooms = '<div class="tags discount">Best Deal</div>';
                } elseif ($subRow->class_room_style == 'featured_room') {
                    $features_of_rooms = '<div class="tags featured">Featured Room</div>';
                }

                $img123 = unserialize($subRow->image);

                if (!empty($subRow->image)) {

                    $imgpath = IMAGE_PATH . 'subpackage/' . $img123[0];
                } else {
                    $imgpath = IMAGE_PATH . 'static/inner-img.jpg';
                }
                $file_path = SITE_ROOT . 'images/subpackage/' . $img123[0];
                if (file_exists($file_path) and !empty($subRow->image)) {
                    $reshmpkg .= '
                            <div class="col-md-4 room-item wow fadeInUp" data-wow-delay=".4s">
                               <div class="inner">
                                   ' . $features_of_rooms . '
                                   <img src="' . $imgpath . '" class="img-responsive" alt="' . $subRow->title . '">
                                   <h3>' . $subRow->title . '</h3>
                                   <div class="price_from">Start From <span>' . $subRow->currency . ' ' . $subRow->onep_price . '++</span>/night</div>
                                   <div class="spacer-half"></div>
                                   <a href="' . BASE_URL . $subRow->slug . '" class="btn-detail">View Details</a>
                               </div>
                           </div>
                                ';
                }
            }
            $reshmpkg .= '';
        }
    }
}




$jVars['module:home-accommodation'] = $reshmpkg;





/*
* Home sub package list
*/
$newpkg = '';

if (defined('HOME_PAGE')) {
    //$slug = !empty($_REQUEST['slug'])? addslashes($_REQUEST['slug']) : '';
    //$pkgRec = Package::getPackage();
    //if (!empty($pkgRec)) {

    /* foreach($pkgRec as $pkgRow) {
        $imglink = '';*/
    /* if ($pkgRow->banner_image != "a:0:{}") {
         $imageList = unserialize($pkgRow->banner_image);
         $file_path = SITE_ROOT . 'images/package/banner/' . $imageList[0];
         if (file_exists($file_path)) {
             $imglink = IMAGE_PATH . 'package/banner/' . $imageList[0];
         }
     } */
    // if(($pkgRow->type)==0) {
    $newpkg .= '<div class="col-sm-6">
                <div class="mosaic_container">
                     <a href="' . BASE_URL . 'page/about-us">
                    <img src="' . BASE_URL . 'template/web/img/mosaic_1.jpg" alt="image" class="img-responsive add_bottom_30"><span class="caption_2">Experience Peninsula</span>
                    </a>
                </div>
            </div>';
    //}else{
    $newpkg .= '<div class="col-sm-6">

         <div class="col-xs-12">
                    <div class="mosaic_container">
                        <a href="' . BASE_URL . 'services">
                        <img src="' . BASE_URL . 'template/web/img/mosaic_2.jpg" alt="image" class="img-responsive add_bottom_30"><span class="caption_2">Services & Faciities</span>
                        </a>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="mosaic_container">
                        <a href="' . BASE_URL . 'rooms">
                        <img src="' . BASE_URL . 'template/web/img/room.jpg" alt="rooms" class="img-responsive add_bottom_30"><span class="caption_2">
Accommodation</span>
                        </a>
                    </div>
                </div>
                  <div class="col-xs-6">
                     <a href="' . BASE_URL . 'dining">
                    <div class="mosaic_container">
                        <img src="' . BASE_URL . 'template/web/img/dining.jpg" alt="dining" class="img-responsive add_bottom_30"><span class="caption_2">Dining & Bar</span>
                    </div>
                    </a>
                </div>

                  </div>
                ';

    //}
    //}
    //}
}

$jVars['module:newpkg'] = $newpkg;


/////
$reshplist = $pakagehometype = '';
$cnt = 1;
if (defined('HOME_PAGE')) {
    $pgkRows = Package::find_by_id(1);
    $pkgRec = Subpackage::getPackage_limits(1, 6);

    if (!empty($pkgRec)) {

        foreach ($pkgRec as $pkgRow) {
            //echo "<pre>";print_r($pkgRow);die();

            //if(!empty($pkgRow->image2)) {


            //echo "<pre>";print_r($reshplist);die();
            if (($cnt % 3) == 2) {
                $reshplist .= ' <div class="container margin_60">
        <div class="row">
            <div class="col-md-5 col-md-offset-1 col-md-push-5">
                  <figure class="room_pic left"><a href="' . BASE_URL . '' . $pkgRow->slug . '"><img src="' . IMAGE_PATH . 'subpackage/image/' . $pkgRow->image2 . '" alt="' . $pkgRow->title . '" class="img-responsive"></a><span class="wow zoomIn"><sup>' . $pkgRow->currency . ' </sup>' . $pkgRow->onep_price . '<small>Per night</small></span></figure>
            </div>
            <div class="col-md-4 col-md-offset-1 col-md-pull-6">
                <div class="room_desc_home">
                    <h3>' . $pkgRow->title . '</h3>
                    <p>
                         ' . $pkgRow->detail . '
                    </p>
                    <ul>';
                $saveRec = unserialize($pkgRow->feature);
                $count = 1;
                if ($saveRec != null) {
                    $featureList = $saveRec[47][1];
                    //echo "<pre>";print_r($featureList);die();

                    if (!empty($featureList)) {
                        $icoRec = '';

                        foreach ($featureList as $fetRow) {

                            $icoRec = Features::get_by_id($fetRow);
                            $reshplist .= '<li>
                            <div class="tooltip_styled tooltip-effect-4">
                                <span class="tooltip-item"><i class="' . $icoRec->icon . '"></i></span>
                                    <div class="tooltip-content">' . $icoRec->title . '</div>
                              </div>
                              </li>';


                            if ($count++ == 5) break;
                        }
                    }
                }
                $reshplist .= '</ul>
                    <a href="' . BASE_URL . '' . $pkgRow->slug . '" class="btn_1_outline">Read more</a>
                </div><!-- End room_desc_home -->
            </div>
        </div><!-- End row -->
    </div>';
            } else {
                $reshplist .= '  <div class="container_styled_1">
        <div class="container margin_60">
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <figure class="room_pic"><a href="' . BASE_URL . '' . $pkgRow->slug . '"><img src="' . IMAGE_PATH . 'subpackage/image/' . $pkgRow->image2 . '" alt="' . $pkgRow->title . ' " class="img-responsive"></a><span class="wow zoomIn"><sup>' . $pkgRow->currency . ' </sup>' . $pkgRow->onep_price . '<small>Per night</small></span></figure>
                </div>
                <div class="col-md-4 col-md-offset-1">
                    <div class="room_desc_home">
                        <h3>' . $pkgRow->title . '  </h3>
                        <p>
                            ' . $pkgRow->detail . '
                        </p>
                        <ul>';
                $saveRec = unserialize($pkgRow->feature);
                $count = 1;
                if ($saveRec != null) {
                    $featureList = $saveRec[47][1];
                    //echo "<pre>";print_r($featureList);die();

                    if (!empty($featureList)) {
                        $icoRec = '';

                        foreach ($featureList as $fetRow) {

                            $icoRec = Features::get_by_id($fetRow);
                            $reshplist .= '<li>
                            <div class="tooltip_styled tooltip-effect-4">
                                <span class="tooltip-item"><i class="' . $icoRec->icon . '"></i></span>
                                    <div class="tooltip-content">' . $icoRec->title . '</div>
                              </div>
                              </li>';


                            if ($count++ == 5) break;
                        }
                    }
                }
                $reshplist .= '</ul>
                        <a href="' . BASE_URL . '' . $pkgRow->slug . '" class="btn_1_outline">Read more</a>
                    </div><!-- End room_desc_home -->
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
    </div>';
            }
            $cnt++;
            //}

        }
    }
    /* $reshplist.= '</div>
                 </div>
             </div>';*/
}
$jVars['module:home-packagelist'] = $reshplist;
$jVars['module:home-package-type-list'] = $pakagehometype;


$roomlist = $roombread = '';
$modalpopup = '';
$room_package = '';
$room__package_new = '';
if (defined('PACKAGE_PAGE') and isset($_REQUEST['slug'])) {

    $slug = !empty($_REQUEST['slug']) ? addslashes($_REQUEST['slug']) : '';

    $pkgRow = Package::find_by_slug($slug);
    if ($pkgRow->type == 1) {

        $imglink = BASE_URL . 'template/web/images/bg/room-banner.jpg';
        $pkgRowImg = $pkgRow->banner_image;
        if ($pkgRowImg != "a:0:{}") {
            $pkgRowList = unserialize($pkgRowImg);
            $file_path = SITE_ROOT . 'images/package/banner/' . $pkgRowList[0];
            if (file_exists($file_path) and !empty($pkgRowList[0])) {
                $imglink = IMAGE_PATH . 'package/banner/' . $pkgRowList[0];
            }
        }

        $roombread .= '
    <!--================ Breadcrumb ================-->
    <section class="page-title" style="background-image:url('. $imglink .')">
        <div class="auto-container">
            <h2>' . $pkgRow->title . '</h2>
        </div>
    </section>
    <!--================ End of Breadcrumb ================-->
    ';

        $sql = "SELECT *  FROM tbl_package_sub WHERE status='1' AND type = '{$pkgRow->id}' ORDER BY sortorder DESC ";

        $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"])) ? $_REQUEST["pageno"] : 1;
        $limit = 200;
        $total = $db->num_rows($db->query($sql));
        $startpoint = ($page * $limit) - $limit;
        $sql .= " LIMIT " . $startpoint . "," . $limit;
        $query = $db->query($sql);
        $pkgRec = Subpackage::find_by_sql($sql);
        // pr($pkgRec);

        if (!empty($pkgRec)) {


            foreach ($pkgRec as $key => $subpkgRow) {
                $imageList = '';
                if ($subpkgRow->image != "a:0:{}") {
                    $imageList = unserialize($subpkgRow->image);
                    $imgno = array_rand($imageList);
                    $file_path = SITE_ROOT . 'images/subpackage/thumbnails/' . $imageList[$imgno];
                    if (file_exists($file_path)) {
                        $imglink = IMAGE_PATH . 'subpackage/' . $imageList[$imgno];
                }else{
                    $imglink = BASE_URL . 'template/web/images/default.jpg';
                }
            }


                $roomlist .= '
            <div class="room-block-four">
                <div class="inner-box">
                    <figure class="image-box"><img src="'.$imglink.'" alt=""></figure>
                    <div class="cotnent-box">
                        <div class="upper-box">
                            <span class="price">From ' . $subpkgRow->currency . $subpkgRow->onep_price . ' Per Night</span>
                        </div>
                        <h5><a href="' . BASE_URL . $subpkgRow->slug . '">' . $subpkgRow->title . '</a></h5>
                        <div class="text">' . $subpkgRow->content . '</div>
                        <a href="' . BASE_URL . 'result.php?hotel_code=' . $booking_code . '" class="learn_more_btn px-4 py-2">Book Now</a>
                        <a href="' . BASE_URL . $subpkgRow->slug . '" class="btn btn-big style-2">Details</a>
                    </div>
                </div>
            </div>

                ';
            }
            $room__package_new .= '
                <!-- Rooms starts -->
                 <section class="rooms-section list-view view-all-rooms">
        <div class="auto-container">
          ' . $roomlist . '
        </div>
    </section>
                <!-- Room Ends -->';
        }
    } else {
        $imglink = BASE_URL . 'template/web/images/default.jpg';
        $pkgRowImg = $pkgRow->banner_image;
        if ($pkgRowImg != "a:0:{}") {
            $pkgRowList = unserialize($pkgRowImg);
            $file_path = SITE_ROOT . 'images/package/banner/' . $pkgRowList[0];
            if (file_exists($file_path) and !empty($pkgRowList[0])) {
                $imglink = IMAGE_PATH . 'package/banner/' . $pkgRowList[0];
            } else {
                $imglink = BASE_URL . 'template/web/images/default.jpg';
            }
        }

        $roombread .= '
    <!--================ Breadcrumb ================-->
    <section class="page-title" style="background-image:url('. $imglink .')">
        <div class="auto-container">
            <h2>' . $pkgRow->title . '</h2>
        </div>
    </section>
    <!--================ End of Breadcrumb ================-->

    ';

        $sql = "SELECT *  FROM tbl_package_sub WHERE status='1' AND type = '{$pkgRow->id}' ORDER BY sortorder DESC ";

        $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"])) ? $_REQUEST["pageno"] : 1;
        $limit = 200;
        $total = $db->num_rows($db->query($sql));
        $startpoint = ($page * $limit) - $limit;
        $sql .= " LIMIT " . $startpoint . "," . $limit;
        $query = $db->query($sql);
        $pkgRec = Subpackage::find_by_sql($sql);

        // pr($pkgRec);

        if (!empty($pkgRec)) {

            $count = 1;


            $max_count = count($subpkgRec);

            foreach ($pkgRec as $key => $subpkgRow) {
                $gallRec = SubPackageImage::getImagelimit_by(3, $subpkgRow->id);
                $subpkg_caro = '';
                foreach ($gallRec as $row) {
                    $file_path = SITE_ROOT . 'images/package/galleryimages/' . $row->image;
                    if (file_exists($file_path) and !empty($row->image)):

                        // $active=($count==0)?'active':'';
                        $subpkg_caro .= '
                    <div class="mad-owl-item">
                                        <img src="' . IMAGE_PATH . 'package/galleryimages/' . $row->image . '" alt="' . $row->title . '" />
                                    </div>



                                ';




                    endif;
                }

                $button = '';
                $modal = '';
                $imageList = '';
                if ($subpkgRow->image != "a:0:{}") {
                    $imageList = unserialize($subpkgRow->image);
                }
                if ($pkgRow->id == 11) {
                    $button = '<a href="contact-us" class="btn">Book Now</a>';
                    if (!empty($subpkgRow->below_content)) {
                        $modal = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#' . $subpkgRow->slug . '">
                details
              </button>';
                    } else {
                        $modal = '';
                    }
                } else {
                    $button = '<a href="#" class="btn">View Menu</a>';
                }

                if ($subpkgRow->type == 11) {

                    $modalpopup .= '
        <div class="modal fade" id="' . $subpkgRow->slug . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">' . $subpkgRow->title . ' details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            ' . $subpkgRow->below_content . '
            </div>
          </div>
        </div>
      </div>';
                    if ($count % 2 == 1) {
                        $roomlist .= '
            <div class="mad-section mad-section--stretched mad-colorizer--scheme-color-4">
                    <div class="mad-entities style-3 type-4">
                        <!--================ Entity ================-->
                        <article class="mad-entity">
                            <div class="mad-entity-media">
                                <div class="owl-carousel mad-simple-slideshow mad-grid with-nav">
                                    ' . $subpkg_caro . '
                                </div>
                            </div>

                            <div class="mad-entity-content">
                                <h2 class="mad-entity-title">' . $subpkgRow->title . '</h2>
                                <p>' . strip_tags($subpkgRow->content) . '</p>
                                <div class="mad-rest-info">
                                    <div class="mad-rest-info-item">
                                        <span class="mad-rest-title">Hall Amenities</span>
                                        <span>' . $subpkgRow->cocktail . '</span>
                                    </div>
                                    <div class="mad-rest-info-item">
                                        <span class="mad-rest-title">Size</span>
                                        <span>' . $subpkgRow->seats . '</span>
                                    </div>
                                </div>
                                ' . $button . ' ' . $modal . '
                                </div>


                        </article>
                        <!--================ End of Entity ================-->
                    </div>
                </div>


                ';
                    } else {
                        $roomlist .= '<div class="mad-section">
                <div class="mad-entities mad-entities-reverse type-4">
                    <!--================ Entity ================-->
                    <article class="mad-entity">
                        <div class="mad-entity-media">
                            <div class="owl-carousel mad-simple-slideshow mad-grid with-nav">
                            ' . $subpkg_caro . '
                            </div>
                        </div>
                        <div class="mad-entity-content">
                            <h2 class="mad-entity-title">' . $subpkgRow->title . '</h2>
                            <p>' . strip_tags($subpkgRow->content) . '</p>
                            <div class="mad-rest-info">
                            <div class="mad-rest-info-item">
                            <span class="mad-rest-title">Hall Amenities</span>
                            <span>' . $subpkgRow->cocktail . '</span>
                        </div>
                        <div class="mad-rest-info-item">
                            <span class="mad-rest-title">Size</span>
                            <span>' . $subpkgRow->seats . '</span>
                        </div>
                            </div>
                            ' . $button . ' ' . $modal . '
                        </div>

                    </article>
                    <!--================ End of Entity ================-->
                </div>
            </div>';
                    }
                    $count++;
                }


                if ($subpkgRow->type == 12) {
                    if ($count % 2 == 1) {
                        $roomlist .= '
            <div class="mad-section mad-section--stretched mad-colorizer--scheme-color-4">
                    <div class="mad-entities style-3 type-4">
                        <!--================ Entity ================-->
                        <article class="mad-entity">
                            <div class="mad-entity-media">
                                <div class="owl-carousel mad-simple-slideshow mad-grid with-nav">
                                    ' . $subpkg_caro . '
                                </div>
                            </div>

                            <div class="mad-entity-content">
                                <h2 class="mad-entity-title">' . $subpkgRow->title . '</h2>
                                <p>' . strip_tags($subpkgRow->content) . '</p>
                                <div class="mad-rest-info">
                                    <div class="mad-rest-info-item">
                                        <span class="mad-rest-title">Opening hours</span>
                                        <span>' . $subpkgRow->theatre_style . ' <br />' . $subpkgRow->class_room_style . '</span>
                                    </div>
                                    <div class="mad-rest-info-item">
                                        <span class="mad-rest-title">Cuisine</span>
                                        <span>' . $subpkgRow->shape . '</span>
                                    </div>
                                    <div class="mad-rest-info-item">
                                        <span class="mad-rest-title">Dess Code</span>
                                        <span>' . $subpkgRow->round_table . '</span>
                                    </div>
                                </div>
                                ' . $button . '
                                </div>
                        </article>
                        <!--================ End of Entity ================-->
                    </div>
                </div>


                ';
                    } else {
                        $roomlist .= '<div class="mad-section">
                <div class="mad-entities mad-entities-reverse type-4">
                    <!--================ Entity ================-->
                    <article class="mad-entity">
                        <div class="mad-entity-media">
                            <div class="owl-carousel mad-simple-slideshow mad-grid with-nav">
                            ' . $subpkg_caro . '
                            </div>
                        </div>
                        <div class="mad-entity-content">
                            <h2 class="mad-entity-title">' . $subpkgRow->title . '</h2>
                            <p>' . strip_tags($subpkgRow->content) . '</p>
                            <div class="mad-rest-info">
                                <div class="mad-rest-info-item">
                                    <span class="mad-rest-title">Opening hours</span>
                                    <span>' . $subpkgRow->theatre_style . '<br />' . $subpkgRow->class_room_style . ' </span>
                                </div>
                                <div class="mad-rest-info-item">
                                    <span class="mad-rest-title">Cuisine</span>
                                    <span>' . $subpkgRow->shape . '</span>
                                </div>
                                <div class="mad-rest-info-item">
                                    <span class="mad-rest-title">Dess Code</span>
                                    <span>' . $subpkgRow->round_table . '</span>
                                </div>
                            </div>
                            ' . $button . '
                        </div>

                    </article>
                    <!--================ End of Entity ================-->
                </div>
            </div>';
                    }
                    $count++;
                }
            }
            $room_package = '
                <!-- Rooms starts -->
                <div class="mad-content no-pd">
            <div class="container">
                <div class="mad-section">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mad-pre-title">M.I.C.E</div>
                            <h2 class="mad-page-title" style="font-size: 42px;line-height: 46px;">' . $pkgRow->sub_title . '</h2>
                        </div>
                        <div class="col-lg-7">
                            <p class="mad-text-medium">' . $pkgRow->content . '
                            </p>
                        </div>
                    </div>
                </div>
                                ' . $roomlist . '
                            </div>
                        </div>


                <!-- Room Ends -->';
        }
    }
    if ($pkgRow->id >= 14) {

        $room_package = '
                <!-- Rooms starts -->
                <div class="mad-content no-pd">
            <div class="container">
                <div class="mad-section">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mad-pre-title">' . $pkgRow->title . '</div>
                            <h2 class="mad-page-title" style="font-size: 42px;line-height: 46px;">' . $pkgRow->sub_title . '</h2>
                        </div>

                    </div>
                    <div class="col-lg-7">
                            <p class="mad-text-medium">' . $pkgRow->content . '
                            </p>
                        </div>
                </div>
                            </div>
                        </div>


                <!-- Room Ends -->';
    }
}


if (defined('HOME_PAGE')) {

    $sql = "SELECT *  FROM tbl_package_sub WHERE status='1' AND type = '15' ORDER BY sortorder DESC ";

    $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"])) ? $_REQUEST["pageno"] : 1;
    // $pkgrec = Package::find_by_id($subpkgRec->type);
    $limit = 200;
    $total = $db->num_rows($db->query($sql));
    $startpoint = ($page * $limit) - $limit;
    $sql .= " LIMIT " . $startpoint . "," . $limit;
    $query = $db->query($sql);
    $pkgRec = Subpackage::find_by_sql($sql);
    if (!empty($pkgRec)) {
        foreach ($pkgRec as $key => $subpkgRow) {
            // pr($subpkgRow);
            $gallRec = unserialize($subpkgRow->image);
            $imageList = '';
            $imagepath = '';
            if(!empty($gallRec[0])){
            $imageList = $gallRec[0];

$imagepath = IMAGE_PATH . 'subpackage/' . $imageList;


        }


            // pr($imagepath);

            $roomlist .= '
           <div class="room-block col-lg-4 col-md-6 col-sm-12">
    <div class="inner-box">
        <figure class="image"><img src="' . $imagepath . '" alt="">
            <span class="price position-absolute room_text_position">From ' . $subpkgRow->currency . $subpkgRow->onep_price . ' /Night</span></figure>
        <div class="overlay-cotnent">
            <h5><a href="' . BASE_URL . $subpkgRow->slug . '">' . $subpkgRow->title . '</a></h5>
            <div class="text"> ' . strip_tags($subpkgRow->detail) . '</div>
        </div>
    </div>
</div>
                ';
        }


}
}

$resturant = '';
$restaurant_img = '';
if (defined('HOME_PAGE')) {


    $sql2 = "SELECT *  FROM tbl_package_sub WHERE status='1' AND type = '16' ORDER BY sortorder DESC ";

    $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"])) ? $_REQUEST["pageno"] : 1;
    // $pkgrec = Package::find_by_id($subpkgRec->type);
    $limit = 200;
    $total = $db->num_rows($db->query($sql2));
    $startpoint = ($page * $limit) - $limit;
    $sql2 .= " LIMIT " . $startpoint . "," . $limit;
    $query = $db->query($sql2);
    $pkgRec = Subpackage::find_by_sql($sql2);


    if (!empty($pkgRec)) {
        foreach ($pkgRec as $key => $subpkgRow) {
            $gallRec = SubPackageImage::getImagelist_by($subpkgRow->id);

            $imageList = '';
            $imagepath = '';
            $imageList = $gallRec[0];


            $file_path = SITE_ROOT . 'images/package/galleryimages/' . $imageList->image;
            if (file_exists($file_path) and !empty($imageList)):

                $imagepath = IMAGE_PATH . 'package/galleryimages/' . $imageList->image;

                foreach ($gallRec as $row) {
                    $file_path = SITE_ROOT . 'images/package/galleryimages/' . $row->image;
                    if (file_exists($file_path) and !empty($row->image)):

                        // $active=($count==0)?'active':'';
                        $restaurant_img .= '
                        <div class="package-block-four">
                    <div class="inner-box">
                        <figure class="image"><img src="' . IMAGE_PATH . 'package/galleryimages/' . $row->image . '" alt="' . $row->title . '" ></figure>
                    </div>
                    </div>


                                ';

                    endif;
                }

            endif;

            $resturant .= '
           <div class="restaurant_text">
<div class="overlay-cotnent mt-3">
    <h5><a href="#" class="pt-2">' . $subpkgRow->title . '</a></h5>
    <div class="text mt-3 rest_content">' . strip_tags($subpkgRow->content) . '</div>
    <div class="restaurant_table mt-4">
        <div class="row mx-auto">
            <div class="col-md-3">
                <div class="d-flex flex-column align-items-center">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                    <a href="" class="text-dark">Book a Table</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center">
                    <i class="fa fa-user-clock" aria-hidden="true"></i>
                    <small class="text-dark"> 9:00 AM - 10:00 PM</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex flex-column align-items-center">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <a href="" class="text-dark">view Menu</a>
                </div>
            </div>
        </div>
    </div>
    <a href="' . BASE_URL . $subpkgRow->slug . '" class="learn_more_btn">Learn More</a>
</div>
</div>
                ';
        }


}
}

$jVars['module:restaurant_img_slider'] = $restaurant_img;
$jVars['module:restaurant-list'] = $resturant;
$jVars['module:details-page'] = $roomlist;
$jVars['module:list-modalpop-up'] = $modalpopup;
$jVars['module:list-package-room'] = $room__package_new;
$jVars['module:list-package-room-bred'] = $roombread;



/**
 *      Package Record
 */
/*
* Sub package
*/
$resubpkgDetail = '';
$subimg = '';
$imageList = '';

if (defined('SUBPACKAGE_PAGE') and isset($_REQUEST['slug'])) {
    $slug = !empty($_REQUEST['slug']) ? addslashes($_REQUEST['slug']) : '';
    $subpkgRec = Subpackage::find_by_slug($slug);
    $pkgrec = Package::find_by_id($subpkgRec->type);
    $gallRec = SubPackageImage::getImagelist_by($subpkgRec->id);
    $booking_code = Config::getField('hotel_code', true);
    if (!empty($subpkgRec)) {
        if ($pkgrec->type == 1) {
            $pricing = '<h4 class="price"><sup>From</sup> <br>' . $subpkgRec->currency . $subpkgRec->onep_price . ' /Night</h4>';
            $booknow = ' <a href="contact.html" class="learn_more_btn px-4">Book Now</a>';
        }else{
            $pricing = '';
            $booknow = '';
        }
        // $relPacs = Subpackage::get_relatedpkg(1, $subpkgRec->id, 12);
        $imglink = '';
        if (!empty($subpkgRec->image2)) {
            $file_path = SITE_ROOT . 'images/subpackage/image/' . $subpkgRec->image2;
            if (file_exists($file_path)) {
                $imglink = IMAGE_PATH . 'subpackage/image/' . $subpkgRec->image2;
            } else {
                $imglink = IMAGE_PATH . 'static/default-art-pac-sub.jpg';
            }
        } else {
            $imglink = IMAGE_PATH . 'static/default-art-pac-sub.jpg';
        }

        $pkgRec = Package::find_by_id($subpkgRec->type);
        $subpkg_carousel = $subpkg_carousel2 = '';
        foreach ($gallRec as $row) {
            $file_path = SITE_ROOT . 'images/package/galleryimages/' . $row->image;
            if (file_exists($file_path) and !empty($row->image)):

                $subpkg_carousel .= '
                  <div class="swiper-slide">
                   <figure class="image"><img src="' . IMAGE_PATH . 'package/galleryimages/' . $row->image . '" alt="' . $row->title . '" /></figure>
                    </div>
                            ';

            endif;
        }

        // $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($subpkgRec->content));
        // pr($subpkgRec);





        $resubpkgDetail .= '<section class="page-title" style="background-image:url(' . $imglink . ')">
            <div class="auto-container">
        <h2>' . $subpkgRec->title . '</h2>
                 </div>
                </section> ';

        $resubpkgDetail .= '

           <section class="room-detail-section">
             <div class="auto-container">
        <div class="room-gallery">
            <div class="swiper-container image-carousel">
                <div class="swiper-wrapper">
                    ' . $subpkg_carousel . '
                    </div>
            </div>
            <div class="swiper-container thumbs-carousel">
                <div class="swiper-wrapper">
                    ' . $subpkg_carousel2 . '
                     </div>
            </div>
        </div>
        <div class="room-detail-tabs tabs-box">
            <div class="room-detail">
              '.$pricing.'
                '.($subpkgRec->content).'
        <div class="btn-box text-center py-3">
           '.$booknow.'
        </div>


        ';

        $resubpkgDetail .= '   <div class="room-features mt-5">
                    <div class="row">';
        if (!empty($subpkgRec->feature)) {
            $ftRec = unserialize($subpkgRec->feature);
            if (!empty($ftRec)) {
                foreach ($ftRec as $k => $v) {
                    // $resubpkgDetail .= '<h3 class="room_d_title">' . $v[0][0] . '</h3>';
                    if (!empty($v[1])) {
                        $sfetname = '';
                        $i = 0;
                        $resubpkgDetail .= '';
                        $feature_list = '';
                        foreach ($v[1] as $kk => $vv) {
                            $sfetname = Features::find_by_id($vv);
                            $feature_list .= '

                                           <img src="' . BASE_URL . 'images/features/' . $sfetname->image . '" alt="' . $sfetname->title . '" />

                                        ';
                            $i++;
                            if (($i % 4 == 0) || (end($v[1]) == $vv)) {
                                $resubpkgDetail .= '
                                        <div class="feature-block col-lg-3 col-md-6 col-sm-12 ">
                                            <div class="inner-box">
                                                    ' . $feature_list . '
                                                <span class="title">' . $sfetname->title . '</span>
                                            </div>
                                        </div>

                                                ';
                                $feature_list = '';
                            }
                        }
                    }
                }
            }
        }


        $resubpkgDetail .= '</div>
                </div> ';

        $resubpkgDetail .= ' </div>
        </div>
        <!-- End Room Detail Tab -->
             </div>
             </section> ';







        $otherroom = '';
        $rooms = Subpackage::get_relatedsub_by($subpkgRec->type, $subpkgRec->id);


        if (!empty($rooms)) {


            foreach ($rooms as $room) {
                if (!empty($room->image)) {
                    $img123 = unserialize($room->image);

                    if (file_exists($file_path) && !empty($img123[0])) {
                        $imglink = IMAGE_PATH . 'subpackage/' . $img123[0];
                        $file_path = SITE_ROOT . 'images/subpackage/' . $img123[0];
                    } else {
                        $imglink = IMAGE_PATH . 'static/static.jpg';
                    }
                } else {
                    $imglink = IMAGE_PATH . 'static/static.jpg';
                }


                $otherroom .= '
                <div class="mad-col">
                    <!--================ Entity ================-->
                    <article class="mad-entity">
                        <div class="mad-entity-media">
                            <a href="' . BASE_URL . $room->slug . '">
                                <img src="' . $imglink . '" alt=""/>
                            </a>
                        </div>
                        <div class="mad-entity-content">
                            <h4 class="mad-entity-title">' . $room->title . '</h4>
                            <div class="mad-pricing-value">
                                <span>From</span>
                                <span class="mad-pricing-value-num">' . $room->currency . $room->onep_price . '/</span>
                                <span>night</span>
                            </div>
                            <div class="mad-entity-footer">
                                <div class="btn-set justify-content-center">
                                    <a href="#" class="btn btn-big">Book Now</a>
                                    <a href="' . BASE_URL . $room->slug . '" class="btn btn-big style-2">Details</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <!--================ End of Entity ================-->
                </div>


        ';
            }
            //$otherroom.='';
            $resubpkgDetail .= '
<h2 class="mad-page-title" style="display:none;">Related Rooms</h2>
<div class="mad-entities with-hover align-center type-3 item-col-3" style="display:none;">
                        ' . $otherroom . '
                        </div>
                        </div>
                    </div>

    ';
        }


        /********For service inner page ***************/
        else {
            $relPacs = Subpackage::get_relatedpkg(1, $subpkgRec->id, 12);
            $imglink = '';
            if (!empty($subpkgRec->image2)) {
                $file_path = SITE_ROOT . 'images/subpackage/image/' . $subpkgRec->image2;
                if (file_exists($file_path)) {
                    $imglink = IMAGE_PATH . 'subpackage/image/' . $subpkgRec->image2;
                } else {
                    $imglink = IMAGE_PATH . 'static/default.jpg';
                }
            } else {
                $imglink = IMAGE_PATH . 'static/default.jpg';
            }




            $resubpkgDetail .= '';
        }
    }
}

$jVars['module:sub-package-detail'] = $resubpkgDetail;



/**********        For What;s nearby from package **************/
$resubpkgDetail = '';
$relPacs = Subpackage::get_relatedpkg(10, 0, 12);

foreach ($relPacs as $relPac) {

    $imglink = '';
    if (!empty($relPac->image)) {
        $img123 = unserialize($relPac->image);
        $file_path = SITE_ROOT . 'images/subpackage/' . $img123[0];
        if (file_exists($file_path)) {
            $imglink = IMAGE_PATH . 'subpackage/' . $img123[0];
        } else {
            $imglink = IMAGE_PATH . 'static/default-art-pac-sub.jpg';
        }
    } else {
        $imglink = IMAGE_PATH . 'static/default-art-pac-sub.jpg';
    }
    $resubpkgDetail .= '

                                            <div class="col-lg-3 col-md-6">
                                                <div class="top-hotels-ii">
                                                    <img src="' . $imglink . '" alt=" ' . $relPac->title . '"/>
                                                    ' . $relPac->content . '
                                                    <div class="pp-details yellow">
                                                        <span class="pull-left">More Info</span>
                                                        <span class="pp-tour-ar">
                                                                <a href="javascript:void(0)"><i class="fa fa-angle-right pad-0"></i></a>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
}

$whats_nearby = '
            <section class="top-hotel">
                <div class="container-xxl px-5">
                    <div class="top-title">
                        <div class="row display-flex">
                            <div class="col-lg-8 mx-auto text-center">
                                <h2>What\'s <span>Nearby</span></h2>
                                <p class="mar-0">
                                    We are located at the heart of Lalitpur. Major shopping outlets, Patan Durbar Square, Hospitals, Banks, UN office, Government offices, etc are
                                    within walking distance.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--Gallery Section-->
                    <div class="row activities-slider">
                        ' . $resubpkgDetail . '
                    </div>
                </div>
            </section>';

// pr($whats_nearby);
$jVars['module:whats-nearby'] = $whats_nearby;
