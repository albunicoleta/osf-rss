<table class="table">
    <thead>
    <th>ID</th>
    <th>Link</th>
</thead>
<tbody>
    <?php foreach ($rssFeed as $rss): ?>
        <tr>
            <td><?php echo $rss->id; ?></td>
            <td><?php echo $rss->link; ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<div class="pagination">
    <?php echo $this->pagination->create_links(); ?>
</div>