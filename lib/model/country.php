<?php

/**
 * Subclass for representing a row from the 'country' table.
 *
 * 
 *
 * @package lib.model
 */ 
class country extends Basecountry
{
	public function __toString(){
		return $this->getPrintableName();
	}
	public function getFlag(){
		$flag_path=sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images/flags/'.strtolower($this->geIso()).'.png';
		if(!file_exists($flag_path))
			return false;
		return 'images/flags/'.strtolower($this->geIso()).'.png';
	}
}
