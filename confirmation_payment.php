<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Payment Page</title>
    <!-- Bootstrap CSS -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h3>Payment Confirmation</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="orderID" class="form-label">Order ID</label>
                    <input type="text" id="orderID" class="form-control" value="ORD123456789" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="amount" class="form-label">Jumlah (RM)</label>
                    <input type="text" id="amount" class="form-control" value="150.00" readonly>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-success">Confirm Payment</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
