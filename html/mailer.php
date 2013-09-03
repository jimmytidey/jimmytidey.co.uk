<?
    
    
    $to         = 'jimmytidey@gmail.com';
    
    
    $subject    = 'SOCIAL MIRROR EMAIL';
    $message    = $_GET['email_address'];
    $user_address    = $_GET['email_address'];
    
    
    mail($to, $subject, $message);
    
    $message = 'This is a place holder for your prescription';
     
    mail($user_address, $subject, $message); 
     

?>