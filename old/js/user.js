
$(document).ready(function() {
  $("#city").click(function () {
    var id = $(this).prop("value");
    $.ajax({
      type: 'GET',
      url: 'getdata.php', //Fetch records
      dataType: "html", 
      data: { post_id: id }, 
      success: function(data) {
      	var id = data[0];      
        var vname = data[1];
        $('#area').html("<option value="+id+">"+vname"</option>");  
        }
      });
  });
});