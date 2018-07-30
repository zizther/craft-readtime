<?php
/**
 * Read Time plugin for Craft CMS 3.x
 *
 * Calculate the estimated read time for content.
 *
 * @link      https://github.com/zizther
 * @copyright Copyright (c) 2018 Nathan Reed
 */

namespace zizther\readtime\models;

use zizther\readtime\ReadTime;

use Craft;
use craft\base\Model;

class Settings extends Model
{
    // Public Properties
    // =========================================================================

    public $wordsPerMinute = 200;

    // Public Methods
    // =========================================================================

    public function rules()
    {
        return [
            [['wordsPerMinute'], 'required'],
            [['wordsPerMinute'], 'number', 'integerOnly' => true]
        ];
    }
}
