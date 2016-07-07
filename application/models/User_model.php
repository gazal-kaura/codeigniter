<?php
class User_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //insert into user table
    function insertUser($data)
    {
        
        return $this->db->insert('users', $data);
    }
    function checkUser($email,$password)
    {

        $pass=md5($password);
        $query = $this->db->query("SELECT name and password from users where email='".$email."' AND password='".$pass."'");
        return($this->db->affected_rows());

    }

    function changePasswordEntry($user_id,$password)
    {
        
            $data=array('password'=>md5($password));
            $this->db->where('user_id',$user_id);
            return $this->db->update('users',$data);
    }


   public function getSuggestions1($suggestion)
    {    
            $suggestion = $suggestion."%";        
            $query = $this->db->query("SELECT tag_id,tag_name from tags where tag_name LIKE '".$suggestion."' LIMIT 10");
            $matches = $query->result_array();
            $data = array();
            foreach($matches as $match){
                $data[] = array(
                        'id'    => $match['tag_id'],
                        'value' => $match['tag_name']
                    );
            }
            return $data;
        }


    function getid($email)
    {

        
        $query = $this->db->query("SELECT user_id from users where email='".$email."'");

        $row = $query->result_array();        
        return $row[0]['user_id'];
        
    }

    function validateEmail($email)
    {
        
        $query = $this->db->query("SELECT email from users where email='".$email."'");

        if($this->db->affected_rows() > 0){
            return "true";
        }
        else{
            return "false";
        }

     }
     
     function hasChangePasswordAccess($user_id,$password){
        
        $query = $this->db->query("SELECT password from users where user_id='".$user_id."'");

        if($this->db->affected_rows() > 0){
            $row = $query->result_array();
            if($password==md5($row[0]['password']))
                return true;
        }        
        return false;
        

     }

    function postQues($data,$tags){
        $question_description = $data['question_description'];
        $this->db->insert('questions',$data);
        $newQuestionID = $this->db->insert_id();
        $query = $this->db->query("SELECT question_id from questions where question_description='".$data['question_description']."'");
        $question = $query->result_array();  
        foreach ($tags as $tag){            
            $q=$this->db->query("SELECT tag_id from tags where tag_name='".$tag."'");
            $row1 = $q->result_array(); 
            
            if($this->db->affected_rows()>0)
            {
                                    
                $data = array(
                    'tag_id'  => $row1[0]['tag_id'],
                    'question_id' =>$question[0]['question_id']                      
                    );             
                $this->db->insert('relation_between_tag_id_question_id',$data);

            }
            else
            {
                $data = array(
                    'tag_name'  => $tag
                );
                $this->db->insert('tags',$data);
                $q=$this->db->query("SELECT tag_id from tags where tag_name='".$tag."'");
                $row1 = $q->result_array();                                                            
                $data = array(
                    'tag_id'  => $row1[0]['tag_id'],
                    'question_id' =>$question[0]['question_id']                      
                ); 
                $this->db->insert('relation_between_tag_id_question_id',$data); 
            }
        }
        return $newQuestionID;


    }


   function tagExist($tag_name)
    {

        
        $query = $this->db->query("SELECT tag_id from tags where tag_name='".$tag_name."'");
         if($this->db->affected_rows() > 0){
            return $query->result_array();
        }
        else{
            return 0;
        }
        
    }

    function getUserDetails($email)
    {
        
        $query = $this->db->query("SELECT * from users where email='".$email."'");
        return $query->result();
    }


        function getQuesFromTag($tid)
    {

        
        $query = $this->db->query("SELECT a.question_id from questions a, relation_between_tag_id_question_id b where b.tag_id='".$tid."' AND b.question_id=a.question_id");
        return $query->result_array();
    }

    function profile($user_id)
    {
        
        $query = $this->db->query("SELECT * from users where user_id='".$user_id."'");
        return $query->result();
    }

    function editUser($data,$user_id)
    {        
            $this->db->where('user_id',$user_id);
            return $this->db->update('users',$data);
         
    }
    function getQues($user_id)
    {
         $query = $this->db->query("SELECT * from questions where user_id='".$user_id."'");
        return $query->result();
    }

    public function getUserTags($user_id)
    {
              $query = $this->db->query("SELECT a.tag_id,b.tag_name from relation_between_user_id_tag_id a,tags b where a.tag_id=b.tag_id AND a.user_id= '".$user_id."'");
        return $query->result(); 


    }

     public function getAllTags()
    {
       $out=$this->db->query("select * from tags;");
        $out=$out->result_array();
        return($out); 


    }

     function recentQ($start_of_page=1,$number_of_records_per_page=5){
        $query = $this->db->query("SELECT GROUP_CONCAT(a.tag_id SEPARATOR '-|::|-') as tag_ids, GROUP_CONCAT(a.tag_name SEPARATOR '-|::|-') as tag_names,b.question_id,c.question_description,c.posted_at,d.name,d.profile_pic from tags a,relation_between_tag_id_question_id b,questions c,users d where a.tag_id=b.tag_id AND b.question_id=c.question_id AND c.user_id=d.user_id  GROUP BY(c.question_id) ORDER BY c.posted_at DESC")->result_array();        
        $ansQuery=$this->db->query("SELECT b.question_id,GROUP_CONCAT(a.answer_id SEPARATOR '-|::|-') as answer_ids,GROUP_CONCAT(a.answer SEPARATOR '-|::|-') as answers from answers a,questions b where a.question_id=b.question_id GROUP BY (b.question_id)")->result_array();
        
       // return $data;

       $total_records=count($query);
       //$number_of_records_per_page=5;
       $number_of_pages=ceil($total_records/$number_of_records_per_page);
       
       $records_to_leave = ($start_of_page-1)*($number_of_records_per_page);
         

       $query = $this->db->query("SELECT GROUP_CONCAT(a.tag_id SEPARATOR '-|::|-') as tag_ids, GROUP_CONCAT(a.tag_name SEPARATOR '-|::|-') as tag_names,b.question_id,c.question_description,c.posted_at,d.name,d.profile_pic from tags a,relation_between_tag_id_question_id b,questions c,users d where a.tag_id=b.tag_id AND b.question_id=c.question_id AND c.user_id=d.user_id  GROUP BY(c.question_id) ORDER BY c.posted_at DESC LIMIT ".$records_to_leave.' , '.$number_of_records_per_page.' ;')->result_array();
       $data=array(
                'question'  =>  $query,
                'answer'    =>  $ansQuery
                );

       
       $out=array('pages' => $number_of_pages,'allinfo' => $data,'records_per_page'=>$number_of_records_per_page,'total_records'=>$total_records);
        return ($out);



     }

     function myInterest($user_id,$start_of_page=1,$number_of_records_per_page=5){        
        $query = $this->db->query("SELECT GROUP_CONCAT(a.tag_id SEPARATOR '-|::|-') as tag_ids, GROUP_CONCAT(a.tag_name SEPARATOR '-|::|-') as tag_names,b.question_id,c.question_description,c.posted_at,d.name,d.profile_pic from tags a,relation_between_tag_id_question_id b,questions c,users d,relation_between_user_id_tag_id e where a.tag_id=e.tag_id AND e.user_id='".$user_id."' AND e.status = '"."live"."' AND a.tag_id = b.tag_id AND b.question_id=c.question_id AND c.user_id=d.user_id GROUP BY(c.question_id) ORDER BY c.posted_at DESC")->result_array();
        //echo "<pre>";
       // print_r($query);
        //echo "</pre>";

       $total_records=count($query);
       //$number_of_records_per_page=5;
       $number_of_pages=ceil($total_records/$number_of_records_per_page);
       
       $records_to_leave = ($start_of_page-1)*($number_of_records_per_page);
             
            
      
        $query = $this->db->query("SELECT GROUP_CONCAT(a.tag_id SEPARATOR '-|::|-') as tag_ids, GROUP_CONCAT(a.tag_name SEPARATOR '-|::|-') as tag_names,b.question_id,c.question_description,c.posted_at,d.name,d.profile_pic from tags a,relation_between_tag_id_question_id b,questions c,users d,relation_between_user_id_tag_id e where a.tag_id=e.tag_id AND e.user_id='".$user_id."' AND e.status = '"."live"."' AND a.tag_id = b.tag_id AND b.question_id=c.question_id AND c.user_id=d.user_id GROUP BY(c.question_id) ORDER BY c.posted_at DESC LIMIT ".$records_to_leave.' , '.$number_of_records_per_page.' ;')->result_array();


        $ansQuery=$this->db->query("SELECT b.question_id,GROUP_CONCAT(a.answer_id SEPARATOR '-|::|-') as answer_ids,GROUP_CONCAT(a.answer SEPARATOR '-|::|-') as answers from answers a,questions b where a.question_id=b.question_id GROUP BY (b.question_id)")->result_array();
        $data=array(
                'question'  =>  $query,
                'answer'    =>  $ansQuery
                );
                 //return $data;
        $out=array('pages' => $number_of_pages,'allinfo' => $data,'records_per_page'=>$number_of_records_per_page,'total_records'=>$total_records);
        return ($out);

     }
//get details of a question
        public function getQuesDetail($question_id,$start_of_page=1,$records_per_page=5){
        $query = $this->db->query("SELECT GROUP_CONCAT(a.tag_id SEPARATOR '-|::|-') as tag_ids, GROUP_CONCAT(a.tag_name SEPARATOR '-|::|-') as tag_names,b.question_id,c.question_description,c.posted_at,d.name,d.profile_pic from tags a,relation_between_tag_id_question_id b,questions c,users d where a.tag_id=b.tag_id AND b.question_id=c.question_id AND c.user_id=d.user_id AND b.question_id='".$question_id."' GROUP BY(c.question_id) ORDER BY c.posted_at DESC");

    



$ansQuery=$this->db->query("SELECT * from answers where question_id='".$question_id."' order by posted_at DESC");

        

        $total_records = count(($ansQuery->result_array()));
        $total_pages = ceil($total_records/$records_per_page);
        $records_to_leave = ($start_of_page-1)*($records_per_page);

        $limitedAnsQuery=$this->db->query("SELECT * from answers where question_id='".$question_id."' order by posted_at DESC LIMIT ".$records_to_leave." , ".$records_per_page.";");

        $data=array(
                'question'  =>  $query->result_array(),
                'answer'    =>  $limitedAnsQuery->result_array(),
                'pages'     =>  $total_pages                
                );

        return $data;


        
        }

        public function getQuesDescription($question_id){
            $query = $this->db->query("SELECT a.question_description,a.posted_at,b.name,b.profile_pic from questions a,users b where a.user_id=b.user_id and a.question_id='".$question_id."'");
            return $query->result();

        
        }
          
                  public function addFollower($tgn)
            {
                $this->db->query("select * from relation_between_user_id_tag_id  where user_id = '".$_SESSION['sessiondata']['user_id']."' and tag_id='".$tgn."'");
                if($this->db->affected_rows() > 0){
                    $this->db->query("update relation_between_user_id_tag_id set status= '"."live"."' where user_id = '".$_SESSION['sessiondata']['user_id']."' and tag_id='".$tgn."'");
                 }
                else {
                   $data = array(
                    'tag_id'  => $tgn,
                    'user_id' =>$_SESSION['sessiondata']['user_id']                    
                ); 
                $this->db->insert('relation_between_user_id_tag_id',$data);

                }

                
            }

       //remove a follower of a tag     
      public function removeFollower($tgn)
         {          

         $this->db->query("UPDATE `relation_between_user_id_tag_id` SET `status`= '"."deleted"."' WHERE `user_id`='".$_SESSION['sessiondata']['user_id']."' AND`tag_id`='".$tgn."'");
        }

        

        //post an answer
        public function postA($data){
            //var_dump($data);
            $this->db->insert('answers',$data);
            $this->db->set('answerCount','`answerCount`+1',FALSE);
            $this->db->where('question_id',$data['question_id']);
            return $this->db->update('questions');
        }
        

        

      public function getTagInfo($tgn,$start_of_page=1,$records_per_page=5){
            $query=$this->db->query("select tag_name from tags where tag_id='".$tgn."' ;")->result_array();
            $out=$this->db->query("select a.question_id,a.question_description,a.posted_at,b.user_id,b.name,b.profile_pic from questions a,users b,relation_between_tag_id_question_id c where c.tag_id='".$tgn."' and c.question_id=a.question_id and a.user_id=b.user_id")->result_array();

            $total_records = count($query);

            $total_pages = ceil($total_records/$records_per_page);
            
            $records_to_leave = ($start_of_page-1)*($records_per_page);
         
            $limited_out=$this->db->query("select a.question_id,a.question_description,a.posted_at,b.user_id,b.name,b.profile_pic from questions a,users b,relation_between_tag_id_question_id c where c.tag_id='".$tgn."
                ' and c.question_id=a.question_id and a.user_id=b.user_id LIMIT ".$records_to_leave." , ".$records_per_page." ;")->result_array();



            $questionIds=array();
            for($i=0;$i<count($limited_out);$i++){
                 $tags=$this->db->query("select GROUP_CONCAT(a.tag_id SEPARATOR '-|::|-') as tag_ids,GROUP_CONCAT(a.tag_name SEPARATOR '-|::|-') as tag_names from tags a,relation_between_tag_id_question_id b where b.question_id='".$limited_out[$i]['question_id']."' and b.tag_id=a.tag_id")->result_array();
                 $answer=$this->db->query("select answer_id,answer,posted_at from answers a where question_id='".$limited_out[$i]['question_id']."' ORDER BY posted_at DESC LIMIT 1;")->result_array();
                 //echo $tags[0];
                 //echo "<pre>";
                 //print_r($tags);
                //echo "</pre>";
                 $limited_out[$i]['tags']=$tags[0];
                 if(count($answer))
                 $limited_out[$i]['answer']=$answer[0];

                  else
                  $limited_out[$i]['answer']=NULL;  
                }
            //var_dump($out);
                $limited_out['pages']=$total_pages;
            $sec=$this->db->query("select * from relation_between_user_id_tag_id where tag_id='".$tgn."'".' and status = "live" and user_id='.$_SESSION['sessiondata']['user_id'].'; ')->result_array();
               if(empty($sec))
               $limited_out['follow'] = 0;
               else
               $limited_out['follow'] = 1;
           $limited_out['currentTag'] =$tgn;
           $limited_out['currentTagName']=$query[0]['tag_name'];

            return($limited_out);
        
        }


}
?>
