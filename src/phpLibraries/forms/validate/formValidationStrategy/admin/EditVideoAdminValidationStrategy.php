<?

	/**
	 *	EditVideoAdminValidationStrategy.php
	 *
	 *	Created:
	 *	2012-08-08
	 *
	 *	Modified:
	 *	2012-08-08
	 *
	 *	Created by:
	 *	Jonathan Blackburn for Teletoon Canada Inc.
	 *
	 *	Purpose:
	 *	- performs validation on video record admin data
	 *
	 *	$obj expects:
	 *	- data:	array of submitted form data
	 */


	/*
		-------------------------------
		include supporting files
		-------------------------------
	*/

		include_once(PHP_PATH . "forms/validate/formValidationStrategy/FormValidationStrategyInterface.php");
 		include_once(PHP_PATH . "forms/validate/formValidationStrategy/admin/BaseAdminValidationStrategy.php");
		include_once(PHP_PATH . "forms/validate/vo/admin/VideoAdminMessagingVO.php");
  		
		class EditVideoAdminValidationStrategy extends BaseAdminValidationStrategy implements FormValidationStrategyInterface {
		
			/**
			 *	validateForm
			 *	- iterates through $obj->data and evaluates each by type 
			 *	- each data type check returns either success (errorCode = 0) or an errorCode, which is then used to 
			 *	retrieve an error message that is pushed to an array
			 */	 
			public function validateForm($obj) {
				
				$errorCode = $this->checkAdminName($obj);
				
				if ($errorCode == 0) $errorCode = $this->checkAlphaNumericSpace($obj->data->content_details->video->video_keywords);
				
				// validation passes
				if ($errorCode == 0) {
					// add success message to return data
					$this->message->addMessage(1);
				} else {
					$this->message->addMessage($errorCode);	
				}
				
				$result = new stdClass();
				$result->errorCode = $errorCode;
				$result->message = $this->message->getMessage();
				
				return $result;
			}
			
			
			protected function generateMessaging() {
				$this->message = new VideoAdminMessagingVO();
			}
		}

?>