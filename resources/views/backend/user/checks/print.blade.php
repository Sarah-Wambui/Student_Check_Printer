<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Check - {{ $check->check_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 2rem;
            background: #f5f5f5;
        }
        .check-container {
            width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background: #fff;
            border: 2px solid #000;
            border-radius: 8px;
        }
        .check-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        .check-title {
            font-size: 24px;
            font-weight: bold;
        }
        .check-body {
            margin-bottom: 2rem;
        }
        .field-label {
            font-weight: bold;
            width: 150px;
            display: inline-block;
        }
        .amount {
            font-size: 20px;
            font-weight: bold;
        }
        .footer {
            text-align: right;
            margin-top: 3rem;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .check-container {
                border: none;
                width: 100%;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="check-container">
        <div class="check-header">
            <div class="check-title">Check #{{ $check->check_number }}</div>
            <div class="date">Date: {{ $check->created_at->format('Y-m-d') }}</div>
        </div>

        <div class="check-body">
            <p><span class="field-label">Payee:</span> {{ $check->company->name }}</p>
            <p><span class="field-label">Amount:</span> $<span class="amount">{{ number_format($check->amount, 2) }}</span></p>
        </div>
    </div>

    <script>
        // Optional: Automatically open print dialog
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
