<?php include '../../view/header.php'; ?>
<?php include '../../view/sidebar_admin.php'; ?>
<main>
    <h1>Shipping Department - Shipped Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Order Date</th>
                <th>Ship Date</th>
            </tr>
        </thead>
        <?php foreach($orders as $row): ?>
            <tr>
                <td><?php echo( $row['firstName'] . " " . $row['lastName']); ?></td>
                <td><?php echo($row['orderDate']); ?></td>
                <td><?php echo($row['shipDate']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="index.php?action=list_unfilled_orders">List Unfilled Orders</a></p>
</main>
<?php include '../../view/footer.php'; ?>