<?php
class Join extends CI_Controller {

    //public $cho_lab_id = 0;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('studentlist_model');
        
        $this->load->library('form_validation');
        
        $this->load->helper('date');
		
		$this->load->helper('form');
    }
    
	public function index()
	{
       $this->_get_still_inside_students();
    
	}
    
   
    public function save()
    {
        $lab_Id = 0;
        //$cho_lab_count = 25;
        
        //echo var_dump($_POST);
        
        
        $this->form_validation->set_rules('st_fname', 'First Name', 'required|callback_arab_alpha');
        $this->form_validation->set_rules('st_lname', 'Surname', 'required|callback_arab_alpha');
        $this->form_validation->set_rules('st_phone', 'Home Telephone Number', 'required|numeric');

         
        if($this->form_validation->run() == false)
        {
            echo "input error";
            //$this->load->view('Join/view');
        }
        else
        {
            if($lab_Id = $this->studentlist_model->getLabId())
            {
            
            //$cho_lab_id = $lab_Id;
            
            $this->load->helper('url');
            
            $datestring = "%Y-%m-%d %h:%i:%s";
            $time = time();

            $time = mdate($datestring, $time);
            
            $postdata = array(
                
                'st_fname' => $this->input->post('st_fname'),
                'st_lname' => $this->input->post('st_lname'),
                'st_phone' => $this->input->post('st_phone'),
                'st_enter_time' => $time,
                'lab_id' => $lab_Id ,
                
            );
            
            $this->studentlist_model->insert($postdata);
             
            $row = $this->studentlist_model->getLabName($lab_Id);
                    
               foreach ($row->result_array() as $lab_name)
                  {
                     echo $lab_name['lab_name'];
                  }
                
            
            //$this->Studentlist_model->getAllStudent();
            
            //$this->load->view('Join/saved');
            
          }
          
          else
          {
             echo "false";
          }   
        }
    }
    
    
    function update()
    {
    	$id = $_GET['id'];
        if($this->studentlist_model->updateStudent($id)==true)
        {
            echo "Updated Successfully";
        }
        else if($this->studentlist_model->updateStudent($id)=='no affected rows')
        {
            echo "no affected rows";
        }else if($this->studentlist_model->updateStudent($id)==false)
        {
            echo "error";
        }
    }
    
   function lab_name()
   {
       
       //echo "oops!";
       
      if( $lab_Id = $this->studentlist_model->getLabId()){
       
       $row = $this->studentlist_model->getLabName($lab_Id);
           
            foreach ($row->result_array() as $lab_name)
               {
                  echo $lab_name['lab_name'];
               }
               
       }
       
       else
       {
           echo "There is no places left!!!";
       }
    } 
    
    
    
    function displayAllStudent()
    {
        if($query = $this->studentlist_model->getAllRegistered())
        {
            $data['regesterd'] = $query;
            $this->load->view('join/view',$data);
        }
        else
        {
            echo false;
        }
    }
    
    function displayAllStudentDay()
    {
        if($query = $this->studentlist_model->getAllRegisteredInDay())
        {
            $data['regesterd'] = $query;
            $this->load->view('join/view',$data);
        }
        else
        {
            echo false;
        }
    }
    
        public function arab_alpha($str)
        {
            
            return ( ! preg_match('/^([a-z ]|\p{Arabic})+$/iu', $str)) ? FALSE : TRUE;
            //return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
        }
		
		function _get_still_inside_students(){
		    $result= $this->studentlist_model->getAllStudent();
			$data['records'] = $result;
			$this->load->view('join/view',$data);
		}
		
		
}
		

?>