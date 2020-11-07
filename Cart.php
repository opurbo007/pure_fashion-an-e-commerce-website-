<?php
include("include/head.php")
?>
   
        <!-- <li class="nav-item active">
    <a class="nav-link cart-item-count" href="cart.html" data-pure-items-count><span
            class="fa fa-shopping-cart"></span> Shopping Cart</a>
</li> -->
        <div>
            <div>
                <div>
                    <h3 class="name2">Your Cart</h3>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <hr>
                    <tbody id="cart-items">
                    </tbody>
                    <hr>
                    <tfoot>

                        <tr>
                            <td class="clear"><a href="javascript:;" class="btn-danger" data-pure-clear-basket>Clear Cart</a></td>
                            <td></td>

                            <td class="total">Total</td>
                            <td class="text-right total" id="total-value"><strong>$0</strong></td>

                        </tr>

                    </tfoot>

                </table>

            </div>

            <div class="purchase">
                <a href="order.php" id="purchase"> Purchase &#10146;</a>
            </div>
        </div>





<script src="./js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.min.js"></script>
<script src="./js/main.js"></script>
<script type="application/javascript">
    function initListaOrcamento() {
        var products = $.Purefashion({
                debug: true
            }).getItems(),
            totalValueTemp = 0,
            $cartItems = $('#cart-items');

        if (!products) {
            console.log("No items in cart!");
            return;
        }

        function updateTotalValue() {

            var totalValue = 0;

            $.each($('[data-item-total-value]'), function(index, item) {
                totalValue += $(item).data('item-total-value');
            });

            $('#total-value').html("$" + parseFloat(totalValue).toFixed(2));
        }

        function mountLayout(index, data) {
            var totalValueTemp = parseFloat(data.unity_price) * parseInt(data.quantity);

            var $layout = "<tr id='product-" + index + "'><td class='col-sm-8 col-md-6'><div class='media' style='text-align:center'>" +
                "<img class='d-flex align-self-center mr-3' width='110px' height='110px'  src='" + index + "' alt=''>" +
                "<div class='media-body'>" +
                "<h5 class='mt-0'>" + data.product_name + "</h5>" +
                "</div></div></td><td class='col-sm-1 col-md-1' style='text-align: center'>" + data.quantity +
                "<td class='col-sm-1 col-md-1' style='text-align: center'><strong>$" + data.unity_price + "</strong></td>" +
                "<td class='col-sm-1 col-md-1 ' style='text-align: center' data-item-total-value='" + totalValueTemp + "'><strong>$" + parseFloat(totalValueTemp).toFixed(2) + "</strong></td>" +
                "<td class='col-sm-1 col-md-1'>";
            //  +
            // "<a href='javascript:;' class='btn-remove fa fa-trash'   data-pure-delete-item='" + index + "'><span class='sr-only' >Remove</span></a>" +
            // "</td></tr>";

            $cartItems.append($layout);
        }


        $.each(products, function(index, value) {
            mountLayout(index, value);
        });

        updateTotalValue();

        $(document).on('click', 'a[data-pure-delete-item]', function(e) {
            e.preventDefault();

            var productId = $(this).data('pure-delete-item');

            if ($(document).on('pure-item-deleted')) {
                $('#product-' + productId).fadeOut(500, function() {
                    $(this).remove();
                    updateTotalValue();
                });
            }
        });

        $(document).on('pure-clear-basket', function(e) {
            $('#cart-items tr').each(function(index, value) {
                $(value).fadeOut(500, function() {
                    $(this).remove();
                    updateTotalValue();
                });
            });
        });

    }

    $(document).ready(function() {

        initListaOrcamento();

    });
</script>
</body>
</html>