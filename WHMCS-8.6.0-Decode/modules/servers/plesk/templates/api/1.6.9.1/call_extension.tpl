<extension>
    <call>
        <<?= $extension; ?>>
            <<?= $command; ?>>
                <?php foreach ($commandParams as $key => $value) { ?>
                <<?= $key ?>><?= htmlspecialchars($value) ?></<?= $key ?>>
                <?php } ?>
            </<?= $command; ?>>
        </<?= $extension; ?>>
    </call>
</extension>
