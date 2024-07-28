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

        if ($params) {
            $functionArguments = array_slice($params, 1);
            self::$nomatch = false;

            if (is_callable($callback)) {
                if (is_array($callback)) {
                    $className = $callback[0];
                    $methodName = $callback[1];
                    $instance = $className::getInstance();
                    $instance->$methodName(...$functionArguments);
                } else {
                    $callback(...$functionArguments);
                }
            } else if (is_array($callback)) {
                $className = $callback[0];
                $methodName = $callback[1];
                $instance = $className::getInstance();
                $instance->$methodName(...$functionArguments);
            } else if (is_string($callback)) {
                $parts = explode("@", $callback);
                $className = "APP\Controllers\\" . $parts[0];
                $methodName = $parts[1];
                $instance = $className::getInstance();
                $instance->$methodName(...$functionArguments);
            }
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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            self::process($pattern, $callback);
        }
    }

    // Registers a DELETE route
    public static function delete($pattern, $callback)
    {
        if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
            self::process($pattern, $callback);
        }
    }

    // Outputs a 404 message if no routes matched
    public static function cleanup()
    {
        if (self::$nomatch) {
            echo "404 - Not Found";
        }
    }
}
