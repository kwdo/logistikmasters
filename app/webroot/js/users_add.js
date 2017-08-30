function checkUserProfileDegree()
{
    if($("#UserProfileDegree").val() == 'nicht in Liste')
    {
        $("#UserProfileDegreeSection").show();
    }
    else
    {
        $("#UserProfileDegreeSection").hide();
    }
}

$(document).ready(function(){
    if($('#UserProfileSchoolCityId').val() != 244 &&   $('#UserProfileSchoolId').val() != 354){
        $("#hideMe").hide();
    }


    $('#UserProfileSchoolCityId').change(function() {
        if($('#UserProfileSchoolCityId').val() == 244){
            $("#hideMe").show();
        }

        $.ajax({async:true, data:$("#UserProfileSchoolCityId").serialize(), dataType:"html", success:function (data, textStatus) {$("#UserProfileSchoolId").html(data);}, type:"post", url:"/schools/getByCity"});
    });

    $('#UserProfileSchoolCityId option[value="244"]').addClass("boldOption");

    $('#UserProfileSchoolId').change(function() {
            if($('#UserProfileSchoolId').val() == 354){
                $("#hideMe").show();
            }else{
                $("#hideMe").hide();
            }
        $('#UserProfileSchoolId option[value="354"]').addClass("boldOption");
     });

    $('#UserProfileSchoolCityId').change(function() {
        if($('#UserProfileSchoolCityId').val() != 244){
            $("#hideMe").hide();
        }
    });
    
    checkUserProfileDegree();
    $("#UserProfileDegree").change(function() {
        checkUserProfileDegree();
    });


});
