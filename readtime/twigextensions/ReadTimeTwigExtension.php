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

    public function readTime($content, $wordsPerMin='')
    {
        // Read speed
        $readSpeed = isset($wordsPerMin) && $wordsPerMin != "" ? $wordsPerMin : 200;

        // Clean content
        $content = strip_tags($content);
        $content = str_replace("\n", ' ', $content);
        $content = preg_replace("/\s+/", ' ', $content);
        $content = trim($content);

        // Calculate number of words
        $words = explode(' ', $content);
        $count = count($words);

        // Calculate time
        $fractionTime = $count / $readSpeed;

        // Return if less than 1 minute
        if( $fractionTime < 1 ) {
            $readTime = '> 1 min';
        }
        else {
            // Round fraction up
            $resultTime = ceil($count / $readSpeed);
            
            $minTxt = $resultTime == 1 ? 'min' : 'mins';
            $resultTime = $resultTime . ' ' . $minTxt;
            
            $readTime = $resultTime;
        }
        
        return $readTime;
    }
}