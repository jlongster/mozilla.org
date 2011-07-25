<dl class="news">
<?php
$story_dir = dirname(dirname(__FILE__)).'/'.LANG.'/about/press/archive';
require_once "{$story_dir}/latest.inc.php";

if (!empty($latest_stories)) {
    foreach ($latest_stories as $story_file) {
        include "{$story_dir}/{$story_file}.story.php";

        echo '<dt><a href="'.url("/about/press/archive/{$story_file}").'">'.$story_title.'</a></dt>';
        echo "<dd>{$story_snippet}</dd>";
    }
}
?>
</dl>

<div class="all-news">
	<a href="<?=url('/about/press/archive/')?>">Read All News</a>
</div>
