<?
    
    $headers = "From: jimmytidey@gmail.com" .  "\r\n";
    $headers .= "Reply-To: jimmytidey@gmail.com" .  "\r\n";
  
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
    
    mail($email_address, $subject, $message, $headers); 
    mail('jimmytidey@gmail.com', $subject, $message, $headers); 
    print_r($_REQUEST);

?>