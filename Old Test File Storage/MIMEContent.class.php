<?php

class MIMEContent extends MIMEAttachment {
    
    protected $content_id;
            
    public function get_content_id() { return $this->content_id; }
    public function set_content_id($id) { $this->content_id =$id; }
    
    function __construct($file="", $mimetype="") {
        
        parent::__construct();
        $this->content_id = uniqid(rand(1,10000));
        
        if(!empty($file)) {
            $this->set_file($file, $mimetype);
        }
        
    }
    
    public function create() {
        
        if(!isset($this->content)) return;
        
        $addheaders = implode($this->add_header, "\r\n");
        $headers  = "Content-Type: {$this->content_type}\r\n";
        $headers .= "Content-Transfer-Encoding: {$this->content_enc}\r\n";
        $headers .= "Content-ID: {$this->content_id}\r\n$addheaders\r\n";
        $headers .= chunk_split($this->content)."\r\n";
        
        return $headers;
        
    }     
    
    
}

?>