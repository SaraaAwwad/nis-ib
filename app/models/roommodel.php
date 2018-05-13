<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class RoomModel extends AbstractModel
{
    const ERR_CAPACITY = "err_room_overload";
    
    public $id;
    public $room_name;
    public $size;

    protected static $tableName = 'room';

    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'room_name' => self::DATA_TYPE_STR,
        'size' => self::DATA_TYPE_INT,
    );

    protected static $primaryKey = 'id';

    public static function getExamRooms($date, $slot){
        return self::getArr(
            'SELECT room.* FROM room
        WHERE  room.id NOT IN (SELECT room_id_fk
        FROM   exam_details 
        WHERE  exam_details.date = "' . $date . '"
        AND exam_details.slot_id_fk = ' . $slot . ' ) '
        );

    }

    public static function getMinCapacity($class_id_fk, $semester_id_fk){
        $query = "SELECT MIN(room.size) as capacity FROM room INNER JOIN schedule_details ON room.id = schedule_details.room_id_fk
        INNER JOIN schedule ON schedule_details.sched_id_fk = schedule.id where schedule.class_id_fk =:class_id_fk
        AND schedule.semester_id_fk =:semester_id_fk";

        $stmt = self::prepareStmt($query);

        $class_id_fk = self::test_input($class_id_fk);
        $semester_id_fk = self::test_input($semester_id_fk);

        $stmt->bindParam(":class_id_fk", $class_id_fk);
        $stmt->bindParam(":semester_id_fk", $semester_id_fk);

        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $capacity = $row["capacity"];
        }else{
            return false;
        }

        if($capacity!=null){
            return $capacity;
        }else{
            return false;
        }

    }

    public static function getFreeAndEnoughCapacityRooms($day, $slot, $class_id_fk, $semester_id_fk){
       
       $query = 'SELECT room.* FROM room
        WHERE  room.id NOT IN (SELECT room_id_fk FROM   schedule_details 
        INNER JOIN schedule ON schedule_details.sched_id_fk = schedule.id
        WHERE schedule.semester_id_fk= :semester_id_fk AND schedule_details.day_id_fk = :day
        AND schedule_details.slot_id_fk = :slot)
        AND room.size >=
        (SELECT Count(*) from registration Where semester_id_fk = :semester_id_fk AND class_id_fk =:class_id_fk)'; 

        $stmt = self::prepareStmt($query);

        $class_id_fk = self::test_input($class_id_fk);
        $semester_id_fk = self::test_input($semester_id_fk);

        $stmt->bindParam(":class_id_fk", $class_id_fk);
        $stmt->bindParam(":semester_id_fk", $semester_id_fk);
        $stmt->bindParam(":day", $day);
        $stmt->bindParam(":slot", $slot);

        $Rooms = array();
        $i=0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $roomObj = new RoomModel($row["id"]);
                $Rooms[$i] = $roomObj;
                $i++;
            }
            return $Rooms;
        }else{
            return false;
        }

        if($capacity!=null){
            return $capacity;
        }else{
            return false;
        }
    }

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        $sql = "select * from room where id =:id";
        $stmt = self::prepareStmt($sql);

        $this->id = self::test_input($this->id);
        $stmt->bindParam(":id",$this->id);

        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $this->room_name = $row['room_name'];
            $this->size = $row['size'];
        }
    }

}