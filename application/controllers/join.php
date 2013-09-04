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
        $pc_id = 0;
        
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
            
            if($pc_id = $this->studentlist_model->getPcId($lab_Id))
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
                    'pc_id'=>$pc_id,
                    
                );
                
                if($this->studentlist_model->insert($postdata))
                {
                    $this->studentlist_model->setPcAvailFalse($pc_id);
                    
                    $pc_name = $this->studentlist_model->getPcName($pc_id);
                 
                    $row = $this->studentlist_model->getLabName($lab_Id);
                        
                        foreach ($pc_name->result_array() as $name)
                        {
                             echo $name['name'];
                        }
                }
           
            
                else
                {
                    echo "false!!";
                }
                
           }
           else
            {
             echo "false!!";
            } 
          }
          
          else
          {
             echo "false!!";
          }   
        }
    }
    
//    
//    function test()
//    {   
//       if($this->studentlist_model->setCounter($_GET['value']))
//       {
//            echo true;
//       }
//       else
//       {
//            echo false;
//       }
//
//    }
    
    function update()
    {
    	$id = $_GET['id'];
        $p_id = $_GET['p_id'];
        if($this->studentlist_model->updateStudent($id)===true)
        {
            $this->studentlist_model->setPcAvailTrue($p_id);
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
        if(isset(self::$counter))
        {
            if(self::$counter < 100)
            {
                echo "im here";
                self::$counter++;
            }
            else
            {
                self::$counter = 1;
            }
            
            echo self::$counter;
            
        }
    }
    
    function num_available_places()
    {
        $available = $this->studentlist_model->availableAndActivePcCount();
		$cap = $this->studentlist_model->workingPcCount();
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode(array('capacity' => $cap,'available'=>$available)));
    }
	
	function capOfLabs()
	{
		$cap = $this->studentlist_model->getCapacityOfLabs();
		echo $cap;
	}
    
    public function arab_alpha($str)
    {
            
        return ( ! preg_match('/^([a-z ]|\p{Arabic})+$/iu', $str)) ? FALSE : TRUE;
        //return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
    }
    
    public function pcCheck($id)
    {
        $this->studentlist_model->setPcWorkingTrue($id);
    }
    
    
    public function pcUnCheck($id)
    {
        $this->studentlist_model->setPcWorkingFalse($id);
    }

    
    public function inc_Counter()
    {
        $this->studentlist_model->increaseCounter();
    }
    
    public function reset_Counter()
    {
         $this->studentlist_model->resetCounter();
    }
    
    public function set_Counter()
    {
         $this->studentlist_model->setCounter($_GET['value']);
    }
    
    public function get_Counter()
    {
       $counter_value = 0;
       $counter_last_update; 
        
       $q = $this->studentlist_model->getCounter();
       
       if($q->num_rows()>0)
       {
            foreach($q->result_array() as $row)
            {
                $counter_value = $row['counter_value'];
                $counter_last_update = $row['counter_last_update'];
            }
            
             $this->output
		          ->set_content_type('application/json')
		          ->set_output(json_encode(array('counter_value' => $counter_value,'counter_last_update'=>$counter_last_update)));
       } 
       
      
    }
    
    function desplay_pc()
    {
        $i = 1;
        
        $q = $this->studentlist_model->getpc();
        
        if($q->num_rows() > 0)
        {
            foreach($q->result_array() as $row)
            {
                $all_pc[$i] =array('lab'=>$row['lab_name'],'pc_'.$i.'_info'=>array('pc_name'=>$row['pc_name'],'status'=>$row['pc_is_working']));
                $i++;
            }
        }
        
        $data['pcs'] = $all_pc;
        $this->load->view('join/saved',$data);
    }
    
    
		
	function updateNumOfAvailPlaces()
	{
		$current = $this->studentlist_model->lastUpdate();
		$last = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0;
		while( $current <= $last) {
			usleep(10000);
			clearstatcache();
			$current = $this->studentlist_model->lastUpdate();//this is a bad piece of code!!
		}
		$available = $this->studentlist_model->availableAndActivePcCount();
		$timestamp = $current;
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode(array('available_places' => $available,'timestamp'=>$timestamp)));
	}
    
    function updateNumOfCapacity()
	{
		$current = $this->studentlist_model->workingPcCount();
		$last = isset($_GET['capacity']) ? $_GET['capacity'] : 0;
		while( $current != $last) {
			usleep(10000);
			clearstatcache();
			$current = $this->studentlist_model->workingPcCount();//this is a bad piece of code!!
		}
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode(array('cap' => $current)));
	}
		
}
		

?>