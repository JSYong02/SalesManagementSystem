<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width", initial-scale=1.0>

        <title>Sales Management System</title>

        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 30px;
                background: #f5f5f5;
            }

            h1 {
                margin-bottom: 25px;
            }

            .container {
                max-width: 1400px;
                margin: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                background: white;
            }

            th, td{
                padding: 12px;
                border: 1px solid #ddd;
                text-align: left;
            }

            th {
                background: #eee;
            }

            .sales {
                color: green;
                font-weight: bold;
            }

            .purchase {
                color: red;
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <div class="container">

            <h1>Sales Management System</h1>

            <h2>Lastest Transactions</h2>

            <table>
                <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Transaction</th>
                        <th>Employee</th>
                        <th>Item</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
            

                <tbody>
                    <?php if (!empty($transactions)): ?>

                        <?php foreach ($transactions as $transaction): ?>

                            <tr>
                                <td>
                                    <?=  esc($transaction['record_id']) ?>
                                </td>

                                <td>
                                    <span class="<?= esc($transaction['transaction_type']) ?>">
                                        <?=  strtoupper(esc($transaction['transaction_type'])) ?>
                                    </span>
                                </td>

                                <td>
                                    <?= esc($transaction['employee_name']) ?>
                                    <br>
                                    <small>
                                        <?= esc($transaction['employee_id']) ?>
                                    </small>
                                </td>

                                <td>
                                    <?= esc($transaction['item_name']) ?>
                                </td>

                                <td>
                                    <?= esc($transaction['category']) ?>
                                </td>

                                <td>
                                    <?= esc($transaction['type']) ?>
                                </td>

                                <td>
                                    <?= esc($transaction['description']) ?>
                                </td>

                                <td>
                                    <?= esc($transaction['quantity']) ?>
                                </td>

                                <td>
                                    RM <?= number_format($transaction['unit_price'], 2) ?>
                                </td>

                                <td>
                                    RM <?= number_format($transaction['total_amount'], 2) ?>
                                </td>

                                <td>
                                    <?= esc($transaction['transaction_date']) ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="11">
                                No transactions found.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </body>
</html>