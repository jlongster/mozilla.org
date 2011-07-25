<?php if ($header == 'about'): ?>
    <div id="sidebar">
        <h2>About</h2>
        <ul>
        <?php
            echo '<li'.($page_id == 'about-mission' ? ' class="selected"' : '').'><a href="'.url('/about/mission').'">Our Mission</a></li>';
            echo '<li'.($page_id == 'about-staff' ? ' class="selected"' : '').'><a href="'.url('/about/staff').'">Our Staff</a></li>';
            echo '<li'.($page_id == 'about-board' ? ' class="selected"' : '').'><a href="'.url('/about/board').'">Our Board</a></li>';
            echo '<li'.($page_id == 'about-community' ? ' class="selected"' : '').'><a href="'.url('/about/community').'">Community</a></li>';
            echo '<li'.($page_id == 'about-careers' ? ' class="selected"' : '').'><a href="'.url('/about/careers').'">Careers</a></li>';
            echo '<li'.($page_id == 'about-contact' ? ' class="selected"' : '').'><a href="'.url('/about/contact').'">Contact Us</a></li>';
        ?>
        </ul>
    </div>
<?php elseif ($header == 'getinvolved'): ?>
    <div id="sidebar">
        <h2>Get Involved</h2>
        <ul>
        <?php
            echo '<li><a href="'.url('/getinvolved#spread').'">Spread</a></li>';
            echo '<li><a href="'.url('/getinvolved#develop').'">Develop</a></li>';
            echo '<li><a href="'.url('/getinvolved#test').'">Test</a></li>';
            echo '<li><a href="'.url('/getinvolved#translate').'">Translate</a></li>';
            echo '<li><a href="'.url('/getinvolved#other').'">Other</a></li>';
        ?>
        </ul>
    </div>
<?php elseif ($header == 'thunderbird'): ?>
    <div id="sidebar">
        <h2>Thunderbird</h2>
        <ul>
        <?php
            echo '<li><a href="'.url('/thunderbird#tb2').'">Thunderbird 2</a></li>';
            echo '<li><a href="'.url('/thunderbird#tb3').'">Thunderbird 3</a></li>';
            echo '<li><a href="'.url('/thunderbird#vision').'">Vision</a></li>';
            echo '<li><a href="'.url('/thunderbird/early_releases').'">Early Releases</a></li>';
        ?>
        </ul>
    </div>
<?php elseif ($header == 'news'): ?>
    <div id="sidebar">
        <h2>News</h2>
        <ul>
        <?php
            echo '<li'.($page_id == 'news' ? ' class="selected"' : '').'><a href="'.url('/news').'">Latest News</a></li>';
            echo '<li'.($page_id == 'news-archives' ? ' class="selected"' : '').'><a href="'.url('/news/archives').'">Archived News</a></li>';
            //echo '<li><a href="'.url('/blog', false).'">Blog</a></li>';
        ?>
        </ul>
    </div>
<?php endif; ?>
