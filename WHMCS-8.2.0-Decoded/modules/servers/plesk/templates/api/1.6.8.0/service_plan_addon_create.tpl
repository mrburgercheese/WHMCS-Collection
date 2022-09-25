<service-plan-addon>
    <add>
        <name><?= $name; ?></name>
        <?php if (isset($limits)) { ?>
            <limits>
                <?php foreach ($limits as $limitName => $limitAmount) { ?>
                    <limit>
                        <name><?= $limitName ?></name>
                        <value><?= $limitAmount ?></value>
                    </limit>
                <?php } ?>
            </limits>
        <?php } ?>
        <permissions>
        <?php foreach ($permissions as $permission => $permissionValue) { ?>
            <permission>
                <name><?= $permission; ?></name>
                <value><?= $permissionValue ?></value>
            </permission>
        <?php } ?>
        </permissions>
    </add>
</service-plan-addon>
