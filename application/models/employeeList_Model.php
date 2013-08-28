<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
	class EmployeeList_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database('employee',true);
            
            $this->load->helper('date');
		}
		
		public function get_EmployeeList()
		{
			$query = $this->db->get('employee');
			return $query->result_array();
		}
        
        
        
        public function insert($row)
        {
            
            $fname = $row['fname'] ;
            $lname = $row['lname'] ;
            
            $query = $this->db->query("select employee.emp_id id 
                                       from employee
                                       where employee.emp_fname like '$fname'
                                       and employee.emp_lname like '$lname'; ");
                                       
        if ($query->num_rows() > 0)
        {
            $row = $query->row_array(); 
            $id = $row['id'];
            
            $datestring = "%Y-%m-%d %h:%i:%s";
            $time = time();

            $time = mdate($datestring, $time);
            
            $postdata = array(
                
                'begin_time' => $time,
                'end_time' => 'NULL',
                'emp_id' => $id ,
                
            );
            
            $query1 = $this->db->insert('schedule',$postdata);
            
                                                   
            return true;
        }
        
        
        else
        {

            $postdata = array(
                
                'emp_fname' => $row['fname'],
                'emp_lname' => $row['lname'],
                
            );
            
            $this->db->insert('employee',$postdata);
            
            $id = $this->db->insert_id(); 
            
            $datestring = "%Y-%m-%d %h:%i:%s";
            $time = time();

            $time = mdate($datestring, $time);
            
            $postdata1 = array(
                
                'begin_time' => $time,
                'end_time' => 'NULL',
                'emp_id' => $id ,
                
            );
            
            $this->db->insert('schedule',$postdata1);

            
            return true;
            
            
        }
        }
        

	}

?>