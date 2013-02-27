<ul class="nav">
    <?php foreach ($data as $row): ?>
    <li><?php echo $row;?></li>
    <?php endforeach; ?>
</ul>
<div class="pagination">
    <?php echo $this->pagination->create_links(); ?>
</div>
