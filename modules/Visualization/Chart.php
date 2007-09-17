<?php
require_once "Visualization/OpenFlashChart.php";
abstract class Piwik_Visualization_Chart extends Piwik_Visualization_OpenFlashChart
{
	abstract function getDefaultLimit();
	
	function setData($data)
	{
		$this->dataGraph = $data;
	}
	
	function prepareData()
	{		
		$label = $data = array();
		foreach($this->dataGraph as $row)
		{
			$label[] = $row['label'];
			$data[] = $row['value'];
		}
		$max = max($data);
		
		$this->arrayData = $data;
		$this->arrayLabel = $label;
		$this->maxData = $max;
//		var_dump($label);var_dump($data);
	}
	
	function render()
	{
		//some tests data
		/*return '&y_legend=Time of day,#736AFF,12&
			&y_ticks=5,10,6&
			&line_dot=3,0x736AFF,Avg. wave height (cm),10,3&
			&values=1.5,1.6986693307951,1.8894183423087,2.064642473395,2.2173560908995,2.3414709848079,2.4320390859672,2.4854497299885,2.4995736030415,2.4738476308782,2.4092974268257,2.3084964038196,2.1754631805512,2.0155013718215,1.8349881501559,1.6411200080599,1.4416258565724,1.2444588979732,1.0574795567051,0.88814210905728,0.74319750469207,0.62842422758641,0.54839792611048,0.50630899636654,0.50383539116416,0.54107572533686,0.61654534427985,0.72723551244401,0.86873336212768,1.0353978205862,1.2205845018011,1.4169105971825,1.6165492048505,1.8115413635134,1.9941133511386,2.1569865987188,2.2936678638492,2.3987080958116,2.4679196720315,2.4985433453746,2.4893582466234,2.4407305566798,2.3545989080883,2.2343970978741,2.0849171928918&
			&x_labels=2:00am,2:10,2:20,2:30,2:40,2:50,3:00am,3:10,3:20,3:30,3:40,3:50,4:00am,4:10,4:20,4:30,4:40,4:50,5:00am,,,,,,,6:00am,,,,,,,7:00am,,,,,,,8:00am,,,,,,&
			&y_min=0&
			&y_max=3&
			&bg_colour=0xDFFFDF&
			&x_label_style=13,0x9933CC,0,6&
			
			&y_label_style=none&
			';
			*/
		return parent::render();
	}
	
}
?>