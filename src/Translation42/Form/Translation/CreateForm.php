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
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

class CreateForm extends Form
{
    /**
     *
     */
    public function init()
    {
        $this->add(new Csrf('csrf'));

        /** @var Select $textDomain */
        $textDomain = $this->getFormFactory()->getFormElementManager()->get('text_domain');
        $textDomain->setName('textDomain');
        $textDomain->setLabel('label.textDomain');
        $this->add($textDomain);

        /** @var Select $locale */
        $locale = $this->getFormFactory()->getFormElementManager()->get('locale');
        $locale->setName('locale');
        $locale->setLabel('label.locale');
        $this->add($locale);

        $message = new Text('message');
        $message->setLabel('label.message');
        $this->add($message);

        $translation = new TextArea('translation');
        $translation->setLabel('label.translation');
        $this->add($translation);
    }
}
