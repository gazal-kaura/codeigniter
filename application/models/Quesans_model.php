<?php
class Quesans_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //insert into user table. Data contains the information regarding question and the tags reperesent the tags associated with the particular question 
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

    //check if a tag exists
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

    //get all questions of a tag with tag_id being supplied as an argument
    function getQuesFromTag($tid)
    {

        
        $query = $this->db->query("SELECT a.question_id from questions a, relation_between_tag_id_question_id b where b.tag_id='".$tid."' AND b.question_id=a.question_id");
        return $query->result_array();
    }

   //get user details from user_id
    function getQues($user_id)
    {
         $query = $this->db->query("SELECT * from questions where user_id='".$user_id."'");
        return $query->result();
    }

    //get all tags that exist
     public function getAllTags()
    {
       $out=$this->db->query("select * from tags;");
        $out=$out->result_array();
        return($out); 


    }

    //get recent posted questions, parameters passed is the page number and the number of records to be displayed on a particular page.
     function recentQ($start_of_page=1,$number_of_records_per_page=5)
     {
        $query = $this->db->query("SELECT GROUP_CONCAT(a.tag_id SEPARATOR '-|::|-') as tag_ids, GROUP_CONCAT(a.tag_name SEPARATOR '-|::|-') as tag_names,b.question_id,c.question_description,c.posted_at,d.name,d.profile_pic from tags a,relation_between_tag_id_question_id b,questions c,users d where a.tag_id=b.tag_id AND b.question_id=c.question_id AND c.user_id=d.user_id  GROUP BY(c.question_id) ORDER BY c.posted_at DESC")->result_array();        
        $ansQuery=$this->db->query("SELECT b.question_id,GROUP_CONCAT(a.answer_id SEPARATOR '-|::|-') as answer_ids,GROUP_CONCAT(a.answer SEPARATOR '-|::|-') as answers from answers a,questions b where a.question_id=b.question_id GROUP BY (b.question_id)")->result_array();

        $total_records=count($query);

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


     //get questions of tags liked by user
     function myInterest($user_id,$start_of_page=1,$number_of_records_per_page=5)
     {        
       $query = $this->db->query("SELECT GROUP_CONCAT(a.tag_id SEPARATOR '-|::|-') as tag_ids, GROUP_CONCAT(a.tag_name SEPARATOR '-|::|-') as tag_names,b.question_id,c.question_description,c.posted_at,d.name,d.profile_pic from tags a,relation_between_tag_id_question_id b,questions c,users d,relation_between_user_id_tag_id e where a.tag_id=e.tag_id AND e.user_id='".$user_id."' AND e.status = '"."live"."' AND a.tag_id = b.tag_id AND b.question_id=c.question_id AND c.user_id=d.user_id GROUP BY(c.question_id) ORDER BY c.posted_at DESC")->result_array();
     
       $total_records=count($query);
     
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

     //get details of a question along with answers
    public function getQuesDetail($question_id,$start_of_page=1,$records_per_page=5)
    {
        $query = $this->db->query("SELECT GROUP_CONCAT(a.tag_id SEPARATOR '-|::|-') as tag_ids, GROUP_CONCAT(a.tag_name SEPARATOR '-|::|-') as tag_names,b.question_id,c.question_description,c.posted_at,d.name,d.profile_pic from tags a,relation_between_tag_id_question_id b,questions c,users d where a.tag_id=b.tag_id AND b.question_id=c.question_id AND c.user_id=d.user_id AND b.question_id='".$question_id."' GROUP BY(c.question_id) ORDER BY c.posted_at DESC");
     
        $ansQuery=$this->db->query("SELECT * from answers where question_id='".$question_id."' order by posted_at DESC");
     
        $total_records = count(($ansQuery->result_array()));
     
        $total_pages = ceil($total_records/$records_per_page);
     
        $records_to_leave = ($start_of_page-1)*($records_per_page);
     
        $limitedAnsQuery=$this->db->query("SELECT * from answers a,users b where a.question_id='".$question_id."' AND a.user_id=b.user_id order by posted_at DESC LIMIT ".$records_to_leave." , ".$records_per_page.";");
     
        $data=array(
                'question'  =>  $query->result_array(),
                'answer'    =>  $limitedAnsQuery->result_array(),
                'pages'     =>  $total_pages                
                );

        return $data;
        }

    //get details of a question
    public function getQuesDescription($question_id)
    {
            $query = $this->db->query("SELECT a.question_description,a.posted_at,b.name,b.profile_pic from questions a,users b where a.user_id=b.user_id and a.question_id='".$question_id."'");
            return $query->result();
    }
    
    //add a follower to a tag      
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

            $this->db->set('followed_by','`followed_by`+1',FALSE);
            $this->db->where('tag_id',$tgn);
            return $this->db->update('tags');

                
            }

       //remove a follower of a tag     
    public function removeFollower($tgn)
         {          

         $this->db->query("UPDATE `relation_between_user_id_tag_id` SET `status`= '"."deleted"."' WHERE `user_id`='".$_SESSION['sessiondata']['user_id']."' AND`tag_id`='".$tgn."'");
         $this->db->set('followed_by','`followed_by`-1',FALSE);
            $this->db->where('tag_id',$tgn);
            return $this->db->update('tags');

        }

        

        //post an answer. data is the answer that is posted y the user
    public function postA($data)
    {
            //var_dump($data);
            $this->db->insert('answers',$data);
            $this->db->set('answerCount','`answerCount`+1',FALSE);
            $this->db->where('question_id',$data['question_id']);
            return $this->db->update('questions');
    }

     //get all information related to a tag from its id, start of page represents the page number which is called and the records per page represents the number of records which have to be displayed on the particular page 
    public function getTagInfo($tgn,$start_of_page=1,$records_per_page=5)
    {
            $query=$this->db->query("select tag_name,followed_by from tags where tag_id='".$tgn."' ;")->result_array();
           
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
           
                 $limited_out[$i]['tags']=$tags[0];
           
                 if(count($answer))
                 $limited_out[$i]['answer']=$answer[0];
                else
                  $limited_out[$i]['answer']=NULL;  
                }
            $limited_out['pages']=$total_pages;
           
            $sec=$this->db->query("select * from relation_between_user_id_tag_id where tag_id='".$tgn."'".' and status = "live" and user_id='.$_SESSION['sessiondata']['user_id'].'; ')->result_array();
               if(empty($sec))
               $limited_out['follow'] = 0;
               else
               $limited_out['follow'] = 1;
           
           $limited_out['currentTag'] =$tgn;
           $limited_out['currentTagName']=$query[0]['tag_name'];
           $limited_out['followed_by']=$query[0]['followed_by'];
        
            return($limited_out);
        
    }

    public function getContributors(){

    }    


}
?>
