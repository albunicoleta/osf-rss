<?php if (!$this->session->userdata('id')): ?>
    <p class="container">Welcome dear trial user.<br/> Please create an account to make use of this website.</p>
    <p>After creating an account you will be able to set and visualize an unlimited number of Rss Sources.</p>
    <p>Thank you and have a nice day !</p>
<?php else: ?>
    <?php if ($data): ?>
        <p>Hi <?php echo $this->session->userdata('username'); ?>! These are your favorite Rss Sources</p>
        <ul class="nav">
            <?php foreach ($data as $rss): ?>
                <li><a href="<?php echo base_url('rssFeed/viewRss/' . $rss->rss_id); ?>"><?php echo $rss->link; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h5>You have not selected any Rss Sources as favorites .<br/> Please use the 'Rss Sources' in the top panel</h5>
    <?php endif; ?>
<?php endif; ?>
