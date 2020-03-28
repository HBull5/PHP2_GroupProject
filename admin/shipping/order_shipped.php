<?php include '../../view/header.php'; ?>
<?php include '../../view/sidebar_admin.php'; ?>
<main>
    <h1>Order Shipped</h1>
    <p>Order Number: <?php echo($order_id); ?></p>
    <p>Order Date: <?php echo($order_date); ?></p>
    <p>Customer: <?php echo($customer_name); ?></p>
    <h2>Shipping</h2>
    <p>Ship Date: <?php echo($ship_date); ?></p>
    <p><?php echo($ship_to); ?></p>
    <h2>Order Items</h2>
    <table>
        <thead>
            <tr>
                <th class="left">Item</th>
                <th class="left">Quantites</th>
            </tr>
        </thead>
        <?php foreach($order_items as $row): ?>
            <?php 
                include_once("../../model/product_db.php");
                $product = get_product($row['productID']);
                $productName = $product['productName'];
            ?>
            <tr>
                <td><?php echo($productName); ?></td>
                <td><?php echo($row['quantity']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
<?php include '../../view/footer.php'; ?>