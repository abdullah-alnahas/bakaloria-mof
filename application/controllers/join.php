<?php
class Join extends CI_Controller {

    //public $cho_lab_id = 0;
    public static $counter = 1 ;
    
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
        
        $this->form_validation->set_rules('st_fname', 'First Name', 'required|callback_arab_alpha');
        $this->form_validation->set_rules('st_lname', 'Surname', 'required|callback_arab_alpha');
        $this->form_validation->set_rules('st_phone', 'Home Telephone Number', 'required|numeric');
        $this->form_validation->set_rules('st_faname', 'Father Name', 'required|callback_arab_alpha');
        $this->form_validation->set_rules('st_mname', 'Mother Name', 'required|callback_arab_alpha');
        $this->form_validation->set_rules('st_queue_num', 'The Number In The Queue', 'required|numeric');
         
        if($this->form_validation->run() === false)
        {
            echo "input error";
        }
        else
        {
            if($lab_Id = $this->studentlist_model->getLabId())
            {
            
            
            $this->load->helper('url');
            
            $datestring = "%Y-%m-%d %h:%i:%s";
            $time = time();

            $time = mdate($datestring, $time);
            
            $postdata = array(
                
                'st_fname' => $this->input->post('st_fname'),
                'st_lname' => $this->input->post('st_lname'),
                'st_phone' => $this->input->post('st_phone'),
                'st_faname' => $this->input->post('st_faname'),
                'st_mname' => $this->input->post('st_mname'),
                'st_queue_num' => $this->input->post('st_queue_num'),
                'st_enter_time' => $time,
                'lab_id' => $lab_Id ,
                
            );
            
            if($this->studentlist_model->insert($postdata))
            {
             
                $row = $this->studentlist_model->getLabName($lab_Id);
                    
                    foreach ($row->result_array() as $lab_name)
                    {
                         echo $lab_name['lab_name'];
                    }
            }
            
            else
            {
                echo "false";
            }
                
            
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
        if($this->studentlist_model->updateStudent($id)===true)
        {
            echo "Updated Successfully";
        }
        else if($this->studentlist_model->updateStudent($id)==='no affected rows')
        {
            echo "no affected rows";
        }else if($this->studentlist_model->updateStudent($id)===false)
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
    
    
   	function _get_still_inside_students()
       {
 		    $result = $this->studentlist_model->getAllStudent();
 			$data['records'] = $result;
 			$this->load->view('join/view',$data);
   	   }
       
    function neededStudent()
    {
        
        $need = $this->studentlist_model->existStudent($this->input->get('already_exist'));
        
        echo $need;
    }
    
    function moveCounter()
    {
        if(join::$counter < 100)
        {
            join::$counter++;
        }
        else
        {
            join::$counter = 1;
        }
        
        echo join::$counter;
    }
    
    function num_available_places()
    {
        $available = $this->studentlist_model->available_places();
        
        return $available ; 
    }
    
        public function arab_alpha($str)
        {
            
            return ( ! preg_match('/^([a-z ]|\p{Arabic})+$/iu', $str)) ? FALSE : TRUE;
            //return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
        }
		
	
		
		
}
		

?>