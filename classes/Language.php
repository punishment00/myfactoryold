<?php
class Language
{
    private $usr_language;
    public $hdlang = array();

    public function __construct($lang)
    {
        $this->usr_language = $lang;
        //get language file
        $lang_path = "languages";
        $langFile = $lang_path."/". $this->usr_language . ".php";
        $temp_lang_file = $langFile; 
        
       
        while(!file_exists($langFile)) {
            $count=3; 
            while(!file_exists($langFile) && $count!=0)
            {
                $langFile = "../".$langFile;
                $count--;
            }
            if(!file_exists($langFile))
            {
                $langFile = $lang_path."/EN.php";
            }
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