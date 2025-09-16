<!-- Copyright 1999-2016. Parallels IP Holdings GmbH. -->
<webspace>
    <get>
        <filter>
            <?php foreach($domains as $domain): ?>
            <name><?php echo $domain; ?></name>
            <?php endforeach; ?>
        </filter>
        <dataset>
            <gen_info/>
            <hosting/>
            <limits/>
            <stat/>
            <disk_usage/>
            <resource-usage/>
        </dataset>
    </get>
</webspace>
<site>
    <get>
        <filter>
            <?php foreach($domains as $domain): ?>
            <parent-name><?php echo $domain; ?></parent-name>
            <?php endforeach; ?>
        </filter>
        <dataset>
            <stat/>
        </dataset>
    </get>
</site>
