var div_box = "<div id='load-screen'><div id='loading'> </div></div>";
$("body").prepend(div_box);
$('#load-screen').delay(500).fadeOut(400,function(){
    $(this).remove();
});