<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hatchery Master Database</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{asset('images/BGC icon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/styles_master_db.css')}}">
</head>
<body>
    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>HATCHERY MASTER DATABASE</h2>
        <div class="exit-icon" >
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/Html/main_module.html'">
        </div>
    </div>

    <div class="body-split">
        <div class="sidebar">
            <a href="#card1" class="active"><div></div><p>1</p></a>
            <a href="#card2"><div></div><p>2</p></a>
            <a href="#card3"><div></div><p>3</p></a>
            <a href="#card4"><div></div><p>4</p></a>
            <a href="#card5"><div></div><p>5</p></a>
            <a href="#card6"><div></div><p>6</p></a>
            <a href="#card7"><div></div><p>7</p></a>
            <a href="#card8"><div></div><p>8</p></a>
            <a href="#card9"><div></div><p>9</p></a>
            <a href="#card10"><div></div><i class="fa-solid fa-clipboard-list"></i></a>
            <a href="#card13"><div></div><i class="fa-solid fa-table"></i></a>
        </div>

        <div class="form-entries">
            <form class="card c1" id="card1">
                <div class="card-label active">
                    <span>1</span>
                    <p>Collected Eggs</p>
                </div>

                <div class="card-form col-2">
                    <div class="input-group">
                        <label for="">PS no.</label>
                        <select name="" id="">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="">Collected Quantity</label>
                        <input type="number">
                    </div>
                    <div class="input-group">
                        <label for="">Production Date (From)</label>
                        <input type="date">
                    </div>
                    <div class="input-group">
                        <label for="">Production Date (To)</label>
                        <input type="date">
                    </div>
                </div>

                <!-- <div class="card-action">
                    <button class="save-btn">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div> -->
            </form>

            <div class="card c2" id="card2">
                <div class="card-label">
                    <span>2</span>
                    <p>Classification for Storage</p>
                </div>

                <div class="card-form">
                    <div class="input-container">
                        <div class="input-group">
                            <label for="">Non-settable Eggs</label>
                            <input type="number">
                        </div>
                        <div class="input-group">
                            <label for="">Settable Eggs</label>
                            <input type="number">
                        </div>
                    </div>
                    <br>

                    <div class="input-group">
                        <label for="">Remaining Balance</label>
                        <input type="number">
                    </div>
                </div>

            </div>

            <div class="card c3" id="card3">
                <div class="card-label">
                    <span>3</span>
                    <p>Storage Pullout Process</p>
                </div>

                <div class="card-form col-2">
                    <div class="input-group">
                        <label for="">Pullout Date</label>
                        <input type="date">
                    </div>
                    <div class="input-group">
                        <label for="">Set. Egg Quantity</label>
                        <input type="number">
                    </div>
                    <div class="input-group">
                        <label for="">Inc. No.</label>
                        <input type="number">
                    </div>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="">Prime Quantity</label>
                            <input type="number">
                        </div>   
                        <div class="input-group prcnt">
                            <label for="">%</label>
                            <input type="text" readonly>
                        </div>                     
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="">JP Quantity</label>
                            <input type="number">
                        </div>   
                        <div class="input-group prcnt">
                            <label for="">%</label>
                            <input type="text" readonly>
                        </div>                     
                    </div>

                </div>

            </div>

            <div class="card c4" id="card4">
                <div class="card-label">
                    <span>4</span>
                    <p>Setter Process Entry</p>
                </div>
                <div class="card-form col-2">
                    <div class="input-group">
                        <label for="">Day 10 Candling Date</label>
                        <input type="date">
                    </div>
                    <div class="input-group">
                        <label for="">Day 10 Candling Quantity</label>
                        <input type="number">
                    </div>
                    <div class="input-group">
                        <label for="">Day 10 Breakout Quantity</label>
                        <input type="number">
                    </div>
                    <div class="input-group">
                        <label for="">Day 10 Breaout %</label>
                        <input type="text" readonly>
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="">Day 10  Inc Quantity</label>
                        <input type="text" readonly>
                    </div>
                </div>


                                <!-- <div class="card-action">

                </div> -->

            </div>
            <div class="card c5" id="card5">
                <div class="card-label">
                    <span>5</span>
                    <p>Candling Process Entry</p>
                </div>
                <div class="card-form">
                    <div class="input-group">
                        <label for="">Day 18.5 Candling Date</label>
                        <input type="date">
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="">Infertiles Quantity</label>
                        <input type="number">
                    </div>
                    <br>    
                    <div class="input-group">
                        <label for="">Embryonic Eggs Quantity</label>
                        <input type="text" disabled>
                    </div>

                </div>

            </div>

            <div class="card c6" id="card5">
                <div class="card-label">
                    <span>5.1</span>
                    <p>Egg Shell Temperature Check</p>
                </div>
                <div class="card-form">
                    <div class="input-container">
                
                        <label for="">TOP LOCATION </label>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="">37.8</label>
                                <input type="number">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="">%</label>
                                <input type="text" readonly>
                            </div>                    
                        </div>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="">37.7</label>
                                <input type="number">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="">%</label>
                                <input type="text" readonly>
                            </div>                    
                        </div>
 
                    </div>
                    <br>
                    <div class="input-container">
                        <label for="">MID LOCATION </label>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="">37.8</label>
                                <input type="number">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="">%</label>
                                <input type="text" readonly>
                            </div>                    
                        </div>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="">37.7</label>
                                <input type="number">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="">%</label>
                                <input type="text" readonly>
                            </div>                    
                        </div>
 
                    </div>
                    <br>
                    <div class="input-container">
                        <label for="">LOW LOCATION </label>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="">37.8</label>
                                <input type="number">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="">%</label>
                                <input type="text" readonly>
                            </div>                    
                        </div>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="">37.7</label>
                                <input type="number">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="">%</label>
                                <input type="text" readonly>
                            </div>                    
                        </div>
 
                    </div>

                
                </div>
                


            </div>

            <div class="card c7" id="card6">
                <div class="card-label">
                    <span>6</span>
                    <p>Hatcher Pullout Process</p>
                </div>

                <div class="card-form col-2">
                    <div class="input-group">
                        <label for="">Hatcher</label>
                        <input type="text">
                    </div>
                    <div class="input-group">
                        <label for="">Hatcher Date</label>
                        <input type="date">
                    </div>
                    <div class="input-group">
                        <label for="">Rejected Hatch Qty</label>
                        <input type="number">
                    </div>
                    <div class="input-group">
                        <label for="">Good Hatch Qty</label>
                        <input type="text" readonly>
                    </div>
                </div>

                <!-- <div class="card-action">

                </div> -->
            </div>

            <div class="card c8" id="card7">
                <div class="card-label">
                    <span>7</span>
                    <p>Sexing</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label for="">Cockerels Quantity</label>
                        <input type="number">
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="">DOP Quantity</label>
                        <input type="text" readonly>
                    </div>

                </div>

                <!-- <div class="card-action">

                </div> -->
            </div>

            <div class="card c9" id="card8">
                <div class="card-label">
                    <span>8</span>
                    <p>QC/QA Process Entry</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label for="">QC Date</label>
                        <input type="date">
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="">Rejected DOP Qty</label>
                            <input type="number">
                        </div>
                        
                        <div class="input-group">
                            <label for="">Good DOP Qty</label>
                            <input type="text" readonly>
                        </div>
                    </div>

                </div>

                <!-- <div class="card-action">

                </div> -->
            </div>

            <div class="card c10" id="card10">
                <div class="card-label">
                    <p>Forecast Base on Last Hatch</p>
                </div>
                <div class="card-form col-3">
                    <div class="input-container">
                        <div class="input-group">
                            <label for="">Infertile Qty</label>
                            <input type="text">
                        </div>
                        
                        <div class="input-group prcnt">
                            <label for="">%</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="">Cock Qty</label>
                            <input type="text">
                        </div>
                        
                        <div class="input-group prcnt">
                            <label for="">%</label>
                            <input type="text">
                        </div>
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="">Rejected Hatch Qty</label>
                            <input type="text">
                        </div>
                        
                        <div class="input-group prcnt">
                            <label for="">%</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="">Rejected DOP Qty</label>
                            <input type="text">
                        </div>
                        
                        <div class="input-group prcnt">
                            <label for="">%</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="">Total Qty</label>
                        <input type="text">
                    </div>
                    

                </div>

                <div class="card-label">
                    <p>Forecast # of Boxes</p>
                </div>
                <div class="card-form col-3">
                    <div class="input-group">
                        <label for="">Total</label>
                        <input type="text">
                    </div>
                    <div class="input-group">
                        <label for="">%</label>
                        <input type="text">
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="">Prime</label>
                        <input type="text">
                    </div>
                    <div class="input-group">
                        <label for="">Junior Prime</label>
                        <input type="text">
                    </div>
                    <div class="input-group">
                        <label for="">DOP Booking</label>
                        <button style="width: 100%; margin-top: 10px; color: white; background-color: #EC8B18; border: none; padding: 10px; border-radius: 7px; cursor: pointer; font-size: 15px;">View / Entry</button>
                    </div>
                </div>
                

                <!-- <div class="card-action">

                </div> -->
            </div>

            <div class="card c11" id="card9">
                <div class="card-label">
                    <span>9</span>
                    <p>Dispath Process Entry</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label for="">Prime Qty</label>
                        <input type="number">
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="">Jr Prime Qty</label>
                        <input type="number">
                    </div>
                </div>
            </div>

            <div class="card c12" id="card10">
                <h1>20</h1>
                <p>Forcasted Number of <br> Boxes</p>
            </div>

            <div class="card c13" id="card13">
                <div class="table-header">
                    <h4>Data List</h4>
        
                    <div class="table-action">
                        <div class="search-bar">
                            <input type="text" placeholder="Search...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
        
                        <select class="sort-btn">
                            <option value=""> Sort By</option>
                        </select>
        
                        <div class="table-icons">
                            <i class="fa-solid fa-print"></i>
                            <i class="fa-solid fa-rotate-right"></i>
                        </div>
                        
                    </div>
        
                </div>
                <div class="table-body">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>PS no.</th>
                                <th>Production Date (From)</th>
                                <th>Production Date (To)</th>
                                <th>Collected QTY</th>
                                <th>Non Settable Eggs QTY</th>
                                <th>Storage Settable Eggs</th>
                                <th>Storage Remaining Balance</th>
                                <th>Pullout Date</th>
                                <th>Pullout Settable Eggs QTY</th>
                                <th>Incubator</th>
                                <th>Day 10 Candling Date</th>
                                <th>Day 10 Candling Eggs QTY</th>
                                <th>Day 10 Breakout QTY</th>
                                <th>Day 10 Breakout %</th>
                                <th>Day 10 Incubated Eggs</th>
                                <th>Top 37.8 UP QTY</th>
                                <th>Top 37.8 UP%</th>
                                <th>Top 37.7 BELOW QTY</th>
                                <th>Top 37.7 BELOW %</th>
                                <th>Mid 37.8 UP QTY</th>
                                <th>Mid 37.8 %</th>
                                <th>Mid 37.7 BELOW QTY</th>
                                <th>Mid 37.7 BELOW %</th>
                                <th>Low 37.8 UP QTY</th>
                                <th>Low 37.8 UP %</th>
                                <th>Low 37.7 BELOW QTY</th>
                                <th>Low 37.7 BELOW %</th>
                                <th>Day 18.5 Candling Date</th>
                                <th>Day 18.5 Infertile QTY</th>
                                <th>Day 18.5 Embryonic QTY</th>
                                <th>Hatcher</th>
                                <th>Hatch Date</th>
                                <th>Rejected Hatch QTY</th>
                                <th>Good Hatch QTY</th>
                                <th>Cockerels QTY</th>
                                <th>DOP QTY</th>
                                <th>QC Date</th>
                                <th>Rejected DOP QTY</th>
                                <th>Good DOP QTY</th>
                                <th>Prime QTY</th>
                                <th>JR Prime QTY</th>
                                <th># of Boxes</th>
                                <th>Infertile %</th>
                                <th>Infertile EST QTY</th>
                                <th>Rejected Hatch %</th>
                                <th>Rejected Hatch EST QTY</th>
                                <th>Cockerels %</th>
                                <th>Cockerels EST QTY</th>
                                <th>Rejected DOP %</th>
                                <th>Rejected DOP EST QTY</th>
                                <th>Total Rejects QTY</th>
                                <th>Projected # of Boxes</th>
                                <th>Prime Set QTY</th>
                                <th>Prime Set %</th>
                                <th>JP Set QTY</th>
                                <th>JP Set %</th>
                                <th>Prime Forecast QTY</th>
                                <th>JP Forecast QTY</th>
                                <th>Customer 1</th>
                                <th>Customer 2</th>
                                <th>Customer 3</th>
                                <th>Customer 4</th>
                                <th>Customer 5</th>
                                <th>CUST 1 Prime QTY</th>
                                <th>CUST 2 Prime QTY</th>
                                <th>CUST 3 Prime QTY</th>
                                <th>CUST 4 Prime QTY</th>
                                <th>CUST 5 Prime QTY</th>
                                <th>CUST 1 JR Prime QTY</th>
                                <th>CUST 2 JR Prime QTY</th>
                                <th>CUST 3 JR Prime QTY</th>
                                <th>CUST 4 JR Prime QTY</th>
                                <th>CUST 5 JR Prime QTY</th>
                                <th>Projected # of Boxes %</th>
                                <th>Encoded/Modified By</th>
                                <th>Date Encoded/Modified</th>
                                <th>Action Done</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>#93</td>
                                <td>09/12/25</td>
                                <td>09/12/25</td>
                                <td>30000</td>
                                <td>0</td>
                                <td>30000</td>
                                <td>30000</td>
                                <td>09/15/25</td>
                                <td>29000</td>
                                <td>Incubator A</td>
                                <td>09/20/25</td>
                                <td>28500</td>
                                <td>500</td>
                                <td>1.75%</td>
                                <td>28000</td>
                                <td>15000</td>
                                <td>53.57%</td>
                                <td>13000</td>
                                <td>46.43%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>12000</td>
                                <td>42.86%</td>
                                <td>16000</td>
                                <td>57.14%</td>
                                <td>09/28/25</td>
                                <td>500</td>
                                <td>400</td>
                                <td>Hatcher B</td>
                                <td>10/02/25</td>
                                <td>300</td>
                                <td>27000</td>
                                <td>12000</td>
                                <td>15000</td>
                                <td>10/04/25</td>
                                <td>200</td>
                                <td>14800</td>
                                <td>14000</td>
                                <td>800</td>
                                <td>600</td>
                                <td>10</td>
                                <td>1.79%</td>
                                <td>500</td>
                                <td>1.11%</td>
                                <td>300</td>
                                <td>42.86%</td>
                                <td>12000</td>
                                <td>1.35%</td>
                                <td>200</td>
                                <td>1000</td>
                                <td>8</td>
                                <td>26000</td>
                                <td>92.86%</td>
                                <td>1000</td>
                                <td>7.14%</td>
                                <td>25000</td>
                                <td>Customer A</td>
                                <td>Customer B</td>
                                <td>Customer C</td>
                                <td>Customer D</td>
                                <td>Customer E</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>85%</td>
                                <td>John Doe</td>
                                <td>10/05/25</td>
                                <td>Updated</td>
                                <td class="datalist-actions">
                                    <i class="fa-regular fa-pen-to-square" id="edit-action"></i>
                                    <i class="fa-regular fa-trash-can" id="delete-action"></i>
                                    <i class="fa-solid fa-print" id="print-action"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>#93</td>
                                <td>09/12/25</td>
                                <td>09/12/25</td>
                                <td>30000</td>
                                <td>0</td>
                                <td>30000</td>
                                <td>30000</td>
                                <td>09/15/25</td>
                                <td>29000</td>
                                <td>Incubator A</td>
                                <td>09/20/25</td>
                                <td>28500</td>
                                <td>500</td>
                                <td>1.75%</td>
                                <td>28000</td>
                                <td>15000</td>
                                <td>53.57%</td>
                                <td>13000</td>
                                <td>46.43%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>12000</td>
                                <td>42.86%</td>
                                <td>16000</td>
                                <td>57.14%</td>
                                <td>09/28/25</td>
                                <td>500</td>
                                <td>400</td>
                                <td>Hatcher B</td>
                                <td>10/02/25</td>
                                <td>300</td>
                                <td>27000</td>
                                <td>12000</td>
                                <td>15000</td>
                                <td>10/04/25</td>
                                <td>200</td>
                                <td>14800</td>
                                <td>14000</td>
                                <td>800</td>
                                <td>600</td>
                                <td>10</td>
                                <td>1.79%</td>
                                <td>500</td>
                                <td>1.11%</td>
                                <td>300</td>
                                <td>42.86%</td>
                                <td>12000</td>
                                <td>1.35%</td>
                                <td>200</td>
                                <td>1000</td>
                                <td>8</td>
                                <td>26000</td>
                                <td>92.86%</td>
                                <td>1000</td>
                                <td>7.14%</td>
                                <td>25000</td>
                                <td>Customer A</td>
                                <td>Customer B</td>
                                <td>Customer C</td>
                                <td>Customer D</td>
                                <td>Customer E</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>85%</td>
                                <td>John Doe</td>
                                <td>10/05/25</td>
                                <td>Updated</td>
                                <td class="datalist-actions">
                                    <i class="fa-regular fa-pen-to-square" id="edit-action"></i>
                                    <i class="fa-regular fa-trash-can" id="delete-action"></i>
                                    <i class="fa-solid fa-print" id="print-action"></i>
                                </td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
                <div class="table-footer">
                    <div class="pagination">
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#"><i class="fa-solid fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebarLinks = document.querySelectorAll(".sidebar a");
            const cardLabels = document.querySelectorAll(".card-label");
            const inputFields = document.querySelectorAll(".card input");
            
            const datalist = document.getElementById("card13");

            // Click event for sidebar links
            sidebarLinks.forEach(link => {
                link.addEventListener("click", function (event) {
                    const targetCard = document.querySelector(this.getAttribute("href"));
                    activateSection(targetCard);
                });
            });

            // Input event for text fields inside cards
            inputFields.forEach(input => {
                input.addEventListener("focus", function () {
                    const parentCard = this.closest(".card");
                    activateSection(parentCard);
                });
            });

            datalist.addEventListener("pointerdown", function () {
                activateSection(this);
            });

            // Function to handle sidebar and card-label activation
            function activateSection(targetCard) {
                // Remove 'active' class from all sidebar links and card labels
                sidebarLinks.forEach(link => link.classList.remove("active"));
                cardLabels.forEach(label => label.classList.remove("active"));

                if (targetCard) {
                    // Activate corresponding sidebar link
                    const targetSidebarLink = document.querySelector(`.sidebar a[href="#${targetCard.id}"]`);
                    if (targetSidebarLink) targetSidebarLink.classList.add("active");

                    // Activate card label
                    const targetLabel = targetCard.querySelector(".card-label");
                    if (targetLabel) targetLabel.classList.add("active");
                }
            }
        });
    </script>
</body>
</html>