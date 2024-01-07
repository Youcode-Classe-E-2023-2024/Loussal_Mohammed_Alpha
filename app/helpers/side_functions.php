<?php 
function isAnyElementEmpty($arr) {
    foreach ($arr as $element) {
        if (empty($element)) {
            return true;
        }
    }
    return false;
}
?>