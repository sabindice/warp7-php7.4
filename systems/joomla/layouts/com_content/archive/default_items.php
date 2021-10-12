<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$params = &$this->params;

foreach ($this->items as $item) {
	// $this->item = $item;
	$args    	= include(__DIR__.'/../article_defaults.php');

	// template args
	$args = array_merge($args, array(
		'permalink' => '',
		'image' => '',
		'image_alignment' => '',
		'image_alt' => '',
		'image_caption' => '',
		'title' => $this->escape($item->title),
		'hook_aftertitle' => '',
		'hook_beforearticle' => '',
		'hook_afterarticle' => '',
		'article' => $params->get('show_intro') ? JHtml::_('string.truncate', $item->introtext, $params->get('introtext_limit')) : '',
		'url' => JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug))
	));

	if ($params->get('show_readmore') && $item->readmore) {
		$args['more'] = $item->alternative_readmore ?: JText::_('TPL_WARP_CONTINUE_READING');
	}

	// render template
	echo $warp['template']->render('article', $args);
}

echo $this->pagination->getPagesLinks();
