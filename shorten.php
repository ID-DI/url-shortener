<?php
session_start();
require_once __DIR__ . "/classes/db.php";
require_once __DIR__ . "/classes/functions.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $original_url = $_POST['url'];
    if (!empty($original_url)) 
    {
        $original_url = filter_var($original_url, FILTER_SANITIZE_URL);

        if (!filter_var($original_url, FILTER_VALIDATE_URL)) 
        {
            header("Location:index.php");
            $_SESSION['error'] = $original_url." is not a valid URL";
            exit();
        } 
        elseif(!preg_match( '/^(http|https):\/\/[a-z0-9_]+([\-\.]{1}[a-z_0-9]+)*\.[_a-z]{2,5}(([0-9]{1,5})?\/.*)?$/i' ,$original_url))
        {
            header("Location:index.php");
            $_SESSION['error'] = $original_url." is not a valid URL";
            exit();
        } 
        else
        {
            $short_code = shorten_url($original_url);
            header("Location:index.php");
            $_SESSION['success']= "Shortened URL: http://{$_SERVER['HTTP_HOST']}/$short_code";
            exit();
        }
    } 
    else 
    {
        header("Location:index.php");
        $_SESSION['error'] = "No URL has been submitted.";
        exit();
    }
}
else
{
       $_SESSION['error'] = "Only POST requests allowed";
        header("Location:index.php");
        die();
} 

?>
