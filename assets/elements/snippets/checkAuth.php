<?php
if (!$modx->user->isAuthenticated()) {
	$url = $modx->makeUrl(25);
	$modx->sendRedirect($url);
}