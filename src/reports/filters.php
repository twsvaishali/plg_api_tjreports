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

/**
 * Tjreports API report class
 *
 * @since  1.0.0
 */
class ReportsApiResourceFilters extends ApiResource
{
	/**
	 * Function get filters data
	 *
	 * @return boolean
	 */
	public function get()
	{
		$app         = JFactory::getApplication();
		$jinput      = $app->input->get;
		$reportName  = $jinput->get('report');

		JLoader::import('plugins.tjreports.' . $reportName . "." . $reportName, JPATH_SITE);
		$className = 'TjreportsModel' . ucfirst($reportName);

		if (!class_exists($className))
		{
			ApiError::raiseError(400, JText::_('PLG_API_REPORTS_REPORT_NAME_INVALID'), 'APIValidationException');
		}

		$reportPlugin = new $className;

		$filters = $reportPlugin->displayFilters();

		$this->plugin->setResponse($filters);
	}
}
