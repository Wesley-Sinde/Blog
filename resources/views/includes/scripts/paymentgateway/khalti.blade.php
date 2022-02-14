
<script src="https://khalti.com/static/khalti-checkout.js"></script>

<!-- Place this where you need payment button -->
<!-- Paste this code anywhere in you body tag -->
<script>
    $(document).ready(function () {
        $('.payment-button').click(function () {
            $due = $(this).data('due');
            productIdentity = $(this).data('product-identity');
            productName = $(this).data('product-name');
            currentUrl = window.location.href;
            var config = {
                // replace the publicKey with yours
                "publicKey": "test_public_key_df221a6ddfac407daba868fb2a356aad",
                "productIdentity": productIdentity,
                "productName": productName,
                "productUrl": currentUrl,
                "eventHandler": {
                    onSuccess (payload) {
                        // hit merchant api for initiating verfication




                        console.log(payload);
                    },
                    onError (error) {
                        console.log(error);
                    },
                    onClose () {
                        console.log('widget is closing');
                    }
                }
            };

            var checkout = new KhaltiCheckout(config);
            $amt = parseInt(Number($due));
            checkout.show($amt);
        });
    });

   /* var btn = document.getElementsByClassName("payment-button");
    btn.onclick = function () {
        var due = $(this).data('due');
        console.log(due);
        checkout.show({amount: $(this).data('due')});
    }*/


</script>
<!-- Paste this code anywhere in you body tag -->