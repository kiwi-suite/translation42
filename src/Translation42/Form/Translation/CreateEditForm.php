<?php
/**
 * admin42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2014 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\Form\Translation;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class CreateEditForm extends Form
{
    /**
     *
     */
    public function init()
    {
        $this->add(new Csrf('csrf'));

        $status = new Text("status");
        $status->setLabel("label.status");
        $this->add($status);

        $textDomain = new Text("textDomain");
        $textDomain->setLabel('label.textDomain');
        $this->add($textDomain);

        $locale = new Text("locale");
        $locale->setLabel('label.locale');
        $this->add($locale);

        $message = new Text("message");
        $message->setLabel("label.message");
        $this->add($message);

        $translation = new Text("translation");
        $translation->setLabel("label.translation");
        $this->add($translation);
    }
}
