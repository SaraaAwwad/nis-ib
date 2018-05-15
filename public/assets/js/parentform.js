$(document).ready(function() {
    $("#searchp").hide();
    $("#pform").hide();
});

$(document).on("change","#parentinfo",function(){
    var conceptName = $('#parentinfo').find(":selected").text();
    if(conceptName == "New Parent")
    {
        document.getElementById("parentsearch").required = false;
        $("#searchp").hide();
        $("#pform").show();
        document.getElementById("parentfname").required = true;
        document.getElementById("parentlname").required = true;
        document.getElementById("parentdate").required = true;
        document.getElementById("parentemail").required = true;
        document.getElementById("parentpassword").required = true;
        document.getElementById("parentusername").required = true;
        document.getElementById("parentnumberin").required = true;
        document.getElementById("imageparentinput").required = true;


    }else if(conceptName == "Existing Parent"){


        document.getElementById("parentfname").required = false;
        document.getElementById("parentlname").required = false;
        document.getElementById("parentdate").required = false;
        document.getElementById("parentemail").required = false;
        document.getElementById("parentpassword").required = false;
        document.getElementById("parentusername").required = false;
        document.getElementById("parentnumberin").required = false;
        document.getElementById("imageparentinput").required = false;
        $("#pform").hide();
        $("#searchp").show();
        document.getElementById("parentsearch").required = false;
    }

});