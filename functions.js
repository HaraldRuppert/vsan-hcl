function refreshList() {
    $('#divList').load('list.php?'+($('#formInput').serialize()));
} 

jQuery(function(){
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();
 
    $('.searchtext').keyup(function() {
        delay(function(){
            refreshList();
        }, 200 );
    });
 
});
