<?
    
    $to             = 'jimmytidey@gmail.com';
    $subject        = 'Your Social Mirror Prescription';
    $message        = $_GET['message'];
    $user_address   = $_GET['email_address'];
    
    if(!$_GET['message']) { 
        $message        = $_POST['message'];
    }
    
    if(!$_GET['email_address']) { 
        $email_address        = $_POST['email_address'];
    }
    
    
    mail($to, $subject, $message);
    mail($user_address, $subject, $message); 
     

?>