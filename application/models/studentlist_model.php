<?php
	class Studentlist_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper('date');
		}
		
		public function get_StudentList()
		{
			$query = $this->db->get('lab');
			return $query->result_array();
		}
        
        public function insert($row)
        {    
            $this->db->where('st_fname',$row['st_fname']);
            $this->db->where('st_lname',$row['st_flname']);
            $this->db->where('st_phone',$row['st_phone']);
            $this->db->where('st_faname',$row['st_faname']);
            $this->db->where('st_mname',$row['st_mname']);
            
            $query = $this->db->get('student');
            if($query->num_rows() == 0)
            {
                $this->db->insert('student',$row);
                return $this->db->insert_id();
            }
            else
            {
                return false;
            } 
        }
        
        public function getLabId()
        {
            $lab_Id1 = 0;
            $cho_lab_count = 7;
            $flag = true;
            
            $query1 = $this->db->query('select lab.lab_id id,COUNT(*) count 
                                       from student right Join lab
                                       ON student.lab_id = lab.lab_id
                                       GROUP BY lab.lab_id , student.`st_leave_time` 
                                       HAVING ISNULL(student.st_leave_time); ');
                                       
            $query2 =$this->db->get('lab');                           
                                       
           // $query2 = $this->db->query('select lab.lab_id from lab order by lab.lab_id;');
            
            
            if($query2->num_rows() > $query1->num_rows())
            {
              
                foreach($query2->result_array() as $row)
                {
                    if($query1->num_rows() == 0)
                    {
                        $lab_Id1 = $row['lab_id'];
                        return $lab_Id1;
                    }
                    else
                    {
                        foreach($query1->result_array() as $exist)
                        {
                            if($exist['id'] == $row['lab_id'])
                            {
                                //echo "im in false <br />";
                                $flag = false;
                                break;
                            }
                            else
                            {
                                //echo "im in true <br />";
                                $lab_Id1 = $row['lab_id'];
                                $flag = true;
                            }
                        }
                    }
                    if($flag == true)
                    {
                        return $lab_Id1;
                    }
                }
            }
            else
            {
              foreach ($query1->result_array() as $row){
                
    
                    //$nrow = $query1->next_row('array');
                    
                    
                    if($cho_lab_count > $row['count'])
                       { 
                         $cho_lab_count = $row['count'];
                         $lab_Id1 = $row['id'];
                         
                       }
                }
                if($cho_lab_count <= 25){
                    
                    //echo $cho_lab_count;
                    return $lab_Id1;
                
                }
                
                else
                {
                    return false;
                }
                
           }
        }
        
        
         public function getAllStudent()
            {
                
               $q = $this->db->query('
               SELECT st.st_fname, st.st_lname, st.st_enter_time, st.st_id, lab.lab_name 
               FROM student st
               inner Join lab
               on st.lab_id = lab.lab_id
               WHERE ISNULL(st.st_leave_time)
			   ;
               ');
			   
		 
               return $q->result();
            }
            
            
         public function getLabName($id)
            {
                
               $q = $this->db->query('SELECT lab_name 
                                      FROM lab 
                                      WHERE lab.lab_id = '.$id.' ;');
               
               return $q;
                    
            }
            
         function updateStudent($id)
         {
         	$q = $this->db->query('SELECT *
         					  FROM student s
         					  WHERE s.st_id = '.$id.'
         					  AND s.st_leave_time is NULL
         	');
			if($q->num_rows()==1){
	            $datestring = "%Y-%m-%d %h:%i:%s";
	            $time = time();
	
	            $time = mdate($datestring, $time);
				
				$data = array(
					'st_leave_time' => $time,
				);
	            
				$this->db->where('st_id',$id);
				$this->db->where('st_leave_time',NULL);
				$this->db->update('student',$data);
	            
				
	            if($this->db->affected_rows() > 0)
	            {
	                return true;
	            }
	            else
	            {
	                return false;
	            }
			}else{
				return 'no affected rows';
			}
         }
         
        function getAllRegisteredInDay()
        {
            $datestring = "%Y-%m-%d";
            $time = time();
            
            $split_time = split("-", $time);
            $y = $split_time[0];
            $m = $split_date[1];
            $d = $split_time[2];
            
            $query = $this->db->query('select st.st_fname as Firstname,st.st_lname as Lastname,st.st_phone Phone,
                                        st.st_enter_time Enter,st.st_leave_time Finish,lab.lab_name Lab
                                        from student st inner join lab
                                        on st.lab_id = lab.lab_id
                                        where !isnull(st.st_leave_time) and YEAR(st.st_enter_time) = '.$y.'and MONTH(st.st_enter_time) = '.$m.' 
                                        and DAY(st.st_enter_time) = '.$d.';');
                                        
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
            
        } 
        
       function getAllRegistered()
        {
            
            $query = $this->db->query('select st.st_fname as Firstname,st.st_lname as Lastname,st.st_phone Phone,
                                        st.st_enter_time Enter,st.st_leave_time Finish,lab.lab_name Lab
                                        from student st inner join lab
                                        on st.lab_id = lab.lab_id
                                        where !isnull(st.st_leave_time)
                                        ;');
                                        
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
            
        } 
        
        function existStudent($already_exist)
        {
            $need_student = 0;
            
            $sleepTime = 60;
            
            do
            {
            
            $maxNumber = $this->db->query('select SUM(lab.lab_max_voloum) max 
                                           from lab;');
            
            $exist_student = $this->db->query('select count(*) exist 
                                               from student st
                                               where isnull(st.st_leave_time);');
                                               
            foreach($exist_student->result_array() as $exist)
            {
                foreach($maxNumber->result_array() as $max)
                  {
                    if($exist['exist'] <= $max['max'])
                     {
                        $need_student = $max['max'] - $exist['exist'];
                        
                        if($need_student == $already_exist)
                        {
                            sleep(1);
                            $sleepTime--;
                        } 
                        
                     }
                
                  }
            }
            
            }while(($need_student == $already_exist)&&($sleepTime != 0));
            
            return $need_student;
        }

	}
    
   
?>