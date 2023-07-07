<?php

namespace Inc\Classes;

class VideoHelper
{

    private static $currentId = 1;

    public static function get_video_tag(
        $videoURL,
        $videoLoop = false,
        $videoAddControls = true,
        $autoplayDesktop = false,
        $autoplayMobile = false,
        $videoBackground = false,
        $class = '',
        $videoAttr = []
    ) {

        if (empty($videoURL)) {
            return false;
        }

        // Add id attribute in $videoAttr
        array_push($videoAttr, 'id="section-video-' . self::$currentId++ . '"');

        // Determine video provider through URL
        if (strpos($videoURL, "youtube") !== false || strpos($videoURL, "youtu.be") !== false) {
            $videoSource = "youtube";
        } elseif (strpos($videoURL, "vimeo") !== false) {
            $videoSource = "vimeo";

            if (strpos($videoURL, "external") !== false) {
                $videoSource = "vimeo-external";
            }
        } elseif (strpos($videoURL, ".mp4") !== false) {
            $videoSource = "mp4";
        } else {
            throw new \Exception("Cannot get video source from URL.");
        }

        // Extract video ID and convert to embed to URL
        if ($videoSource === "vimeo") {
            return self::get_vimeo_tag($videoURL, $videoLoop, $autoplayDesktop, $videoBackground, $videoAttr, $autoplayMobile, $class);
        } elseif ($videoSource === "youtube") {
            return self::get_youtube_tag($videoURL, $videoLoop, $autoplayDesktop, $videoAddControls, $videoBackground, $videoAttr, $autoplayMobile, $class);
        } elseif (in_array($videoSource, array("vimeo-external", "mp4"))) {
            return self::get_mp4_vimeo_external($videoURL, $videoLoop, $autoplayDesktop, $autoplayMobile, $videoBackground, $class, $videoAttr);
        }
    }

    private static function get_vimeo_tag($videoURL, $videoLoop, $autoplayDesktop, $videoBackground, $videoAttr, $autoplayMobile, $class)
    {
        $videoID = substr($videoURL, strrpos($videoURL, "/") + 1);
        $url = "https://player.vimeo.com/video/$videoID?title=0&byline=0&portrait=0&api=1";

        if ($videoLoop) {
            $url .= "&loop=1";
        }

        if ($autoplayDesktop) {
            $url .= "&autoplay=1";
        }

        if ($videoBackground) {
            $url .= "&background=1";
        }

        if ($autoplayDesktop) {
            array_push($videoAttr, 'data-autoplay="1"');
        }

        if ($autoplayMobile) {
            array_push($videoAttr, 'data-autoplayMobile="1"');
        }

        $tag = '<iframe ' . implode(' ', $videoAttr) . ' class="hero-iframe-video is-vimeo js-video-iframe is-video-hidden ' . $class
            . '" style="z-index:1;opacity:0.000001;" data-source="vimeo" frameborder="0" src="%s" allow="autoplay;"></iframe>';

        return sprintf($tag, $url);
    }

    private static function get_youtube_tag($videoURL, $videoLoop, $autoplayDesktop, $videoAddControls, $videoBackground, $videoAttr, $autoplayMobile, $class)
    {
        $breakString = "watch?v=";

        if (strpos($videoURL, $breakString)) {
            $videoID = substr($videoURL, strpos($videoURL, $breakString) + strlen($breakString));
        } else {
            $videoID = substr($videoURL, strrpos($videoURL, "/") + 1);
        }

        $url = "https://www.youtube.com/embed/$videoID?rel=0&showinfo=0&controls=0&enablejsapi=1&fs=0";

        if ($videoLoop) {
            $url .= "&loop=1&playlist=$videoID";
        }

        if ($autoplayDesktop) {
            $url .= "&autoplay=1";
        }

        if (isset($videoAddControls) && $videoAddControls) {
            $url = str_replace("controls=0", "controls=1", $url);
        }

        if ($videoBackground) {
            $url .= "&mute=1";
        }

        if ($autoplayDesktop) {
            array_push($videoAttr, 'data-autoplay="1"');
        }

        if ($autoplayMobile) {
            array_push($videoAttr, 'data-autoplayMobile="1"');
        }

        $tag = '<iframe ' . implode(' ', $videoAttr) . ' class="hero-iframe-video is-yt js-video-iframe ' . $class
            . '" style="opacity:0.000001;" data-source="youtube" src="%s" frameborder="0" allow="autoplay;"></iframe>';

        return sprintf($tag, $url);
    }

    private static function get_mp4_vimeo_external($videoURL, $videoLoop, $autoplayDesktop, $autoplayMobile, $videoBackground, $class, $videoAttr)
    {
        $loop = $videoLoop ? "loop" : "";
        $autoplay = $autoplayDesktop ? "autoplay" : "";

        // $videoAttr = [];

        if ($autoplay) {
            array_push($videoAttr, 'autoplay="autoplay"');
        }

        if ($autoplayMobile) {
            array_push($videoAttr, 'data-autoplayMobile="1"');
        }

        if ($videoBackground) {
            array_push($videoAttr, 'muted');
        }

        return '<video class="hero-video js-video-tag ' . $class . '" ' . implode(' ', $videoAttr) . ($loop ? ' loop="loop"' : '')
            . 'playsinline><source src="' . $videoURL . '" type="video/mp4"></video>';
    }
}
