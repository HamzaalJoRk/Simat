<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إيصال دفع - سمة</title>
    <style>
        @media print {
            @page {
                size: A5;
                margin: 0;
            }

            body {
                margin: 0;
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            margin: 1mm;
        }

        .copy {
            padding: 10px;
        }

        .header,
        .second-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footers {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .second-header {
            margin-top: 10px;
            justify-content: space-around;
        }

        .header img {
            width: 100px;
        }

        .header .center {
            text-align: center;
            flex: 1;
        }

        .header .right {
            text-align: right;
            font-size: 14px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            margin-top: 20px;
            font-size: 12px;
            border-collapse: collapse;
        }

        td {
            border: 1.5px solid black;
            padding: 4px;
            text-align: center;
        }

        .amount-box {
            border: 1px solid black;
            padding: 10px;
            margin-top: 5px;
            font-size: 20px;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 14px;
        }
    </style>
</head>

<body onload="window.print();">

    @php
        $copies = [
            'نسخة الحفظ (الصندوق)',
            'نسخة: مركز الهجرة والجوازات',
            'نسخة: صاحب الطلب'
        ];
    @endphp

    @foreach ($copies as $footerText)
        <div class="copy">
            <div class="header" style="direction: ltr">
                Syrian Arab Republic <br>
                Land And Sea Port General Authority <br>
                Nassib Border Crossing
                <div class="center">
                    <img src="/newlogo.png" alt="شعار" style="width: 60px;"><br>
                </div>
                <div class="right">
                    الجمهورية العربية السورية<br>
                    الهيئة العامة للمنافذ البرية والبحرية<br>
                    معبر نصيب الحدودي<br>
                </div>
            </div>

            <div class="second-header">
                <div>التاريخ والوقت</div>
                <!--<div><span class="today-date"></span></div>-->
                <div>{{ \Carbon\Carbon::parse($simat->created_at)->format('d/m/Y - h:i A') }}</div>

            </div>

            <div class="second-header mt-1">
                قسيمة شراء \ سمة دخول \ Visa
            </div>

            <table>
                <tr>
                    <td>رقم الايصال / number</td>
                    <td>{{ $simat->serial_number }}</td>
                    <td>الجنسية / Nationality</td>
                    <td>{{ $simat->nationality }}</td>
                </tr>
                <tr>
                    <td>الاسم الثلاثي / Full Name</td>
                    <td>{{ $simat->name }}</td>
                    <td>رقم جواز السفر / Passport Number</td>
                    <td>{{ $simat->passport_number }}</td>
                </tr>
                <tr>
                    <td>اسم الأم / Mother's Name</td>
                    <td>{{ $simat->mother_name }}</td>
                    <td>نوع السمة / Visa Type</td>
                    <td>{{ $simat->visa_type }}</td>
                </tr>
                <tr>
                    <td>تاريخ الدخول / Entry Date</td>
                    <td>{{ $simat->entry_date }}</td>
                    <td>مدة الصلاحية / Validity Duration</td>
                    <td>{{ $simat->validity_duration }}</td>
                </tr>
                <tr>
                    <td>تاريخ الميلاد / Birth Date</td>
                    <td>{{ $simat->birth_date }}</td>
                    <td>رسوم العمالة</td>
                    <td>{{ $simat->labor_fee ? $simat->labor_fee : 0  }} $</td>
                </tr>
                <tr>
                    <td>رسوم السمة / Fees</td>
                    <td>{{ $simat->fee_number }} $</td>
                    <td>رمزها</td>
                    <td>{{ $simat->country_code }}</td>
                </tr>
                <tr>
                    <td>الاجمالي رقماََ </td>
                    <td colspan="3">{{ $total }} $</td>
                </tr>
                <tr>
                    <td>الاجمالي كتابةً </td>
                    <td colspan="3">{{ $totalInWords }} دولاراََ فقط لا غير</td>
                </tr>
            </table>

            <div class="footers">
                <div class="footer">{{ $footerText }}</div>
                <div class="footer">توقيع وختم الصندوق
                </div>
            </div>
        </div>
        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif

    @endforeach


    <script>
        const todayFormatted = (() => {
            const today = new Date();
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const year = today.getFullYear();
            const time = today.toLocaleTimeString('en-EG');
            return `${day}/${month}/${year} - ${time}`;
        })();

        document.querySelectorAll('.today-date').forEach(el => {
            el.textContent = todayFormatted;
        });
    </script>
</body>

</html>