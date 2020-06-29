<?php
namespace App\Service;

class Sort
{
    public function sortBySeason($v1, $v2) {
    	if($v1->getSeason()->getName() == $v2->getSeason()->getName()) {
    		return 0;
    	}
    	return ($v1->getSeason()->getName() < $v2->getSeason()->getName()) ? - 1 : 1;
    }

}
 ?>
