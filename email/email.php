<?php
    require_once('../email/class.PHPMailer.php');
    function sendEmail($nameOfCompany, $customerFirstName, $customerLastName, $customerEmail, $order_items, $order_id, $shipping_address, $billing_address) {
        set_time_limit(0);
        $message = '';
        $subtotal = 0;
        //creates html to show subtotal and what customer ordered
        foreach ($order_items as $item) {
            $product_id = $item['productID'];
            $product = get_product($product_id);
            $item_name = $product['productName'];
            $list_price = $item['itemPrice'];
            $savings = $item['discountAmount'];
            $your_cost = $list_price - $savings;
            $quantity = $item['quantity'];
            $line_total = $your_cost * $quantity;
            $subtotal += $line_total;
            $name = htmlspecialchars($item_name);
            $price = sprintf('$%.2f', $list_price);
            $saved = sprintf('$%.2f', $savings);
            $cost = sprintf('$%.2f', $your_cost);
            $total = sprintf('$%.2f', $line_total);

            $message = $message .  "<tr>
                                        <td>$name</td>
                                        <td>$price</td>
                                        <td>$saved</td>
                                        <td>$cost</td>
                                        <td>$quantity</td>
                                        <td>$total</td>
                                    </tr>
            ";
        }
        //vars to help with message HTML creation 
        $customerPhone = $shipping_address['phone'];
        $subtotal_f = sprintf('$%.2f', $subtotal);
        //message to be sent
        $messageHTML = "<html>
                            <head>
                                <title>Thank you for your purchase</title>
                            </head>
                            <body>
                                <h2>We at $nameOfCompany thank you for your order $customerFirstName $customerLastName</h2>
                                <p>Your order has been received and is now being processed. Your order details are shown below for your reference.</p>
                                <h1>Order: #$order_id </h1>
                                <table>
                                    <thead>
                                        <td>Item</td>
                                        <td>List Price</td>
                                        <td>Savings</td>
                                        <td>Your Cost</td>
                                        <td>Quantity</td>
                                        <td>Line Total</td>
                                    </thead>
                                    " . $message . "
                                </table>
                                <p>Order Total: $subtotal_f </p>
                            </body>
                        </html>
                    ";
    //code to send email
    $email = new PHPMailer();
    $email->IsSMTP();
    $email->Host       = "smtp.gmail.com";   
    $email->SMTPAuth   = true; 
    $email->Port       = 465;
    $email->SMTPDebug  = 1;                     
    $email->SMTPSecure = 'ssl';
    $email->Username   = "murielbroom@gmail.com"; 
    $email->Password   = "applepies4me";      
    $email->SetFrom('murielbroom@gmail.com', 'applepie4me'); 
    $email->SingleTo  = true;	
    $email->From      = 'murielbroom@gmail.com'; 
    $email->FromName  = 'Muriel Broom'; 
    $email->Subject   = 'Purchases from Guitar Shop PHP';
    $email->Body      = $messageHTML ; 
    $email->AltBody = $message;            
    $destination_email_address = $customerEmail;
    $destination_user_name = $customerFirstName . " " . $customerLastName;
    //sends email
    $email->AddAddress($destination_email_address, $destination_user_name);
         if(!$email->Send()) {
         echo "Mailer Error: " . $email->ErrorInfo;
          }
    }
?>