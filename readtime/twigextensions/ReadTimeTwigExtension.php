<?php
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class ReadTimeTwigExtension extends Twig_Extension
{
    public function getName()
    {
        return 'ReadTime';
    }

    public function getFilters()
    {
        return array(
            'readTime' => new Twig_Filter_Method($this, 'readTime'),
        );
    }

    public function readTime($content, $wordIndentifier=null, $wordsPerMin=200)
    {
        // Clean content
        $content = strip_tags($content);
        $content = str_replace("\n", ' ', $content);
        $content = preg_replace("/\s+/", ' ', $content);
        $content = trim($content);

        // Calculate number of words
        $words = explode(' ', $content);
        $count = count($words);

        // Calculate time
        $fractionTime = $count / $wordsPerMin;

        // If less than 1 minute
        if ($fractionTime < 1) {
			// Test if identifier
			$readTime = $wordIndentifier ? '< 1 '.$wordIndentifier : $fractionTime;
        }
        else {
            // Round fraction up
            $resultTime = ceil($count / $wordsPerMin);

			if ($wordIndentifier) {
	            $txt = $resultTime == 1 ? $wordIndentifier : $wordIndentifier.'s';
	            $resultTime = $resultTime.' '.$txt;
			}
			else {
				$resultTime = $resultTime;
			}

            $readTime = $resultTime;
        }

        return $readTime;
    }
}
