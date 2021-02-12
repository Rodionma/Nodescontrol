
$(document).ready(function () {
    $('#root').on('click',function (){
        $.ajax({
            url: "../Controller.php",
            type:"GET",
            data:{
                action:'create',
            },
            success: function(result){
                $('.nodes').html(result);
            },
            error:function () {
                alert('Error');
            }
        });
    });
})
