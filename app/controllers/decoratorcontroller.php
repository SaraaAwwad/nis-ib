<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\DecoratorModel;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\CurrencyModel;
use PHPMVC\Models\DecoratorpricesModel;
use PHPMVC\Lib\Helper;
class DecoratorController extends AbstractController
{   
    use Helper;
   
    public function defaultAction(){
        $types = DecoratorModel::getDecorator();
        $this->_data['decorator'] = $types;
        $this->_view();
    }

    public function addAction(){  
        $this->_data['currency'] = CurrencyModel::getAll();
        $grades =  SclGradeModel::getAll();
        $this->_data['grades'] = $grades;

        if(isset($_POST['addfees'])){

            $name = $_POST['name'];
            $d_id = DecoratorModel::add($name);

            $currency = $_POST["currency"];
            $price = $_POST["price"];
            $arr_length = count($currency);
            $i=0;      
            for($i=0; $i<$arr_length; $i++){    
                $scl_grade_id_fk = $grades[$i]->id;
                DecoratorPricesModel::add($d_id, $currency[$i], $price[$i], $scl_grade_id_fk);  
            }
            
            $this->redirect("/decorator");
        }
        

        $this->_view();

    }  

   public function editAction(){
    if(isset($this->_params[0])){
        $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 

        $s = new DecoratorModel($id);

        if(!$s->isExist()){
            $this->redirect("\semester");
        }
        
        if(isset($_POST['editfees'])){
            $s->name = $_POST['name'];
            $s->edit();

        $currency = $_POST["currency"];
        $price = $_POST["price"];
        
        $arr_length = count($currency);
        $i=0; 

        for($i=0; $i<$arr_length; $i++){    
            $priceid = $s->prices[$i]->id;
            DecoratorPricesModel::edit($priceid, $currency[$i], $price[$i]);  
        }
        $this->redirect("/semester");
        }

        $this->_data['fee'] = $s;       
        $this->_data['season'] = SeasonModel::getAll();
        $this->_data['currency'] = CurrencyModel::getAll();
        $this->_view();
        }  
   }
  
}