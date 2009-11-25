<?php
/*
 * Class de gestion le sfIpGeoloc pour la localisation des utilisateurs
 * @author Cédric Lombardot <cedric.lombardot@spyrit.net>
 * @see http://lombardot.fr
 * @see http://spyrit.net
 * 
 */
class sfIpGeolocToolkit {
	static public function getCoutryByIp($ip=null){
		if(is_null($ip))
			$ip=$_SERVER['REMOTE_ADDR'];
		$ip=long2ip(ip2long($ip));//nettoie l'adresse
		//SELECT ip2country.IP_FROM, ip2country.IP_TO, ip2country.COUNTRY_CODE2, ip2country.COUNTRY_CODE3, ip2country.COUNTRY_NAME FROM ip2country 
		//WHERE ip2country.IP_FROM<='inet_aton(\"82.243.37.107\")' 
		//AND ip2country.IP_TO>='inet_aton(\"82.243.37.107\")' LIMIT 1
		$c=new Criteria();
		$c->add(ip2countryPeer::IP_FROM,sfIpGeolocToolkit::inet_aton($ip),Criteria::LESS_EQUAL);
		$c->add(ip2countryPeer::IP_TO,sfIpGeolocToolkit::inet_aton($ip),Criteria::GREATER_EQUAL);
		$ip2country=ip2countryPeer::doSelectOne($c);
		
		if(!$ip2country){
			return false;
		}else{
			$c=new Criteria();
			$c->add(countryPeer::ISO,$ip2country->getCountryCode2());
			$country=countryPeer::doSelectOne($c);
			if(!$country){
				$c=new Criteria();
				$c->add(countryPeer::ISO,'FR');
				$country=countryPeer::doSelectOne($c);
				return $country;
			}
		}
		return $country;
	}
	
	static public function inet_aton($ip){
		$ip=explode('.',$ip);
		//return 2130706433;
		return $ip[0]*pow(256,3)+$ip[1]*pow(256,2)+$ip[2]*pow(256,1)+$ip[3];
	}

}

?>