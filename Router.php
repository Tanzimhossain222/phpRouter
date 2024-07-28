<?php

namespace APP\Routing;

/**
 * Router class for handling URL routing.
 */
class Router
{

    /**
     * Retrieves the current URL from the server request.
     *
     * @return string The current URL.
     */
    private static function getUrl()
    {
        return $_SERVER["REQUEST_URI"];
    }

    /**
     * Matches the current URL against a given pattern.
     *
     * @param string $pattern The regular expression pattern to match.
     * @return array|false The matched results or false if no match.
     */
    private static function getMatches($pattern)
    {
        // Get the current URL
        $url = self::getUrl();

        // Check if the URL matches the pattern
        if (preg_match($pattern, $url, $matches)) {
            return $matches;
        }
        
        // Return false if no match is found
        return false;
    }

    /**
     * Registers a GET route and calls the corresponding callback if the URL matches the pattern.
     *
     * @param string $pattern The URL pattern to match.
     * @param callable $callback The callback function to execute if the URL matches the pattern.
     */
    static function get($pattern, $callback)
    {
        // Prepare the pattern by wrapping it with delimiters
        $pattern = "~^{$pattern}$~";
        
        // Get the matches for the URL
        $params = self::getMatches($pattern);

        // If matches are found and the callback is callable
        if ($params) {
            if (is_callable($callback)) {
                // Remove the first element (full match) and pass the rest as arguments to the callback
                $functionArguments = array_slice($params, 1);
                $callback(...$functionArguments);
            }
        }
    }
}
