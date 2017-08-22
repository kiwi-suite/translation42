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

namespace Translation42\Command\Translation;

use Core42\Command\ConsoleAwareTrait;
use ZF\Console\Route;

class ExportCommand extends AbstractCommand
{
    use ConsoleAwareTrait;

    /**
     * @var string
     */
    private $availableFormats = ['json', 'phparray'];

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $output;

    /**
     * @var string
     */
    private $format;

    /**
     * @var string
     */
    private $textDomain;

    /**
     * @var bool
     */
    protected $transaction = false;

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @param string $textDomain
     * @return $this
     */
    public function setTextDomain($textDomain)
    {
        $this->textDomain = $textDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param $fileName
     * @return string
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     *
     */
    protected function preExecute()
    {
        if (!in_array($this->format, $this->availableFormats)) {
            $this->addError('format', "format is not set or not supported: {$this->format}");

            return;
        }

        if ($this->textDomain === null) {
            $this->addError('textdomain', 'textdomain not set');

            return;
        }

        $this->messages = $this->getMessages($this->textDomain);

        if (empty($this->messages)) {
            $this->addError('name', "no messages to export for text-domain {$this->textDomain}");

            return;
        }
    }

    /**
     *
     */
    protected function execute()
    {
        $extension = '';

        switch ($this->format) {
            case 'json':
                $extension = 'json';
                $this->output = json_encode($this->messages);
                break;
            case 'phparray':
                $extension = 'php';
                $this->output = '<?php ' . var_export($this->messages, true) . ';';
                break;
        }

        $this->setFileName('translations-' . $this->textDomain . '.' . $extension);

        $this->consoleOutput($this->output);
    }

    /**
     * @param Route $route
     * @return mixed|void
     */
    public function consoleSetup(Route $route)
    {
        $this->setFormat($route->getMatchedParam('format'));
        $this->setTextDomain($route->getMatchedParam('textdomain'));
    }
}
