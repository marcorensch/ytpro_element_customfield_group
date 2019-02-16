<?php
function createElObj($string, $childprops, $debug){

    $object = new stdClass();
    $object->mobile = false;
    $object->medium = replacer("%value%", $string, $childprops, $debug);

    $x = $childprops['short_to']-1;

    $arr = explode(' ',trim($string));

    if($childprops['useshort']){
        if($debug) print '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: Shortener for '.$string.'");</script>'."\n";
        if(count($arr) > 1 && count($arr) >= $x){
            $object->mobile = replacer("%value%", $arr[$x], $childprops, $debug);
        }else{
            if($debug) print '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: Shortener for '.$string.' has a too high value or the string is too short - no shortener used!");</script>'."\n";
            $object->mobile = replacer("%value%", $string, $childprops, $debug);
        };
    }else{

    };
    if($debug) echo '<div><h4>Debug Info for Field:</h4>'.$string."\n".'<br><pre>' . var_export($object, true) . '</pre></div>';
    return $object;
};

function replacer($search, $replace, $childprops, $debug){

    

    if($childprops['template'] !== '' && strpos( $childprops['template'], $search) !== false ){
        if($debug){
            echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro Templater");</script>'."\n";
            echo '<script> console.log("Template: '.$childprops['template'].'");</script>'."\n";
            echo '<script> console.log("Search for: '.$search.'");</script>'."\n";
            echo '<script> console.log("Replace with: '.$replace.'");</script>'."\n";
            echo '<script> console.log("Stringpos for Search: '.strpos($childprops['template'], $search).'");</script>'."\n";
        };
        $string = str_replace($search, $replace, $childprops['template']);

        return $string;

    }else{
        return $replace;
    };
};
?>