<?php
/**
 * @version     CVS: 1.0.0
 * @package     Joomla.Plugin
 * @subpackage  Api.reports
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   2017 Techjoomla
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');
JLoader::import('components.com_tjreports.models.report', JPATH_SITE);

/**
 * Tjreports API plugin
 *
 * @since  1.0
 */
class PlgAPIReports extends ApiPlugin
{
	/**
	 * Constructor
	 *
	 * @param   STRING  &$subject  subject
	 * @param   array   $config    config
	 *
	 * @since 1.0
	 */
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config = array());

		// Set resource path
		ApiResource::addIncludePath(dirname(__FILE__) . '/reports');

		// Load language files
		$lang = JFactory::getLanguage();
		$lang->load('plg_api_reports', JPATH_ADMINISTRATOR, '', true);

		// Set the resource to be public
		$this->setResourceAccess('report', 'public', 'post');
		$this->setResourceAccess('filters', 'public', 'get');
	}
}
