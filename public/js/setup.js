$(document).ready(function(){
        $messages = $('.messages');
        setTimeout(function(){
                            $messages.slideUp("slow", function () {
                            $messages.remove();
                             });

        }, 3000);
        
    $("#request-accordion h3.expand").toggler();
    $("#demo2 h3.expand").toggler({initShow: "div.collapse:eq(0)"});
    
    $("#request-accordion").expandAll({
      trigger: "h3.expand", 
      ref: "h3.expand", 
      showMethod: "slideDown", 
      hideMethod: "slideUp"
    });
    $("#demo2").expandAll({
      trigger: "h3.expand", 
      ref: "h3.expand", 
      showMethod: "slideDown", 
      hideMethod: "slideUp", 
      oneSwitch : false
    });     
});
var bsspUtil = {
    authideNotices: function(){
        $messages = $('.messages');
        setTimeout(function(){
                            $messages.slideUp("slow", function () {
                            $messages.remove();
                             });

        }, 3000);
    }
}