<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hatchery System</title>
    <link rel="icon" href="/Images/BGC icon.ico">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap');
        
        *{
            font-family: "Lexend";
            box-sizing: border-box;
            margin: 0;
            color: #4C4C4C;
        }

        body{
            background-color: #F6F4F1;
            height: 100vh;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            gap: 40px;

            padding-bottom: 30px;
        }

        #logo{
            width: clamp(200px, 20vw, 300px);
        }


        .row{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
        }

        @media(max-width: 1112px){
            body {
                padding: 50px 0;
                height: auto;
            }
        }

        

        .card{
            width: calc(100% - 40px);
            max-width: 320px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;


            background-color: white;
            padding: 30px;
            border-radius: 10px;

            text-align: center;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        }
        .card h3{
            font-size: clamp(14px, 3vw, 17px);
            font-weight: 700;
        }
        .card img{
            width: clamp(70px, 10vw, 100px);
        }
        .card button{
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;

            color: white;
            background-color: #EC8B18;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 1px;
            margin-top: 15px;
            cursor: pointer;
        }

        @media(max-width: 679px){
            .card{
                width: calc(100% - 80px);
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <img src="/Images/BDL.png" id="logo" alt="">
    <div class="row">
        <div class="card">
            <img src="/Images/Egg_Add.png" alt="">
            <h3>EGG COLLECTION <br> ENTRY</h3>
            <button onclick="window.location.href='/egg-collection'">OPEN</button>
        </div>
        <div class="card">
            <img src="/Images/Egg_Temp.png" alt="">
            <h3>EGG TEMPERATURE CHECK <br> ENTRY</h3>
            <button onclick="window.location.href='/egg-temperature'">OPEN</button>
        </div>
        <div class="card">
            <img src="/Images/Egg_Reject.png" alt="">
            <h3>REJECTED HATCH <br> ENTRY</h3>
            <button onclick="window.location.href='/rejected-hatch'">OPEN</button>
        </div>
        <div class="card">
            <img src="/Images/Hatch_Reject.png" alt="">
            <h3>REJECTED PULLETS <br> ENTRY</h3>
            <button onclick="window.location.href='/rejected-pullets'">OPEN</button>
        </div>
        <div class="card">
            <img src="/Images/Master_Database.png" alt="">
            <h3>HATCHERY MASTER<br> DATABASE</h3>
            <button onclick="window.location.href='/master-database'">OPEN</button>
        </div>
    </div>

</body>
</html>