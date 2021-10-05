<?php
    function currencyConverter ($amount, $from_Currency, $to_Currency) 
    {
        $from_Currency = urlencode(strtoupper($from_Currency));
        $to_Currency = urlencode(strtoupper($to_Currency));
        $from_to = $from_Currency."_".$to_Currency;
        $apikey = "e63fe03032026658d7d9";
        $url = file_get_contents("http://free.currconv.com/api/v7/convert?q=$from_to&compact=ultra&apiKey=$apikey");
       
        $json = json_decode($url, true);
        
            $ratevalue = $json[$from_Currency . '_' . $to_Currency];
            
            $output = $amount * $ratevalue;
            
            return "<h2>".$output ." ". $to_Currency."<h2>";
    }
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Currency Converter</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Currency Converter</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <h3>From</h3>
                <select class="form-select" name="from_currency">
                    <?php 
                    if (isset($_POST['from_currency'])) {?>
                        <option value="<?php echo $_POST['from_currency']; ?>"><?php echo $_POST['from_currency']; ?></option>
                    <?php } ?>
                    <option value="HUF">HUF</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                </select>
            </div>
            <div class="mb-3">
                <h3>To</h3>
                <select class="form-select" name="to_currency">
                <?php 
                    if (isset($_POST['to_currency'])) {?>
                        <option value="<?php echo $_POST['to_currency']; ?>"><?php echo $_POST['to_currency']; ?></option>
                    <?php } ?>
                <option value="USD">USD</option>
                <option value="HUF">HUF</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                </select>
            </div>
            <div class="mb-3">
                <h3>Amout</h3>
                <input type="number" name="amount" value="<?php echo $_POST['amount']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    <?php
    
    if (isset($_POST['amount'])) {

        $amount = $_POST['amount'];
        $from_currency = $_POST['from_currency'];
        $to_currency = $_POST['to_currency'];

        echo currencyConverter($amount, $from_currency, $to_currency );
    }
    ?>

    </div>
</body>
</html>