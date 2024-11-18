<?php
// SEO Meta Tags And Meta Description

function className_metatags()
{
    $current_url = pathinfo($_SERVER["PHP_SELF"]);
    $fileName = $current_url['filename'];

    if ($fileName == 'inner'):
        $className = 'Article';
        return $className;
        exit;
    endif;

    if ($fileName == 'career-form'):
        $className = 'vacency';
        return $className;
        exit;
    endif;

    if ($fileName == 'subpkgdetail'):
        $className = 'Subpackage';
        return $className;
        exit;
    endif;
    if ($fileName == 'conference_detail'):
        $className = 'Subpackage';
        return $className;
        exit;
    endif;

    if ($fileName == 'service_list'):
        $className = 'Services';
        return $className;
        exit;
    endif;
    if ($fileName == 'dining_list'):
        $className = 'Dining';
        return $className;
        exit;
    endif;

    if ($fileName != 'index'):
        $className = ucfirst(strtolower($fileName));
        return $className;
        exit;
    endif;

    return '';
}

function MetaTagsFor_SEO()
{

    $c_url = pathinfo($_SERVER["PHP_SELF"]);
    $chk = $c_url['filename'];
    $config = Config::find_by_id(1);
    $sitetitle = (!empty($config->meta_title) and $chk == 'index') ? $config->meta_title : $config->sitetitle;
    $keywords = $config->site_keywords;
    $description = $config->site_description;

    $addtitle = '';
    $class = className_metatags();

    // Transaction start
    if (isset($_REQUEST['slug']) and !empty($_REQUEST['slug'])) {
        if ($class == 'Global') {
            $nrec = Mlink::find_by_slug(addslashes($_REQUEST['slug']));
            if (!empty($nrec)) {
                $cls = new $nrec->mod_class;
                $rec = $cls->find_by_slug(addslashes($_REQUEST['slug']));
                if (!empty($rec)) {
                    $addtitle = !empty($rec->meta_title) ? $rec->meta_title : $rec->title;
                    if (!empty($rec->meta_keywords)) {
                        $keywords = $rec->meta_keywords;
                        $description = $rec->meta_description;
                    }
                }
            }
        } else {
            $cls = new $class;
            $rec = $cls->find_by_slug(addslashes($_REQUEST['slug']));
            if (!empty($rec)) {
                $addtitle = !empty($rec->meta_title) ? $rec->meta_title : $rec->title;
                if (!empty($rec->meta_keywords)) {
                    $keywords = $rec->meta_keywords;
                    $description = $rec->meta_description;
                }
            }
        }
    }

    if (isset($_REQUEST['id']) and !empty($_REQUEST['id'])) {
        $cls = new $class;
        $rec = $cls->find_by_id($_REQUEST['id']);
        if ($rec) {
            $addtitle = $rec->title;
        }
    }

    $altclass = !empty($class) ? $class : '';
    $addtitle = !empty($addtitle) ? $addtitle : $altclass;
    $addsep = !empty($addtitle) ? ' - ' : '';

    $sociallinks = SocialNetworking::getSocialNetwork();
    $sameas = '';
    foreach ($sociallinks as $social) {
        if (end($sociallinks) === $social) {
            $sameas .= '"' . $social->linksrc . '"';
        } else {
            $sameas .= '"' . $social->linksrc . '",';
        }

    }
    $schema = '';
    $schema .= '<script type="application/ld+json">
	{
		"@context": "http://schema.org/",
		"@type": "Organization",
		"headline": "' . $config->sitetitle . '|' . $config->sitename . '",
		"keywords": "' . $config->site_keywords . '",
		"description": "' . $config->site_description . '",
		"url": "' . BASE_URL . '",
		"sameAs": [
					' . $sameas . '
					],
		"image": {
		  "@type": "ImageObject",
		  "height": "",
		  "width": "",
		  "url": "' . IMAGE_PATH . 'preference/' . $config->logo_upload . '"
		},
		"author": "' . $config->sitetitle . '",
		"publisher": {
		  "@type": "Organization",
		  "logo": {
			"@type": "ImageObject",
			"url": "' . IMAGE_PATH . 'preference/' . $config->logo_upload . '"
		  },
		  "name": "' . $config->sitetitle . '|' . $config->sitename . '"
	  }';
    if (!empty($config->schema_code)) {
        $schema .= ',' . $config->schema_code;
    }
    $schema .= '}</script>';


    $seoSources = '<title>' . $addtitle . $addsep . $sitetitle . '</title>' . "\n";
    $seoSources .= '<meta charset="utf-8">' . "\n";
    $seoSources .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n";
    $seoSources .= '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
    $seoSources .= '<meta name="robots" content="index,follow">' . "\n";
    $seoSources .= '<meta name="Googlebot" content="index, follow"/>' . "\n";
    $seoSources .= '<meta name="distribution" content="Global">' . "\n";
    $seoSources .= '<meta name="revisit-after" content="2 Days" />' . "\n";
    $seoSources .= '<meta name="classification" content="Hotel, Hotels in Nepal" />' . "\n";
    $seoSources .= '<meta name="category" content="Hotel, Hotels in Nepal" />' . "\n";
    $seoSources .= '<meta name="language" content="en-us" />' . "\n";
    $seoSources .= '<meta name="keywords" content="' . $keywords . '">' . "\n";
    $seoSources .= '<meta name="description" content="' . $description . '">' . "\n";
    $seoSources .= '<meta name="author" content="Longtail-e-media">' . "\n\n";

    //Facebook and twitter sharing
    $seoSources .= '<meta property="og:title" content="' . $sitetitle . '">' . "\n";
    $seoSources .= '<meta property="og:description" content="' . $description . '">' . "\n";

    if (isset($_REQUEST['slug']) and !empty($_REQUEST['slug'])) {
        if ($class == 'Global') {
            $nrec = Mlink::find_by_slug(addslashes($_REQUEST['slug']));
            if (!empty($nrec)) {
                $cls = new $nrec->mod_class;
                $classname = $nrec->mod_class;
                if ($classname == 'Article') {
                    $rec = $cls->find_by_slug(addslashes($_REQUEST['slug']));
                    if (!empty($rec)) {
                        $images = unserialize($rec->image);
                        if (!empty($images)) {
                            $img = $images[0];
                            $imagePath = SITE_ROOT . 'images/articles/' . $img;
                            if (file_exists($imagePath)) {
                                $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'articles/' . $img . '">' . "\n";
                                $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'articles/' . $img . '">' . "\n";
                            } else {
                                $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                                $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
                            }
                        } else {
                            $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                            $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
                        }
                    } else {
                        $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                        $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
                    }
                }
                if ($classname == 'Package') {
                    $rec = $cls->find_by_slug(addslashes($_REQUEST['slug']));
                    if (!empty($rec)) {
                        $images = unserialize($rec->banner_image);
                        if (!empty($images)) {
                            $img = $images[0];
                            $imagePath = SITE_ROOT . 'images/package/banner/' . $img;
                            if (file_exists($imagePath)) {
                                $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'package/banner/' . $img . '">' . "\n";
                                $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'package/banner/' . $img . '">' . "\n";
                            } else {
                                $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                                $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
                            }
                        } else {
                            $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                            $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
                        }
                    } else {
                        $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                        $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
                    }
                }
                if ($classname == 'Subpackage') {
                    $rec = $cls->find_by_slug(addslashes($_REQUEST['slug']));
                    if (!empty($rec)) {
                        $images = unserialize($rec->image);
                        if (!empty($images)) {
                            $img = $images[0];
                            $imagePath = SITE_ROOT . 'images/subpackage/' . $img;
                            if (file_exists($imagePath)) {
                                $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'subpackage/' . $img . '">' . "\n";
                                $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'subpackage/' . $img . '">' . "\n";
                            } else {
                                $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                                $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
                            }
                        } else {
                            $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                            $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
                        }
                    } else {
                        $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                        $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
                    }
                }
            } else {
                $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
                $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
            }
        } else {
            $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
            $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
        }
    } else {
        $seoSources .= '<meta property="og:image" content="' . IMAGE_PATH . 'preference/' . $config->fb_upload . '">' . "\n";
        $seoSources .= '<meta property="twitter:image" content="' . IMAGE_PATH . 'preference/' . $config->twitter_upload . '">' . "\n";
    }

    $tot = strlen(SITE_FOLDER) + 2;
    $data = substr($_SERVER['REQUEST_URI'], $tot);
    $seoSources .= '<meta property="og:url" content="' . BASE_URL . $data . '">' . "\n";
    $seoSources .= '<meta property="og:type" content="website">' . "\n";
    $seoSources .= '<meta property="twitter:card" content="summary_large_image">' . "\n\n";
//    $seoSources .= '<link rel="canonical" href="' . curPageURL() . '" />' . "\n";

    $seoSources .= '<base url="' . BASE_URL . '"/>' . "\n";
    $seoSources .= $config->google_anlytics . "\n";
    $seoSources .= $schema . "\n";
    $seoSources .= $config->headers . "\n";

    return $seoSources;
}

?>
