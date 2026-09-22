<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            
            .search-box {
                background: white;
                padding: 20px;
                margin-bottom: 25px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            }

            .search-row {
                display: flex;
                gap: 15px;
                flex-wrap: wrap;
                align-items: end;
            }

            .search-field {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .search-field label {
                font-weight: bold;
                font-size: 14px;
            }

            .search-field input,
            .search-field select {
                padding: 9px;
                min-width: 170px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .button-group {
                display: flex;
                gap: 10px;
            }

            button {
                padding: 10px 18px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            #searchButton {
                background: #008cff;
                color: white;
            }

            #resetButton {
                background: #ddd;
                color: #333;
            }

            button:hover {
                opacity: 0.85;
            }

            .message {
                margin-bottom: 15px;
                font-weight: bold;
            }

            .error {
                color: red;
            }

            .loading {
                color: #555;
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

            .sale {
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

            <div class="search-box">
                <h2>Search Transaction</h2>

                <div class="search-row">

                    <div class="search-field">
                        <label for="transaction">Transaction</label>
                        <select id="transaction">
                            <option value="both">Both</option>
                            <option value="sale">Sales</option>
                            <option value="purchase">Purchase</option>
                        </select>
                    </div>

                    <div class="search-field">
                        <label for="searchBy">Search By</label>
                        <select id="searchBy">
                            <option value="employee_name">Employee Name</option>
                            <option value="employee_id">Employee ID</option>
                            <option value="record_id">Record ID</option>
                            <option value="description">Description</option>
                        </select>
                    </div>

                    <div class="search-field">
                        <label for="keyword">Keyword</label>
                        <input type="text" id="keyword" placeholder="Enter keyword">
                    </div>

                    <div class="search-field">
                        <label for="type">Type</label>
                        <select id="type">
                            <option value="">All</option>
                            <option value="Product">Product</option>
                            <option value="Resource">Resource</option>
                        </select>
                    </div>

                    <div class="search-field">
                        <label for="dateFrom">Date From</label>
                        <input type="date" id="dateFrom">
                    </div>

                    <div class="search-field">
                        <label for="dateTo">Date To</label>
                        <input type="date" id="dateTo">
                    </div>

                    <div class="search-field">
                        <label for="timeFrom">Time From</label>
                        <input type="time" id="timeFrom" step="1">
                    </div>

                    <div class="search-field">
                        <label for="timeTo">Date To</label>
                        <input type="time" id="timeTo" step="1">
                    </div>

                    <div class="button-group">
                        <button type="button" id="searchButton">Search</button>

                        <button type="button" id="resetButton">Reset</button>
                    </div>
                </div>
            </div>

            <h2>Transactions</h2>

            <div id="message" class="message"></div>

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
                        <th>Time</th>
                    </tr>
                </thead>
            

                <tbody id="transactionTableBody">

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

                                <td>
                                    <?= esc($transaction['transaction_time']) ?>
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

        <script>
            document.getElementById('searchButton').addEventListener('click', searchTransactions);
            document.getElementById('resetButton').addEventListener('click', resetSearch);

            async function searchTransactions()
            {
                const transaction = document.getElementById('transaction').value;
                const searchBy = document.getElementById('searchBy').value;
                const keyword = document.getElementById('keyword').value;
                const type = document.getElementById('type').value;
                const dateFrom = document.getElementById('dateFrom').value;
                const dateTo = document.getElementById('dateTo').value;
                const timeFrom = document.getElementById('timeFrom').value;
                const timeTo = document.getElementById('timeTo').value;

                const requestData = {
                    transaction: transaction,
                    search_by: searchBy,
                    keyword: keyword,
                    type: type,
                    date_from: dateFrom,
                    date_to: dateTo,
                    time_from: timeFrom,
                    time_to: timeTo
                };

                localStorage.setItem(
                    'salesManagementSearch',
                    JSON.stringify(requestData)
                );

                const message = document.getElementById('message');

                message.textContent = 'Searching...';

                message.className = 'message loading';

                try {
                    const response = await fetch(
                        '<?=  base_url('api/transactions/search') ?>',
                        {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },

                            body: JSON.stringify(requestData)
                        }
                    );

                    const result = await response.json();

                    if (result.status !== 'success') {
                        throw new Error(
                            result.message || 'Search Failed.'
                        );
                    }

                    displayTransactions(result.data);

                    message.textContent = `${result.count} transaction(s) found.`;

                    message.className = 'message';
                }
                catch (error) {
                    console.error(error);

                    message.textContent = error.message;

                    message.className = 'message error';
                }
            }

            function displayTransactions(transactions) 
            {
                const tableBody = document.getElementById('transactionTableBody');

                tableBody.innerHTML = '';

                if(transactions.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="11">No Transaction found.</td>
                        </tr>
                    `;

                    return;
                }

                transactions.forEach(transaction => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        <td>
                            ${escapeHtml(transaction.record_id)}
                        </td>


                        <td>
                            <span class="${escapeHtml(transaction.transaction_type)}">
                                ${escapeHtml(transaction.transaction_type.toUpperCase())}
                            </span>
                        </td>

                        <td>
                            ${escapeHtml(transaction.employee_name)}
                            <br>
                            <small>
                                ${escapeHtml(transaction.employee_id)}
                            </small>
                        </td>

                        <td>
                            ${escapeHtml(transaction.item_name)}
                        </td>

                        <td>
                            ${escapeHtml(transaction.category)}
                        </td>

                        <td>
                            ${escapeHtml(transaction.type)}
                        </td>

                        <td>
                            ${escapeHtml(transaction.description || '')}
                        </td>

                        <td>
                            ${escapeHtml(transaction.quantity)}
                        </td>

                        <td>
                            RM ${formatMoney(transaction.unit_price)}
                        </td>

                        <td>
                            RM ${formatMoney(transaction.total_amount)}
                        </td>

                        <td>
                            ${escapeHtml(transaction.transaction_date)}
                        </td>

                        <td>
                            ${escapeHtml(transaction.transaction_time)}
                        </td>

                    `;

                    tableBody.appendChild(row);
                });
            }

            function resetSearch()
            {
                localStorage.removeItem('salesManagementSearch');

                document.getElementById('transaction').value = 'both';
                document.getElementById('searchBy').value = 'employee_name';
                document.getElementById('keyword').value = '';
                document.getElementById('type').value = '';
                document.getElementById('dateFrom').value = '';
                document.getElementById('dateTo').value = '';
                document.getElementById('timeFrom').value = '';
                document.getElementById('timeTo').value = '';

                document.getElementById('message').textContent = '';

                window.location.reload();
            }

            function formatMoney(value) 
            {
                return Number(value).toLocaleString(
                    'en-MY',
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                );
            }

            function escapeHtml(value)
            {
                const div=document.createElement('div');

                div.textContent=value ?? '';

                return div.innerHTML;
            }

            function setDefaultDates()
            {
                const today = new Date();

                const lastMonth = new Date(today);

                lastMonth.setMonth(
                    lastMonth.getMonth() - 1
                )

                document.getElementById('dateTo').value = formatDate(today);
                document.getElementById('dateFrom').value = formatDate(lastMonth);

                document.getElementById('timeFrom').value = '00:00:00';
                document.getElementById('timeTo').value = '23:59:59';
            }

            function formatDate(date)
            {
                const year = date.getFullYear();

                const month = String(date.getMonth() + 1).padStart(2, '0');

                const day = String(date.getDate()).padStart(2, '0');

                return `${year}-${month}-${day}`;
            }

            document.addEventListener('DOMContentLoaded', function () {

                const savedSearch = localStorage.getItem('salesManagementSearch');

                if (savedSearch) {
                    const data = JSON.parse(savedSearch);

                    document.getElementById('transaction').value = data.transaction || 'both';
                    document.getElementById('searchBy').value = data.search_by || '';
                    document.getElementById('keyword').value = data.keyword || '';
                    document.getElementById('type').value = data.type || '';
                    document.getElementById('dateFrom').value = data.date_from || '';
                    document.getElementById('dateTo').value = data.date_to || '';
                    document.getElementById('timeFrom').value = data.time_from || '00:00:00';
                    document.getElementById('timeTo').value = data.time_to || '23:59:59';

                    searchTransactions();
                } else {
                    setDefaultDates();

                    searchTransactions();
                }
            });

            document.getElementById('transaction').addEventListener('change', function () {
                searchTransactions();
            })
        </script>
    </body>
</html>