<?php
/**
 * Piwik - Open source web analytics
 * 
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html Gpl v3 or later
 * @version $Id$
 * 
 * @package Piwik_CoreAdminHome
 */

require_once "API/Request.php";

/**
 * @package Piwik_CoreAdminHome
 */
class Piwik_CoreAdminHome_Controller extends Piwik_Controller
{
	function getDefaultAction()
	{
		return 'redirectToIndex';
	}
	
	function redirectToIndex()
	{
		if(Piwik::isUserIsSuperUser()) 
		{
			$module = 'CorePluginsAdmin';
		} 
		else 
		{
			$module = 'SitesManager';
		}
		header("Location:index.php?module=" . $module);
	}

	public function index()
	{
		Piwik::checkUserIsSuperUser();
		$view = $this->getDefaultIndexView();
		echo $view->render();
	}
	
	protected function getDefaultIndexView()
	{
		$view = new Piwik_View('CoreAdminHome/templates/index.tpl');
		$view->content = '';
		$view->menu = Piwik_GetAdminMenu();
		return $view;
	}
}

