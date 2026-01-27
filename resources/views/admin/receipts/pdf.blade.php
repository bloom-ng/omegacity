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
                Name: {{ $receipt->client->first_name }} {{ $receipt->client->last_name }} <br>
                Tel: {{ $receipt->client->phone }} <br>
                Address: {{ $receipt->client->address }} <br>
                Email: {{ $receipt->client->email }} <br>
            </div>
            <div style="display: table-cell; width: 33%; padding: 5px; vertical-align: top;">

            </div>
            <div style="display: table-cell; width: 33%; padding: 5px; text-align: right;">
                <div style="font-weight: bold; font-size: 20px;">RECEIPT</div>
                Date: {{ \Carbon\Carbon::parse($receipt->date)->format("jS F Y") }}<br>
                Payment Type: {{ $receipt->payment_type }}<br>
                Receipt No: REC-{{ $receipt->created_at->format("Ymd") }}{{ $receipt->id }} <br>
                <div style="font-weight: bold; font-size: 15px; margin-top: 15px;">
                    Payment option
                </div>

                @php
                    $isFull = strtolower($receipt->payment_type) === "full_payment";
                    $isInstallment = strtolower($receipt->payment_type) === "installmental";
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
        $items = json_decode($receipt->receipt_items, true);
        $subtotal = collect($items)->sum(fn($item) => $item["price"] * $item["quantity"]);
        $discount = $receipt->discount ?? 0;
        $discountValue = $subtotal * ($discount / 100);
        $vatPercent = $receipt->tax ?? 0;
        $taxValue = $subtotal * ($vatPercent / 100);

        $total = $subtotal + $taxValue - $discountValue;

        $amountPaid = $receipt->amount_paid ?? 0;
        $balanceDue = max($total - $amountPaid, 0);

        $grandTotal = $total - $balanceDue;
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
        <tr>
            <td style="font-weight: bold;">Balance Due</td>
            <td></td>
            <td style="text-align: right;">₦{{ number_format($balanceDue, 2) }}</td>
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
                    <div style="margin-top: 40px; width: 250px;">
                        <div style="border-top: 3px solid #000; height: 0;"></div>
                        <p style="margin-top: 5px; font-weight: bold; font-size: 11px; text-align: center">
                            General Manager
                        </p>
                    </div>


                </td>

                <!-- RIGHT SIDE -->
                <td style="width: 35%; vertical-align: top; text-align: right;">
                    <p>
                        <strong>Omega City &amp; Properties</strong><br>
                        Tel: 07056260000.<br>
                        Email: info@omegacityproperties.com<br>
                        Address: 30 Libreville Crescent, Wuse 2 Abuja.
                    </p>
                </td>
            </tr>
        </table>
    </div>


</body>

</html>
