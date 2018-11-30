<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Uploadedfiles]].
 *
 * @see Uploadedfiles
 */
class UploadedfilesBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Uploadedfiles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Uploadedfiles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
