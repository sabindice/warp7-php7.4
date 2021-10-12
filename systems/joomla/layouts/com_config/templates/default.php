<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$id   = \JFactory::getApplication()->getTemplate('template')->id;
$link = \JUri::root() . 'administrator/index.php?option=com_templates&view=style&layout=edit&id=' . $id;

?>

<script>
    window.location.href = "<?php echo $link ?>"
</script>

<noscript>
    <a href="<?php echo $link ?>" class="uk-button"><?php JText::_('JADMINISTRATOR'); ?></a>
</noscript>
