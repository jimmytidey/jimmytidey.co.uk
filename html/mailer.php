<?
    
    $headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
  
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
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
    
    if(!$_GET['email_address']) { 
        $subject        = $_POST['subject'];
    }
    
    mail($user_address, $subject, $message, $headers); 
     

?>