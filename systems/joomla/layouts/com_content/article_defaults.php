<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$default_args = array(
	'permalink' => '',
	'image' => '',
	'image_alignment' => '',
	'image_alt' => '',
	'image_caption' => '',
	'title' => '',
	'title_link' => '',
	'author' => '',
	'author_url' => '',
	'date' => '',
	'datetime' => '',
	'category' => '',
	'category_url' => '',
	'hook_aftertitle' => '',
	'hook_beforearticle' => '',
	'hook_afterarticle' => '',
	'article' => '',
	'tags' => '',
	'edit' => '',
	'url' => '',
	'more' => '',
	'previous' => '',
	'next' => '',
	'is_column_item' => ''
);

if (!isset($item, $params)) {
    return $default_args;
}

// Create shortcuts to some parameters.
$images	= json_decode($item->images);

// secure permalink url
$force_ssl = JFactory::getApplication()->get('force_ssl') == 2 ? 1 : -1;

$args = array_merge($default_args, array(
    'permalink' 	     => JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug), true, $force_ssl),
    'image' 			 => isset($images->image_fulltext) && $params->get('access-view') ? htmlspecialchars($images->image_fulltext) : '',
    'image_alignment' 	 => !isset($images->float_fulltext) || empty($images->float_fulltext) ? htmlspecialchars($params->get('float_fulltext')) : htmlspecialchars($images->float_fulltext),
    'image_alt' 		 => isset($images->image_fulltext_alt) ? htmlspecialchars($images->image_fulltext_alt) : '',
    'image_caption' 	 => isset($images->image_fulltext_caption) ? htmlspecialchars($images->image_fulltext_caption) : '',
    'title' 			 => $params->get('show_title') ? $this->escape($item->title) : '',
	'title_link' 		 => $params->get('link_titles'),
	'author' 			 => $params->get('show_author') ? ($item->created_by_alias ? $item->created_by_alias : $item->author) : '',
	'author_url'		 => !empty($item->contactid) && $params->get('link_author') == true ? JRoute::_('index.php?option=com_contact&view=contact&id='.$item->contactid) : '',
	'date' 	 	 		 => $params->get('show_create_date') ? $item->created : '',
    'date_published' 	 => $params->get('show_publish_date') ? $item->publish_up : '',
	'date_modified' 	 => $params->get('show_modify_date') ? $item->modified : '',
    'datetime' 			 => substr($item->publish_up, 0, 10),
	'category'			 => $params->get('show_category') ? $this->escape($item->category_title) : '',
    'category_url' 		 => $params->get('link_category') && $item->catslug ? JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)) : '',
	'hits' 				 => $params->get('show_hits') ? $item->hits : '',
    'hook_aftertitle' 	 => !$params->get('show_intro') ? $item->event->afterDisplayTitle : '',
    'hook_beforearticle' => $item->event->beforeDisplayContent.(isset($item->toc) ? $item->toc : ''),
    'hook_afterarticle'  => $item->event->afterDisplayContent
));


return $args;
