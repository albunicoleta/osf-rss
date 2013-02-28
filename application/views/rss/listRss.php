<script type="text/javascript">
    function pencilClicked() {
        var html = $(this).next('a').html();
        var editableText = $("<textarea />");
        editableText.val(html);
        $(this).next('a').replaceWith(editableText);
        editableText.focus();
        
        // setup the blur event for this new textarea
        editableText.blur(editableTextBlurred);
    }
        
    function editableTextBlurred() {
        var html = $(this).val();
        var viewableText = $("<a>");
        viewableText.html(html);
        var rssId = getRssId($(this));
        updateRssLink(rssId,viewableText.html());
        $(this).replaceWith(viewableText);
        // setup the click event for this new div
        viewableText.click(pencilClicked);
    }
    
    function getRssId(link){
        return link.parent().children('input').val();
    }
    
    function updateRssLink(rssId,newValue) {
        $.post("<?php echo base_url('rssFeed/updateRssLink'); ?>", {id : rssId, value: newValue});
    }
    
    function deleteRssAjax(rssId) {
        $.post("<?php echo base_url('rssFeed/deleteRss'); ?>", {id : rssId});
    }
    
    function deleteRss()
    {
        //alert('Are you sure ?');
        $(this).parent().fadeOut();
        var rssId = getRssId($(this));
        deleteRssAjax(rssId);
    }
    
    function setRssReadStatusAjax(rssId)
    {
        $.post("<?php echo base_url('rssFeed/setIsRead'); ?>", {id : rssId});
    }
    

    $(document).ready(function() {
        $(".icon-pencil").click(pencilClicked);
        $('.icon-remove-sign').click(deleteRss);
        $('.icon-check').click(function(){
           if ($(this).hasClass('icon-white')){
               $(this).removeClass('icon-white');
           }
           else {
               $(this).addClass('icon-white');
               setRssReadStatusAjax(getRssId($(this)));
           }
            
        });
    });
    
</script>
<ul class="nav">
    <?php foreach ($data as $row): ?>
        <li>
            <i class="icon-remove-sign"></i>
            <i class="icon-pencil"></i>
            <i class="icon-check"></i>
            <a class="rss-link" href="<?php echo base_url('rssFeed/viewRss/' . $row->rss_id); ?>"><?php echo $row->link; ?></a>
            <input value="<?php echo $row->rss_id; ?>" type="hidden"/>
        </li>
    <?php endforeach; ?>
</ul>
<div class="pagination">
    <?php echo $this->pagination->create_links(); ?>
</div>
