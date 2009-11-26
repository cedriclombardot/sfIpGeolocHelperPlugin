<?php

/**
 * Subclass for performing query and update operations on the 'country' table.
 *
 * 
 *
 * @package lib.model
 */ 
class countryPeer extends BasecountryPeer
{
static public function getSortedObject(){
		$c = new Criteria();
		$c->addAscendingOrderByColumn(self::PRINTABLE_NAME);
		$rs = self::doSelect($c);
		return $rs;
	}
}
