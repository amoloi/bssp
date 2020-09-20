$(document).ready(function(){
    $(".messages").on('click' ,'span[id=close] i' , function() {
                $(".messages").animate(
                        {"opacity": "0"},{
                         "complete":function(){
                             $(this).remove();
                         }
                        }
                        );
            });      
});