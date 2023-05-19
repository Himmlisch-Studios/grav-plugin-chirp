<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Plugin\Chirp\GetTweetAction;
use Symfony\Component\DomCrawler\Crawler;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class TweetShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('tweet', function (ShortcodeInterface $sc) {
            $url = $sc->getParameter('url', false);

            if (!$url) {
                if ($sc->hasContent()) {
                    $url = (new Crawler($sc->getContent()))->text();
                }
            }

            $cache = $this->grav['cache'];
            $cache_id = md5('tweet-' . $url);

            $tweet = $cache->fetch($cache_id);

            if (!$tweet) {
                $action = new GetTweetAction($url);
                $tweet = $action();
            }

            $output = $this->twig->processTemplate(
                'partials/tweet.html.twig',
                [
                    'tweet' => $tweet
                ]
            );

            return $output;
        });
    }
}
