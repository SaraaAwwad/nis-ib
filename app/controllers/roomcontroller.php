<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\RoomModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Lib\InputFilter;

class RoomController extends AbstractController{
    use Helper;
    use InputFilter;

    public function defaultAction(){
        $rooms = RoomModel::getAll();
        $this->_data['rooms'] = $rooms;
        $this->_view();
    }

    public function addAction(){

        if(isset($_POST['addroom'])){

            $roomname = $this->filterString($_POST['room']); 
            $capacity = $this->filterInt($_POST['size']); 

            $r = new RoomModel();
            $r->room_name = $roomname;
            $r->size = $capacity;

            if($r->save()){
                $this->redirect('/room');
            }
        }
        $this->_view();
    }

    public function editAction(){

        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $room = RoomModel::getByPK($id);
            if(isset($_POST['editroom'])){
                $roomname = $this->filterString($_POST['room']); 
                $capacity = $this->filterInt($_POST['size']); 
                $room->room_name = $roomname;
                $room->size = $capacity;
                
                if($room->save()){
                    $this->redirect('/room');
                }
            }
            if($room){
                $this->_data['room'] = $room;
                $this->_view();
            }
        }
    }


}