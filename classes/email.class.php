<?php 
    class Email{
        public $subject;
        public $optinalLink;
        public $message;
        public $email;

        function __construct($subject, $optinalLink, $message, $email) {
            $this->subject = $subject;
            $this->optinalLink = $optinalLink;
            $this->message = $message;
            $this->email = $email;
          }
        
        function sendEmail(){
            $from = 'Christianvillads.tech <noreply@christianvillads.tech>';
            $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'Return-Path: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
            $formatMessage = '<p>'. $this->message . '<a href="'. $this->optinalLink .'">'. $this->optinalLink .'</a></p>';
            mail($this->email, $this->subject, $formatMessage, $headers);
        }
    }