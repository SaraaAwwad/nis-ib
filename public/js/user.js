$( document).ready(function() {
 $(document).on('change', '#country', function() {
  var url = '/address/view';
   $.ajax({  
   url: url,  
   data: {id:  
   $(this).val(), cityName:'City'},  
   type: "POST",  
   success:function(data){  
   $("#City").html(data);  
}  
}); });  

$(document).on('change', '#City', function() {
  var url = '/address/view';
   $.ajax({  
   url: url,  
   data: {id:  
   $(this).val() , cityName:'Area'},  
   type: "POST",  
   success:function(data){  
   $("#Area").html(data);  
}  
}); }); 

$(document).on('change', '#Area', function() {
  var url = '/address/view';
   $.ajax({  
   url: url,  
   data: {id:  
   $(this).val(), cityName:'Street'},  
   type: "POST",  
   success:function(data){  
   $("#Street").html(data);  
}  
});  }); });