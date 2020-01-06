 <?php
/**
 * @package      Tjreports
 * @subpackage   com_api
 *
 * @author       Techjoomla <extensions@techjoomla.com>
 * @copyright    Copyright (C) 2009 - 2018 Techjoomla. All rights reserved.
 * @license      GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Tjreports API to get the tjreports plugin those support Google studio connector
 *
 * @since  1.1.0
 */
class ReportsApiResourceGdsreports extends ApiResource
{
	/**
	 * Function get reports
	 *
	 * @return boolean
	 */
	public function get()
	{
		$app        = JFactory::getApplication();
		$jinput     = $app->input;
		$formData   = $jinput->post;

		// Create object of tjreports plugin class
		JLoader::import('components.com_tjreports.models.reports', JPATH_SITE);
		$reportModel = new TjreportsModelreports;

		$reports 	= $reportModel->getenableReportPlugins();
		$reportsArray = array();

		foreach ($reports as $report)
		{
			$pluginModel = $reportModel->getPluginModel($report['plugin']);

			if (method_exists($pluginModel, 'getGoogleDsFields'))
			{
				$reportsArray[] = $report;
			}
		}

		$this->plugin->setResponse($reportsArray);
	}
}
