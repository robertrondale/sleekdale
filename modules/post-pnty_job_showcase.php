<?php 

$postID = isset($postID) ? $postID : get_the_ID();

Sleek\Modules\render('post-pnty_job', ['postID' => $postID]); ?>