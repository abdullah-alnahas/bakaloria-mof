<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
class join_employee extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('EmployeeList_Model');
        
        $this->load->library('form_validation');
        
        $this->load->helper('url');
    }
    
	public function index()
	{
	   $this->load->helper('form');
       $this->load->view('join_employee/view');
	   //$this->load->view('main');
	   
       //$this->load->view('footer');
    
	}
    
   
    public function save()
    {
        
        $fname = $this->input->post('emp_fname');
        $lname = $this->input->post('emp_lname');
        
        $this->form_validation->set_rules('emp_fname', 'First Name', 'required|callback_arab_alpha');
        $this->form_validation->set_rules('emp_lname', 'Surname', 'required|callback_arab_alpha');

         
        if($this->form_validation->run() == false)
        {
            //echo "input error";
            $this->load->view('join_employee/main');
        }
        
        else{
        
        
            $postdata = array(
                
                'fname' => $fname,
                'lname' => $lname,
                
            );
            
          if($this->EmployeeList_Model->insert($postdata))
          {
            $this->load->view('join_employee/saved'); 
          }
          else
          {
            $this->index();
          }
      }    
    }
   
    
        public function arab_alpha($str)
        {
            
            return ( ! preg_match('/^([a-z]|\p{Arabic})+$/iu', $str)) ? FALSE : TRUE;
            //return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
        } 
    
}

?>