<?php
    /*
        The Send Mail PHP Script for Contact Form
        Server-side data validation is also added for good data validation.
    */
    
    $data['error'] = false;
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Basic validation
    if( empty($name) ){
        $data['error'] = 'Please enter your name.';
    } else if( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){
        $data['error'] = 'Please enter a valid email address.';
    } else if( empty($subject) ){
        $data['error'] = 'Please enter your subject.';
    } else if( empty($message) ){
        $data['error'] = 'The message field is required!';
    } else {
        
        // Sanitize the message content
        $formcontent = "From: " . htmlspecialchars($name) . "\n" .
                       "Subject: " . htmlspecialchars($subject) . "\n" .
                       "Email: " . htmlspecialchars($email) . "\n" .
                       "Message: " . htmlspecialchars($message);
        
        // Place your Email Here
        $recipient = "your_mail@your_domain.com";
        
        // Email headers
        $mailheader = "From: " . $email . "\r\n" .
                      "Reply-To: " . $email . "\r\n" .
                      "Content-type: text/plain; charset=UTF-8" . "\r\n";
        
        // Send the email with the corrected subject
        if( mail($recipient, $subject, $formcontent, $mailheader) == false ){
            $data['error'] = 'Sorry, an error occurred!';
        } else {
            $data['error'] = false;
        }
    }
    
    // Return response as JSON
    echo json_encode($data);
?>
