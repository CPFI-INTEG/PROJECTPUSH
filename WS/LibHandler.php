<?php

class LibHandler{
		public function loginAuthenticator($studentnum, $password){
		if (empty($studentnum)) {
			return false;
		}
		if (empty($password)) {
			return false;
		}

		$results = libDAO::loginAuthenticator($studentnum, $password);
		//ECHO $results;
		return $results;
		
	}




}

?>