<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2014 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\Command\Translation;

use Translation42\Model\Translation;
use Core42\Command\AbstractCommand;

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
            $this->translation = $this->getTableGateway('Admin42\User')->selectByPrimary((int)$this->translationId);
        }

        if (!($this->translation instanceof Translation)) {
            $this->addError("translation", "invalid translation");
        }
    }

    /**
     *
     */
    protected function execute()
    {
        $this->getTableGateway('Admin42\Translation')->delete($this->translation);
    }
}
