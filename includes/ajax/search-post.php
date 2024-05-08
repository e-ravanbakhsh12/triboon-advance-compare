<?php

namespace TriboonTAC\includes\ajax;


use WP_Query;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
$data = json_decode(stripslashes($_POST['data']));

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'search_title'   =>sanitize_text_field($data->search),
);
$result = $this->searchProductByTitle(sanitize_text_field($data->search));

$posts = new WP_Query($args);
$this->ajaxResponse(true, __('اطلاعات محصولات ها با موفقیت بروزرسانی شد', 'tac'), $result);
