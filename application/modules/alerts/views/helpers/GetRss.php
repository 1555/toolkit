<?


class Zend_View_Helper_GetRss extends Zend_View_Helper_Abstract
{
    public function getrss(){

$xml=("http://news.google.com/news?ned=us&topic=h&output=rss");


$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

var_dump($xmlDoc);


	}
	
	
}
	
	
	
	