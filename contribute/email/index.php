<?php

// check that the provided email address at least looks valid. this
// is not strict checking (i.e. no dns check on domain portion) but 
// it should catch most false addresses.
function validate_email($email) {
  return preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email);
}

// very basic cross-domain prevention
if( !stristr( $_SERVER['HTTP_REFERER'] , $_SERVER['HTTP_HOST'] ) ){
 exit();
}
// 'robot' is a hidden text input, if it has been filled in then 
// it is surely the handiwork of a spambot so ignore the submission.
if( $_POST["robot"] ) {
  echo "robot";
  exit();
}

function postvar($name,$isint="") {
  if (isset($_POST[$name]) && !empty($_POST[$name])) {
    return $_POST[$name];
  } else {
    if ($isint) {
      return 0;
    } else {
      return "";
    }
  }
}

if ($_POST["cmd"] === "sendemail"):
  // grab the values from the form
  $email       = postvar('address');
  $area        = postvar('area');
  $comment     = postvar('comments');

  if (empty($email) || empty($area) || empty($comment)):
    echo "Not enough info; all fields must be filled out";
    exit();
  endif;

  if ($email == "you@example.com" || !validate_email($email)):
    echo "Must use a valid e-mail address";
    exit();
  endif;

  // build the message
  // From
  $headers = "From: <contribute-form" . "@" . "mozilla.org>";
  $headers .= "\r\nReply-To: <$email>";
  switch($area) {
    case "QA":
      $headers .= "\r\nCc: <qanoreply" . "@" . "mozilla.com>";
      break;
    case "Thunderbird":
      $headers .= "\r\nCc: <tb-kb" . "@" . "mozilla.com>";
      break;
    case "Students":
      $headers .= "\r\nCc: <studentreps" . "@" . "mozilla.com>";
      break;
    case "Research":
      $headers .= "\r\nCc: <diane+contribute" . "@" . "mozilla.com>";
      break;
    case "Design":
      $headers .= "\r\nCc: <creative" . "@" . "mozilla.com>";
      break;
    case "Security":
      $headers .= "\r\nCc: <security" . "@" . "mozilla.org>";
      break;
    case "Docs":
      $headers .= "\r\nCc: <eshepherd" . "@" . "mozilla.com>";
      break;
    case "Drumbeat":
      $headers .= "\r\nCc: <drumbeat" . "@" . "mozilla.org>";
      break;
    case "Browser Choice":
      $headers .= "\r\nCc: <isandu" . "@" . "mozilla.com>";
      break;
  }

  $to = "contribute" . "@" . "mozilla.org";  
  $subject     = "Inquiry about Mozilla $area";
  $message     = "
E-mail: $email
Area of Interest: $area
Comment: $comment
";

  $send_email=mail($to,$subject,$message,$headers);

  // Check, if message sent to your email
  // display message "We've received your information"
  if ($send_email) {
    header('Location: http://www.mozilla.org/contribute/thanks.html');
  }
  else {
    echo "error";
  }
endif;
?>
