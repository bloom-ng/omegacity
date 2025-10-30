<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receipt : REC-{{ $receipt->created_at->format("Ymd") }}{{ $receipt->id }}</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 40px;
            font-size: 12px;
            color: #000;
            background-color: #fff;
            box-sizing: border-box;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .totals-table {
            width: 40%;
            float: right;
            margin-top: 30%;
            border-collapse: collapse;
        }

        .footer {
            clear: both;
            margin-top: 70px;
            border-top: 1px solid #000;
            padding-top: 8px;
            font-size: 11px;
        }

        .footer-section {
            display: table;
            width: 100%;
        }

        .footer-cell {
            display: table-cell;
            width: 33%;
            vertical-align: top;
            padding: 3px;
        }

        .footer h4 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }

        .footer ol {
            margin: 0;
            padding-left: 14px;
        }
    </style>
</head>

<body>

    <!-- Company Logo -->
    <div style="padding: 0; margin: 0;">
        <img src="{{ public_path("assets/images/omegacitylogo.png") }}" alt="Company Logo"
            style="display: block; width: 280px; margin: 0;">
    </div>

    <!-- Header Info -->
    <div style="display: table; width: 100%; border-bottom: 2px solid #000; margin-top: 10px;">
        <div style="display: table-row;">
            <div style="display: table-cell; width: 33%; padding: 5px; vertical-align: top;">
                {{ \Carbon\Carbon::parse($receipt->date)->format("jS F Y") }}<br>
                {{ $receipt->client->first_name }} {{ $receipt->client->last_name }}
            </div>
            <div style="display: table-cell; width: 33%; padding: 5px; vertical-align: top;">
                REC-{{ $receipt->created_at->format("Ymd") }}{{ $receipt->id }} <br>
                {{ $receipt->client->address }}
            </div>
            <div style="display: table-cell; width: 33%; padding: 5px; text-align: right;">
                <div style="font-weight: bold; font-size: 28px;">RECEIPT</div>
            </div>
        </div>
    </div>

    <!-- Watermark -->
    <img src="{{ public_path("assets/images/OmegaCityBlack.png") }}" alt="Watermark Logo"
        style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                width: 600px; opacity: 0.05; z-index: -1; pointer-events: none;">

    @php
        // Decode receipt items from JSON
        $items = json_decode($receipt->receipt_items, true);
        $subtotal = collect($items)->sum(fn($item) => $item["price"] * $item["quantity"]);
        $discount = $receipt->discount ?? 0;
        $discountValue = $subtotal * ($discount / 100);
         $vatPercent = $receipt->tax ?? 0;
       $taxValue = $subtotal * ($vatPercent / 100);
        $total = ($subtotal + $taxValue) - $discountValue;
    @endphp

    <!-- Items Table -->
    <table style="margin-top: 25px; font-size: 12px;">
        <thead>
            <tr>
                <th style="background-color: #000; color: #fff;">No.</th>
                <th style="background-color: #000; color: #fff;">Item Description</th>
                <th style="background-color: #000; color: #fff;">Unit Price (₦)</th>
                <th style="background-color: #ffcc00; color: #000;">Qty</th>
                <th style="background-color: #ffcc00; color: #000; text-align: center;">Total (₦)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr style="background-color: {{ $loop->even ? "#FACF071A" : "transparent" }};">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item["description"] }}</td>
                    <td>₦{{ number_format($item["price"], 2) }}</td>
                    <td>{{ $item["quantity"] }}</td>
                    <td style="text-align: center;">₦{{ number_format($item["price"] * $item["quantity"], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals -->
    <table class="totals-table">
        <tr>
            <td style="font-weight: bold;">Sub Total</td>
            <td></td>
            <td style="text-align: right;">₦{{ number_format($subtotal, 2) }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Discount ({{ $discount }}%)</td>
            <td></td>
            <td style="text-align: right;">₦{{ number_format($discountValue, 2) }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">VAT ({{ $vatPercent }}%)</td>
            <td></td>
            <td style="text-align: right;">₦{{ number_format($taxValue, 2) }}</td>
        </tr>
        <tr style="background-color: #ffcc00; font-weight: bold;">
            <td>Total</td>
            <td></td>
            <td style="text-align: right;">₦{{ number_format($total, 2) }}</td>
        </tr>
    </table>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-section">
            <div class="footer-cell">
                <p style="font-weight: bold;">Thanks for your Business!</p>
                 <p> Omega City &amp; Properties <br>
                Office Address. <br> 30 Libreville Cres, Wuse 2, Abuja, Federal Capital Territory.</p>
            </div>

        </div>
    </div>

</body>

</html>
