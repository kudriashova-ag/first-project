<?php
session_start();

require_once './functions/helpers.php';
require_once './functions/Message.php';

$page = $_GET['page'] ?? 'home';

$action = $_POST['action'] ?? null; // 'reg'
if(!empty($action) && function_exists($action)){
  $action();  
}




function sendMail(){
  $email = clear($_POST['email'] ?? null);
  $subject = clear($_POST['subject'] ?? null);
  $message = clear($_POST['message'] ?? null);

  $errors = [];
  if (empty($email)) {
    $errors[] = 'Email is required';
  }
  if (empty($subject)) {
    $errors[] = 'Subject is required';
  }
  if (empty($message)) {
    $errors[] = 'Message is required';
  }

  if (count($errors) > 0) {
    Message::set($errors, 'danger');
  } else {
    mail('kudriashova.ag@gmail.com', $subject, "From: $email, Message: $message");
    Message::set('Thank!'); 
  }
  redirect('contacts');
}



function uploadFile(){
  $file = $_FILES['file'];
  extract($file);

  if($error != 0){
    Message::set('Error', 'danger');
    redirect('upload');
  }

  $allowed = ['image/jpeg', 'image/png', 'image/gif'];
  if(!in_array($type, $allowed)){
    Message::set('Not Image', 'danger');
    redirect('upload');
  }

  if(!file_exists('./uploads')){
    mkdir('./uploads');
  }

  $name = translit_file(microtime() . '_' . $name);

  if(!move_uploaded_file($tmp_name, './uploads/' . $name)){
    Message::set('Error', 'danger');
    redirect('upload');
  }

  Message::set('File uploaded!');
  redirect('upload');
}