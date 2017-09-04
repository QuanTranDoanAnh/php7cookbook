<?php
namespace Application\Web;

use DOMDocument;

class Hoover
{
    protected $content;
    
    /**
     * get web page content
     * 
     * @param string $url
     * @return DOMDocument
     */
    public function getContent(string $url): DOMDocument
    {
        if (!$this->content) {
            if (stripos($url, 'http') !== 0) {
                $url = 'http://' . $url;
            }
            $this->content = new DOMDocument('1.0', 'utf-8');
            $this->content->preserveWhiteSpace = FALSE;
            
            // @ used to suppress warnings generated from
            // improperly configured web pages
            @$this->content->loadHTMLFile($url);
        }
        return $this->content;
    }
    
    /**
     * get all tags in page
     * 
     * @param string $url
     * @param string $tag
     * @return array
     */
    public function getTags(string $url, string $tag): array
    {
        $count = 0;
        $result = array();
        $elements = $this->getContent($url)->getElementsByTagName($tag);
        
        foreach ($elements as $node) {
            /**
             * @var \DOMNode $node
             */
            $result[$count]['value'] = trim(preg_replace('/\s+/', ' ', $node->nodeValue));
            
            if ($node->hasAttributes()) {
                foreach ($node->attributes as $name => $attr) {
                    $result[$count]['attributes'][$name] = $attr->value;
                }
            }
            $count++;
        }
        return $result;
    }
    
    /**
     * 
     * @param string $url
     * @param string $attr DOM node attribute name
     * @param string $domain
     * @return array
     */
    public function getAttribute(string $url, string $attr, string $domain=NULL): array 
    {
       $result = array();
       $elements = $this->getContent($url)->getElementsByTagName('*');
       
       foreach ($elements as $node) {
           /**
            * @var \DOMElement $node (\DOMElement extends \DOMNode)
            */
           if ($node->hasAttribute($attr)) {
               $value = $node->getAttribute($attr);
               if ($domain) {
                   if (stripos($value, $domain) !== FALSE) {
                       $result[] = trim($value);
                   }
               } else {
                   $result[] = trim($value);
               }
           }
       }
       return $result;
    }
}

