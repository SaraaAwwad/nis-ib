<?php
namespace PHPMVC\Controllers;
use PHPMVC\Lib\Helper;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\CreateModel;
use PHPMVC\Models\MailerModel;
use PHPMVC\Models\NotificationModel;
use PHPMVC\Models\NotificationUserModel;


class NotificationController extends AbstractController{
    use Helper;

    public function defaultAction()
    {
        $userid = $_SESSION["userID"];
        $this->_data['notifications'] = NotificationUserModel::getNotifications($userid);
        $this->_view();
    }

    public function addAction(){
        $this->_data['usertype'] = UserTypesModel::getUsers();
        $cm = new CreateModel();
        $notification = new NotificationModel();
        if(isset($_POST['action']))  {
            if($_POST['action'] == 'getUnseen'){
                    $userid = $_SESSION["userID"];
                    $count = NotificationUserModel::countUnseenNotifications($userid);
                    echo json_encode($count);
                    return;
            }
                else if ($_POST['action'] == 'getSeen'){
                $userid = $_SESSION["userID"];
                NotificationUserModel::UpdateUnseenNotifications($userid);
                $result = NotificationUserModel::getNotifications($userid);
                    echo json_encode($result);
                    return;
            }
        }

        if(isset($_POST['addnotification'])) {
            $recipientid = $_POST['recipient'];
            $recipient = UserModel::getUsersByUserType($recipientid);
            $notification->sender_id_fk = $_SESSION["userID"];
            $notification->title = $_POST['subject'];
            $notification->body = $_POST['comment'];
            $notification->created_at = date("Y-m-d h:i:s",strtotime('+2 hour'));
            $notification->save();

            //Attach Users To Observer
            foreach ($recipient as $rep)
            {
                $usernotify = new NotificationUserModel();
                $usernotify->notification_id_fk = $notification->id;
                $usernotify->user_id_fk = $rep->id;
                $usernotify->is_read = 0;
                $usernotify->save();

                $observer = new MailerModel();
                $cm->attach($observer);
            }

            $cm->createUserNotification();

//            //Detach Users From Observer
//            foreach ($recipient as $rep)
//            {
//                $observer = new MailerModel();
//                $cm->detach($observer);
//            }
            $this->redirect('/user/default');
        }
        $this->_view();
    }

    public function deleteAction()
    {
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);
            $s = NotificationUserModel::getByPK($id);
            $s->delete();
            $this->redirect('/notification/default');
        }

    }

}