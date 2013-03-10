$(function(){
    $('#navbar-users-data').click(function(){
        $('.ajax-container').load('admin/ajaxUsers');
    });
    $('#navbar-rss-data').click(function(){
        $('.ajax-container').load('admin/ajaxRss');
    });
    
    $(document).on("click",".pagination a",function(event){
        event.preventDefault();
        $('.ajax-container').load($(this).attr('href'));
    });
    
   
});
