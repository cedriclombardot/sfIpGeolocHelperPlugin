<?php

function getCoutryByIp($ip=null){
	return sfIpGeolocToolkit::getCoutryByIp($ip);
}



function country_select_tag($name,$value=null,$options=null){
	$country=countryPeer::doSelect(new Criteria());
	$opts=array();
	foreach($country as $v){
		$opts[$v->getIso()]=$v;
	}
	if($value!=null){
		$c=new Criteria();
		$c->add(countryPeer::PRINTABLE_NAME,$value);
		$value=countryPeer::doSelectOne($c);
	}
	return select_tag($name,options_for_select($opts,$value->getIso()),$options);
}
?>