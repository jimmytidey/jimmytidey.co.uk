<?
    
    
    $to             = 'jimmytidey@gmail.com';
    $subject        = 'Your Social Mirror Prescription';
    $message        = $_GET['message'];
    $user_address   = $_GET['email_address'];
    
    
    mail($to, $subject, $message);
    
   
     
    mail($user_address, $subject, $message); 
     

?>