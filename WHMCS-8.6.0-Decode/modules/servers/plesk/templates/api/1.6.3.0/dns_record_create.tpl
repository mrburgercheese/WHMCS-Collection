<dns>
    <?php foreach ($dnsRecords as $dnsRecord): ?>
    <add_rec>
        <site-id><?= $pleskSiteId; ?></site-id>
        <type><?= $dnsRecord['type'] ?></type>
        <?php if ($dnsRecord['host']): ?>
        <host><?= $dnsRecord['host'] ?> </host>
        <?php else: ?>
        <host/>
        <?php endif; ?>
        <value><?= $dnsRecord['value'] ?></value>
        <?php if ($dnsRecord['opt']): ?>
        <opt><?= $dnsRecord['opt'] ?> </opt>
        <?php endif; ?>
    </add_rec>
    <?php endforeach; ?>
</dns>
