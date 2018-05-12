<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class NotificationUserModel extends AbstractModel {

    public $id;
    public $notification_id_fk;
    public $user_id_fk;
    public $is_read;
    private $table_name = 'notification_user';


    protected static $tableName = 'notification_user';
    protected static $tableSchema = array(
        'id'                               => self::DATA_TYPE_INT,
        'notification_id_fk'               => self::DATA_TYPE_INT,
        'user_id_fk'                       => self::DATA_TYPE_INT,
        'is_read'                          => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        $query = "SELECT * FROM ".$this->table_name ." Where id = '$this->id' ";
        $stmt =self::prepareStmt($query);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->notification_id_fk = $row['notification_id_fk'];
                $this->user_id_fk = $row['user_id_fk'];
                $this->is_read = $row['is_read'];
            }
        }
    }

    public static function UpdateUnseenNotifications($userid){
        $query = "UPDATE notification_user SET is_read = 1 WHERE is_read = 0 AND user_id_fk = :user_id_fk";
        $stmt =self::prepareStmt($query);

        $userid = self::test_input($userid);

        $stmt->bindParam(':user_id_fk', $userid, \PDO::PARAM_INT);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public static function getNotifications($userid){
        return self::getArr('SELECT notification.*, notification_user.*, user.fname, user.lname from notification_user INNER JOIN notification ON notification.id = notification_user.notification_id_fk inner join user on user.id = 
        notification.sender_id_fk WHERE notification_user.user_id_fk = '.$userid.' order by notification.created_at DESC LIMIT 5');
    }

    public static function countUnseenNotifications($userid){
        $query = "SELECT COUNT(id) from notification_user 
         WHERE user_id_fk = '.$userid.' AND is_read = 0";
        $stmt = self::prepareStmt($query);
        if ($stmt->execute()){
            $num_rows = $stmt->fetchColumn();
            return intval($num_rows);
        }else{
            return false;
        }
    }
}
