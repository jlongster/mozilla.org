<?php
echo '<div id="nav">';
    echo '<ul'.($header != 'home' ? ' class="sidebarred"' : '').'>';
        echo '<li'.($header == 'home' ? ' class="selected"' : '').'><a href="'.url('/').'">Home</a></li>';
        echo '<li'.($header == 'about' ? ' class="selected"' : '').'><a href="'.url('/about').'">About</a></li>';
        echo '<li'.($header == 'getinvolved' ? ' class="selected"' : '').'><a href="'.url('/getinvolved').'">Get Involved</a></li>';
        echo '<li'.($header == 'thunderbird' ? ' class="selected"' : '').'><a href="'.url('/thunderbird').'">Thunderbird</a></li>';
        if ($page_id != 'home')
            echo '<li'.($header == 'news' ? ' class="selected"' : '').'><a href="'.url('/news').'">News</a></li>';
    echo '</ul>';
echo '</div>';
?>
