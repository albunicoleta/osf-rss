<table class="table">
    <thead>
    <th></th>
    <th>ID</th>
    <th>Link</th>
</thead>
<tbody>
    <?php foreach ($rssFeed as $rss): ?>
        <tr>
            <td><i class="icon-remove-sign" onclick="deleteLink(<?php echo $rss->id; ?>,this)"></i>
            </td>
            <td><span><?php echo $rss->id; ?></span></td>
            <td><?php echo $rss->link; ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<div class="pagination">
    <?php echo $this->pagination->create_links(); ?>
</div>