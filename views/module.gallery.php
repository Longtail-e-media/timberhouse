<?php
$reslgall = '';

$gallRec = Gallery::getParentgallery(2);
if (!empty($gallRec)) {
foreach ($gallRec as $gallRow) {
$childRec = GalleryImage::getGalleryImages($gallRow->id);
if (!empty($childRec)) {
$reslgall .= '';
foreach ($childRec as $childRow) {
$file_path = SITE_ROOT . 'images/gallery/galleryimages/' . $childRow->image;
if (file_exists($file_path) and !empty($childRow->image)) {
    $reslgall .= '
            <div class="gallery-block">
                <figure class="image"><a href="' . IMAGE_PATH . 'gallery/galleryimages/' . $childRow->image . '" class="lightbox-image"
                        data-fancybox="gallery"><img src="' . IMAGE_PATH . 'gallery/galleryimages/' . $childRow->image . '" alt="' . $childRow->title . '"></a></figure>
            </div>
                    ';
}
}
$reslgall .= '';
}
}
}

$res_gallery = '
<section class="gallery-section style-two bg-light">
    <div class="container-fluid">
        <div class="sec-title text-center">
            <h2>Gallery</h2>
        </div>
        <!-- Gallery Carousel -->
        <div class="gallery-carousel-two owl-carousel owl-theme default-dots">
                        '. $reslgall .'
        </div>
    </div>
</section>';
$jVars['module:galleryHome'] = $res_gallery;



$dininggallery = '';
$galldining = GalleryImage::getImagelist_by(19, 3);
if (!empty($galldining)) {
    $dininggallery .= '<div class="row about">
                     <div class="demo-gallery">
    		     <div id="lightgallery" class="list-unstyled">';
    foreach ($galldining as $row) {
        $dininggallery .= '<div class="item col-sm-4 col-xs-12" data-responsive="' . IMAGE_PATH . 'gallery/galleryimages/' . $row->image . '" data-src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row->image . '" data-sub-html="<h4>' . $row->title . '</h4>">
                        <a href="">
                            <img src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row->image . '"/>
                        </a>
                    </div>';
    }
    $dininggallery .= '</div>
    </div>
    </div>';
}
$jVars['module:dining-gallery'] = $dininggallery;

$gallerybread='';
$siteRegulars = Config::find_by_id(1);
$imglink= $siteRegulars->gallery_upload ;
if(!empty($imglink)){
    $img= IMAGE_PATH . 'preference/gallery/' . $siteRegulars->gallery_upload ;
}
else{
    $img='';
}

$gallerybread='
    <section class="page-title" style="background-image:url('.$img.')">
        <div class="auto-container">
            <h2>Gallery</h2>
        </div>
    </section>
';

$jVars['module:gallery-bread'] = $gallerybread;

/**
 *      Main Gallery
 */
$thegal = $gallerylistbread = $thegalnav= '';
$gallRectit = Gallery::getParentgallery();

if ($gallRectit) {
    $thegal .= '';
    foreach ($gallRectit as $row) {
        $thegalnav .= '
        <li  class="filter" data-role="button" data-filter=" .' . $row->id . '">' . $row->title . '</li>';
    }
    $thegal .= '';

    // $thegal .= '
    //     <div id="gallery" class="gallery full-gallery de-gallery gallery-3-cols">
    // ';
    foreach ($gallRectit as $row) {

        $gallRec = GalleryImage::getGalleryImages($row->id);
        foreach ($gallRec as $row1) {
            // pr($row1);

            $file_path = SITE_ROOT . 'images/gallery/galleryimages/' . $row1->image;
            if (file_exists($file_path) and !empty($row1->image)):
                $thegal .= '
                    <div class="room-block-three all masonry-item ' . $row1->galleryid . ' col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <figure class="image">  <img src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row1->image . '" alt="' . $row1->galleryid . ' "></figure>
                        </div>
                    </div>

                ';
            endif;
        }
    }
    $thegal .= '';

}
$jVars['module:gallery-list'] = $thegal;
$jVars['module:gallery-nav'] = $thegalnav;