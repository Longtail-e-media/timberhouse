<?php
$resinndetail = $imageList = $innerbred = $t = '';
$homearticle = Article::find_by_id(16);
if (!empty($homearticle)) {
    if ($homearticle->image != "a:0:{}") {
        $imageList = unserialize($homearticle->image);
        $imgno = array_rand($imageList);
        $file_path = SITE_ROOT . 'images/articles/' . $imageList[$imgno];
        if (file_exists($file_path)) {
            $imglink = IMAGE_PATH . 'articles/' . $imageList[$imgno];
        } else {
            $imglink = BASE_URL . 'template/web/img/mosaic_2.jpg';
        }
    } else {
        $imglink = BASE_URL . 'template/cms/img/mosaic_2.jpg';
    }
  $t .= ' <div class="col-xs-12">
                     <a href="' . BASE_URL . 'page/' . $homearticle->slug . '">
                    <div class="mosaic_container">
                        <img src="' . $imglink . '" alt="' . $homearticle->title . '" class="img-responsive add_bottom_30"><span class="caption_2"> ' . $homearticle->title . '</span>
                    </div>
                    </a>
                </div>';


}

$jVars['module:aboutarticle'] = $t;

/**
 *      Home page
 */
$resinnh = '';

// if (defined('HOME_PAGE')) {
//     $recInn = Article::homepageArticle();
//     if (!empty($recInn)) {
//         foreach ($recInn as $innRow) {
//             $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($innRow->content));
//             $readmore = '';
//             if (!empty($innRow->linksrc)) {
//                 $linkTarget = ($innRow->linktype == 1) ? ' target="_blank" ' : '';
//                 $linksrc = ($innRow->linktype == 1) ? $innRow->linksrc : BASE_URL . $innRow->linksrc;
//                 $readmore = '<a href="' . $linksrc . '" title="">see more</a>';
//             } else {
//                 $readmore = (count($content) > 1) ? '<a href="' . BASE_URL . 'page/' . $innRow->slug . '" title="">Read more...</a>' : '';
//             }
//             $resinnh .=
//             $innRow->content;
//         }
//     }

// }

// $jVars['module:home-article'] = $resinnh;

if (defined('HOME_PAGE')) {
    $recInn = Article::homepageArticle();
    if (!empty($recInn)) {
        foreach ($recInn as $innRow) {
            $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($innRow->content));
            $readmore = '';
            if (!empty($innRow->linksrc)) {
                $linkTarget = ($innRow->linktype == 1) ? ' target="_blank" ' : '';
                $linksrc = ($innRow->linktype == 1) ? $innRow->linksrc : BASE_URL . $innRow->linksrc;
                $readmore = '<a href="' . $linksrc . '" title="">see more</a>';
            } else {
                $readmore = (count($content) > 1) ? '<a href="' . BASE_URL . 'page/' . $innRow->slug . '" title="">Read more...</a>' : '';
            }
            $resinnh .= '
                        ' . $content[0] . '
            ';
        }
    }

}

$jVars['module:home-article'] = $resinnh;

/**
 *      Inner page detail
 */

$aboutdetail = $imageList = $aboutbred = '';

if (defined('INNER_PAGE') and isset($_REQUEST['slug'])) {
    $slug = addslashes($_REQUEST['slug']);
    $recRow = Article::find_by_slug($slug);

    if (!empty($recRow)) {

        $imglink = BASE_URL . 'template/web/images/default.jpg';
        if ($recRow->image != "a:0:{}") {
            $imageList = unserialize($recRow->image);
            $imgno = array_rand($imageList);
            $file_path = SITE_ROOT . 'images/articles/' . $imageList[$imgno];
            if (file_exists($file_path)) {
                $imglink = IMAGE_PATH . 'articles/' . $imageList[$imgno];
            }
            else{
                $imglink = BASE_URL . 'template/web/images/default.jpg';
            }
        }

        $innerbred .= '
    <section class="page-title" style="background-image:url(' . $imglink . ')">
        <div class="auto-container">
            <h2>' . $recRow->title . '</h2>
        </div>
    </section>
        ';

        $rescontent = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->content));
        $content = !empty($rescontent[1]) ? $rescontent[1] : $rescontent[0];

        $aboutdetail .=

                    $content;

    } else {
        redirect_to(BASE_URL);
    }
}
$jVars['module:inner-about-detail'] = $aboutdetail;
$jVars['module:inner-about-bread'] = $innerbred;


$restyp = '';

$typRow = Article::get_by_type();
if (!empty($typRow)) {
    $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($typRow->content));
    $readmore = '';
    if (!empty($typRow->linksrc)) {
        $linkTarget = ($typRow->linktype == 1) ? ' target="_blank" ' : '';
        $linksrc = ($typRow->linktype == 1) ? $typRow->linksrc : BASE_URL . $typRow->linksrc;
        $readmore = '<a class="text-link link-direct" href="' . $linksrc . '">see more</a>';
    } else {
        $readmore = (count($content) > 1) ? '<a href="' . BASE_URL . $typRow->slug . '">Read more...</a>' : '';
    }
    $restyp .= '<h3 class="h3 header-sidebar">' . $typRow->title . '</h3>
	<div class="home-content">
		' . $content[0] . ' ' . $readmore . '
	</div>';

}

$jVars['module:article_by_type'] = $restyp;



/*
    Why Choose Us
*/
$resinnh1 = '';

if (defined('HOME_PAGE')) {

    $resinnh1 .= '';

// pr($resinnh1);
    $recInn1 = Article::find_by_id(2);
    if (!empty($recInn1)) {
            $resinnh1 .= $recInn1->content;


    }

}

$jVars['module:home_article'] = $resinnh1;


/*
    HomePage Facilities
*/
$homepage = '';

if (defined('HOME_PAGE')) {

    $homepage .= '';


    $homepages = Article::find_by_id(11);

    if (!empty($homepages)) {

            $homepage .= $homepages->content;


    }

}

$jVars['module:home_page'] = $homepage;


?>