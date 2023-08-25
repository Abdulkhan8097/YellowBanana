<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_model extends CI_Model{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->inboxTable 	= "mail_inbox";
		$this->sentTable 	= "mail_sent";
		$this->invitationTable = "friend_invitation";		
		$sessionData  = $this->session->userdata('sessionData');
		$this->userId = $sessionData["userId"];		
	}
	
	public function getAllInboxMail(){
		$receiverId = $this->userId; //logged in user
		$this->db->select('IB.id,IB.from_user_id,IB.subject,IB.added_on,IB.mail_body,IB.status AS mailStatus,U.id AS user_id,U.fname,U.lname,U.profile_picture');
		$this->db->from($this->inboxTable.' AS IB');
		$this->db->join('users AS U', 'U.id = IB.from_user_id');
		$this->db->where('IB.to_user_id', $receiverId);
		$this->db->where('U.status', 1);		
		$this->db->order_by("IB.added_on", "desc");
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function getMailData($mId,$table_name){
		$this->db->select('IB.*');
		$this->db->from($table_name.' AS IB');
		$this->db->where('IB.id', $mId);
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function getAllSentMail(){
		$senderId = $this->userId; //logged in user
		$this->db->select('SB.id,SB.from_user_id,SB.subject,SB.added_on,SB.mail_body,SB.mail_id,SB.status AS mailStatus,U.id AS user_id,U.fname,U.lname,U.profile_picture');
		$this->db->from($this->sentTable.' AS SB');
		$this->db->join('users AS U', 'U.id = SB.to_user_id');
		$this->db->where('SB.from_user_id', $senderId);
		$this->db->where('U.status', 1);				
		$this->db->order_by("SB.added_on", "desc");
		$result = $this->db->get()->result();
		
		
		$this->db->select('SB.id,SB.to_user_id,SB.from_user_id,SB.subject,SB.added_on,SB.mail_body,SB.mail_id,SB.status AS mailStatus');
		$this->db->from($this->sentTable.' AS SB');		
		$this->db->where('SB.from_user_id', $senderId);
		$this->db->where('SB.to_user_id', 0);				
		$this->db->order_by("SB.added_on", "desc");
		$result1 = $this->db->get()->result();
		$return = array_merge($result, $result1);
		return $return;
	}
	
	public function changeMailStatus($table,$id,$status){	
		$data   = array(
			'status'     => $status
		);
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}
	
	public function checkRegisteredEmail($email){ // check in table_sent table 
		$this->db->select('SB.*');
		$this->db->from($this->sentTable.' AS SB');		
		$this->db->where('SB.mail_id', $email);
		$this->db->where('SB.to_user_id', 0);						
		$result1 = $this->db->get()->result();
		$total = count($result1);
		
		if($total > 0) {			
			return $result1;
		} else {
			return " ";
		}	
	}
	
	public function insertExistingInvitationToInbox($to_id,$from_user_id,$subject,$added_on,$mail_body,$status,$emailId){
			$data = array(
				"to_user_id" 	=> $to_id,
				"from_user_id" 	=> $from_user_id,
				"subject" 		=> $subject,				
				"added_on" 		=> $added_on,
				"mail_body" 	=> $mail_body,
				"status" 		=> $status
			);			
			$this->db->insert("mail_inbox", $data);
			
			$udata   = array(
				'mail_id'     => "",
				'to_user_id'  => $to_id
			);
			$this->db->where('mail_id', $emailId);
			$this->db->where('to_user_id',0);
			$this->db->update("mail_sent", $udata);			
		}
		
	
		
		
		
		
		
		
		
		
	//////////////////////////////
	/* function to send friend request */
	public function sendInvitationRequest($receiverId){
		$senderId = $this->userId;
		$date 	=  date('Y-m-d H:i:s');
		$insert =1;//Flag for check insert
		
		// Check Request is already sent or not 
		$existData = $this->checkRequestExist($receiverId);
		if($existData){
			$insert = 0;
			$requestDate = $existData[0]->request_date;
			$tempDate	= explode(" ",$requestDate);
			
			if($tempDate[0] == date('Y-m-d')){
				return 1;// You have sent request today, you can not send request two times today.
			}else if($existData[0]->status == 0 || $existData[0]->status == 2){//0: Pending, 2: Rejected
				$this->update($existData[0]->id,$this->invitationTable,array("status"=>0,'request_date'  => $date));
				return 0;
			}
		} 
		
		if($insert == 1){
			$data   = array(
					'sender_id'     => $this->userId,
					'receiver_id'   => $receiverId,
					'request_date'  => $date,
					'status'	 	=> 0
			);
			$this->db->insert($this->invitationTable, $data);
			return 0;
		}
	}
	
	public function checkRequestExist($rId){
		$this->db->from($this->invitationTable);
		$this->db->where('sender_id', $this->userId);
		$this->db->where('receiver_id', $rId);
		
		$result = $this->db->get()->result();
		return $result;
	}
	// display friend request invitations for lgin user
	public function countFriendRequest($userId){
		$this->db->select('count(FI.id) AS COUNT');
		$this->db->from('friend_invitation AS FI');
		$this->db->join('users AS U', 'U.id = FI.sender_id');
		$this->db->where('FI.receiver_id', $userId);
		$this->db->where('U.status', 1);
		$this->db->where('FI.status', 0);
		$result = $this->db->get()->result();
		return $result;
	}
	
	// display friend request invitations for lgin user
	public function getFriendInvitaions(){
		$this->db->select('FI.id,U.id AS user_id,FI.request_date,U.fname,U.lname,U.profile_picture');
		$this->db->from('friend_invitation AS FI');
		$this->db->join('users AS U', 'U.id = FI.sender_id');
		$this->db->where('FI.receiver_id', $this->userId);
		$this->db->where('U.status', 1);
		$this->db->where('FI.status', 0);
		$this->db->order_by("FI.request_date", "desc");
		$result = $this->db->get()->result();
		return $result;
	}
	
	// view pending invitations
	public function getFriendPendingInvitaions(){
		$this->db->select('FI.id,U.id AS user_id,FI.request_date,U.fname,U.lname,U.profile_picture');
		$this->db->from('friend_invitation AS FI');
		$this->db->join('users AS U', 'U.id = FI.receiver_id');
		$this->db->where('FI.sender_id', $this->userId);
		$this->db->where('U.status', 1);
		$this->db->where('FI.status', 0);
		$this->db->order_by("FI.request_date", "desc");
		$result = $this->db->get()->result();
		return $result;
	}
	
	// To Accept friend invitation 
	public function acceptInvitation($id,$sender){
		$receiver	= $this->userId;
		//Check friend request is valid or not
		$existData = $this->checkRequestExistWithId($id,$sender,$receiver);
		if($existData && $existData[0]->status == 0){
			//Check they are already friend or not
			$friendCount = $this->checkFriendExist($receiver,$sender);
			if($friendCount == 0){
				//Make Friend Entry
				$this->makeFriend($receiver,$sender);
				//Set status to become friend
				$this->update($id,$this->invitationTable,array("status"=>1));
				// check reverse entry and if yes then get id 
				$rid = $this->checkReverseEntry($receiver,$sender);
				if($rid > 0) {
					$this->update($rid,$this->invitationTable,array("status"=>1));				
				}
			}
		}
		$data = $this->countFriendRequest($this->userId);
		echo $data[0]->COUNT;				
	}
	
	// Check request is sent or not before 
	public function checkRequestExistWithId($id,$sender,$receiver){
		$this->db->from($this->invitationTable);
		$this->db->where('id',$id);
		$this->db->where('sender_id', $sender);
		$this->db->where('receiver_id', $receiver);
	
		$result = $this->db->get()->result();
		return $result;
	}
	
	/* Add Friend */
	public function makeFriend($userId,$friendId){
		$date 	=  date('Y-m-d H:i:s');
		if($userId>0 && $friendId>0){
			$data1   = array(
					'user_id'     => $userId,
					'friend_id'   => $friendId,
					'created_date'=> $date
			);
			$data2   = array(
					'user_id'     => $friendId,
					'friend_id'   => $userId,
					'created_date'=> $date
			);
			$this->db->insert($this->friendTable, $data1);
			$this->db->insert($this->friendTable, $data2);
		}
	}
	
	// Check Friends are exist or not 
	public function checkFriendExist($userId,$friendId){
		$this->db->select('id');
		$this->db->from($this->friendTable);
		$this->db->where('user_id', $userId);
		$this->db->where('friend_id', $friendId);
		
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// Reject Friend Request 
	public function rejectInvitation($id,$sender){
		$receiver	= $this->userId;
		//Check friend request is valid or not
		$existData = $this->checkRequestExistWithId($id,$sender,$receiver);
		if($existData && $existData[0]->status == 0){
			//Check they are already friend or not
			$friendCount = $this->checkFriendExist($receiver,$sender);
			if($friendCount == 0){
				$this->update($id,$this->invitationTable,array("status"=>2));
			}
		}
		$data = $this->countFriendRequest($this->userId);
		echo $data[0]->COUNT;
	}
	
	// resend invitation
	public function resendInvitation($id,$receiver){
		/*Check they are friend or not*/
		$date 	=  date('Y-m-d H:i:s');
		$sender = $this->userId;
		$existData = $this->checkRequestExistWithId($id,$sender,$receiver);
		if($existData && $existData[0]->status == 0){
			//Check they are already friend or not
			$friendCount = $this->checkFriendExist($receiver,$sender);
			if($friendCount == 0){
				$this->update($id,$this->invitationTable,array("request_date"=>$date));
			}
		}
	}

	// Cancel Connection Inviation 
	public function cancelInvitation($id,$receiver){
		$date 	=  date('Y-m-d H:i:s');
		$sender = $this->userId;
		$existData = $this->checkRequestExistWithId($id,$sender,$receiver);
		if($existData && $existData[0]->status == 0){
			//Delete Entry
			$this->db->delete($this->invitationTable, array('id' => $id));
		}
		/* resend invitation again */
	}	
	
	// Genereal Update Function 
	public function update($id,$table,$data){
		if($id >0 && count($data)>0 && $table != ""){
			$this->db->where('id', $id);
			$this->db->update($table, $data);
		}
	}
	
	public function checkReverseEntry($sender,$receiver){
		$this->db->select('id');
		$this->db->from($this->invitationTable);
		$this->db->where('sender_id', $sender);
		$this->db->where('receiver_id', $receiver);
		
		$result = $this->db->get()->result();
		if($result) {
			return $result[0]->id;		
		} else {
			return 0;
		}
	}
	
	// Function for getting friend list 
	public function getMyFriends(){
		$this->db->select('U.id AS user_id,
		U.fname,
		U.lname,
		U.profile_picture,
		U.gender,
		(SELECT `name` FROM category AS CA where CA.id = U.professional_status) AS pro_status,
		(SELECT `name` FROM country AS C where C.id = U.country_id) AS country_name,
		(SELECT `name` FROM state AS S where S.id = U.state_id) AS state_name														');
		$this->db->from('friends AS F');
		$this->db->join('users AS U', 'U.id = F.friend_id');
		$this->db->where('F.user_id', $this->userId);
		$this->db->where('U.status', 1);
		$this->db->order_by("F.created_date", "desc");
		$result = $this->db->get()->result();
		return $result;
		
	}
	
	// function to get wall message and detail - private instant message
	public function getWallDataByUserId($receiverId){
	
		$this->db->select('
		U.fname,
		U.lname,
		U.profile_picture,
		W.id,
		W.from_user_id,
		W.to_user_id,
		W.message,
		W.posted_date');
		$this->db->from('user_wall AS W');
		$this->db->join('users AS U', 'U.id = W.from_user_id');
		$this->db->where('W.to_user_id', $receiverId);
		$this->db->where('U.status', 1);
		$this->db->where('W.status', 1);
		$this->db->order_by("W.posted_date", "desc");
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function countWallMessages($id){
		$this->db->select('id');
		$this->db->from('user_wall');
		$this->db->where('to_user_id', $id);
		$this->db->where('status', 1);
		
		$result = $this->db->count_all_results();
		return $result;
	}
	
	public function postWallMessages($receiverId,$message){
		$sender = $this->userId;
		$date 	=  date('Y-m-d H:i:s');
		$data   = array(
			'to_user_id'     => $receiverId,
			'from_user_id'   => $sender,
			'message'  		 => $message,
			'posted_date'	 => $date,
			'status			'=> 1
		);
		$this->db->insert('user_wall', $data);
		return 0;
	}
	public function deleteConversation($msgId,$rId){
		$this->db->delete('user_wall', array('id' => $msgId));
		
		$sql= "SELECT count(*) AS total FROM user_wall WHERE `to_user_id` = $rId";
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		$totalR = $result[0]->total;
		return $totalR;
	}
	
	public function getFindContacts($fname,$lname,$cid,$sid){
		$where = "";
		if($fname != "") {
			$where .= " U.fname LIKE '%$fname%' OR";
		}
		if($lname != "") {
			$where .= " U.lname LIKE '%$lname%' OR";
		}
		if($cid > 0 OR $cid != '') {
			$where .= " U.country_id = $cid OR";
		}
		if($sid > 0 OR $sid != '') {
			$where .= " U.state_id = $sid";
		}
		$where .= " 1=0 ";
		
		$sql = 'SELECT 
					U.id AS user_id,
					U.fname,
					U.lname,
					U.profile_picture,
					U.gender,
					(SELECT `name` FROM category AS CA where CA.id = U.professional_status) AS pro_status,
					(SELECT `name` FROM country AS C where C.id = U.country_id) AS country_name,
					(SELECT `name` FROM state AS S where S.id = U.state_id) AS state_name														
					FROM users AS U WHERE 
		('.$where.') AND U.id != '.$this->userId.' AND U.status = 1 ORDER BY U.created_date DESC';
		
		$query 		= $this->db->query($sql);
		$result   	= $query->result();
		
		return $result;
	}
	
	public function removeFriend($userId,$friendId){
		$this->db->delete('friends', array('user_id' => $userId,'friend_id'=>$friendId));
		$this->db->delete('friends', array('user_id' => $friendId,'friend_id'=>$userId));
		$this->db->delete('friend_invitation', array('sender_id' => $userId,'receiver_id'=>$friendId));
		$this->db->delete('friend_invitation', array('sender_id' => $friendId,'receiver_id'=>$userId));
				
		return 0;
	}
	
	// function to add default friends list while register a new member 
	
	public function makeDefaultFriend($userId,$friendIdList){
		$date 	=  date('Y-m-d H:i:s');
		$total  = count($friendIdList);
		
		if($total > 0) {	
			for($i=0; $i<$total ; $i++) {
				if($userId>0 && $friendIdList[$i]>0){
					$data1   = array(
							'user_id'     => $userId,
							'friend_id'   => $friendIdList[$i],
							'created_date'=> $date
					);
					$data2   = array(
							'user_id'     => $friendIdList[$i],
							'friend_id'   => $userId,
							'created_date'=> $date
					);
					$this->db->insert($this->friendTable, $data1);
					$this->db->insert($this->friendTable, $data2);
				}
			}	
		}	
	}
	
	
	
}
?>