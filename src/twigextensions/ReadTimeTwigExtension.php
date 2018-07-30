<?php
/**
 * Read Time plugin for Craft CMS 3.x
 *
 * Calculate the estimated read time for content.
 *
 * @link      https://github.com/zizther
 * @copyright Copyright (c) 2018 Nathan Reed
 */

namespace zizther\readtime\twigextensions;

use zizther\readtime\ReadTime;

use Craft;
use craft\helpers\DateTimeHelper;
use craft\helpers\StringHelper;

use yii\base\ErrorException;

class ReadTimeTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    public function getName()
    {
        return 'readTime';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('readTime', [$this, 'readTimeFunction']),
        ];
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('readTime', [$this, 'readTimeFilter']),
        ];
    }

    public function readTimeFunction($element, $wordIndentifier = null)
    {
        $totalSeconds = 0;
        $vals = '';

        foreach ($element->getFieldLayout()->getFields() as $field) {
            try {
                // If field is a matrix then loop through fields in block
                if ($field instanceof craft\fields\Matrix) {
                    foreach($element->getFieldValue($field->handle)->all() as $block) {
                        $blockFields = $block->getFieldLayout()->getFields();

                        foreach($blockFields as $blockField){
                            $value = $block->getFieldValue($blockField->handle);
                            $seconds = $this->valToSeconds($value);
                            $totalSeconds = $totalSeconds + $seconds;
                        }
                    }
                } else {
                  $value = $element->getFieldValue($field->handle);
                  $seconds = $this->valToSeconds($value);
                  $totalSeconds = $totalSeconds + $seconds;
                }
            } catch (ErrorException $e) {
                continue;
            }
        }

        return $this->valToFormat($totalSeconds, $wordIndentifier);
    }

    public function readTimeFilter($value = null, $wordIndentifier = null)
    {
        return $this->valToFormat( $this->valToSeconds($value), $wordIndentifier );
    }

    // Private Methods
    // =========================================================================

    private function valToSeconds($value)
    {
        $settings = ReadTime::$plugin->getSettings();
        $wpm = $settings->wordsPerMinute;

        $string = StringHelper::toString($value);
        $wordCount = StringHelper::countWords($string);
        $seconds = $wordCount / $wpm * 60;

        return $seconds;
    }

    private function valToFormat($seconds, $wordIndentifier)
    {
        // Calculate time
        $minutes = $seconds / 60;

        // If less than 1 minute
        if ($minutes < 1) {
			// Test if identifier
			$readTime = $wordIndentifier ? '< 1 '.$wordIndentifier : $minutes;
        }
        else {
            // Round minutes up
            $resultTime = ceil($minutes);

			if ($wordIndentifier) {
	            $txt = $resultTime == 1 ? $wordIndentifier : $wordIndentifier.'s';
	            $readTime = $resultTime.' '.$txt;
			}
			else {
				$readTime = $resultTime;
			}
        }

        return $readTime;
    }
}
