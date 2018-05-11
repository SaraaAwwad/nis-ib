<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class NotificationModel extends AbstractModel {

    public $id;
    public $sender_id_fk;
    public $title;
    public $body;
    public $created_at;
    private $table_name = 'notification';


    protected static $tableName = 'notification';
    protected static $tableSchema = array(
        'id'                         => self::DATA_TYPE_INT,
        'sender_id_fk'               => self::DATA_TYPE_INT,
        'title'                      => self::DATA_TYPE_STR,
        'body'                       => self::DATA_TYPE_STR,
        'created_at'                 => self::DATA_TYPE_DATE
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
                $this->sender_id_fk = $row['sender_id_fk'];
                $this->title = $row['title'];
                $this->body = $row['body'];
                $this->created_at = $row['created_at'];
            }
        }
    }
    public static function getAllNotifications($userid){
        return self::getArr('SELECT notification.*, notification_user.*, user.* from notification_user INNER JOIN notification ON notification.id = notification_user.notification_id_fk inner join user on user.id =
            notification.sender_id_fk WHERE notification_user.user_id_fk = '.$userid.' order by notification.created_at DESC LIMIT 5');
    }


}
