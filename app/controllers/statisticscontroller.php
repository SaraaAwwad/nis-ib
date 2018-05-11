<?php
namespace PHPMVC\Controllers;

use PHPMVC\Lib\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\UserTypesModel;

class StatisticsController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {

        $values = [];
        $position = [];
        $UserTypes = UserTypesModel::getExcept();
        foreach($UserTypes as $us){
            array_push($position, $us->title);
        }
        $countPositionLength = count($position);
        for($i=0; $i<$countPositionLength; $i++){
            $usertype = UserTypesModel::count($position[$i]);
            array_push($values, array("position" => "$position[$i]", "newbalance" => "$usertype"));
        }
        $countArrayLength = count($values);

        $this->_data['teachers'] = $values;
        $this->_data['count'] = $countArrayLength;
        $this->_view();
    }

}