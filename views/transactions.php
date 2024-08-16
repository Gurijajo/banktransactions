<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Check Number</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transactions)): ?>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?php echo formatdate($transaction['date']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['checkNumber']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                            <td><?php if($transaction['amount']<0):?>
                                        <span style="color:red;"><?php echo formatDollarAmount($transaction['amount']); ?></td></span>
                                    <?php elseif($transaction['amount']>0):?>
                                        <span style="color:green;"><?php echo formatDollarAmount($transaction['amount']); ?></span>
                                <?php endif?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No transactions available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot class="bg-light">
                <tr>
                    <th colspan="3"  class="text-end">Total Income</th>
                    <th id="total-income" ><?php if($totals['totalIncome']<0):?>
                            <span style="color:red;"><?php echo formatDollarAmount($totals['totalIncome'] ?? 0); ?></th></span>
                            <?php elseif($totals['totalIncome']>0):?>
                            <span style="color:green;"><?php echo formatDollarAmount($totals['totalIncome'] ?? 0); ?></th></span>
                            <?php endif?>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Total Expenses</th>
                    <th id="total-expenses"><?php if($totals['totalExpense']<0):?>
                            <span style="color:red;"><?php echo formatDollarAmount($totals['totalExpense'] ?? 0); ?></th></span>
                            <?php elseif($totals['totalExpense']>0):?>
                            <span style="color:green;"><?php echo formatDollarAmount($totals['totalExpense'] ?? 0); ?></th></span>
                            <?php endif?>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Net Total</th>
                    <th id="net-total"><?php if($totals['netTotal']<0):?>
                            <span style="color:red;"><?php echo formatDollarAmount($totals['netTotal'] ?? 0); ?></th></span>
                            <?php elseif($totals['netTotal']>0):?>
                            <span style="color:green;"><?php echo formatDollarAmount($totals['netTotal'] ?? 0); ?></th></span>
                            <?php endif?>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


</body>
</html>