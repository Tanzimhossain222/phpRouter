<?php

namespace APP\Routing;

class Router
{
    // Flag to determine if no routes matched
    private static $nomatch = true;

    // Retrieves the current URL from the server request
    private static function getUrl()
    {
        return $_SERVER["REQUEST_URI"];
    }

    // Matches the current URL against a given pattern
    private static function getMatches($pattern)
    {
        $url = self::getUrl();
        return preg_match($pattern, $url, $matches) ? $matches : false;
    }

    // Processes the route and calls the callback if the URL matches the pattern
    private static function process($pattern, $callback)
    {
        $pattern = "~^{$pattern}/?$~";
        $params = self::getMatches($pattern);

        if ($params && is_callable($callback)) {
            self::$nomatch = false;
            $functionArguments = array_slice($params, 1);
            $callback(...$functionArguments);
        }
    }

    // Registers a GET route
    public static function get($pattern, $callback)
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            self::process($pattern, $callback);
        }
    }

    // Registers a POST route
    public static function post($pattern, $callback)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        self::process($pattern, $callback);
    }

    // Registers a DELETE route
    public static function delete($pattern, $callback)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
            return;
        }

        self::process($pattern, $callback);
    }

    // Outputs a 404 message if no routes matched
    public static function cleanup()
    {
        if (self::$nomatch) {
            echo "404 - Not Found";
        }
    }
}
