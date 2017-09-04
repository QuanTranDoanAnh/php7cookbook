<?php
namespace Application\Web;

class Deep
{
    protected $domain;
    
    /**
     * Returns the DNS domain from a URL
     * 
     * @param string $url = web site to scan
     * @return string $dns = DNS domain
     */
    public function getDomain(string $url): string 
    {
        if (!$this->domain) {
            $this->domain = parse_url($url, PHP_URL_HOST);
        }
        return $this->domain;
    }
    
    /**
     * Return an array of values for $tag from $url
     * PHP 7 delegating generator
     * 
     * @param string $url
     * @param string $tag
     * @return an iteration (yield)
     */
    public function scan(string $url, string $tag)
    {
       $vac = new Hoover();
       
       $scan = $vac->getAttribute($url, 'href', $this->getDomain($url));
       $result = array();
       
       foreach ($scan as $subsite) {
           yield from $vac->getTags($subsite, $tag);
       }
       
       // returns total number of scanned sub-sites
       return count($scan);
    }
}

