<?php

/*
 * translation42
 *
 * @package translation42
 * @link https://github.com/raum42/translation42
 * @copyright Copyright (c) 2010 - 2016 raum42 (https://www.raum42.at)
 * @license MIT License
 * @author raum42 <kiwi@raum42.at>
 */

namespace Translation42\Command\Translation;

use Core42\Command\AbstractCommand;
use Translation42\Model\Translation;
use Translation42\TableGateway\TranslationTableGateway;

class DeleteCommand extends AbstractCommand
{
    /**
     * @var Translation
     */
    private $translation;

    /**
     * @var int
     */
    private $translationId;

    /**
     * @param Translation $translation
     * @return $this
     */
    public function setTranslation(Translation $translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * @param int $translationId
     * @return $this
     */
    public function setTranslationId($translationId)
    {
        $this->translationId = $translationId;

        return $this;
    }

    /**
     *
     */
    protected function preExecute()
    {
        if (!empty($this->translationId)) {
            $this->translation =
                $this->getTableGateway(TranslationTableGateway::class)->selectByPrimary((int) $this->translationId);
        }

        if (!($this->translation instanceof Translation)) {
            $this->addError('translation', 'invalid translation');
        }
    }

    /**
     *
     */
    protected function execute()
    {
        $this->getTableGateway(TranslationTableGateway::class)->delete([
            'textDomain' => $this->translation->getTextDomain(),
            'message' => $this->translation->getMessage(),
        ]);
    }
}
