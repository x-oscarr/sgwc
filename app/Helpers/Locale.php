<?php


namespace App\Helpers;


class Locale
{
    private $def_lang_priority = array(
        'ru' => 0.9,
        'en' => 1,
    );
    public function __construct()
    {
        if (!isset($_SESSION['lang']) || file_exists(LANG_DIR.$_SESSION['lang'].'.lang') == false) {
            $lang_list = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            if (preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', $lang_list, $lang_list)) {
                $lang_list = array_combine($lang_list[1], $lang_list[2]);

                foreach ($lang_list as $n => $v)
                    $lang_list[$n] = $v ? $v : 1;

                arsort($lang_list, SORT_NUMERIC);
                $lang_priority = array();

                foreach ($lang_list as $key => $value) {
                    $nk = strtok($key, '-');
                    if (!isset($lang_priority[$nk]) || $lang_priority[$nk] < $value) {
                        $lang_priority[$nk] = $value;
                    }
                }
            }
            else $lang_priority = $this->def_lang_priority;

            foreach ($lang_priority as $key) {
                $lang_high_priority = array_search(max($lang_priority), $lang_priority);
                if (file_exists(LANG_DIR. $lang_high_priority . '.lang') == true) {
                    $_SESSION['lang'] = $lang_high_priority;
                    break;
                }
                else unset($lang_priority[$lang_high_priority]);
            }
        }
    }
}
