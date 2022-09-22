<?php
  $amount = $_GET["total"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <form method="POST" action="" id="paymentForm">
      <input type="hidden" name="" value="<?php echo $amount ?>"  id="amount">
      <div class="form-group">
        <label for="">Email Address</label>
        <input class="form-control" type="email" name="email" id="email">
      </div>

      <div class="form-group">
        <label for="">Full Name</label>
        <input class="form-control" type="text" name="name" id="">
      </div>

      <div class="form-group">
        <label for="">Shipping Address</label>
        <input class="form-control" type="text" name="add" id="">
      </div>

      <div class="form-group mt-2">
        <button class="btn btn-primary" onclick="payWithPaystack()" >
            Pay Now
        </button>
      </div>
    </form>
    </div>

<script src="https://js.paystack.co/v1/inline.js"></script> 
<script>
      const paymentForm = document.getElementById('paymentForm');
      paymentForm.addEventListener("submit", payWithPaystack, false);
      function payWithPaystack(e) {
      e.preventDefault();

      let handler = PaystackPop.setup({
      key: 'pk_test_7291d5c33dfdc5dd6ead24de40a3c9c1bdc94077', // Replace with your public key
      email: document.getElementById("email").value,
      amount: document.getElementById("amount").value * 100,
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      // label: "Optional string that replaces customer email"
      onClose: function(){
      alert('Window closed.');
      },
      callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
    }
  });

  handler.openIframe();
}
</script>
</body>
</html>