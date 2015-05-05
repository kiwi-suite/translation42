<?php
/**
 * admin42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2014 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\Controller;

use Admin42\Mvc\Controller\AbstractAdminController;

class TranslationController extends AbstractAdminController
{
    /**
     *
     */
    public function dashboardAction()
    {
        // show all textdomains and their stats
        $config = $this->getServiceLocator()->get('config');
        $textDomainConfigs = $config['translator']['remote_translation'];
        return [
            'textDomains' => $textDomainConfigs,
        ];
    }

    /**
     *
     */
    public function indexAction()
    {
        // TODO: show table of keys of textdomain
    }

    /**
     *
     */
    public function detailAction()
    {
        $isEditMode = $this->params()->fromRoute("isEditMode");

        $prg = $this->prg();
        if ($prg instanceof Response) {
            return $prg;
        }

        $createEditForm = $this->getForm('Translation42\Translation\CreateEdit');

        if ($prg !== false) {
            if ($isEditMode === true) {
                $cmd = $this->getCommand('Translation42\Translation\Edit');
                $cmd->setTranslationId($this->params()->fromRoute("id"));
            } else {
                $cmd = $this->getCommand('Translation42\Translation\Create');
            }

            $formCommand = $this->getFormCommand();
            $translation = $formCommand->setForm($createEditForm)
                ->setProtectedData(['status'])
                ->setCommand($cmd)
                ->setData($prg)
                ->run();
            if (!$formCommand->hasErrors()) {
                $this->flashMessenger()->addSuccessMessage("Success");

                // TODO: get current textdomain:
                return $this->redirect()->toRoute(
                    'admin/translation/frontend/edit',
                    ['textDomain' => $this->params()->fromRoute("textDomain"), 'id' => $translation->getId()]
                );
            } else {
                $this->flashMessenger()->addErrorMessage("Error");
            }
        } else {
            if ($isEditMode === true) {
                $translation = $this->getTableGateway('Translation42\Translation')->selectByPrimary(
                    (int)$this->params()->fromRoute("id")
                );
                if (empty($translation)) {
                    return $this->redirect()->toRoute('admin/translation');
                }
                $createEditForm->setData(
                    [
                        'key' => $translation->getKey(),
                    ]
                );
            }
        }

        return [
            'createEditForm' => $createEditForm,
        ];
    }

    /**
     *
     */
    public function deleteAction()
    {
    }

}
