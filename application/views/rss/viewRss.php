<a class="btn" href="javascript:history.back()">Back</a>
<?php foreach ($data as $link): ?>
    <div class="rss-container">
        <h4><?php echo $link['title']; ?></h4>
        <?php echo $link['description']; ?>
        <div class="rss-pub-date"><?php echo $link['pubDate']; ?></div>
        <div class="rss-art-link">
            <a href="<?php echo $link['link']; ?>"><?php echo $link['link']; ?></a>
        </div>
        <div class="rss-author"><?php echo $link['author']; ?></div>

        <br/>
    </div>
<?php endforeach; ?>
<a class="btn" href="javascript:history.back()">Back</a>
