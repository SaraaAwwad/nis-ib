
              var controller = "user";
              var action = "city";
              var myURL = "http://nisib.example.com/" + controller + "/" + action + "/";
 
                  $(document).ready(function() {  
                     $("#country").change(function(){ 
                     $.ajax({  
                        url: myURL,  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("#city").html(data);  
                     }  
                  });  
               });  
            });  