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
            font-size: 12px;
            margin: 0;
        }

        .dotted-line {
            border-bottom: 1px dotted #000;
            height: 14px;
            width: 100%;
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

        .content {
            margin-top: 10px;
        }

        .title {
            font-size: 14px;
            text-align: center;
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .center {
            text-align: center;
        }

        .section-title {
            font-weight: bold;
            padding: 4px;
            margin: 25px 0 10px 0;
            font-size: 12px;
            page-break-inside: avoid;
            text-transform: uppercase;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        table td {
            padding: 3px 2px;
            font-size: 11px;
            vertical-align: top;
        }

        .label {
            width: 160px;
            font-weight: bold;
            background: #f9f9f9;
        }

        .photo-box {
            width: 120px;
            height: 120px;
            border: 1px solid #000;
            text-align: center;
            font-size: 11px;
            float: right;
            margin-bottom: 20px;
        }

        .signature-img {
            height: 50px;
        }

        .official-box {
            border: 1px solid #000;
            min-height: 120px;
            padding: 5px;
            font-size: 11px;
        }

        ul li {
            font-size: 11px;
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

    <div class="content">

        <div>
            <div class="title">INTEGRITY / INNOVATION / EXCELLENCE / CUSTOMER FOCUS / SUSTAINABILITY</div>
            <hr>
            <div class="subtitle">EXPRESSION OF INTEREST / LAND ALLOCATION FORM (INDIVIDUAL)</div>
        </div>

        {{-- PAGE 1 --}}
        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <!-- Passport Photo -->
                <!-- Note -->
                <td style="vertical-align: top; font-size: 11px; font-style: italic; padding-left: 10px;">
                    THE ENDORSEMENT OF THIS EXPRESSION OF INTEREST (EOI) FORM SERVES
                    AS BOTH AN APPLICATION AND A REQUEST FOR LAND ALLOCATION IN
                    OMEGA CITY & PROPERTIES NIG. LTD.
                </td>

                <td style="width: 130px; vertical-align: top;">
                    <div class="photo-box">

                    </div>
                </td>
            </tr>
        </table>


        {{-- Section A --}}
        <div class="section-title" style="margin-top: 60px;">Section A – Personal Information</div>
        <table>
            <tr>
                <td class="label">Title:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Surname:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">First Name:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Other Names:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Nationality:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">State of Origin:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">LGA:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Date of Birth:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Sex:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Marital Status:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Mobile No.:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Email Address:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Residential Address:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Business/Office Address:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Valid Means of ID:</td>
                <td class="dotted-line"></td>
            </tr>
        </table>

        {{-- Section B --}}
        <div class="section-title">Section B – Next of Kin</div>
        <table>
            <tr>
                <td class="label">Name:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Mobile No.:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Address:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Valid ID:</td>
                <td class="dotted-line"></td>
            </tr>
        </table>


        {{-- PAGE 2 --}}
        <div class="page-break"></div>

        {{-- Section C --}}
        <div class="section-title">Section C – Category of Land</div>
        <table>
            <tr>
                <td class="label">Land Category:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Payment Option:</td>
                <td>

                </td>
            </tr>
            <tr>
                <td class="label">Agent Name:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Agent Phone:</td>
                <td class="dotted-line"></td>
            </tr>
        </table>

        {{-- Account --}}
        <div class="section-title">Authorized Account Details</div>
        <table>
            <tr>
                <td class="label">Bank:</td>
                <td>Wema Bank</td>
            </tr>
            <tr>
                <td class="label">Account Name:</td>
                <td>Omega City & Properties Nig LTD</td>
            </tr>
            <tr>
                <td class="label">Account Number:</td>
                <td>0127081443</td>
            </tr>
        </table>

        {{-- Section D --}}
        <div class="section-title">Section D – Endorsement</div>
        <p>I confirm all details are true and accurate.</p>
        <table>
            <tr>
                <td class="label">Applicant Name:</td>
                <td class="dotted-line"></td>
            </tr>
            <tr>
                <td class="label">Signature/Date:</td>
                <td>

                </td>
            </tr>
            <tr>
                <td class="label">Additional Comments:</td>
                <td class="dotted-line"></td>
            </tr>
        </table>

        {{-- Documents --}}
        <div class="section-title">Documents Required</div>
        <ul>
            <li>Copy of National ID</li>
            <li>2 Passport photos (Applicant)</li>
            <li>2 Passport photos (Next of Kin)</li>
            <li>Affidavit of Good Financial Standing</li>
            <li>Proof of EOI payment</li>
        </ul>


        {{-- PAGE 3 --}}
        <div class="page-break"></div>

        {{-- Section E --}}
        <div class="section-title">Section E – Official Use Only</div>
        <div class="official-box">
            Receiving Manager: <br><br>
            Date Received: <br><br>
            Approval Status: <br><br>
            Comment / Remark:
        </div>

    </div>

</body>

</html>
