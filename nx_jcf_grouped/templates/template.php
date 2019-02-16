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

$i = 1;
$child_count = count($children);

if(intval($props['debug'])){

?>
    <div class="uk-child-width-1-1">
<?php

}else{
?>
    <div class="uk-child-width-auto uk-flex uk-flex-<?= $props['container_alignement']?>" uk-grid>
<?php
}
?>

<?php
if(count($children) > 0){
    foreach($children as $child){
        if(!empty($child->props['fieldname']) && !in_array($child->props['fieldname'], [null, 'name-of-field'])){
            if(array_key_exists($child->props['fieldname'], $cfields)){
                // Shortener
                $field = createElObj($cfields[$child->props['fieldname']]['value'], $child->props, intval($props['debug']));

                echo '<div class="nx-field">'."\n";
                if(!$field->mobile) echo '<div class="uk-hidden@m">'.$field->mobile."</div>\n";
                echo '<div class="uk-visible@m">'.$field->medium."</div>\n";
                echo '</div>'."\n";


            }else{
                if(intval($props['debug'])) echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: Customfield '.$child->props['fieldname'].' not found in this article");</script>'."\n";
            };
        }else{
            if(intval($props['debug'])) echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: no Customfield configured");</script>';
        };

        // Divider
        if(is_numeric($props['divider_interval'])){
            if($i%$props['divider_interval'] === 0){
                if($i+1 <= $child_count){
                    echo '<div class="">' . $props['divider'] . '</div>'."\n";
                };
            };
        }elseif(empty($props['divider_interval'])){
            // not set so do nothing
        }else{
            if(intval($props['debug'])) echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: '.$props['divider_interval'].' is not a numeric value as interval!");</script>'."\n";
        }
        $i++;
    };
};

?>
</div>

    <?php // render node title field by using $props['title'] ?>

    <?php // render node select field by using $props['select'] ?>

    

</div>
