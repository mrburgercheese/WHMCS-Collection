<?php
/**
 * @var string|array $keys It is an empty string when the parameter is not set.
 */
?>
<server>
    <get>
        <?php if(empty($keys)): ?>
            <key/>
            <stat/>
        <?php elseif(in_array('gen_info', $keys, true)): ?>
            <gen_info/>
        <?php endif; ?>
    </get>
</server>
