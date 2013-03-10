//on dom ready
$(function(){
    //removes .active class from all li elements 
    //from .form-admin
    function removeActiveClassFromFormAdmin()
    {
        $('.form-admin li').each(function(){
            $(this).removeClass('active'); 
        });
    }
    
    /**
     * load users table
     */
    $('#navbar-users-data').click(function(){
        removeActiveClassFromFormAdmin();
        $(this).addClass('active');
        $('.ajax-container').load('admin/ajaxUsers');
    });
    
    /**
     * load rss table
     */
    $('#navbar-rss-data').click(function(){
        removeActiveClassFromFormAdmin();
        $(this).addClass('active');
        $('.ajax-container').load('admin/ajaxRss');
    });
    
    $('#navbar-users-add').click(function(){
        removeActiveClassFromFormAdmin();
        $(this).addClass('active');
        $('.ajax-container').load('admin/ajaxUserCreate');
    });
    
    /**
     * add ajax to pagination
     */
    $(document).on("click",".pagination a",function(event){
        event.preventDefault();
        $('.ajax-container').load($(this).attr('href'));
    });
     
   
});

function deleteUser(id,obj)
{
    var parentRow = $(obj).parents('tr');
    $.get('/users/delete/'+id, function(data) {
        if (data.success){
            parentRow.fadeOut();
        }
    });
}
function deleteLink(id,obj)
{
    var parentRow = $(obj).parents('tr');
    $.get('/rssFeed/delete/'+id, function(data) {
        if (data.success){
            parentRow.fadeOut();
        }
    });
}
