<?php

class Template{

	private $css = array('bootstrap.min.css' , 'font-awesome.min.css' , 'simple-line-icons.css',
						 'css/slick.css','slick-theme.css', 'owl.carousel.min.css' ,'style.css');

	public function setCSS()
	{
	
		foreach ($this->css as $css) {
			
			if(file_exists(APP_PATH . 'css' . DS . $css))
			{	
				echo '<link rel="stylesheet" href="'. CSS_DIR . $css .'"> ';
			}
		}
		
	}

}
?>