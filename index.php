<?php

use de\langner_dev\ui\utils\document\Card;
use de\langner_dev\ui\utils\document\CardBody;
use de\langner_dev\ui\utils\document\CardList;
use de\langner_dev\ui\utils\document\CardListItem;
use de\langner_dev\ui\utils\document\Div;
use de\langner_dev\ui\utils\document\Grid;
use de\langner_dev\ui\utils\document\GridItem;
use de\langner_dev\ui\utils\document\GridRow;
use de\langner_dev\ui\utils\document\InformationCardListItem;
use de\langner_dev\ui\utils\document\Span;
use de\langner_dev\ui\utils\document\Section;

require_once 'head.php';


$html_document = new SimpleHTMLDocument(INDEX_TITLE, ICON_URL);

#
#   WELCOME
#
$welcome_text_div = new Div(INDEX_WELCOME_TEXT);
$html_document->getSection()->addElement($welcome_text_div);





#
#   SERVICES
#
$services_section = new Section(INDEX_SERVICES_TITLE, "h3"); 
$services_section->addClass("pb-2");
$services_section->addElement(new Div(INDEX_SERIVCES_TEXT));



#   
#   CARDS
$services_section_cards = new Grid("container-sm");
$services_section_cards_row = new GridRow();
$services_section_cards_item_1 = new GridItem("", "col-lg-4");
$services_section_cards_item_2 = new GridItem("", "col-lg-4");
$services_section_cards_row->addClass("d-flex");
$services_section_cards_row->addClass("justify-content-center");
$services_section_cards_row->addElement($services_section_cards_item_1);
$services_section_cards_row->addElement($services_section_cards_item_2);
$services_section_cards->addElement($services_section_cards_row);


# 1st card
$with_out_login_service_card = new Card(false);
$with_out_login_service_card_list = new CardList();
$with_out_login_service_card->setStyle("height: 100%");
$with_out_login_service_card->addClass("me-1");
$with_out_login_service_card->addElement(new CardBody(SERVICE_WITHOUT_LOGIN_CARD_TITLE, SERVICE_WITHOUT_LOGIN_CARD_TEXT));
$with_out_login_service_card->addElement($with_out_login_service_card_list);
$with_out_login_service_card_list->addElement(new InformationCardListItem(SERVICE_WITHOUT_LOGIN_CARD_ITEM_STORAGE_PER_FILE_TITLE, UNSET_STR));
$with_out_login_service_card_list->addElement(new InformationCardListItem(UNSET_STR, UNSET_STR));


# 2nd card
$with_login_service_card = new Card(false);
$with_login_service_card_list = new CardList();
$with_login_service_card->setStyle("height: 100%");
$with_login_service_card->addClass("ms-1");
$with_login_service_card->addElement(new CardBody(UNSET_STR, UNSET_STR));
$with_login_service_card->addElement($with_login_service_card_list);
$with_login_service_card_list->addElement(new InformationCardListItem(SERVICE_WITHOUT_LOGIN_CARD_ITEM_STORAGE_PER_FILE_TITLE, UNSET_STR));
$with_login_service_card_list->addElement(new InformationCardListItem(UNSET_STR, UNSET_STR));

$services_section_cards_item_1->addElement($with_out_login_service_card);
$services_section_cards_item_2->addElement($with_login_service_card); 

$services_section->addElement($services_section_cards);




#
#   PRINT
#

$html_document->addElement($services_section);
$html_document->printHTMLText();

?>