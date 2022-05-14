<?php

use de\langner_dev\ui\utils\document\HTMLDocument;
use de\langner_dev\ui\utils\localization\Language;

use function de\langner_dev\ui\utils\localization\l_str;
use de\langner_dev\ui\utils\document\NavBar;
use de\langner_dev\ui\utils\document\NavBarList;
use de\langner_dev\ui\utils\document\NavBarListItem;
use de\langner_dev\ui\utils\document\Select;
use de\langner_dev\ui\utils\document\Button;
use de\langner_dev\ui\utils\document\Spacer;
use de\langner_dev\ui\utils\document\Div;
use de\langner_dev\ui\utils\document\Section;

require_once 'ui_utils/localization.php';

Language::setCurrentLanguage(new Language("de", "Deutsch"));

require_once "ui_utils/keys.php";

require_once 'ui_utils/document.php';
require_once 'ui_utils/elements.php';
require_once 'ui_utils/keys.php';

class SimpleHTMLDocument extends HTMLDocument {
    
    private Section $section;
   
    public function __construct($title, $icon) 
    {
        parent::__construct($title, $icon);
        $this->section = new Section($title);

        $this->buildNavBar();
        $this->addElement($this->section); 
    }

    private function buildNavBar() {
        $nav_bar = new NavBar(NAV_BAR_TITLE);
        $nav_bar_list = new NavBarList();
        $nav_bar_list_item_file = new NavBarListItem(NAV_BAR_ITEM_FILES_TITLE);
        $nav_bar_list_item_file->setId(NAV_BAR_ITEM_FILES_ID);
        $nav_bar_list_item_file->setActive(false);

        $nav_bar_list->addElement($nav_bar_list_item_file);

        $select = new Select(
            array(
                "de"=>LANGUAGE_DE
            )
        );

        $select->setStyle("width: 200px");

        $login_logout_button = new Button(NAV_BAR_LOGIN_BUTTON_CONTENT, BS5_BUTTON_TYPE_SUCCESS, false);


        $nav_bar->addElement($nav_bar_list);
        $nav_bar->addElement($select);
        $nav_bar->addElement(new Spacer(2, 0, 0, 2)); 
        $nav_bar->addElement($login_logout_button);
    

        $this->addElement($nav_bar);
    }
    
    public function getSection(): Section{
        return $this->section;
    }

}