<?php 

/**
 * summary
 */
class Andi
{
    /**
     * summary
     */
    function __construct()
    {
    	$this->CI =& get_instance();    
    }
    public function sugara($template, $data = null){
    	$data['contents']	= $this->CI->load->view($template,$data, true);
    	$this->CI->load->view('template/template_utama',$data);
    }
}