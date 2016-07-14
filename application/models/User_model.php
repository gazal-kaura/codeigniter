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

    //check if user is authenticated
    function checkUser($email,$password)
    {

        $pass=md5($password);
        $query = $this->db->query("SELECT name and password from users where email='".$email."' AND password='".$pass."'");
        return($this->db->affected_rows());

    }

    //change password of a user
    function changePasswordEntry($user_id,$password)
    {
        
            $data=array('password'=>md5($password));
            $this->db->where('user_id',$user_id);
            return $this->db->update('users',$data);
    }

   //get suggestions for tags on postQ page 
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

    //get id of user from his email    
    function getid($email)
    {

        $query = $this->db->query("SELECT user_id from users where email='".$email."'");
        $row = $query->result_array();        
        return $row[0]['user_id'];
        
    }

    //validate email to see if it already exists
    function validateEmail($email){
        
        $query = $this->db->query("SELECT email from users where email='".$email."'");

        if($this->db->affected_rows() > 0){
            return "true";
        }
        else{
            return "false";
        }

     }
     
     //see if user has access to change his password
     function hasChangePasswordAccess($user_id,$password){
        
        $query = $this->db->query("SELECT password from users where user_id='".$user_id."'");

        if($this->db->affected_rows() > 0){
            $row = $query->result_array();
            if($password==md5($row[0]['password']))
                return true;
        }        
        return false;
        

     }

     //get details of user from his email id
    function getUserDetails($email)
    {
        
        $query = $this->db->query("SELECT * from users where email='".$email."'");
        return $query->result();
    }

    //see profile of user
    function profile($user_id)
    {
        
        $query = $this->db->query("SELECT * from users where user_id='".$user_id."'");
        return $query->result();
    }

    //edit data of users table given his id
    function editUser($data,$user_id)
    {        
            $this->db->where('user_id',$user_id);
            return $this->db->update('users',$data);
         
    }

    //get tags liked by user
    public function getUserTags($user_id)
    {
              $query = $this->db->query("SELECT a.tag_id,b.tag_name from relation_between_user_id_tag_id a,tags b where a.tag_id=b.tag_id AND a.user_id= '".$user_id."'");
        return $query->result(); 


    }

}
?>
