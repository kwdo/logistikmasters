$(document).ready(function(){
    if($('#ProfileSchoolCityId').val() != 244 &&   $('#ProfileSchoolId').val() != 354){
        $("#hideMe").hide();
    }


    $('#ProfileSchoolCityId').change(function() {
        if($('#ProfileSchoolCityId').val() == 244){
            $("#hideMe").show();
        }

        $.ajax({async:true, data:$("#ProfileSchoolCityId").serialize(), dataType:"html", success:function (data, textStatus) {$("#ProfileSchoolId").html(data);}, type:"post", url:"/schools/getByCity"});
    });

    $('#ProfileSchoolCityId option[value="244"]').addClass("boldOption");

    $('#ProfileSchoolId').change(function() {
            if($('#ProfileSchoolId').val() == 354){
                $("#hideMe").show();
            }else{
                $("#hideMe").hide();
            }
        $('#ProfileSchoolId option[value="354"]').addClass("boldOption");
     });



    $('#ProfileSchoolCityId').change(function() {
        if($('#ProfileSchoolCityId').val() != 244){
            $("#hideMe").hide();
        }
    });
    

});
