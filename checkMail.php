<?php
function checkOK($field)
{
if (eregi("\r",$field) || eregi("\n",$field))
{
die("Invalid Input!");
}
}

$name=$_POST['name'];
checkOK($name);
$email=$_POST['email'];
checkOK($email);
$comments=$_POST['comments'];
checkOK($comments);
$to="php@gowansnet.com";
$message="$name just filled in your comments form. They said:\n$comments\n\nTheir e-mail address was: $email";
if(mail($to,"Comments From Your Site",$message,"From: $email\n")) {
echo "Thanks for your comments.";
} else {
echo "There was a problem sending the mail. Please check that you filled in the form correctly.";
}
?>