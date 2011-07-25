<?php
require_once '../../../includes/config.inc.php';

/** See README.txt for info on how to create/update news stories and faq **/

if (empty($_GET['id'])) {
    header('Location: ..');
}

$faq_id = $_GET['id'];
$faq_file = "{$faq_id}.faq.php";

// If id was passed, make sure it's in the proper format
if (!preg_match("/^\d{4}-\d{2}-\d{2}(-\d+)?$/", $faq_id) || !file_exists($faq_file)) {
    header('Location: ..');
}

include $faq_file;

$page_title = $faq_title;
$page_id = 'news-faq';
$header = 'news';
$breadcrumbs = array('News' => '/news',
                     'Stories' => '/news',
                     $faq_title => "/news/faq/{$faq_id}");

require_once '../../../includes/header.inc.php';

echo "<h3>{$faq_title}</h3>";
echo '<p style="text-align: right;"><a href="'.url("/news/stories/{$faq_id}").'">View the Press Release</a></p>';
echo $faq_body;

require_once '../../../includes/footer.inc.php';
?>