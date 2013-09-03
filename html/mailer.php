<?
    
    
    $to         = 'jimmytidey@gmail.com';
    
    
    $subject    = 'THIS IS AN EMAIL';
    $message    = $_GET['email_address'];
    
    mail($to, $subject, $message); 
     

?>