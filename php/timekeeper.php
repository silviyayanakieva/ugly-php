<?php
    
    $current=time()+1;
    $timeidle=$current-$_SESSION['last_active'];
   
	if(($timeidle/60)<5)
    {
        $_SESSION['last_active']=time();
    }
    else
    {
        session_unset();
		session_destroy();
    }
    	
?>