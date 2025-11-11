<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        @page {
            margin: 120px 35px 120px 35px;
        }

        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 14px;
            margin: 0;
        }

        /* Repeat Header */
        header {
            position: fixed;
            top: -100px;
            left: 0;
            right: 0;
            height: 90px;
        }

        header img.logo {
            height: 100px;
            margin-top: -10px;
        }

        header hr {
            margin-top: -10px;
            border: 0;
            border-top: 1px solid #000;
        }

        /* Repeat Footer */
        footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 80px;
        }

        footer img {
            width: 100%;
        }

        /* Watermark */
        .watermark {
            position: fixed;
            top: 20%;
            right: -5%;
            opacity: 0.10;
            width: 70%;
            z-index: -1;
        }



        /* Force page breaks */
        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <header>
        <img src="{{ public_path("assets/images/omegacitylogo.png") }}" class="logo">
        <hr>
    </header>

    <footer>
        <img src="{{ public_path("assets/images/footer.png") }}">
    </footer>

    <img class="watermark" src="{{ public_path("assets/images/Omega-City.png") }}">

    <h4 class="center">OMEGA SALES INSTALLMENT TRACKING PLAN</h4>


    {{-- 1. CLIENT INFO --}}
    <div style="font-size:14px; font-weight: bold; margin-bottom: 2px;">1. CLIENT INFORMATION</div>

    <table class="table" style="width:100%; border-collapse: collapse; font-size: 12px; margin-bottom: 5px;">
        <tr>
            <td style="border:1px solid #000; padding:5px; width:25%;">Name: {{ $salestracking->name }}</td>
            <td style="border:1px solid #000; padding:5px; width:25%;">Phone Number: {{ $salestracking->phone }}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; padding:5px;">Email: {{ $salestracking->email }}</td>
            <td style="border:1px solid #000; padding:5px;">Residential Address: {{ $salestracking->address }}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; padding:5px;">Identification: {{ $salestracking->id_type }}</td>
            <td style="border:1px solid #000; padding:5px;">Next of Kin: {{ $salestracking->nok_name }}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; padding:5px;">Next of Kin Phone: {{ $salestracking->nok_phone }}</td>
            <td style="border:1px solid #000; padding:5px;">Occupation/Employer: {{ $salestracking->occupation }}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; padding:5px;">Date of Registration:
                {{ $salestracking->registration_date }}</td>
            <td style="border:1px solid #000; padding:5px;">Sales Representative: {{ $salestracking->sales_rep }}</td>
        </tr>
    </table>


    {{-- 2. PROPERTY DETAILS --}}
    <div style="font-size:14px; font-weight: bold; margin-bottom: 2px;">2. PROPERTY DETAILS</div>
    <table class="table" style="width:100%; border-collapse: collapse; font-size: 12px; margin-bottom: 5px;">
        <tr>
            <td style="border:1px solid #000; padding:5px; width:25%;">Estate/Project Name:
                {{ $salestracking->project_name }}</td>
            <td style="border:1px solid #000; padding:5px; width:25%;">Property Type:
                {{ $salestracking->property_type }}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; padding:5px;">Plot/Unit No: {{ $salestracking->plot_unit_no }}</td>
            <td style="border:1px solid #000; padding:5px;">Location: {{ $salestracking->location }}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; padding:5px;">Size: {{ $salestracking->size }}</td>
            <td style="border:1px solid #000; padding:5px;">Total Purchase Price:
                {{ number_format($salestracking->total_price) }}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; padding:5px;">Payment Option: {{ $salestracking->payment_option }}</td>
            <td style="border:1px solid #000; padding:5px;">Initial Deposit:
                {{ number_format($salestracking->initial_deposit) }}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; padding:5px;">Date Of Initial Payment: {{ $salestracking->initial_date }}
            </td>
            <td style="border:1px solid #000; padding:5px;"></td>
        </tr>
    </table>

    <div class="page-break"></div>

    {{-- 3. PAYMENT SCHEDULE TABLE --}}
    <div style="font-size:14px; font-weight: bold; margin-bottom: 2px;">3. PAYMENT SCHEDULE AND TRACKING</div>

    <table class="table" style="width:100%; border-collapse: collapse; font-size: 12px; margin-bottom: 5px;">
        <tr>
            <th>#</th>
            <th>Due Date</th>
            <th>Amount Due</th>
            <th>Amount Paid</th>
            <th>Date Paid</th>
            <th>Method</th>
        </tr>
        @for ($i = 1; $i <= 6; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endfor

        <tr>
            <th colspan="2">TOTAL</th>
            <td>{{ number_format($salestracking->total_price) }}</td>
            <td>{{ number_format($salestracking->total_paid) }}</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th colspan="2">BALANCE</th>
            <td colspan="4">{{ number_format($salestracking->outstanding_balance) }}</td>
        </tr>
    </table>

    <div class="section-title">4. SUMMARY DASHBOARD</div>
    <table class="table">
        <tr>
            <td>Total Agreed Amount</td>
            <td>{{ number_format($salestracking->total_price) }}</td>
        </tr>
        <tr>
            <td>Total Amount Paid</td>
            <td>{{ number_format($salestracking->total_paid) }}</td>
        </tr>
        <tr>
            <td>Outstanding Balance</td>
            <td>{{ number_format($salestracking->outstanding_balance) }}</td>
        </tr>
        <tr>
            <td>Next Due Payment</td>
            <td>{{ $salestracking->next_due_payment }}</td>
        </tr>
        <tr>
            <td>Payment Status</td>
            <td>{{ $salestracking->payment_status }}</td>
        </tr>
        <tr>
            <td>Last Payment Date</td>
            <td>{{ $salestracking->last_payment_date }}</td>
        </tr>
        <tr>
            <td>Handled By (Sales Rep)</td>
            <td>{{ $salestracking->handled_by }}</td>
        </tr>
    </table>


    <div class="section-title">5. COMMENTS / SPECIAL NOTES</div>
    <div style="border:1px solid #000; min-height:120px; padding:5px;">
        {!! nl2br($salestracking->comments) !!}
    </div>

</body>

</html>
