
$(document).ready(function () {//creating root
    $('.root').on('click',function (){
        $.ajax({
            url: "../Controller.php",
            type:"GET",
            data:{
                action:'create'
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

$(document).ready(function () {//submit
    $('.addfrm').on('submit',function () {
        event.preventDefault();

        $.ajax({
            url: "../Controller.php",
            type:"GET",
            data:{
                action:'add',
                text: $(this).find("input[name=textadd]").val(),
                parent_id:$('#parrent').val()
            },
            success: function(result){

                $('.dialog').css('display','none');
                $('.overlay').css('display','none');
                $('.nodes').html(result);
            },
            error:function () {
                alert('Error');
            }
        });
    })
})

$(document).ready(function () {//adding new node
    $('.add').on('click',function (){

        $.ajax({
            url: "../Controller.php",
            type:"GET",
            data:{
                action:'addform',
                parent_id:$(this).val()
            },
            success: function(result){
                $('.dialog').css('display','block');
                $('.overlay').css('display','block');
                $('.dialog').html(result);
            },
            error:function () {
                alert('Error');
            }
        });
    });
})


function timer(id) {
    $('.timer').text(20);
    var _Seconds = 20,
        int;
    int = setInterval(function() {
        if (_Seconds > 0) {
            _Seconds--;
            $('.timer').text(_Seconds);
        } else {
            clearInterval(int);
            $('.timer').text(20);
            $('.overlay').css('display','none');
            $('.dialog').css('display','none');
        }
    }, 1000);

    $('.cancel').on('click',function (){
        $('.overlay').css('display','none');
        $('.dialog').css('display','none');
        _Seconds=20;
        clearInterval(int);
        $('.timer').text(20);})

    $('.overlay').on('click',function (){
        $('.overlay').css('display','none');
        $('.dialog').css('display','none');
        clearInterval(int);
        _Seconds=20;
        $('.timer').text(_Seconds);
    })
    $('.deletefrm').on('submit',function (){
        $('.overlay').css('display','none');
        $('.dialog').css('display','none');
        clearInterval(int);
        _Seconds=20;
        $('.timer').text(_Seconds);})
}

$(document).ready(function (){
    $('.overlay').on('click',function (){
        $('.overlay').css('display','none');
        $('.dialog').css('display','none');

        $('.timer').text(20);
    })
})


$(document).ready(function () {
    $('.remove').on('click',function (){
        var id=$(this).val()
        $.ajax({
            url: "../Controller.php",
            type:"GET",
            data:{
                action:'deleteform',
                parent_id:id
            },
            success: function(result){
                $('.dialog').css('display','block');
                $('.overlay').css('display','block');
                $('.dialog').html(result);

                timer(id);
            },
            error:function () {
                alert('Error');
            }
        });
    });
})

function deleting(id) {
    $.ajax({
        url: "../Controller.php",
        type:"GET",
        data:{
            action:'delete',
            id:id
        },
        success: function(result){
            $('.dialog').css('display','none');
            $('.overlay').css('display','none');
            $('.nodes').html(result);
        },
        error:function () {
            alert('Error');
        }
    });
}


$(document).ready(function () {//deleting node
    $('.deletefrm').on('submit',function (){
        event.preventDefault();

        deleting($('#parrent').val())
    });
})


