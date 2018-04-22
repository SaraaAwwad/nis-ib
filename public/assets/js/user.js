$(document).ready(function(){

	$('#country').change(function(){
		var city_id = $(this).val();
		$.ajax({
			url:"fetch_data.php",
			method: "POST",
			data:{cityId:city_id, cityName:'City'},
			dataType:"text",
			success:function(data)
			{
				$('#city').html(data);
			}
	});
});

	$('#city').change(function(){
		var city_id = $(this).val();
		$.ajax({
			url:"fetch_data.php",
			method: "POST",
			data:{cityId:city_id, cityName:'Area'},
			dataType:"text",
			success:function(data)
			{
				$('#area').html(data);
			}
	});
});

	$('#area').change(function(){
		var city_id = $(this).val();
		$.ajax({
			url:"fetch_data.php",
			method: "POST",
			data:{cityId:city_id, cityName:'Street'},
			dataType:"text",
			success:function(data)
			{
				$('#street').html(data);
			}
	});
});

    $.ajax({
        url:"fetch_data.php",
        method: "POST",
        data:{cityId:city_id, cityName:'Street'},
        dataType:"text",
        success:function(data)
        {
            $('#street').html(data);
        }
    });

});	