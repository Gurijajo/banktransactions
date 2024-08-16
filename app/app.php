<?php

declare(strict_types = 1);


function getTransactionFiles(string $dirPath): array
{
    $files = [];

    foreach(scandir($dirPath) as $file){
        if(is_dir($dirPath . $file)){
            continue;
        }
       $files[] =$dirPath . $file;
    }

    return $files;
}


function getTransactions(string $filename, ?callable $transactionHandler = null): array
{
    if(!file_exists($filename)){
        trigger_error('File"'. $filename .'"does not exist.',E_USER_ERROR);
    }

    $file = fopen($filename, 'r');

    fgetcsv($file);

    $transactions = [];

    while(($transaction = fgetcsv($file)) !== false){
        if($transactionHandler !== null){
            $transaction = $transactionHandler($transaction);
        }
        $transactions[] = $transaction;
    }

    fclose($file);

    return $transactions;

}

function extractTransaction(array $transactiononRow): array
{
    [$date, $checkNumber, $description, $amount]= $transactiononRow;

    $amount = (float)str_replace(['$', ','], '', $amount);

    return[
        'date' => $date,
        'checkNumber'=> $checkNumber,
        'description' => $description,
        'amount' => $amount,
    ];

}

function calculatetotal(array $transactions): array
{
    $totals =['netTotal'=>0, 'totalIncome'=>0, 'totalExpense'=>0];

    foreach($transactions as $transaction){
        $totals['netTotal'] += $transaction['amount'];

        if($transaction['amount'] >= 0 ){
            $totals['totalIncome']+= $transaction['amount'];
        }else{
            $totals['totalExpense'] += $transaction['amount'];
        }
    }
    
    return $totals;
}


function formatDollarAmount(float $amount): string{
    $isnegative = $amount < 0;

    return($isnegative ? '-' : '') . '$' . number_format(abs($amount), 2);
}


function formatdate(string $date): string{
    return date('M j, Y', strtotime($date));
}