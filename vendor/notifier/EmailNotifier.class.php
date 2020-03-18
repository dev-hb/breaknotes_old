<?php


class EmailNotifier extends Notifier {

    public function __construct($id=null)
    {
        parent::__construct($id);
    }

    public function retrieveHeaders(){
        $headers = "From: " . $this->getFrom() . "\r\n";
        $headers .= "Reply-To: ". $this->getFrom() . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $this->setHeaders($headers);
    }

    /**
     * Send the message
     * @return boolean
     */

    public function send(){
        // send via email
        return mail($this->getTo(), $this->getSubject(), $this->getMessage(), $this->getHeaders());
    }

}