<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/28/20
 * Time: 4:35 PM
 */

namespace HtmlGetters;

use Db\MySql;
require_once 'AbstractGetter.php';
require_once 'Db/MySql.php';

final class FileGetContentGetter extends AbstractGetter implements HtmlGettersInterface
{

    public function getData($observer, &$counter)
    {
        $counter++;
        $db = new MySql();
        foreach ($this->urls as $url) {
            $html = $this->getPageContent($url);
            if($html){
                $url['counter']=$counter;
                $db->linkInsert($url);
                $this->res_urls_object->resUrlPush($url);
                $parent = $url['id'];
                $links_array = $this->htmlParse($html);
                /* temp array pushing */
                if (count($links_array) > 0) {
                    $this->tempArrayPushing($links_array, $parent);
                }
            }
        }
        $observer();
    }
    private function getPageContent(&$url){
        if($this->res_urls_object->checkIsUnique($url['url'])) {
            /* set context params */
            $context = stream_context_create(array('http' => array('follow_location' => false)));

            /* try get page data */
            $page_data = file_get_contents($url['url'], false, $context);
            $pattern = "/HTTP\/\d.\d\s(\d{3})/";
            $status = '404'; /*default status*/
            if (preg_match($pattern, $http_response_header[0], $matches)) {
                $status = $matches[1];
            }
            if ($status == "200") {
                $url['status'] = 200;
                $url['real_url'] = $url['url'];
                return $page_data;
            } elseif ($status == "301") {
                $pattern = "/^Location:\s*(.*)$/i";
                $location_headers = preg_grep($pattern, $http_response_header);
                $values = array_values($location_headers);
                $location = array_shift($values);
                $url['url'] = trim(str_replace('Location:', '', $location));
                return $this->getPageContent($url);
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}
