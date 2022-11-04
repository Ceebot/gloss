<?php
function vueTag($classname, $props = []) {
    return "<div class='".$classname."' data-vue='".json_encode($props)."'></div>";
}
