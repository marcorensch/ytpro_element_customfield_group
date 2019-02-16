<?php

function shortener($string, $n){
    $arr = explode(' ',trim($string));
    if(count($arr) > 1){
        $new_string = '<span class="uk-hidden@m">'.$arr[$n].'</span>';
        $new_string .= '<span class="uk-visible@m">'.$string.'</span>';
    }else{
        $new_string = '<span class="">'.$string.'</span>';
    }
    
    return $new_string;
}

$el = $this->el('div', [

    'class' => [
        'example-element'
    ]

]);

$i = 1;
$child_count = count($children);

?>
<div class="uk-child-width-auto" uk-grid>
<?php
foreach($children as $child){
    if(!empty($child->props['fieldname'])){
        if(array_key_exists($child->props['fieldname'], $cfields)){
            echo '<div class="">' . $cfields[$child->props['fieldname']]['value'] . '</div>';
        }else{
            echo '<div> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: Customfield '.$child['fieldname'].' not found in this article");</div>';
        };
    }else{
        echo '<div> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: no Customfield configured");</div>';
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
        echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: '.$props['divider_interval'].' is not a numeric value as interval!");</script>';
    }
    $i++;
};
?>
</div>
<?= $el($props, $attrs) ?>

    <?php // render node title field by using $props['title'] ?>

    <?php // render node select field by using $props['select'] ?>

    

</div>
