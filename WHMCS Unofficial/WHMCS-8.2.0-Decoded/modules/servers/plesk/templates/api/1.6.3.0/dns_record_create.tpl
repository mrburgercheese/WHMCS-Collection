<dns>
    <?php foreach ($dnsRecords as $dnsRecord): ?>
    <add_rec>
        <site-id><?= $pleskSiteId; ?></site-id>
        <type><?= $dnsRecord['type'] ?></type>
        <host/>
        <value><?= $dnsRecord['value'] ?></value>
    </add_rec>
    <?php endforeach; ?>
</dns>
