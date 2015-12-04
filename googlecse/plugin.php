<?php

class pluginGoogleCSE extends Plugin {

	public function init()
	{
		$this->dbFields = array(
			'search-engine-id'=>'1234567'
		);
	}

	public function form()
	{
		global $Language;

		$html  = '<div>';
		$html .= '<label>'.$Language->get('Plugin label').'</label>';
		$html .= '<input name="label" id="jslabel" type="text" value="'.$this->getDbField('label').'">';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label for="search-engine-id">'.$Language->get('Google Search Engine ID').'</label>';
		$html .= '<input type="text" name="search-engine-id" value="'.$this->getDbField('search-engine-id').'" />';
		$html .= '<div class="tip">'.$Language->get('complete-this-field-with-the-google-search-engine-id').'</div>';
		$html .= '</div>';
		return $html;
	}

	public function siteSidebar()
	{

		$html  = '<div class="plugin plugin-cse">';

		// Print the label if not empty.
		$label = $this->getDbField('label');
		if( !empty($label) ) {
			$html .= '<h2>'.$label.'</h2>';
		}

	    $html .= '<gcse:searchbox></gcse:searchbox>';
		$html .= '</div>';
		return $html;
	}

	public function siteBodyBegin()
	{
		global $layout;

        $html = '<gcse:searchresults></gcse:searchresults>';

 		return $html;
	}

 	public function siteBodyEnd()
 	{
 		global $Site;
 		global $layout;

 		$html  = '<script>(function() {';
		$html  .= 'var cx = "'.$this->getDbField("search-engine-id").'";';
   		$html  .= 'var gcse = document.createElement("script"); gcse.type = "text/javascript"; gcse.async = true; gcse.src = (document.location.protocol == "https" ? "https:" : "http:") + "//www.google.com/cse/cse.js?cx=" + cx;';
   		$html  .= 'var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(gcse, s);';
		$html  .= '})();</script>';

 		return $html;
	}

}
