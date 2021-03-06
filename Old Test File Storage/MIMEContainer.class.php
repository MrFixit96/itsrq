<?php

class MIMEContainer {
        
    protected $content_type = "text/plain";
    protected $content_enc  = "7-bit";
    protected $content;
    protected $subcontainers;
    protected $boundary;
    protected $created;
    protected $add_header;
    
    public function get_message($add_headers = "") {
        return $this->create($add_headers);
    }
    
    public function sendmail($to, $from, $subject, $add_headers="") {  
        ini_set("SMTP", "localhost");
        ini_set("smtp_port", "25");
        mail($to, $subject, $this->get_message($add_headers), "From: $from\r\n");
    }
    
    function __construct() { 
        $this->created = false;
        $this->boundary = uniqid(rand(1,10000));            
    }

    public function add_header($header) { $this->add_header[] = $header; }
    public function get_add_headers() { return $this->add_header; }
    public function set_content_type($newval) { $this->content_type = $newval; }          
    public function get_content_type() { return $this->content_type; }
    public function get_content_enc() { return $this->content_enc; }
    public function set_content($newval) { $this->content = $newval; }
    public function get_content() { return $this->content; }
    
    public final function set_content_enc($newval)  { $this->content_enc = $newval; }
    
    public final function add_subcontainer($container) { $this->subcontainers[] = $container; }
    public final function get_subcontainers() { return $this->subcontainers; }

    public function create() {
            
      /* Standard Headers that exist on every MIME e-mail */
      $headers  = "MIME-Version: 1.0\r\n" .
                  "Content-Transfer-Encoding: {$this->content_enc}\r\n";
            
      $addheaders = (is_array($this->add_header)) ? implode($this->add_header, "\r\n") : '';
            
      /* If there is a subcontainer */
      if(is_array($this->subcontainers) && 
         (count($this->subcontainers) > 0)) {
        
           $headers .= "Content-Type: {$this->content_type}; " .
                       "boundary={$this->boundary}\r\n$addheaders\r\n\r\n";
           $headers .= wordwrap("If you are reading this portion of the e-mail, then " .
                      "you are not reading this e-mail through a MIME compatiable " .
                      "e-mail client.\r\n\r\n");

           foreach($this->subcontainers as $val) {
                if(method_exists($val, "create")) {
                   $headers .= "--{$this->boundary}\r\n";
                   $headers .= $val->create();
                }
           }
           
           $headers .= "--{$this->boundary}--\r\n";
       } else {
           
           $headers .= "Content-Type: {$this->content_type}\r\n$addheaders\n{$this->content}";
      
       }
       
       return $headers;        
    }
    
}
    
?>