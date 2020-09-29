<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/24/20
 * Time: 4:14 PM
 */


namespace HtmlGetters;



use Db\MySql;

require_once 'AbstractGetter.php';
require_once 'Db/MySql.php';


final class CurlHtmlGetter extends AbstractGetter implements HtmlGettersInterface
{
    public function getData( $observer, &$counter ){
        $counter++;
        $db = new MySql();
        foreach ($this->urls as $key => $url) {
            if($this->res_urls_object->checkIsUnique($url['url'])) {/* check if is unique */
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url['url']);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $html = curl_exec($ch);
                $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $real_url = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL);
                curl_close($ch);
                if ($html !== false && $status == 200) {
                    $url['status'] = $status;
                    $url['counter'] = $counter;
                    $url['real_url']=$real_url;
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
        }
        $observer();
    }



}
