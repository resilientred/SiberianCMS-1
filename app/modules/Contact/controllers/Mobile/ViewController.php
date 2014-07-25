<?php

class Contact_Mobile_ViewController extends Application_Controller_Mobile_Default {

    public function indexAction() {
        $this->forward('index', 'index', 'Front', $this->getRequest()->getParams());
    }

    public function templateAction() {
        $this->loadPartials($this->getFullActionName('_').'_l'.$this->_layout_id, false);
    }

    public function findAction() {

        $option = $this->getCurrentOptionValue();
        $contact = $option->getObject();
        $application = $this->getApplication();
        $contact_name = !is_null($contact->getName()) ? $contact->getName() : $application->getName();
        $data = array();

        $data['contact'] = array(
            "name" => $contact_name,
            "cover_url" => $contact->getCoverUrl() ? $contact->getCoverUrl() : null,
            "street" => $contact->getStreet(),
            "postcode" => $contact->getPostcode(),
            "city" => $contact->getCity(),
            "description" => $contact->getDescription(),
            "phone" => $contact->getPhone(),
            "email" => $contact->getEmail(),
            "form_url" => $this->getUrl("contact/mobile_form/index", array('value_id' => $option->getId())),
            "website_url" => $contact->getWebsite(),
            "facebook_url" => $contact->getFacebook()
        );

        $data['page_title'] = $option->getTabbarName();


        $this->_sendHtml($data);

    }

}