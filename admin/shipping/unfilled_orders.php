<?php include '../../view/header.php'; ?>
<?php include '../../view/sidebar_admin.php'; ?>
<main>
    <h1>Shipping Department - Unfilled Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Order Date</th>
                <th></th>
            </tr>
        </thead>
        <?php foreach($orders as $row): ?>
            <tr>
                <td><?php echo( $row['firstName'] . " " . $row['lastName']); ?></td>
                <td><?php echo($row['orderDate']); ?></td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="ship" />
                        <input type="hidden" name='order_id' value="<?php echo($row['orderID']); ?>" />
                        <input type="submit" value='Ship' />
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="index.php?action=list_shipped_orders">List Shipped Orders</a></p>
</main>
<?php include '../../view/footer.php'; ?>