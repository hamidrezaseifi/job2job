<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_contactmessage".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $title
 * @property string $message
 * @property string $createdate
 */
class ContactmessageBase extends \common\models\Contactmessage
{
    
 
    /**
     * {@inheritdoc}
     * @return ContactmessageQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactmessageQueryBase(get_called_class());
    }
}
