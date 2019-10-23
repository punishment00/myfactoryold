<?php
class Language
{
    private $usr_language;
    public $hdlang = array();

    public function __construct($lang)
    {
        $this->usr_language = $lang;
        //get language file
        $lang_path = './languages';
        $langFile = $lang_path.'/'. $this->usr_language . '.php';
        if(!file_exists($langFile))
        {
             $langFile = $lang_path.'/EN.php';
        }
        
        include($langFile);
        $this->hdlang = $hdlang;
    }

    public function userLanguage()
    {
        return $this->hdlang;
    }

}
?>