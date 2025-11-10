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
            font-size: 14px;
            page-break-inside: avoid;
            text-transform: uppercase;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
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

        {{-- PAGE 1 --}}
        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <!-- Passport Photo -->
                <!-- Note -->
                <td
                    style=" font-size: 20px; font-style: bold; padding-left: 10px; text-align: center; font-weight: bold; margin-top: 70px">
                    PERSONAL INFORMATION OF INDIVIDUAL GUARANTOR
                </td>

                <td style="width: 130px; vertical-align: top;">
                    <div class="photo-box">
                        @if ($guarantor->id_file)
                            <img src="file://{{ storage_path("app/public/" . $guarantor->id_file) }}"
                                alt="Passport Photo" style="width:120px; height:120px; object-fit:cover;">
                        @endif
                    </div>
                </td>
            </tr>
        </table>


        <table style="margin-top: 80px">

        </table>

        <div class="section">Our employment process requires that any person seeking employment in our
            establishment must provide a credible, responsible, and acceptable individual as a
            guarantor, subject to employment confirmation.
            If you are willing to stand as a guarantor for the said applicant, kindly complete this form.
            Note: It is risky to stand as a guarantor for someone you do not know personally.
            Guarantors are hereby warned that any false declaration on this form will attract
            severe consequences, including possible prosecution
        </div>

        <div class="section" style="margin-top: 15px">
            {{ $guarantor->candidate_title }} <strong>{{ $guarantor->candidate_name }}</strong>, who is being considered
            for
            employment, has given your name as his/her guarantor.
            Please confirm your willingness to act as guarantor by completing the information
            below:
        </div>

        <table width="100%" style="font-size: 13px; line-height: 22px; margin-top: 10px;">
            <tr>
                <td width="5%">a)</td>
                <td>Is the candidate well known to you?</td>
                <td style="border-bottom: 1px dotted #000; width: 60%">
                    {{ $guarantor->known_candidate == 1 ? "Yes" : "No" }}
                </td>
            </tr>

            <tr>
                <td>b)</td>
                <td>What is your relationship with him/her?</td>
                <td style="border-bottom: 1px dotted #000;">{{ $guarantor->relationship }}</td>
            </tr>

            <tr>
                <td>c)</td>
                <td>How long have you known him/her?</td>
                <td style="border-bottom: 1px dotted #000;">{{ $guarantor->known_duration }}</td>
            </tr>

            <tr>
                <td>d)</td>
                <td>Please state your occupation:</td>
                <td style="border-bottom: 1px dotted #000;">{{ $guarantor->occupation }}</td>
            </tr>
        </table>


        <p style="margin-top: 15px; font-size: 13px;">
            I, {{ $guarantor->guarantor_title }}
            <span style="border-bottom: 1px dotted #000; display: inline-block; width: 35%;">
                <strong>{{ " " }}{{ $guarantor->guarantor_name }}</strong></span>
            of
        </p>

        <p style="font-size: 13px;">
            Home Address:
            <span style="border-bottom: 1px dotted #000; display: inline-block; width: 70%;">
                {{ " " }}{{ $guarantor->home_address }}</span>
        </p>

        <p style="font-size: 13px;">
            Office Address:
            <span style="border-bottom: 1px dotted #000; display: inline-block; width: 70%;">
                {{ " " }}{{ $guarantor->office_address }}</span>
        </p>

        <p style="margin-top: 10px; font-size: 13px;">
            hereby stand as guarantor to {{ $guarantor->candidate_title }}{{ " " }}
            <span style="border-bottom: 1px dotted #000; display: inline-block; width: 40%;">
                <strong>{{ " " }}{{ $guarantor->candidate_name }}</strong></span>,
            who is being considered for employment with Omega City &amp; Properties Nig. Ltd.
        </p>


        <div class="page-break"></div>

        <p style="font-size:14px; line-height:20px; margin-top:10px;">
            I irrevocably and unconditionally guarantee to indemnify the Company against any loss
            suffered as a result of any act or omission by {{ $guarantor->candidate_title }}
            <span
                style="border-bottom:1px dotted #000; display:inline-block; width:40%;"><strong>{{ $guarantor->candidate_name }}</strong></span>
            while in the Company’s employment.
        </p>
        <p style="font-size:14px; line-height:20px; margin-top:5px;">
            I also undertake to produce him/her whenever required for any reason of security or
            official concern.
        </p>

        <br>
        <p style="font-size:14px; line-height:20px; margin-top:5px;">
            This guarantee shall be governed by the laws of the Federal Republic of Nigeria.
        </p>
        <table width="100%" style="font-size:14px; line-height:22px;">

            <tr>
                <td width="30%">Email Address:</td>
                <td style="border-bottom:1px dotted #000; width:50%;">{{ $guarantor->guarantor_email }}</td>
            </tr>

            <tr>
                <td>Means of Identification:</td>
                <td style="border-bottom:1px dotted #000; width:50%;">{{ $guarantor->id_type }}</td>
                <td style="font-size:10px; margin-top: 10px;">(Attach a copy)</td>
            </tr>



            <tr>
                <td>Name:</td>
                <td style="border-bottom:1px dotted #000; width:50%;">{{ $guarantor->guarantor_name }}</td>
            </tr>

            <tr>
                <td>Signature:</td>
                <td style="border-bottom:1px dotted #000; width:50%;">
                    @if ($guarantor->signature_file)
                        <img src="file://{{ storage_path("app/public/" . $guarantor->signature_file) }}"
                            alt="Signature" style="width: 60px; height: 50px;">
                    @endif
                </td>
            </tr>

            <tr>
                <td>Telephone No.:</td>
                <td style="border-bottom:1px dotted #000; width:50%;">{{ $guarantor->phone }}</td>
            </tr>

            <tr>
                <td>Date:</td>
                <td style="border-bottom:1px dotted #000; width:50%;">{{ $guarantor->date_signed }}</td>
            </tr>

        </table>
    </div>

</body>

</html>
