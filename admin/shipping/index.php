<?php
require_once('../../util/main.php');
require_once('util/secure_conn.php');
require_once('util/valid_admin.php');

require_once('model/customer_db.php');
require_once('model/address_db.php');
require_once('model/order_db.php');
require_once('model/product_db.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {        
        $action = 'list_shipped_orders';
    }
}

switch($action) {
    case 'list_shipped_orders':
        $orders = get_filled_orders();
        include("shipped_orders.php");
        break;
    case 'list_unfilled_orders':
        $orders = get_unfilled_orders();
        include("unfilled_orders.php");
        break;
    case 'ship':
        $order_id = $_POST['order_id'];
        set_ship_date($order_id);
        $order = get_order($order_id);
        $customer = get_customer($order['customerID']);
        $ship_address = get_address($order['shipAddressID']);
        $order_number = $order_id;
        $customer_name = $customer['firstName'] . ' ' . $customer['lastName'];
        $customer_email = $customer['emailAddress'];
        $ship_to = $ship_address['line1'] . '</br>' . $ship_address['city'] . ', ' . $ship_address['state'] . ' ' . $ship_address['zipCode'] . '</br>' . $ship_address['phone'];
        $order_items = get_order_items($order_id);
        $ship_date = $order['shipDate'];
        $order_date = $order['orderDate'];
        include("order_shipped.php");
        break;
}

?>