<?php
// SITE REGULARS
$jVars['site:header'] 		= Config::getField('headers',true);
$jVars['site:footer'] 		= Config::getField('footer',true);
$siteRegulars 				= Config::find_by_id(1);
$jVars['site:copyright']	= '<p>'.str_replace('{year}',date('Y'),$siteRegulars->copyright).' Developed by <a href="https://longtail.info/" target="_blank">Longtail e-media</a></p>';

$jVars['site:contact-header'] = '<span class="address"><a href="tel:'.$siteRegulars->contact_info.'" data-toggle="tooltip" data-placement="bottom" title="Call"><i class="fa fa-phone"></i></a></span>
<span class="address"><a href="mailto:'.$siteRegulars->mail_address.'" data-toggle="tooltip" data-placement="bottom" title="Mail"><i class="fa fa-envelope-o"></i></a></span>';

$jVars['site:phone-news-side'] = '<a href="tel:'.$siteRegulars->contact_info.'" class="phone">'.$siteRegulars->contact_info.'</a>';

$jVars['site:fevicon']		=  '<link rel="shortcut icon" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'">
							    <link rel="apple-touch-icon" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'">
							    <link rel="apple-touch-icon" sizes="72x72" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'">
							    <link rel="apple-touch-icon" sizes="114x114" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'">';
$jVars['site:logo']			= '<div class="logo logo_timber"><a href="'.BASE_URL.'home"><img src="'.IMAGE_PATH.'preference/'.$siteRegulars->logo_upload.'" alt="logo" data-retina="true"/></a></div>';

$jVars['site:seotitle'] = MetaTagsFor_SEO();
$jVars['site:googleanalatic'] = $siteRegulars->google_anlytics;

$jVars['site:pixel-code']	= $siteRegulars->pixel_code;


$jVars['ota-logo'] = '
 <section class="ota-group">
    <div class="row justify-content-center my-5">
<div class="col-xl-6 col-lg-6 col-md-6 col-6 d-flex justify-content-md-between align-items-center py-4">
    <a href=" https://www.booking.com/searchresults.en-gb.html?aid=311984&label=timber-house-oZA45QHt9muccZ556KYqiQS393127741096%3Apl%3Ata%3Ap1%3Ap2%3Aac%3Aap%3Aneg%3Afi%3Atikwd-523352538708%3Alp1011034%3Ali%3Adec%3Adm%3Appccp%3DUmFuZG9tSVYkc2RlIyh9YbSsBl3MCvHsD8UKUHIRFxY&gclid=Cj0KCQjwj4K5BhDYARIsAD1Ly2qvi1z5bHtaidOxCKWl2v1PlG3bpX10Tdrv_cRSzLp6zWc6j8Ug6nYaAhpzEALw_wcB&highlighted_hotels=2787270&redirected=1&city=-1022136&hlrd=no_dates&source=hotel&expand_sb=1&keep_landing=1&sid=8e25dd8956a040e47346e2d2eb889f62" target="_blank"><img src="'.BASE_URL.'template/web/img/ota/booking.png" alt="Booking.com" width="113"></a>
    <a href="https://www.expedia.com/Kathmandu-Hotels-Timber-House.h29690347.Hotel-Information" target="_blank"><img width="106" src="'.BASE_URL.'template/web/img/ota/expedia.png" alt="expedia"></a>
    <a href="https://www.goibibo.com/hotels-international/timber-house-hotel-in-kathmandu-2837295275728455434/#amenities" target="_blank"><img src="'.BASE_URL.'template/web/img/ota/goi.png" alt="Goibibo" width="87"></a>
    <a href="https://www.makemytrip.com/hotels-international/nepal/kathmandu-hotels/timber_house-details.html" target="_blank"><img src="'.BASE_URL.'template/web/img/ota/mmt.png" alt="Make my Trip" width="109"></a>
    <a href="https://www.tripadvisor.com/Hotel_Review-g293890-d15053855-Reviews-Timber_House-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Central_Region.html " target="_blank"><img src="'.BASE_URL.'template/web/img/ota/tripadviser.png" alt="Trip Advisor" width="129"></a>
</div>
    </div>
 </section>

';



require_once("views/module.booking.php");

// SITE MODULES
$modulesList = Module::getAllmode();
foreach($modulesList as $module):
	$fileName = "module.".$module->mode.".php";
	if(file_exists("views/".$fileName)){
	  	require_once("views/".$fileName);
	}
endforeach;

// view modules

require_once("views/module.contact.php");

require_once("views/module.reservation.php");
require_once("views/module.header.php");
require_once("views/module.footer.php");


?>