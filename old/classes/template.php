<?php

class Template{

	private $css = array('bootstrap.min.css' , 'font-awesome.min.css' , 'simple-line-icons.css',
						 'slick.css','slick-theme.css', 'owl.carousel.min.css' ,'style.css');

	private $css_cdn = array('https://fonts.googleapis.com/css?family=Lora:400,700');

	private $js = array('jquery.min.js', 'tether.min.js', 'bootstrap.min.js', 'slick.min.js' , 
						'waypoints.min.js', 'counterup.min.js' , 'instafeed.min.js', 'owl.carousel.min.js',
						'validate.js' ,'tweetie.min.js' ,'subscribe.js', 'script.js');

	private $js_cdn = array();
	private $temp = array('trial-header.php','trial-home.php','trial-footer.php');

	public function setPage()
	{
		$output = '<!DOCTYPE html>
			 	   <html lang="en">
			 	   <head>
			 	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">'	;	
		$output .= $this->setTitle('Home - Nefertari');
	    $output .= $this->setEncoding();
		$output .= $this->setCSS();
		$output .= $this->setCDN();
		$output .= $this->setJS();
		$output .= '</head>';	
		$output .= '<body>';
		echo $output;
		$output .= $this->callTemplate();


	}

	public function callTemplate()
	{
		foreach($this->temp as $temp)
		{
			if(file_exists(APP_PATH . $temp))
			{
				require_once($temp);
			}
		}
	}

	private function setCSS()
	{
		$arr = array();
		foreach ($this->css as $css) {

			if(file_exists(CSS_PATH . $css))
			{	
				    $arr[] =  '<link rel="stylesheet" href="http://localhost/nis-ib/old/'. CSS_DIR . $css .'"> ';
				    
			}
		}
		return implode('', $arr);
		
	}

    private function setJS()
	{
		$arr = array();
		foreach ($this->js as $js) {
			
			if(file_exists(JS_PATH . $js))
			{	
					$arr[] = '<script src="http://localhost/nis-ib/old/"' . JS_DIR . $js . '"></script>';
			
			}
		}
		return implode('', $arr);
		
	}

	private function setCDN()
	{
		$arr = array();
		foreach ($this->css_cdn as $cdn)
		{
			$arr[] ='<link rel="stylesheet" href="'. $cdn .'"> ';
		}

		foreach ($this->js_cdn as $cdn)
		{
			$arr[] ='<script src="' . $js . '"></script>';
		}

		return implode('', $arr);
	}

	private function addMeta($name , $content)
	{
		return '<meta name="' . $name .'" content="' . $content .'"/>';
	}

	private function setTitle($title)
	{
		return   '<title>'. $title .'</title>';
	}

	private function setEncoding($encoding = 'utf-8')
	{

		return ' <meta charset="' . $encoding . '">';
	}


}
?>