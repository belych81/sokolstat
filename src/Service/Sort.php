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

    public function sortBySum($v1, $v2) {
    	if($v1['sum'] == $v2['sum']) {
    		return 0;
    	}
    	return ($v1['sum'] < $v2['sum']) ? 1 : -1;
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
        if($currentField == $field && $currentOrder == 'ASC'){
          $fieldsSortOrder[$field] = 'DESC';
        } else {
          $fieldsSortOrder[$field] = 'ASC';
        }
      }
      return ['arSort' => $arSort, 'fieldsSortOrder' => $fieldsSortOrder];
    }
}
