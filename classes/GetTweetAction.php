<?php

namespace Grav\Plugin\Chirp;

use Exception;
use Grav\Common\HTTP\Response;
use Grav\Common\Grav;

class GetTweetAction
{
    const API_URL = 'https://cdn.syndication.twimg.com/tweet-result';

    public function __construct(
        public string $url
    ) {
    }

    public function __invoke(): array
    {
        $response = $this->getResponse($this->url);

        return $this->parseTweet($response);
    }

    protected function parseTweet($response)
    {
        $response = json_decode($response, true);

        $date = strtotime($response['created_at']);
        $author = $response['user']['name'];
        $at = $response['user']['screen_name'];
        $url = !$this->isId($this->url) ? $this->url : "https://twitter.com/$at/status/" . $response['id_str'];

        $content = explode("\n", $response['text']);
        $content = array_filter($content);
        $content = array_map(fn ($v) => "<p>$v</p>", $content);
        $content = implode("\n", $content);

        $media = [];
        if (isset($response['entities']['media'])) {
            $media = $response['entities']['media'];
            array_walk($media, function ($v, $k) use (&$media) {
                unset($media[$k]);
                $text = $v['url'];
                $url = $v['expanded_url'];
                $media[$text] = Grav::instance()['twig']->processTemplate(
                    'partials/tweet-image.html.twig',
                    compact('url', 'text')
                );;
            });
        }

        $content = str_replace(array_keys($media), $media, $content);

        return compact(
            'url',
            'content',
            'author',
            'at',
            'date',
            'date',
        );
    }

    protected function getResponse(string $url): string
    {
        $id = $this->getId($url);

        if (!$id) {
            throw new Exception("Incorrect Twitter URL given", 1);
        }

        $params = '?' . http_build_query([
            'id' => $id,
            'lang' => 'en',
        ]);

        $response = Response::get(static::API_URL . $params);

        return $response;
    }

    protected function getId(string $url)
    {
        preg_match("/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitter.com\/[a-zA-Z0-9_]{4,15}\/status\/)(\w+)/", $url, $matches);

        if (!isset($matches[1])) {
            if ($this->isId($url)) {
                return $url;
            }

            return null;
        }


        return $matches[1];
    }

    protected function isId($url)
    {
        return is_numeric($url);
    }
}
