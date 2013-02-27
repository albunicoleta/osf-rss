<script type="text/javascript">
    function pencilClicked() {
        var html = $(this).next('span').html();
        var editableText = $("<textarea />");
        editableText.val(html);
        $(this).next('span').replaceWith(editableText);
        editableText.focus();
        // setup the blur event for this new textarea
        editableText.blur(editableTextBlurred);
    }
    
    function editableTextBlurred() {
        var html = $(this).val();
        var viewableText = $("<span>");
        viewableText.html(html);
        $(this).replaceWith(viewableText);
        // setup the click event for this new div
        viewableText.click(pencilClicked);
    }

    $(document).ready(function() {
        $(".icon-pencil").click(pencilClicked);
    });
    
</script>
<ul class="nav">
    <?php foreach ($data as $row): ?>
        <li>
            <i class="icon-pencil"></i>
            <span><?php echo $row; ?></span>
        </li>
    <?php endforeach; ?>
</ul>
<div class="pagination">
    <?php echo $this->pagination->create_links(); ?>
</div>
