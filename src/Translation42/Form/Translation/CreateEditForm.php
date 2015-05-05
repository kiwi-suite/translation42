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

        $key = new Text("key");
        $key->setLabel("Key");
        $this->add($key);
    }
}
