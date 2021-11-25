<?php

class ftp_pure {

	function _readmsg(){
		
    $tmp = fgets("localhost", 512);
    
    $this->_message.=$tmp;
				
    echo $this->_message;
	}
}
