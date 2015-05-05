<?php
namespace Translation42\Model;

use Core42\Model\AbstractModel;

/**
 * @method Translation setId() setId(int $id)
 * @method int getId() getId()
 * @method Translation setMessage() setMessage(string $message)
 * @method int getMessage() getMessage()
 * @method Translation setTextDomain() setTextDomain(string $textDomain)
 * @method int getTextDomain() getTextDomain()
 * @method Translation setLocale() setLocale(string $locale)
 * @method int getLocale() getLocale()
 * @method Translation setTranslation() setTranslation(string $translation)
 * @method int getTranslation() getTranslation()
 * @method Translation setStatus() setStatus(string $status)
 * @method int getStatus() getStatus()
 * @method Translation setUpdated() setUpdated(\DateTime $updated)
 * @method \DateTime getUpdated() getUpdated()
 * @method Translation setCreated() setCreated(\DateTime $created)
 * @method \DateTime getCreated() getCreated()
 */
class Translation extends AbstractModel
{
    const STATUS_AUTO = "auto";
    const STATUS_MANUAL = "manual";

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
        'created'
    ];

}
