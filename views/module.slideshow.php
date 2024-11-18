<?php
/* First Slideshow */
$reslide='';

$Records = Slideshow::getSlideshow_by(0);
// var_dump($Records); die();
// if($Records) {
//     $reslide.='';
//         foreach($Records as $RecRow) {
//             if(!empty($RecRow->source)){
//                 $reslide.='

//                 <div class="video-fullscreen-wrap">
//    <iframe src="'.$RecRow->source.'?rel=0&autoplay=1&loop=1&mute=1&controls=0&playlist=vZjqrPshuJ4" title="By Ace Hotel" frameborder="0" allowfullscreen></iframe>
//         </div>


//         <div class="v-middle caption overlay">
//             <div class="container">
//                 <div class="row">
//                      <div class="col-md-10 offset-md-1">

//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>

//                    ';
//             }
//             $file_path = SITE_ROOT.'images/slideshow/'.$RecRow->image;
//             if(file_exists($file_path) and !empty($RecRow->image)) {
//                 $reslide.='
//                 <div class="mad-media-element with-overlay" data-bg-image-src="'.IMAGE_PATH.'slideshow/'.$RecRow->image.'"alt="'.$RecRow->title.'>
//             <div class="mad-media-element-inner">

//                 <div class="mad-media-element-inner">
//                 <div class="mad-pre-title">'.$RecRow->title.'</div>
//                 <h1 class="mad-title">'.$RecRow->content.'</h1>
//                 </div>

//                 ';

//             }
//         }
//     $reslide.='';
// }


if ($Records) {
    foreach ($Records as $RecRow) {
        $file_path = SITE_ROOT . 'images/slideshow/' . $RecRow->image;
        if (file_exists($file_path) and !empty($RecRow->image)) {
            $reslide .= '
         <div class="slide-item">
<figure class="image"><img src="' . IMAGE_PATH . 'slideshow/' . $RecRow->image . '" alt="' . $RecRow->title . '"></figure>
</div>
            ';
        }
    }
}

$jVars['module:slideshow']= $reslide;
?>

