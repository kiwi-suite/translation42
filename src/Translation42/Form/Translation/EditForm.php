<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\Form\Translation;

use Admin42\FormElements\Wysiwyg;
use Zend\Form\Element\Csrf;
use Zend\Form\Form;

class EditForm extends Form
{
    /**
     *
     */
    public function init()
    {
        $this->add(new Csrf('csrf'));

        $translation = new Wysiwyg("translation");
        $translation->setLabel("label.translation");
        $this->add($translation);
    }
}
