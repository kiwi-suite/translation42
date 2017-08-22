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

namespace Translation42\Model;

use Core42\Model\AbstractModel;
use Core42\Stdlib\DateTime;

/**
 * @method Translation setId() setId(int $id)
 * @method int getId() getId()
 * @method Translation setTextDomain() setTextDomain(string $textDomain)
 * @method string getTextDomain() getTextDomain()
 * @method Translation setLocale() setLocale(string $locale)
 * @method string getLocale() getLocale()
 * @method Translation setMessage() setMessage(string $message)
 * @method string getMessage() getMessage()
 * @method Translation setTranslation() setTranslation(string $translation)
 * @method string getTranslation() getTranslation()
 * @method Translation setStatus() setStatus(string $status)
 * @method string getStatus() getStatus()
 * @method Translation setUpdated() setUpdated(DateTime $updated)
 * @method DateTime getUpdated() getUpdated()
 * @method Translation setCreated() setCreated(DateTime $created)
 * @method DateTime getCreated() getCreated()
 */
class Translation extends AbstractModel
{
    const STATUS_AUTO = 'auto';
    const STATUS_MANUAL = 'manual';

    /**
     * @var array
     */
    protected $properties = [
        'id',
        'textDomain',
        'locale',
        'message',
        'translation',
        'status',
        'updated',
        'created',
    ];
}
