<?php
	
class Piwik_Plugin_Provider extends Piwik_Plugin
{	
	public function __construct()
	{
	}

	public function getInformation()
	{
		$info = array(
			'name' => 'Provider',
			'description' => 'Provider // lookup during logging + archive + display',
			'author' => 'Piwik',
			'homepage' => 'http://piwik.org/',
			'version' => '0.1',
		);
		
		return $info;
	}
	
	function install()
	{
		// add column hostname / hostname ext in the visit table
		$query = "ALTER TABLE `".Piwik::prefixTable('log_visit')."` ADD `location_provider` VARCHAR( 100 ) NOT NULL";
		Zend_Registry::get('db')->query($query);
	}
	
	function uninstall()
	{
		// add column hostname / hostname ext in the visit table
		$query = "ALTER TABLE `".Piwik::prefixTable('log_visit')."` DROP `location_provider`";
		Zend_Registry::get('db')->query($query);
	}
	
	function getListHooksRegistered()
	{
		$hooks = array(
			'ArchiveProcessing_Day.compute' => 'archiveDay',
			'LogStats.newVisitorInformation' => 'logProviderInfo',
		);
		return $hooks;
	}
	
		
	/**
	 * Archive the provider count
	 */
	function archiveDay($notification)
	{
		$this->ArchiveProcessing = $notification->getNotificationObject();
		
		$recordName = 'Provider_hostnameExt';
		$labelSQL = "location_provider";
		$tableProvider = $this->ArchiveProcessing->getDataTableInterestForLabel($labelSQL);
		$record = new Piwik_Archive_Processing_Record_Blob_Array($recordName, $tableProvider->getSerialized());
//		echo $tableProvider;
	}
	
	/**
	 * Logs the provider in the log_visit table
	 */
	public function logProviderInfo($notification)
	{
		$visitorInfo =& $notification->getNotificationObject();
		
		$hostname = $this->getHost($visitorInfo['location_ip']);
		$hostnameExtension = $this->getHostnameExt($hostname);
		
		// add the value to save in the table log_visit
		$visitorInfo['location_provider'] = $hostnameExtension;
	}
	
	/**
	 * Returns the hostname extension (site.co.jp in fvae.VARG.ceaga.site.co.jp)
	 * given the full hostname looked up from the IP
	 * 
	 * @param string $hostname
	 * 
	 * @return string
	 */
	private function getHostnameExt($hostname)
	{
		$extToExclude = array(
			'com', 'net', 'org', 'co'
		);
		
		$off = strrpos($hostname, '.');
		$ext = substr($hostname, $off);
	
		if(empty($off) || is_numeric($ext) || strlen($hostname) < 5)
		{
			return 'Ip';
		}
		else
		{
			$e = explode('.', $hostname);
			$s = sizeof($e);
			
			// if extension not correct
			if(isset($e[$s-2]) && in_array($e[$s-2], $extToExclude))
			{
				return $e[$s-3].".".$e[$s-2].".".$e[$s-1];
			}
			else
			{
				return $e[$s-2].".".$e[$s-1];
			}
		}
	}
	
	/**
	 * Returns the hostname given the string IP in the format ip2long
	 * php.net/ip2long
	 * 
	 * @param string $ip
	 * 
	 * @return string hostname
	 */
	private function getHost($ip)
	{
		return trim(strtolower(@gethostbyaddr(long2ip($ip))));
	}
	
}
