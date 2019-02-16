<?php
require_once(dirname(__FILE__).'/helper.php');


$i = 1;
$child_count = count($children);

if(intval($props['debug'])){

?>
    <div class="uk-child-width-1-1">
<?php

}else{
?>
    <div class="uk-child-width-auto uk-flex uk-flex-<?= $props['container_alignement']?> uk-grid-<?= $props['grid_size']?>" uk-grid>
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
                if($field->mobile !== false) echo '<div class="uk-hidden@m">'.$field->mobile."</div>\n";
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

    


