<?php

function shortener($string, $n){
    $x = $n-1;
    $arr = explode(' ',trim($string));
    if(count($arr) > 1 && count($arr) >= $x){
        $new_string = '<span class="uk-hidden@m">'.$arr[$x].'</span>';
        $new_string .= '<span class="uk-visible@m">'.$string.'</span>';
    }else{
        $new_string = '<span class="">'.$string.'</span>';
    }
    
    return $new_string;
};

function templater($string, $templatestring){
    return $html;
};

$el = $this->el('div', [

    'class' => [
        'example-element'
    ]

]);

$i = 1;
$child_count = count($children);

?>
<div class="uk-child-width-auto uk-flex uk-flex-<?= $props['container_alignement']?>" uk-grid>
<?php
if(count($children) > 0){
    foreach($children as $child){
        if(!empty($child->props['fieldname']) && !in_array($child->props['fieldname'], [null, 'name-of-field'])){
            if(array_key_exists($child->props['fieldname'], $cfields)){
                // Shortener
                if($child->props['useshort']){
                    $string = shortener($cfields[$child->props['fieldname']]['value'], $child->props['short_to']);
                }else{
                    $string = $cfields[$child->props['fieldname']]['value'];
                };
                // Templater
                if(!empty($child->props['template']) && strpos('%value%', $child->props['template'])){
                    $tmpl_string = templater($string, $child->props['template']);
                }else{
                    if(intval($props['debug'])) echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: Customfield Template not setted up");</script>';
                    $tmpl_string = $string;
                };
                echo '<div class="">' . $tmpl_string . '</div>';
            }else{
                if(intval($props['debug'])) echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: Customfield '.$child->props['fieldname'].' not found in this article");</script>';
            };
        }else{
            if(intval($props['debug'])) echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: no Customfield configured");</script>';
        };
        // Divider
        if(is_numeric($props['divider_interval'])){
            if($i%$props['divider_interval'] === 0){
                if($i+1 <= $child_count){
                    echo '<div class="">' . $props['divider'] . '</div>';
                };
            };
        }elseif(empty($props['divider_interval'])){
            // not set so do nothing
        }else{
            if(intval($props['debug'])) echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: '.$props['divider_interval'].' is not a numeric value as interval!");</script>';
        }
        $i++;
    };
};

?>
</div>
<?= $el($props, $attrs) ?>

    <?php // render node title field by using $props['title'] ?>

    <?php // render node select field by using $props['select'] ?>

    

</div>
