<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <title>Document</title>
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/modal-notification-loader.css">

    <style>


        *{
            font-family: "Lexend";
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #1C1C1C;

            transition: 0.3s ease;
        }

        body{
            min-height: 100vh;
            padding-top: 20px;
            height: auto;
            
            display: flex;
            align-items: center;
            justify-content: center;

            background-color: #F6F4F1;
        }

        .report-container{
            min-width: 1300px;

            display: flex;
            flex-direction: column;
            justify-content: center;

            position: relative;
        }

        .report-content{
            background-color: white;
        }

        .report-header{
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 40px;
        }
        .report-header img{
            width: 160px;
        }
        .report-header #BGC{
            width: 180px;
        }

        .report-title{
            font-size: 25px;
            font-weight: 5  00;
            text-align: center;

            padding: 10px 0;

            background-color: #EC8B18;
            color: white;
        }

        .report-form{
            display: flex;
            flex-direction: column;
            /* justify-content: space-between; */
            gap:60px;

            padding: 50px;
        }

        .report-form .col-2{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;            
        }

        .report-form .form-group{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-group input{
            border: none;
            font-size: 16px;
            padding: 12px 15px;
            background-color: #F3F3F3;
            outline: none;
        }
        .form-group select{
            border: none;
            font-size: 16px;
            padding: 12px 15px;
            background-color: #F3F3F3;
            outline: none;

            border-right: 16px solid transparent
        }

        .report-footer{
            display: flex;
            flex-direction: column;
            margin: 0 50px 30px;
            padding: 20px 0;
            border-top: solid 2px #F0F0F0;
            text-align: center;
            font-weight: 500;
            color: #D8D8D8;
        }

        /* .report-actions{
            position: absolute;
            right: -170px;
            bottom: -20px;

            display:flex;
            flex-direction: column;
            justify-content: end;
            gap: 20px;
            margin: 20px 0;
        } */

        .report-actions{
            display:flex;
            justify-content: end;
            gap: 20px;
            margin: 20px 0;
        }

        .report-actions button{
            padding: 8px 20px;
            cursor: pointer;
            border: none;

            font-size: 16px;
            font-weight: 400;
        }

        .back{
            color: #4C4C4C;
            background-color: #D9D9D9;
        }
        .back i{
            color: #4C4C4C;
            margin-left: 5px;
        }

        .print{
            color: white;
            background-color: #EC8B18;
        }
        .print i{
            color: white;
            margin-left: 5px;
        }

        .form-container table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: #EC8B18; /* Orange header */
            color: white;
            
            padding: 10px;
            font-size: 16px;
            font-weight: 500;

            border: 2px solid #ffffff;
        }

        td {
            padding: 10px;
            border: 2px solid #E9E9E9;
        }

        /* tr:nth-child(even) {
            background-color: #f9f9f9; 
        } */

        tr:hover {
            background-color: #f1f1f1; /* Hover effect */
        }

        /* .custom-file-upload {
            display: flex;
            justify-content: space-between;
            padding: 10px 14px;
            cursor: pointer;
            background-color: #eaeaea;
            border: 1px solid #ccc;
        }
        .custom-file-upload:hover {
            background-color:rgb(205, 205, 205);
        } */

        .signature {
            display: block; 
            width: 110px;   
            height: 80px;   
            object-fit: contain; 
            margin-bottom: 5px; 
        }

        /* .signature {
            display: block; 
            width: 110px;   
            height: 80px;   
            object-fit: contain; 
            margin-bottom: 5px; 
            z-index: 2px;
        }

        .form-group{
            position: relative;
        }

        #prepared-by{
            bottom: 10px;
            position: absolute;
            z-index: 1;

            background-color: transparent;
        } */

    </style>
</head>
<body>

    <input type="text" class="targetForm" value="{{$targetForm}}" hidden>

    <div class="report-container">
        @if($targetForm == "egg-collection" && $targetForm != null)
            <form class="report-content">
                <div class="report-header">
                    <img src="/Images/BDL.png" id="BDL" alt="Brookdale Farms">
                    <img src="/Images/BGC.png" id="BGC" alt="Brookside Group of Companies">
                    <img src="/Images/PFC.png" id="PFC" alt="Poultrypure Farms">
                </div>

                <div class="report-title">EGG COLLECTION REPORT</div>

                <div class="report-form">

                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="ps-no">PS No:</label>
                            <input type="text" id="ps-no">
                        </div>
                        <div class="form-group">
                            <label for="house-no">House No:</label>
                            <input type="text" id="house-no">
                        </div>
                        <div class="form-group">
                            <label for="production-date">Production Date:</label>
                            <input type="date" id="production-date">
                        </div>
                        <div class="form-group">
                            <label for="collection-time">Collection Time:</label>
                            <input type="time" id="collection-time">
                        </div>
                        <div class="form-group">
                            <label for="collection-quantity">Collection Quantity:</label>
                            <input type="number" id="collection-quantity">
                        </div>         
                    </div>


                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="prepared-by">Prepared By:</label>
                            <input type="text" id="prepared-by">
                        </div>
                        <div class="form-group">
                            <label for="date-prepared">Date Prepared:</label>
                            <input type="date" id="date-prepared">
                        </div>   
                    </div>
                </div>

                <div class="report-footer">
                    Brookside Group of Companies | Brookdale Farms | Poultrypure Farms
                </div>
            </form>
        @elseif ($targetForm == "egg-temperature" && $targetForm != null)
            <form class="report-content">
                <div class="report-header">
                    <img src="/Images/BDL.png" id="BDL" alt="Brookdale Farms">
                    <img src="/Images/BGC.png" id="BGC" alt="Brookside Group of Companies">
                    <img src="/Images/PFC.png" id="PFC" alt="Poultrypure Farms">
                </div>

                <div class="report-title">EGG SHELL TEMPERATURE CHECK REPORT</div>

                <div class="report-form">

                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="ps_no">PS No: <span></span></label>
                            <select name="ps_no" id="ps_no">
                                <option value=""></option>
                                <option value="#93">#93</option>
                                <option value="#94">#94</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="incubator">Incubator No: <span></span></label>
                            <select name="incubator" id="incubator">
                                <option value=""></option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="setting_date">Setting Date: <span></span></label>
                            <input type="date" name="setting_date" id="setting_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="hatch_date">Hatch Date: <span></span></label>
                            <input type="date" name="hatch_date" id="hatch_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="temp_check_date_from">Temperature Check Date (From): <span></span></label>
                            <input type="date" name="temp_check_date_from" id="temp_check_date_from" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="temp_check_date_to">Temperature Check Date (To): <span></span></label>
                            <input type="date" name="temp_check_date_to" id="temp_check_date_to" value="{{ date('Y-m-d') }}">
                        </div>      
                    </div>

                    <div class="form-container">
                        <table>
                            <thead>
                                <th>LOCATION</th>
                                <th>37.8 ABOVE</th>
                                <th>37.7 BELOW</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Top</td>
                                    <td>200</td>
                                    <td>200</td>
                                </tr>
                                <tr>
                                    <td>Middle</td>
                                    <td>200</td>
                                    <td>200</td>
                                </tr>
                                <tr>
                                    <td>Bottom</td>
                                    <td>200</td>
                                    <td>200</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="prepared-by">Prepared By:</label>

                            <!-- Signature Image (Fixed Size) -->
                            <img class="signature" src="/Images/DummySignature.png" alt="Signature">

                            <!-- Prepared By Input Field -->
                            <input type="text" id="prepared-by" value="Chris P. Bacon" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-prepared">Date Prepared:</label>
                            <input type="date" id="date-prepared" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>

                <div class="report-footer">
                    Brookside Group of Companies | Brookdale Farms | Poultrypure Farms
                </div>
            </form>
        @endif
        <div class="report-actions">
            <button type="button" class="back" onclick="window.history.back()">GO BACK <i class="fa-solid fa-door-open"></i></button>
            <button type="submit" class="print">PRINT <i class="fa-solid fa-print"></i></button>
        </div>
    </div>
    
</body>
</html>