<?php

$array = array(
    "firstname" => "",
    "lastname" => "",
    "email" => "",
    "phone" => "",
    "message" => "",
    "firstnameE" => "",
    "lastnameE" => "",
    "emailE" => "",
    "phoneE" => "",
    "messageE" => "",
    "isSuccess" => false
);

$emailTo = "rianasantatra665@gmail.com";

function isPhone($var)
{
    return preg_match("/^[0-9]+$/", $var);
}

function isEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function verifyInput($var)
{
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);

    return $var;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $array["firstname"] = verifyInput($_POST["firstname"]);
    $array["lastname"] = verifyInput($_POST["lastname"]);
    $array["email"] = verifyInput($_POST["email"]);
    $array["phone"] = verifyInput($_POST["phone"]);
    $array["message"] = verifyInput($_POST["message"]);
    $array["isSuccess"] = true;
    $emailText = "";

    if (empty($array["firstname"])) {
        $array["firstnameE"] = "entrez des informations correctes";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Firstname: {$array["firstname"]}\n";

    if (empty($array["lastname"])) {
        $array["lastnameE"] = "entrez des informations correctes";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Lastname: {$array["lastname"]}\n";

    if (!isEmail($array["email"])) {
        $array["emailE"] = "entrez email valide";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Email: {$array["email"]}\n";

    if (!isPhone($array["phone"])) {
        $array["phoneE"] = "entrez numéro de téléphone valide";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Phone: {$array["phone"]}\n";

    if (empty($array["message"])) {
        $array["messageE"] = "entrez votre message";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Message: {$array["message"]}\n";

    if ($array["isSuccess"]) {
        $headers = "From: {$array["firstname"]} {$array["lastname"]} {$array["email"]}\r\nReply-To: {$array["email"]}";
        mail($emailTo, "message du site", $emailText, $headers);
    }
    echo json_encode($array);
}
