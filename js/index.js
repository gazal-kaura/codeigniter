
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function validateForm() {     
    var x = document.forms["myForm"]["name"].value;
    x=x.trim();
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
    if (!(/^[A-Za-z\s]+$/.test(x))) {
        alert("Name is in incorrect format");
        return /^[A-Za-z\s]+$/.test(x);
    }
    
    var emailID = document.forms["myForm"]["email"].value;
    if(!validateEmail(emailID))
    {
		 alert("Please enter correct email ID");
		 return false;
    }   
    
    var x = document.forms["myForm"]["pwd"].value;
    if (x == null || x == "") {
        alert("Password must be filled out");
        return false;
    }  
    
    var y= document.forms["myForm"]["cpwd"].value;
    if(x!=y){
    document.getElementById("cpwv").innerHTML = "Passwords do not match!";
    }
    else{
    	document.getElementById("cpwv").innerHTML = "";
    }
    var x = document.forms["myForm"]["ph"].value;
    if (x == null || x == "") {
        alert("Contact must be filled out");
        return false;
    } 
    if(x.length<10){
      document.getElementById("phonev").innerHTML = "Invalid:Please enter correct phone number";  
      return false;  
    
    }
    else{
    	document.getElementById("phonev").innerHTML = "";
    }
    
	  if(isNaN(x)||x.indexOf(" ")!=-1)
           {
            document.getElementById("phonev").innerHTML = "Invalid:Please enter correct phone number";
              return false; 
           }  
           else{
    	document.getElementById("phonev").innerHTML = "";
    }  
    
    
    
    return true;
   
}


$("#signupSubmit").click(function(){  
 $email = $("#email").val();
 $name = $("#name").val();
 $password = $("#pwd").val();
 $phone = $("#ph").val();
  data = {'email' : $email};
  if(validateForm()){
      $.post('http://www.answerme.com/index.php/Answerme/abcd',data,function(res){
      if(res == "false"){
          /*$.post('http://www.answerme.com/index.php/Answerme/register',data,function(res2){
              alert(res2);
          });*/
          $("#myForm").submit();
      }
      else{
        //alert(1);
        alert("Email already exists");
      }
    });
  }
  });



$("#loginSubmit").click(function(){  
 $email = $("#email").val();
 $password = $("#pwd").val();
  data = {'email' : $email,'pwd':$password};
  $.post('http://www.answerme.com/index.php/Answerme/login',data,function(res){   
      //alert(res); 
      if(res == "true"){
          $("#error").hide();
          $("#loginForm").submit();
          flag=true;
      }
      else{
        $("#error").html("Invalid username or password");
        $("#error").show(500);
    }
  });
  return false;
});


$("#quesSubmit").click(function(){  
  $("#errorQ").hide();
  $("#errorT").hide();
  $tag = document.forms["quesForm"]["tag"].value;
  $ques = document.forms["quesForm"]["ques"].value;  

    if ($tag== null || $tag== "") {
        $("#errorT").html("Tags must be filled");
        $("#errorT").show(500);
        return false;
    }
    else{
      $("#errorT").hide();
    }
    if ($ques== null || $ques== "") {
        $("#errorQ").html("Question must be filled");
        $("#errorQ").show(500);
        return false;
    }
    else{
      $("#errorQ").hide();
    }

  data = {'tag' : $tag, 'ques' : $ques };
  
  $.post("http://www.answerme.com/index.php/Question/postQ",data,function(res){ 
      //alert(res);           
      if(res=="false"){
       alert('Question was not submitted');
      }
      else{
        $("#error").hide();
        $("#quesForm").attr('action',"http://www.answerme.com/index.php/question/qdp/"+res);
        $("#quesForm").submit();
        //flag = true;
      }
  });
  return false;
});



function openQDP(qid){
  window.location = "http://www.answerme.com/index.php/question/answer/"+qid;
  //alert(1);
}

$("#ansSubmit").click(function(){  
  $("#errorA").hide();
  $answer = document.forms["answerForm"]["answer"].value;
    if ($answer== null || $answer== "") {
        $("#errorA").html("Please type an answer");
        $("#errorA").show(500);
        return false;
    }
    else{
      $("#errorA").hide();
      $("#answerForm").submit();
    }
  return false;
});

$("#searchSubmit").click(function(){  
  $question = document.forms["searchForm"]["question"].value;
    if ($question== null || $question== "") {
        alert("please specify your search");
        return false;
    }
    else{
      $("#searchForm").submit();
    }
  return false;
});



function bindAutoSuggst(){
      $( "#searchbar" ).autocomplete({
      source: "http://www.answerme.com/index.php/Answerme/autoSuggestor",
      minLength : 1,
      select : function(event,ui){
          var tag_id = ui.item.id;
          window.location="http://www.answerme.com/index.php/Answerme/tagInfo/"+tag_id;
      }

    });
  }


function bindAutoSuggst1(){
      //alert(1);
      $( "#tag" ).autocomplete({      
        source: "http://www.answerme.com/index.php/Answerme/autoSuggestor",
        minLength : 1,
        select : function(event,ui){
            var tag_id = ui.item.id;          
        }

    });
}    
  
$("#forgotPasswordSubmit").click(function(){    
 $forgotPasswordEmail = $("#forgotPasswordEmail").val(); 
 data = {'forgotPasswordEmail' : $forgotPasswordEmail};
  $.post('http://www.answerme.com/index.php/ForgotPassword/checkEmail',data,function(res){   
      alert(res); 
      if(res == "true"){          
          $.post('http://www.answerme.com/index.php/ForgotPassword/sendMail',data,function(res){   
            alert(res);
            if(res=="true"){
              $("#forgotPasswordError").hide();
            }
            else{
              $("#forgotPasswordError").html("Email Sending Error");
              $("#forgotPasswordError").show(500);
            }
          });
      }
      else{
        $("#forgotPasswordError").html("Email Does Not Exist");
        $("#forgotPasswordError").show(500);
    }
  });
  return false;
});

$("#changePasswordSubmit").click(function(){  
var x = document.forms["changePasswordForm"]["newPassword"].value;
    if (x == null || x == "") {
        alert("Password must be filled out");
        return false;
    }  
    
    var y= document.forms["changePasswordForm"]["cnewPassword"].value;
    if(x!=y){
    document.getElementById("error").innerHTML = "Passwords do not match!";
    }
    else{
      document.getElementById("error").innerHTML = "";
      $("#changePasswordForm").submit();
    }





});