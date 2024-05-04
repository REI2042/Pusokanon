<?php
	class crud{
		private $db;

		function __construct($conn){
			$this ->db = $conn;
		}

		public function insert($fname,$lname,$midname,$suffix,$gender,$bdate,$civilstatus,$registeredvoter,$citizenship,$contactno,$placeofbirth,$addsitio,$addpurok,$accountemail,$accountpassword,$userrole,$imageupload){

			try {
				$sql = "INSERT INTO resident_user VALUES (:fname,:lname,:midname,:suffix,:gender,:bdate,:civilstatus,:registeredvoter,:citizenship,:contactno,:placeofbirth,:addsitio,:addpurok,:accountemail,:accountpassword,:userrole,:imageupload)";
				$stmt =$this->db->prepare($sql);

				$stmt->bindparam(':fname',$fname);
				$stmt->bindparam(':lname',$lname);
				$stmt->bindparam(':midname',$midname);
				$stmt->bindparam(':suffix',$suffix);
				$stmt->bindparam(':gender',$gender);
				$stmt->bindparam(':bdate',$bdate);
				$stmt->bindparam(':civilstatus',$civilstatus);
				$stmt->bindparam(':registeredvoter',$registeredvoter);
				$stmt->bindparam(':citizenship',$citizenship);
				$stmt->bindparam(':contactno',$contactno);
				$stmt->bindparam(':placeofbirth',$placeofbirth);
				$stmt->bindparam(':addsitio',$addsitio);
				$stmt->bindparam(':addpurok',$addpurok);
				$stmt->bindparam(':accountemail',$accountemail);
				$stmt->bindparam(':accountpassword',$accountpassword);
				$stmt->bindparam(':userrole',$userrole);
				$stmt->bindparam(':imageupload',$imageupload);
				

				$stmt->execute();
				return true;

			} catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		} 
	}
?>