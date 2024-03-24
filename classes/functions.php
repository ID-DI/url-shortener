<?php

function generate_short_code() 
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($characters), 0, 6);
}

function shorten_url($original_url) 
{
    global $conn;
    $short_code = generate_short_code();
    $stmt = $conn->prepare("INSERT INTO urls (original_url, short_code) VALUES (:original_url, :short_code)");
    $stmt->bindParam(':original_url', $original_url);
    $stmt->bindParam(':short_code', $short_code);
    $stmt->execute();
    return $short_code;
}

function get_original_url($id) 
{
    global $conn;
    $stmt = $conn->prepare("SELECT original_url FROM urls WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['original_url'];
    }
    return null;
}

function open_original_url()
{
    global $conn;
    $original_url = get_original_url($_GET['id']);
    if ($original_url) 
    {
        $stmt = $conn->prepare("UPDATE urls SET access_count = access_count + 1 WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        header("Location: $original_url", true, 302);
        exit();
    } 
    else 
    {
        header("Location:404.php");
        exit();
    }
}