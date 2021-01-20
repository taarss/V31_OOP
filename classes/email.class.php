<?php 
    class Email{
        function sendEmail($subject, $optinalLink, $message, $email){
            $from = 'Christianvillads.tech <noreply@christianvillads.tech>';
            $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'Return-Path: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
            $formatMessage = '<p>'. $message . '<a href="'. $optinalLink .'">'. $optinalLink .'</a></p>';
            mail($email, $subject, $formatMessage, $headers);
        }
    }