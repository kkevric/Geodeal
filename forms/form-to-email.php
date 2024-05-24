<?php

  include './form-to-email-config.php';
  include './functions.php';

  $name = $_POST['name'];
  $visitor_email = $_POST['email'];
  $message = $_POST['message'];

  // Check name
  if(!$name)
  {
  $error .= 'Please enter your First name.<br />';
  }

  // Check email
  if(!$visitor_email)
  {
  $error .= 'Please enter an e-mail address.<br />';
  }

  if($visitor_email && !ValidateEmail($visitor_email))
  {
  $error .= 'Please enter a valid e-mail address.<br />';
  }

	$email_from = WEBMASTER_EMAIL;
	$email_subject = "Novo sporočilo";
	$email_body = "Dobili ste sporočilo od osebe $name.\nSporočilo je naslednje:\n$message";

  if(!$error)
    {
      // $to = WEBMASTER_EMAIL;

      // $headers = "From: $email_from \r\n";

      // $headers .= "Reply-To: $visitor_email \r\n";

      // $mail = mail($to,$email_subject,$message,$headers);

      // if($mail)
      //     {
      //       echo '<div class="sent-message">
      //       Vaše sporočilo je bilo uspešno poslano! Hvala!
      //       </div>'
      //     }
      $mail = mail(WEBMASTER_EMAIL, $email_subject, $email_body,
        "From: ".$name." <".$visitor_email.">\r\n"
        ."Reply-To: ".$visitor_email."\r\n"
        ."X-Mailer: PHP/" . phpversion());
        if($mail)
        // {
        //   echo 'Vase sporocilo je bilo uspesno poslano! Hvala!';
        // }
        { ?>
          <script language="javascript" type="text/javascript">
           alert('Thank you for the message. We will contact you shortly.');
           window.location.href = './../index.html';
          </script>
          <?php
          }
    }
  else
    {
    echo '<div class="notification_error">'.$error.'</div>';
    }


?>