<?php
namespace PHPMVC\Controllers;

use PHPMVC\Lib\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\DecoratorModel;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\UserTypesModel;

class StatisticsController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {

        //Staff in System
        $values = [];
        $position = [];
        $UserTypes = UserTypesModel::getUserTypeExcept();
        foreach($UserTypes as $us){
            array_push($position, $us->title);
        }
        $countPositionLength = count($position);
        for($i=0; $i<$countPositionLength; $i++){
            $usertype = UserTypesModel::count($position[$i]);
            array_push($values, array("position" => "$position[$i]", "newbalance" => "$usertype"));
        }
        $countArrayLength = count($values);

        //Students Registered Statistics
        $number = [];
        //season-year
        $semester = [];
        //semesters ids
        $semesterid = [];
        //semesters in system
        $semestercount = SemesterModel::getSemesters();

        foreach($semestercount as $sem){
            array_push($semesterid, $sem->id);
            array_push($semester, $sem->season_name.' - '.$sem->year);
        }
        $countSemesterLength = count($semesterid);

        for($i=0; $i<$countSemesterLength; $i++){
            $countnum = SemesterModel::count($semesterid[$i]);
            array_push($number, array("year" => "$semester[$i]", "students" => "$countnum"));
        }
        $countNumberLength = count($number);

        //Data in Profit

        $profit = [];
        $dec = [];
        $decorators = DecoratorModel::getDecorator();
        foreach($decorators as $D){
            array_push($dec, $D->name);
        }
        $countDecoratorLength = count($dec);
        for($i=0; $i<$countDecoratorLength; $i++){
            $amount = SemesterModel::sumAmount($dec[$i]);
            if($amount == ''){
                $amount = 0;
                array_push($profit, array("decorator" => "$dec[$i]", "amount" => "$amount"));
            }else{
                array_push($profit, array("decorator" => "$dec[$i]", "amount" => "$amount"));
            }
        }
        $countProfitLength = count($profit);

        //Data in Students
        $this->_data['students'] = $number;
        $this->_data['number'] = $countNumberLength;

        //Data in Staff
        $this->_data['teachers'] = $values;
        $this->_data['count'] = $countArrayLength;

        //Data in Profit
        $this->_data['profit'] = $profit;
        $this->_data['profitnum'] = $countProfitLength;



        $this->_view();
    }

}