<?php
namespace App\Service;

class Sort
{
    public static function sortBySeason($v1, $v2) {
    	if($v1->getSeason()->getName() == $v2->getSeason()->getName()) {
    		return 0;
    	}
    	return ($v1->getSeason()->getName() < $v2->getSeason()->getName()) ? - 1 : 1;
    }

    public static function sortBySum($v1, $v2) {
    	if($v1['sum'] == $v2['sum']) {
    		return 0;
    	}
    	return ($v1['sum'] < $v2['sum']) ? 1 : -1;
    }

    public static function sortByGoal($v1, $v2) {
    	if($v1['goal'] == $v2['goal']) {
    		return 0;
    	}
    	return ($v1['goal'] < $v2['goal']) ? 1 : -1;
    }

    public static function sortByAge($v1, $v2) {
    	if($v1['age'] == $v2['age']) {
    		return 0;
    	}
    	return ($v1['age'] < $v2['age']) ? 1 : -1;
    }

    public static function sortByDate($v1, $v2) {
        if($v1->getData() < $v2->getData()){
            return -1;
        }
        elseif($v1->getData() > $v2->getData()) {
            return 1;
        }
        else {
            return 0;
        }
    }

    public function prepareSort(array $fields, ?string $currentField, string $currentOrder): array
    {
      $arSort = ['field' => '', 'order' => ''];
      if($currentField){
        $arSort = ['field' => $currentField, 'order' => $currentOrder];
      }
      $fieldsSortOrder = [];
      foreach ($fields as $field) {
        if($currentField == $field && $currentOrder == 'DESC'){
          $fieldsSortOrder[$field] = 'ASC';
        } else {
          $fieldsSortOrder[$field] = 'DESC';
        }
      }
      return ['arSort' => $arSort, 'fieldsSortOrder' => $fieldsSortOrder];
    }
}
