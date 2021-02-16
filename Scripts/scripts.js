
$(document).ready(function () {//creating root
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



$(document).ready(function () {
    $('.add').on('click',function (){
        alert(1);
        $.ajax({
            url: "../Controller.php",
            type:"GET",
            data:{
                action:'add',
                parent_id:$(this).val()
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