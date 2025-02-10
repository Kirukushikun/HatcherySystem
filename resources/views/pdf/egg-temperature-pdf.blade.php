<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Shell Temperature Check Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #fff;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }
        .info-table, .temp-table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }
        .info-table td, .temp-table th, .temp-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        .info-table td:first-child {
            font-weight: bold;
            text-align: left;
        }
        .temp-table th {
            background-color: #f4f4f4;
        }
        .signature {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .signature div {
            text-align: center;
            flex: 1;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .container {
                border: none;
                box-shadow: none;
            }
            .header {
                border-bottom: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Brookside Farms Corporation</h2>
            <h3 class="title">EGG SHELL TEMPERATURE CHECK REPORT</h3>
        </div>
        <table class="info-table">
            <tr>
                <td>PS No.</td>
                <td>92</td>
                <td>Setting Date</td>
                <td>06/09/2022</td>
            </tr>
            <tr>
                <td>Incubator #</td>
                <td>1</td>
                <td>Temperature Check Date</td>
                <td>24/09/2022</td>
            </tr>
            <tr>
                <td>Date Hatch</td>
                <td colspan="3">18/03/2023</td>
            </tr>
        </table>
        <table class="temp-table">
            <tr>
                <th>Location</th>
                <th>37.8 UP</th>
                <th>37.7 BELOW</th>
            </tr>
            <tr>
                <td>TOP</td>
                <td>128</td>
                <td>50</td>
            </tr>
            <tr>
                <td>MIDDLE</td>
                <td>141</td>
                <td>41</td>
            </tr>
            <tr>
                <td>BOTTOM</td>
                <td>191</td>
                <td>16</td>
            </tr>
        </table>
        <div class="signature">
            <div>
                <p>Prepared By:</p>
                <p>Richard Soliman</p>
                <p>ENCODER</p>
            </div>
            <div>
                <p>Date Prepared:</p>
                <p>10/02/2025 15:43</p>
            </div>
        </div>
    </div>
</body>
</html>
