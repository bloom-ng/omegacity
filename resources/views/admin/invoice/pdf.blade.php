<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice :  INV-{{ $invoice->created_at->format('Ymd') }}{{ $invoice->id }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0; padding: 40px;
            font-size: 12px; color: #000; background-color: #fff;
            box-sizing: border-box;
        }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 8px; text-align: left; }

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
        .footer-section { display: table; width: 100%; }
        .footer-cell { display: table-cell; width: 33%; vertical-align: top; padding: 3px; }
        .footer h4 { font-size: 16px; font-weight: bold; margin: 0 0 5px 0; }
        .footer ol { margin: 0; padding-left: 14px; }
    </style>
</head>
<body>

    <!-- Company Logo -->
    <div style="padding-bottom: 5px;">
        <img src="{{ public_path('assets/images/omegacitylogo.png') }}" alt="Company Logo"
             style="display: block; width: 280px; margin: 0;">
    </div>

    <!-- Header Info -->
    <div style="display: table; width: 100%; border-bottom: 2px solid #000; margin-top: 10px;">
        <div style="display: table-row;">
            <div style="display: table-cell; width: 33%; padding: 5px; vertical-align: top;">
                {{ \Carbon\Carbon::parse($invoice->date)->format('jS F Y') }}<br>
                {{ $invoice->client->first_name }} {{ $invoice->client->last_name }}
            </div>
            <div style="display: table-cell; width: 33%; padding: 5px; vertical-align: top;">
                INV-{{ $invoice->created_at->format('Ymd') }}{{ $invoice->id }} <br>
                {{ $invoice->client->address }}
            </div>
            <div style="display: table-cell; width: 33%; padding: 5px; text-align: right;">
                <div style="font-weight: bold; font-size: 28px;">INVOICE</div>
            </div>
        </div>
    </div>

    <!-- Watermark -->
    <img src="{{ public_path('assets/images/OmegaCityBlack.png') }}" alt="Watermark Logo"
         style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                width: 600px; opacity: 0.05; z-index: -1; pointer-events: none;">

    @php
        // Decode invoice items from JSON
        $items = json_decode($invoice->invoice_items, true);
        $subtotal = collect($items)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discount = $invoice->discount ?? 0;
        $tax = $invoice->tax ?? 0;
        $total = $subtotal - $discount + $tax;
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
                <tr style="background-color: {{ $loop->even ? '#FACF071A' : 'transparent' }};">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['description'] }}</td>
                    <td>₦{{ number_format($item['price'], 2) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td style="text-align: center;">₦{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
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
            <td style="font-weight: bold;">Discount</td>
            <td></td>
            <td style="text-align: right;">₦{{ number_format($discount, 2) }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Tax</td>
            <td></td>
            <td style="text-align: right;">₦{{ number_format($tax, 2) }}</td>
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
                <h4>PAYMENT</h4>
                <p>
                    Bank Name: Paystack Titan<br>
                    Account Name: Omega City &amp; Properties<br>
                    Account Number: 00200206682
                </p>
            </div>
            <div class="footer-cell"></div>
            <div class="footer-cell" style="text-align: right;">
                <h4 style="font-size: 13px;">Terms &amp; Conditions</h4>
                <ol>
                    <li>7 days from issue date</li>
                    <li>All payments are final</li>
                    <li>Contact us for clarifications</li>
                </ol>
            </div>
        </div>

        <div style="margin-top: 8px; border-top: 1px solid #000; padding-top: 5px;" class="footer-section">
            <div class="footer-cell">
                <p style="font-weight: bold;">Thanks for your Business!</p>
            </div>
            <div class="footer-cell"></div>
            <div class="footer-cell" style="text-align: right;">
                <p>Omega City &amp; Properties</p>
                <p>Office Address</p>
            </div>
        </div>
    </div>

</body>
</html>
