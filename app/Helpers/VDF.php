<?php


namespace App\Helpers;


class VDF
{
    private const QUOTE = "\"";
    private const SINGLE_QUOTE = "'";
    private const CURLY_BRACE_BEGIN = "{";
    private const CURLY_BRACE_END = "}";
    private const NEW_LINE = "\n";
    private const C_RETURN = "\r";
    private const C_TAB = "\t";
    private const C_ESCAPE = "\\";
    private const C_COMMENT = "/";
    private const PATH_DEPTH_SEPARATOR = ">>>>";

    public static function parse($data, $content = false) {
        $parsed = array();
        $ptr = &$parsed;
        $path = '';			// The current level represented as a string
        $p = 0;				// How many quotes have been seen
        $string = "";			// The string of consumed characters
        $key = "";			// The discovered key
        $value = "";			// The discovered corresponding value
        $reading = false;		// Currently consuming characters
        $lastCharSeen = "";		// Tracks the last character seen
        $comment_chars_seen = 0;        // Tracks the number of comments characters seen (2 comment characters designates the start of a comment)

        if(!$content) $filecontent = file_get_contents($data);
        else $filecontent = $data;

        // Begin parsing by character
        $chunks = str_split($filecontent, 2048);
        unset($filecontent);
        foreach ($chunks as &$chunk) {
            $chars = str_split($chunk, 1);
            foreach($chars as $c) {
                // Dont consume any escapes or quotes (unless the last seen character is escaping them)
                if($reading) {
                    if($lastCharSeen == self::C_ESCAPE) {
                        if($c == self::QUOTE || $c == self::SINGLE_QUOTE || $c == self::C_ESCAPE)
                            $string .= $c;
                        else
                            $string .= self::C_ESCAPE . $c;
                    }
                    else if($c != self::C_ESCAPE && $c != self::QUOTE)
                        $string .= $c;
                }
                // If both the key and value have been discovered store them and reset
                if(strlen($key) > 0 && strlen($value) > 0) {
                    $ptr[$key] = $value;
                    $key = '';
                    $value = '';
                    $p = 0;
                }
                // If I haven't seen a comment yet, parse the character
                // Otherwise, ignore all characters until a newline
                if($comment_chars_seen < 2) {
                    // Handle the character
                    switch($c) {
                        case self::QUOTE:
                            if($lastCharSeen != self::C_ESCAPE) {
                                $comment_chars_seen = 0;
                                $p++;	// Quote counter
                                if($p == 5) $p = 1;
                                if($reading) {
                                    // End parsing string
                                    $reading = false;
                                    switch($p) {
                                        case 2: // Key
                                            $key = $string;
                                            $string = '';
                                            break;
                                        case 4: // Value
                                            $value = $string;
                                            $string = '';
                                            break;
                                    }
                                }
                                else {
                                    $reading = true;
                                }
                            }
                            break;
                        case self::CURLY_BRACE_BEGIN:
                            // Ignore character if we are consuming a key/value
                            if(!$reading) {
                                $comment_chars_seen = 0;
                                if(!(strlen($key)>0)) { print_r($parsed); die("Not properly formed key-value structure"); }
                                $ptr[$key] = array();
                                $ptr = &$ptr[$key];
                                // Keep track of depth via a string path
                                if($path == '')
                                    $path .= $key;
                                else
                                    $path .= self::PATH_DEPTH_SEPARATOR . $key;
                                // Reset for new level
                                $string = '';
                                $key = '';
                                $value = '';
                                $p = 0;
                            }
                            break;
                        case self::CURLY_BRACE_END:
                            // Ignore character if we are consuming a key/value
                            if(!$reading) {
                                $ptr = &$parsed;
                                $full_path = explode(self::PATH_DEPTH_SEPARATOR, $path);
                                $new_path = '';
                                if(count($full_path) > 0) {
                                    $i = 0;
                                    for($i = 0; $i < count($full_path)-1; $i++) {
                                        if($new_path == '')
                                            $new_path .= $full_path[$i];
                                        else
                                            $new_path .= self::PATH_DEPTH_SEPARATOR . $full_path[$i];
                                        $ptr = &$ptr[$full_path[$i]];
                                    }
                                }
                                $path = $new_path;
                            }
                            break;
                        case self::C_COMMENT:
                            // Only look for comments if we're not currently reading a key or value
                            if(!$reading)
                                $comment_chars_seen++;
                            break;
                        default:
                            $comment_chars_seen = 0;
                    }
                }
                // Reset comment counter
                if($c == self::NEW_LINE) {
                    $comment_chars_seen = 0;
                }
                $lastCharSeen = $c;
            }
        }
        return $parsed;
    }

    public static function cfg($filepath) {
        $filecontent = file_get_contents($filepath);
    }
}
