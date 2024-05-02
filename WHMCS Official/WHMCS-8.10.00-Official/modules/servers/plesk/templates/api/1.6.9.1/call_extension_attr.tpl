<extension>
    <call>
        <<?= $extension; ?>>
            <<?= $command; ?><?php foreach ($commandParams as $key => $value) { ?> <?= $key ?>="<?= htmlspecialchars($value) ?>"<?php } ?>/>
        </<?= $extension; ?>>
    </call>
</extension>
