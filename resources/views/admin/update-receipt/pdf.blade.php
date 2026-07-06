<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receipt : REC-{{ $update_receipt->created_at->format("Ymd") }}{{ $update_receipt->id }}</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
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
            margin-top: 15%;
            border-collapse: collapse;
        }

        .footer {
            clear: both;
            margin-top: 20px;
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
                Receipt To <br>
                <strong>Name:</strong> {{ $update_receipt->client->first_name }} {{ $update_receipt->client->last_name }} <br>
                <strong>Tel:</strong> {{ $update_receipt->client->phone }} <br>
                <strong>Address:</strong> {{ $update_receipt->client->address }} <br>
                <strong>Email:</strong> {{ $update_receipt->client->email }} <br>
            </div>
            <div style="display: table-cell; width: 33%; padding: 5px; vertical-align: top;">

            </div>
            <div style="display: table-cell; width: 33%; padding: 5px; text-align: right;">
                <div style="background-color: #000; color: #fff; font-weight: bold; font-size: 12px; padding: 5px;">RECEIPT NO: REC-{{ $update_receipt->created_at->format("Ymd") }}{{ $update_receipt->id }}</div>
                <strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($update_receipt->date)->format("jS F Y") }}<br>
                <strong>Payment Type:</strong> {{ $update_receipt->payment_type }}<br>
                <div style="font-weight: bold; font-size: 15px; margin-top: 15px;">
                    Payment option
                </div>

                @php
                    $isFull = strtolower($update_receipt->payment_type) === "full_payment";
                    $isInstallment = strtolower($update_receipt->payment_type) === "installment";
                @endphp

                <div style="font-size: 14px; margin-top: 5px;">
                    Full Payment {!! $isFull ? "☑" : "☐" !!} <br>
                    Installment  {!! $isInstallment ? "☑" : "☐" !!}
                </div>

            </div>
        </div>
    </div>

    <!-- Watermark -->
    <img src="{{ public_path("assets/images/OmegaCityBlack.png") }}" alt="Watermark Logo"
        style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                width: 600px; opacity: 0.05; z-index: -1; pointer-events: none;">

   @php
    $items = is_array($update_receipt->receipt_items) 
                ? $update_receipt->receipt_items 
                : json_decode($update_receipt->receipt_items, true);
    $subtotal = collect($items)->sum(fn($item) => $item['price'] * $item['quantity']);

    $grandTotal = $update_receipt->grand_total ?? 0;

    $discountPercent = $update_receipt->discount ?? 0;
    $vatPercent = $update_receipt->tax ?? 0;

    $discountValue = $subtotal * ($discountPercent / 100);
    $vatValue = $subtotal * ($vatPercent / 100);
    $balanceDue = max($grandTotal - $subtotal, 0);
@endphp


    <!-- Items Table -->
    <table style="margin-top: 25px; font-size: 12px;">
        <thead>
            <tr>
                <th style="background-color: #000; color: #fff;">No.</th>
                <th style="background-color: #ffcc00; color: #000;">Item Description</th>
                <th style="background-color: #000; color: #fff;">Unit Price</th>
                <th style="background-color: #ffcc00; color: #000;">Quantity</th>
                <th style="background-color: #000; color: #fff; text-align: center;">Total </th>
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

    <!-- Totals and Footer Group -->
    <div style="page-break-inside: avoid;">
        <table class="totals-table">
            <tr>
        <td style="font-weight: bold;">Subtotal</td>
        <td></td>
        <td style="text-align: right;">₦{{ number_format($subtotal, 2) }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Discount ({{ $discountPercent }}%)</td>
        <td></td>
        <td style="text-align: right;">₦{{ number_format($discountValue, 2) }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">VAT ({{ $vatPercent }}%)</td>
        <td></td>
        <td style="text-align: right;">₦{{ number_format($vatValue, 2) }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Amount Paid</td>
        <td></td>
        <td style="text-align: right;">₦{{ number_format($update_receipt->amount_paid ?? $grandTotal, 2) }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Balance Due</td>
        <td></td>
        <td style="text-align: right; color: {{ ($update_receipt->balance_due ?? $balanceDue) > 0 ? 'red' : 'black' }};">₦{{ number_format($update_receipt->balance_due ?? $balanceDue, 2) }}</td>
    </tr>
    <tr style="background-color: #ffcc00; font-weight: bold;">
        <td>Grand Total</td>
        <td></td>
        <td style="text-align: right;">₦{{ number_format($grandTotal, 2) }}</td>
    </tr>
  
</table>


    <!-- Footer -->
    <div class="footer">
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <!-- LEFT SIDE -->
                <td style="width: 65%; vertical-align: top;">
                    <p>
                        <strong>Terms &amp; Conditions:</strong>
                        This receipt serves as proof of payment only, and does not on its own confer ownership rights.
                    </p>

                    <p style="font-weight: bold;">Thanks for your Business!</p>

                    <!-- Signature Block -->
                    <div style="margin-top: 60px; width: 250px;">
                        <div style="border-top: 3px solid #000; height: 0;"></div>
                        <p style="margin-top: 5px; font-weight: bold; font-size: 11px; text-align: center">
                            General Manager
                        </p>
                    </div>


                </td>

                <!-- RIGHT SIDE -->
                <td style="width: 35%; vertical-align: top; text-align: left;">
                    <p>
                         <img src="{{ public_path("assets/images/Omega-City.png") }}" alt="Company Logo" height="20"
            style="padding-right: 5px"><strong>Omega City &amp; Properties Nig Ltd</strong><br>
                        <strong>Tel:</strong> 07056260000.<br>
                        <strong>Email:</strong> info@omegacityproperties.com<br>
                        <strong>Address:</strong> 30 Libreville Crescent, Wuse 2 Abuja.
                    </p>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
