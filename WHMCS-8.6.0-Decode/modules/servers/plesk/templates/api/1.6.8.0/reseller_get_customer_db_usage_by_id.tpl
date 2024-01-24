<webspace>
    <get>
        <filter>
            <?php foreach ($ownerIds as $ownerId): ?>
            <owner-id><?= $ownerId ?></owner-id>
            <?php endforeach; ?>
        </filter>
        <dataset>
            <disk_usage/>
        </dataset>
    </get>
</webspace>
