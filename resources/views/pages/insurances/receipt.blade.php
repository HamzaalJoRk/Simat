<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إيصال أمانة - التأمينات</title>
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

        .footers {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        .footer {
            font-size: 14px;
        }
    </style>
</head>

<body onload="window.print();">
    @php
        $copies = [
            'توقيع وختم الصندوق',
            'توقيع وختم الصندوق'
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
                <div><span class="today-date"></span></div>
            </div>

            <div class="second-header mt-1">
                وثيقة تأمين
            </div>

            <table>
                <tr>
                    <td>رقم الايصال</td>
                    <td>{{ $insurance->serial_number }}</td>
                    <td>رقم اللوحة</td>
                    <td>{{ $insurance->plate_number }}</td>
                </tr>
                <tr>
                    <td>اسم المؤمن له</td>
                    <td colspan="3">{{ $insurance->name }}</td>
                </tr>
                <tr>
                    <td>رقم الهيكل</td>
                    <td>{{ $insurance->chassis_number }}</td>
                    <td>الطراز</td>
                    <td>{{ $insurance->model }}</td>
                </tr>
                <tr>
                    <td>نوع الآلية</td>
                    <td>{{ $insurance->vehicle_type }} يوم</td>
                    <td>مدة التأمين</td>
                    <td>{{ $insurance->duration }} يوم</td>
                </tr>
                <tr>
                    <td>تاريخ البداية</td>
                    <td>{{ $insurance->start_date }}</td>
                    <td>تاريخ النهاية</td>
                    <td>{{ $insurance->end_date }} يوم</td>
                </tr>
                <tr>
                    <td>الرسوم رقماً</td>
                    <td colspan="3">{{ number_format($insurance->amount_numeric, 2) }} $</td>
                </tr>
                <tr>
                    <td>ملاحظات</td>
                    <td colspan="3">{{ $insurance->notes ?? '-' }}</td>
                </tr>
            </table>

            <div class="footers">
                <div class="footer"></div>
                <div class="footer">توقيع وختم الصندوق</div>
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