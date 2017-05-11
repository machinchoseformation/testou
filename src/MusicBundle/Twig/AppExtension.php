<?php
/*
services:
  app.twig_extension:
          class: MusicBundle\Twig\AppExtension
          public: false
          tags:
              - { name: twig.extension }

 */
namespace MusicBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('time', array($this, 'timeFilter')),
        );
    }

    public function timeFilter($secondNumber){
        $hours = floor($secondNumber/3600);
        $minutes = floor(($secondNumber - ($hours*3600))/60);
        $seconds = $secondNumber%60;
        if($seconds < 10){
            $seconds = "0" . $seconds;
        }
        if($minutes < 10){
            $minutes = "0" . $minutes;
        }
        if($hours > 0){
            if($hours < 10){
                $hours = "0" . $hours;
            }
            $result = $hours . ":" . $minutes . ":" . $seconds;
        }
        else{
            $result = $minutes . ":" . $seconds;
        }
        return $result;
    }
}