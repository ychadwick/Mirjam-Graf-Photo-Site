<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class PhotoSite {

    static public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    static public function getPreferredCulture(sfRequest $request, array $cultures = null) {
        $preferredCultures = $request->getLanguages();
        foreach($preferredCultures as $key => $culture) {
            $preferredCultures[$key] = substr($culture, 0,2);
        }

        if (null === $cultures) {
            return isset($preferredCultures[0]) ? $preferredCultures[0] : null;
        }

        if (!$preferredCultures) {
            return $cultures[0];
        }

        $preferredCultures = array_values(array_intersect($preferredCultures, $cultures));

        return isset($preferredCultures[0]) ? $preferredCultures[0] : $cultures[0];
    }
}

?>
