<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <link rel="stylesheet" href="styles.css">
    @include('shared.imports')
    @include('shared.navbar')

</head>

<body>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6" style="margin-top: 5rem;">
                        <h1 class="m-0">Order List</h1>
                    </div>
                    <div class="rounded m-2 p-2">
                        <div>
                            <div class="bg-white m-4 p-4 rounded">
                                <div class="border p-2 rounded">
                                    <table id="orderTable" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Order ID</th>
                                                <th class="text-center">Item Purchased</th>
                                                <th class="text-center">Total Price</th>
                                                <th class="text-center">Payment Type</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($results as $row) {
                                                ?>
                                            <tr id="<?php echo $row->orderId; ?>">
                                                <td class="text-center">
                                                    ORD-<?php echo $row->orderId; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row->itemName; ?>
                                                </td>
                                                <td class="text-center">
                                                    ₱ <?php echo $row->totalPrice; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row->paymentType; ?>
                                                </td>
                                                <td class="text-center">
                                                    <button title="View Orders" class="btn btn-outline-info btnView"
                                                        data-bs-toggle="modal" data-id="<?php echo $row->orderId; ?>"
                                                        data-bs-target="#viewModal" id="btnViewOrders">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static" id="viewModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form>
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Purchased Item</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <input type="hidden" class="form-control" id="hdnOrderId" name="hdnOrderId">
                    <div class="container p-3">
                        <form id="viewOrders">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="orderId" class="col-form-label">Order ID</label>
                                        <input type="text" class="form-control" id="orderId" name="orderId"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="itemName" class="col-form-label">Item Name</label>
                                        <input type="text" class="form-control" id="itemName" name="itemName"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="totalPrice" class="col-form-label">Total Price</label>
                                        <input type="text" class="form-control" id="totalPrice" name="totalPrice"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="initialPrice" class="col-form-label">Price</label>
                                        <input type="text" class="form-control" id="initialPrice" name="initialPrice"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="quantity" class="col-form-label">Quantity</label>
                                        <input type="text" class="form-control" id="quantity" name="quantity"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="orderedDate" class="col-form-label">Order Date</label>
                                        <input type="text" class="form-control" name="orderedDate"
                                            id="orderedDate" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="paymentType" class="col-form-label">Payment Type</label>
                                        <input type="text" class="form-control" id="paymentType"
                                            name="paymentType" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="refNum" class="col-form-label">Reference Number</label>
                                        <input type="text" class="form-control" id="refNum"
                                            name="refNum" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('#orderTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": 4
            }]
        });
    });

    $('body').on('click', '.btnView', function() {
        var orderId = $(this).attr('data-id');
        console.log(orderId);
        $.ajax({
            url: '/viewOrder',
            type: "GET",
            data: {
                orderId: orderId
            },
            dataType: 'json',
            success: function(res) {
                let result = res.results[0];
                $('#viewModal #orderId').val("ORD-" + result.orderId);
                $('#viewModal #itemName').val(result.itemName);
                $('#viewModal #totalPrice').val(result.totalPrice);
                $('#viewModal #initialPrice').val(result.initialprice);
                $('#viewModal #quantity').val(result.quantity);
                $('#viewModal #orderedDate').val(result.orderDate);
                $('#viewModal #paymentType').val(result.paymentType);
                $('#viewModal #refNum').val(result.refNum);
            },
            error: function(data) {}
        });
    });
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

</html>
