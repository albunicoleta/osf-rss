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
    
    function setRssReadStatusAjax(rssId,status)
    {
        $.post("<?php echo base_url('rssFeed/setIsRead'); ?>", {id : rssId, status: status});
    }
    
    function setRssFavoriteStatusAjax(rssId,status)
    {
        $.post("<?php echo base_url('rssFeed/setFavorite'); ?>", {id : rssId, status: status});
    }
    

    $(document).ready(function() {
        $(".icon-pencil").click(pencilClicked);
        $('.icon-remove-sign').click(deleteRss);
        $('.icon-check').click(function(){
            if ($(this).hasClass('icon-white')){
                $(this).removeClass('icon-white');
                setRssReadStatusAjax(getRssId($(this)),0);
            }
            else {
                $(this).addClass('icon-white');
                setRssReadStatusAjax(getRssId($(this)),1);
            } 
        });
        $('.icon-favorite').click(function(){
            if ($(this).hasClass('icon-star-empty')){
                $(this).addClass('icon-star');
                $(this).removeClass('icon-star-empty');
                setRssFavoriteStatusAjax(getRssId($(this)),1);
            } 
            else{
                $(this).addClass('icon-star-empty');
                $(this).removeClass('icon-star');
                setRssFavoriteStatusAjax(getRssId($(this)),0);
            }
        });
    });
    
</script>
<ul class="nav">
    <?php foreach ($data as $row): ?>
        <li>
            <i class="icon-remove-sign"></i>
            <i class="icon-pencil"></i>
            <i class="icon-check <?php echo $row->is_read ? 'icon-white' : ''; ?>"></i>
            <i class="icon-favorite <?php echo $row->favorite ? 'icon-star' : 'icon-star-empty'; ?>"></i>
            <a class="rss-link" href="<?php echo base_url('rssFeed/viewRss/' . $row->rss_id); ?>"><?php echo $row->link; ?></a>
            <input value="<?php echo $row->rss_id; ?>" type="hidden"/>
        </li>
    <?php endforeach; ?>
</ul>
<div class="pagination">
    <?php echo $this->pagination->create_links(); ?>
</div>
