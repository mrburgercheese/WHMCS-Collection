<?php
/**
 * @var string|array $filter
 * @var string|array $dataset
 */
?>
<webspace>
    <get>
        <?php if (empty($filter)): // Filter ?>
            <filter/>
        <?php else: // Filter ?>
            <filter>
                <?php foreach ($filter['owner-login'] as $ownerLogin): // Owner login ?>
                    <owner-login><?= $ownerLogin ?></owner-login>
                <?php endforeach; // Owner login ?>
            </filter>
        <?php endif; // Filter ?>
        <dataset>
            <?php if (empty($dataset)): // Dataset ?>
                <hosting/>
                <subscriptions/>
            <?php else: // Dataset ?>
                <?php if(in_array('gen_info', $dataset, true)): // gen_info ?>
                    <gen_info />
                <?php endif; // gen_info ?>
            <?php endif; // Dataset ?>
        </dataset>
    </get>
</webspace>
