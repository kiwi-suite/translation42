<?php

/*
 * translation42
 *
 * @package translation42
 * @link https://github.com/kiwi-suite/translation42
 * @copyright Copyright (c) 2010 - 2017 kiwi suite (https://www.kiwi-suite.com)
 * @license MIT License
 * @author kiwi suite <dev@kiwi-suite.com>
 */

namespace Translation42\Form\Translation;

use Admin42\FormElements\Form;

class CreateForm extends Form
{
    /**
     *
     */
    public function init()
    {
        $this->add([
            'name' => 'csrf',
            'type' => 'csrf',
        ]);

        $this->add([
            'name' => 'textDomain',
            'type' => 'textDomain',
            'options' => [
                'label' => 'label.textDomain',
            ],
        ]);

        $this->add([
            'name' => 'locale',
            'type' => 'translationLocale',
            'options' => [
                'label' => 'label.locale',
            ],
        ]);

        $this->add([
            'name' => 'message',
            'type' => 'text',
            'options' => [
                'label' => 'label.message',
            ],
        ]);


        $this->add([
            'name' => 'translation',
            'type' => 'textarea',
            'options' => [
                'label' => 'label.translation',
            ],
        ]);
    }
}
