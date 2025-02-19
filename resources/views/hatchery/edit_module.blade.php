<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/modal-notification-loader.css">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    
    <style>
        body{
            height: 100vh;
            background-color: #F6F4F1;
            padding: 40px 15%;

            display: flex;
            flex-direction: column;
            justify-content: center;    
            gap: 20px;
        }

        .body{
            padding-bottom: 80px;
        }

        .form-header{
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 15px 30px;

            background-color: white;
            border-radius: 10px;
        }

        .form-header h2{
            text-align: center;
            font-weight: 500;
            font-size: 22px;
        }

        .form-header .logo{
            width: 100px;
        }

        .form-header .exit-icon{
            display: flex;
            justify-content: end;
            width: 100px;
        }

        .form-header .exit-icon img{
            width: 30px;
            cursor: pointer;
        }
    </style>
</head>


<body>
        <!-- PUSH NOTIFICATION -->
        @if(session()->has('error'))
            <div class="push-notification danger">
                <i class="fa-solid fa-bell danger"></i>
                <div class="notification-message">
                    <h4>{{session('error')}}</h4>
                    <p>{{session('error_message')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @elseif(session()->has('success'))
            <div class="push-notification success">
                <i class="fa-solid fa-bell success"></i>
                <div class="notification-message">
                    <h4>{{session('success')}}</h4>
                    <p>{{session('success_message')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @endif
    
    <div class="modal" id="modal">
    </div>
  
    <input type="text" id="targetForm" value="{{$targetForm}}" hidden>

    @if($targetForm == 'egg-collection' && $targetForm != null)
        <form class="body" action="{{ route('edit.record.update', ['targetForm' => 'egg-collection', 'targetID' => $record->id]) }}" method="POST">
          @csrf
          @method('PATCH')

          <div class="form-header">
              <img class="logo" src="/Images/BDL.png" alt="">
              <h2>EGG COLLECTION ENTRY (EDIT FORM)</h2>
              <div class="exit-icon">
                <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/{{$targetForm}}'">
              </div>
          </div>
          <div class="form-input col-3">  
              <div class="input-container column">
                  <label for="record_id">ID <span></span></label>
                  <input name="record_id" id="record_id" type="number" value="{{ $record->id }}" readonly>
              </div>
              <div class="input-container column">
                  <label for="ps_no">PS no. <span></span></label>
                  <select name="ps_no" id="ps_no">
                      <option value="" selected></option>
                      <option value="93" {{ $record->ps_no == '93' ? 'selected' : ''}}>93</option>
                      <option value="95" {{ $record->ps_no == '95' ? 'selected' : ''}}>95</option>
                      <option value="98" {{ $record->ps_no == '98' ? 'selected' : ''}}>98</option>
                  </select>
              </div>
              <div class="input-container column">
                  <label for="house_no">House no. <span></span></label>
                  <select name="house_no" id="house_no">
                      <option value=""selected></option>
                      <option value="1" {{ $record->house_no == '1' ? 'selected' : ''}}>1</option>
                      <option value="2" {{ $record->house_no == '2' ? 'selected' : ''}}>2</option>
                      <option value="3" {{ $record->house_no == '3' ? 'selected' : ''}}>3</option>
                  </select>
              </div>
              <div class="input-container column">
                  <label for="production_date">Production Date <span></span></label>
                  <input type="date" name="production_date" id="production_date" value="{{ $record->production_date->format('Y-m-d') }}">
              </div>
              <div class="input-container column">
                  <label for="collection_time">Collection Time (hh:mm) <span></span></label>
                  <input type="time" name="collection_time" id="collection_time" value="{{ \Carbon\Carbon::parse($record->collection_time)->format('H:i') }}">
              </div>
              <div class="input-container column">
                  <label for="collection_eggs_quantity">Collected Eggs Quantity <span></span></label>
                  <input name="collection_eggs_quantity" id="collection_eggs_quantity" type="number" value="{{ $record->collected_qty }}">
              </div>
          </div>

          <div class="form-action">
              <button class="save-btn" type="submit">Save</button>
              <button class="reset-btn" type="button">Reset</button>
          </div>
      </form>
    @elseif ($targetForm == 'egg-temperature' && $targetForm != null)
        <form class="body" action="{{ route('edit.record.update', ['targetForm' => 'egg-temperature', 'targetID' => $record->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-header">
                <img class="logo" src="/Images/BDL.png" alt="">
                <h2>EGG SHELL TEMPERATURE CHECK ENTRY (EDIT FORM)</h2>
                <div class="exit-icon">
                    <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/{{$targetForm}}'">
                </div>
            </div>

            <div class="form-input col-3">
                <div class="input-container column">
                    <label for="record_id">ID <span></span></label>
                    <input name="record_id" id="record_id" type="number" value="{{ $record->id }}" readonly>
                </div>
                <div class="input-container column">
                    <label for="ps_no">PS no. <span></span></label>
                    <select name="ps_no" id="ps_no">
                        <option value=""></option>
                        <option value="#93" {{ $record->ps_no == '#93' ? 'selected' : ''}}>#93</option>
                        <option value="#94" {{ $record->ps_no == '#94' ? 'selected' : ''}}>#94</option>
                    </select>
                </div>
                
                <div class="input-container column">
                    <label for="setting_date">Setting Date <span></span></label>
                    <input type="date" name="setting_date" id="setting_date" value="{{ $record->setting_date->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="incubator_no">Incubator # <span></span></label>
                    <select name="incubator_no" id="incubator_no">
                        <option value=""></option>
                        <option value="#1" {{ $record->incubator == '1' ? 'selected' : ''}}>1</option>
                        <option value="#2" {{ $record->incubator == '2' ? 'selected' : ''}}>2</option>
                        <option value="#3" {{ $record->incubator == '5' ? 'selected' : ''}}>5</option>
                    </select>
                </div>
                <div class="input-container column">
                    <label for="location">Location <span></span></label>
                    <select name="location" id="location">
                        <option value=""></option>
                        <option value="Top" {{ $record->location == 'Top' ? 'selected' : ''}}>Top</option>
                        <option value="Mid" {{ $record->location == 'Mid' ? 'selected' : ''}}>Mid</option>
                        <option value="Low" {{ $record->location == 'Low' ? 'selected' : ''}}>Low</option>
                    </select>
                </div>
                <div class="input-container column">
                    <label for="temp_check_date">Temperature Check Date <span></span></label>
                    <input name="temp_check_date" id="temp_check_date" type="date" value="{{ $record->temperature_check_date->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="temperature">Temperature <span></span></label>
                    <select name="temperature" id="temperature">
                        <option value=""></option>
                        <option value="37.8 Above" {{ $record->temperature == '37.8 Above' ? 'selected' : ''}}>37.8 Above</option>
                        <option value="37.7 Below" {{ $record->temperature == '37.7 Below' ? 'selected' : ''}}>37.7 Below</option>
                    </select>
                </div>
                <div class="input-container column">
                    <label for="quantity">Quantity <span></span></label>
                    <input name="quantity" id="quantity" type="number" value="{{ $record->quantity }}">
                </div>
            </div>

            <div class="form-action">
                <button class="save-btn" type="submit">Save</button>
                <button class="reset-btn" type="button">Reset</button>
            </div>
        </form>

        @elseif ($targetForm == 'rejected-pullets' && $targetForm != null)
        <form class="body" action="{{ route('edit.record.update', ['targetForm' => 'rejected-pullets', 'targetID' => $record->id]) }}" method="POST">
            @csrf @method('PATCH')
            <div class="form-header">
                <img class="logo" src="/Images/BDL.png" alt="" />
                <h2>REJECTED PULLETS ENTRY (EDIT FORM)</h2>
                <div class="exit-icon">
                    <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/{{$targetForm}}'" />
                </div>
            </div>

            <div class="form-input col-5">
                <div class="input-container column">
                    <label for="ID">ID</label>
                    <input type="text" readonly value="{{$record->id}}">
                </div>

                <div class="input-container column">
                    <label for="ps_no">PS no. <span></span></label>
                    <select name="ps_no" id="ps_no">
                        <option value="" selected></option>
                        <option value="93" {{ $record->ps_no == '93' ? 'selected' : ''}}>93</option>
                        <option value="95" {{ $record->ps_no == '95' ? 'selected' : ''}}>95</option>
                        <option value="98" {{ $record->ps_no == '98' ? 'selected' : ''}}>98</option>
                    </select>
                </div>

                <div class="input-container column">
                    <label for="production_date"> Production Date <span></span> </label>
                    <input type="date" name="production_date" id="production_date" value="{{ $record->production_date->format('Y-m-d') }}" />
                </div>

                <div class="input-container column">
                    <label for="set_eggs_qty">Settable Eggs Quantity <span></span></label>
                    <input type="number" name="set_eggs_qty" id="set_eggs_qty" value="{{ $record->set_eggs_qty }}" placeholder="0">
                </div>

                <div class="input-container column">
                    <label for="incubator_no">Incubator # <span></span></label>
                    <select name="incubator_no" id="incubator_no">
                        <option value=""></option>
                        <option value="5" {{ $record->incubator_no == '5' ? 'selected' : ''}}>5</option>
                    </select>
                </div>

                <div class="input-container column">
                    <label for="hatcher_no">Hatch # <span></span></label>
                    <select name="hatcher_no" id="hatcher_no">
                        <option value=""></option>
                        <option value="5" {{ $record->hatcher_no == '5' ? 'selected' : ''}}>5</option>
                    </select>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="singkit_mata">Singkit ang 1 Mata</label>
                        <input type="number" name="singkit_mata" id="singkit_mata" placeholder="0" value="{{ $record->rejected_pullets_data['singkit_mata']['qty'] ?? 0 }}">
                    </div>
                    <div class="input-group prcnt">
                        <label for="singkit_mata_prcnt">%</label>
                        <input type="number" placeholder="0" name="singkit_mata_prcnt" id="singkit_mata_prcnt" value="{{ $record->rejected_pullets_data['singkit_mata']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="wala_mata">Walang Mata</label>
                        <input type="number" name="wala_mata" id="wala_mata" value="{{ $record->rejected_pullets_data['wala_mata']['qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="wala_mata_prcnt">%</label>
                        <input type="number" placeholder="0" name="wala_mata_prcnt" id="wala_mata_prcnt" value="{{ $record->rejected_pullets_data['wala_mata']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="maliit_mata">Maliit ang Mata</label>
                        <input type="number" name="maliit_mata" id="maliit_mata" value="{{ $record->rejected_pullets_data['maliit_mata']['qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="maliit_mata_prcnt">%</label>
                        <input type="number" placeholder="0" name="maliit_mata_prcnt" id="maliit_mata_prcnt" value="{{ $record->rejected_pullets_data['maliit_mata']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="malaki_mata">Malaki ang Mata</label>
                        <input type="number" name="malaki_mata" id="malaki_mata" value="{{ $record->rejected_pullets_data['malaki_mata']['qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="malaki_mata_prcnt">%</label>
                        <input type="number" placeholder="0" name="malaki_mata_prcnt" id="malaki_mata_prcnt" value="{{ $record->rejected_pullets_data['malaki_mata']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="unhealed_navel">Unhealed Navel</label>
                        <input type="number" name="unhealed_navel" id="unhealed_navel" value="{{ $record->rejected_pullets_data['unhealed_navel']['qty'] ?? 0 }}"  placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="unhealed_navel_prcnt">%</label>
                        <input type="number" placeholder="0" name="unhealed_navel_prcnt" id="unhealed_navel_prcnt" value="{{ $record->rejected_pullets_data['unhealed_navel']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="cross_beak">Cross Beak</label>
                        <input type="number" name="cross_beak" id="cross_beak" value= "{{ $record->rejected_pullets_data['cross_beak']['qty'] ?? 0 }}"  placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="cross_beak_prcnt">%</label>
                        <input type="number" placeholder="0" name="cross_beak_prcnt" id="cross_beak_prcnt" value= "{{ $record->rejected_pullets_data['cross_beak']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="small_chick">Small Chick</label>
                        <input type="number" name="small_chick" id="small_chick" value= "{{ $record->rejected_pullets_data['small_chick']['qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="small_chick_prcnt">%</label>
                        <input type="number" placeholder="0" name="small_chick_prcnt" id="small_chick_prcnt" value= "{{ $record->rejected_pullets_data['small_chick']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="weak_chick">Weak Chick</label>
                        <input type="number" name="weak_chick" id="weak_chick" value= "{{ $record->rejected_pullets_data['weak_chick']['qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="weak_chick_prcnt">%</label>
                        <input type="number" placeholder="0" name="weak_chick_prcnt" id="weak_chick_prcnt" value="{{ $record->rejected_pullets_data['weak_chick']['percentage'] ?? 0 }}" readonly>
                    </div> 
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="black_bottons">Black Bottons</label>
                        <input type="number" name="black_bottons" id="black_bottons" value= "{{ $record->rejected_pullets_data['black_bottons']['qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="black_bottons_prcnt">%</label>
                        <input type="number" placeholder="0" name="black_bottons_prcnt" id="black_bottons_prcnt" value= "{{ $record->rejected_pullets_data['black_bottons']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="string_navel">String Navel</label>
                        <input type="number" name="string_navel" id="string_navel" value="{{ $record->rejected_pullets_data['string_navel']['qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="string_navel_prcnt">%</label>
                        <input type="number" placeholder="0" name="string_navel_prcnt" id="string_navel_prcnt" value="{{ $record->rejected_pullets_data['string_navel']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="bloated">Bloated</label>
                        <input type="number" name="bloated" id="bloated" value="{{ $record->rejected_pullets_data['bloated']['qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="bloated_prcnt">%</label>
                        <input type="number" placeholder="0" name="bloated_prcnt" id="bloated_prcnt" value="{{ $record->rejected_pullets_data['bloated']['percentage'] ?? 0 }}" readonly>
                    </div>
                </div>

            </div>

            <div class="form-result">
                <div class="input-container column">
                    <label for="pullout_date"> Pull-out Date <span></span> </label>
                    <input type="date" name="pullout_date" id="pullout_date" value="{{ $record->pullout_date->format('Y-m-d') }}" />
                </div>
                <div class="input-container column">
                    <label for="hatch_date"> Hatch Date <span></span> </label>
                    <input type="date" name="hatch_date" id="hatch_date" value="{{ $record->hatch_date->format('Y-m-d') }}" />
                </div>
                <div class="input-container column">
                    <label for="qc_date"> QC Date <span></span> </label>
                    <input type="date" name="qc_date" id="qc_date" value="{{ $record->qc_date->format('Y-m-d') }}" />
                </div>
                <div class="input-container row">
                    <div class="input-group">
                        <label for="rejected_total">Rejected Total </label>
                        <input type="number" name="rejected_total" id="rejected_total" value="{{ $record->rejected_total }}" placeholder="0" readonly />
                    </div>
                    <div class="input-group prcnt">
                        <label for="rejected_total_percentage">Rejected Total % </label>
                        <input type="number" name="rejected_total_percentage" id="rejected_total_percentage" value="{{ $record->rejected_total_percentage }}" placeholder="0" readonly />
                    </div>
                </div>
            </div>

            <div class="form-action">
                <button class="save-btn" type="submit">Save</button>
                <button class="reset-btn" type="reset">Reset</button>
            </div>
        </form>
    @elseif ($targetForm == 'rejected-hatch' && $targetForm != null)
        <form class="body" action="{{ route('edit.record.update', ['targetForm' => 'rejected-hatch', 'targetID' => $record->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-header">
                <img class="logo" src="/Images/BDL.png" alt="">
                <h2>REJECTED HATCH ENTRY (EDIT FORM)</h2>
                <div class="exit-icon">
                    <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/{{$targetForm}}'">
                </div>
            </div>

            <div class="form-input col-5">
                <div class="input-container column">
                    <label for="ps_no">PS no. <span></span></label>
                    <select name="ps_no" id="ps_no">
                        <option value=""></option>
                        <option value="#93" {{ $record->ps_no == '#93' ? 'selected' : ''}}>#93</option>
                        <option value="#94" {{ $record->ps_no == '#94' ? 'selected' : ''}}>#94</option>
                    </select>
                </div>

                <div class="input-container column">
                    <label for="production_date">Production Date <span></span></label>
                    <input type="date" id="production_date" name="production_date" value="{{ $record->production_date->format('Y-m-d') }}">
                </div>

                <div class="input-container column">
                    <label for="set_eggs_qty">Set Egg Qty <span></span></label>
                    <input type="number" id="set_eggs_qty" name="set_eggs_qty" placeholder="0" value="{{ $record->set_eggs_qty }}">
                </div>

                <div class="input-container column">
                    <label for="incubator_no">Incubator  <span></span></label>
                    <select id="incubator_no" name="incubator_no">
                        <option value=""></option>
                        <option value="1" {{ $record->incubator_no == '1' ? 'selected' : ''}}>1</option>
                    </select>
                </div>

                <div class="input-container column">
                    <label for="hatcher_no">Hatch # <span></span></label>
                    <select id="hatcher_no" name="hatcher_no">
                        <option value=""></option>
                        <option value="1" {{ $record->hatcher_no == '1' ? 'selected' : ''}}>1</option>
                    </select>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="unhatched">Unhatched <span></span></label>
                        <input type="number" id="unhatched" name="unhatched" placeholder="0" 
                            value="{{ $record->rejected_hatch_data['unhatched']['qty'] ?? 0 }}">
                    </div>
                    <div class="input-group prcnt">
                        <label for="unhatched_prcnt">%</label>
                        <input type="number" id="unhatched_prcnt" name="unhatched_prcnt" placeholder="0" readonly
                            value="{{ $record->rejected_hatch_data['unhatched']['percentage'] ?? 0 }}">
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="pips">Pips <span></span></label>
                        <input type="number" id="pips" name="pips" placeholder="0" 
                            value="{{ $record->rejected_hatch_data['pips']['qty'] ?? 0 }}">
                    </div>
                    <div class="input-group prcnt">
                        <label for="pips_prcnt">%</label>
                        <input type="number" id="pips_prcnt" name="pips_prcnt" placeholder="0" readonly
                            value="{{ $record->rejected_hatch_data['pips']['percentage'] ?? 0 }}">
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="rejected_chicks">Rejected Chicks <span></span></label>
                        <input type="number" id="rejected_chicks" name="rejected_chicks" placeholder="0" 
                            value="{{ $record->rejected_hatch_data['rejected_chicks']['qty'] ?? 0 }}">
                    </div>
                    <div class="input-group prcnt">
                        <label for="rejected_chicks_prcnt">%</label>
                        <input type="number" id="rejected_chicks_prcnt" name="rejected_chicks_prcnt" placeholder="0" readonly
                            value="{{ $record->rejected_hatch_data['rejected_chicks']['percentage'] ?? 0 }}">
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="dead_chicks">Dead Chicks <span></span></label>
                        <input type="number" id="dead_chicks" name="dead_chicks" placeholder="0" 
                            value="{{ $record->rejected_hatch_data['dead_chicks']['qty'] ?? 0 }}">
                    </div>
                    <div class="input-group prcnt">
                        <label for="dead_chicks_prcnt">%</label>
                        <input type="number" id="dead_chicks_prcnt" name="dead_chicks_prcnt" placeholder="0" readonly
                            value="{{ $record->rejected_hatch_data['dead_chicks']['percentage'] ?? 0 }}">
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="rotten">Rotten <span></span></label>
                        <input type="number" id="rotten" name="rotten" placeholder="0" 
                            value="{{ $record->rejected_hatch_data['rotten']['qty'] ?? 0 }}">
                    </div>
                    <div class="input-group prcnt">
                        <label for="rotten_prcnt">%</label>
                        <input type="number" id="rotten_prcnt" name="rotten_prcnt" placeholder="0" readonly
                            value="{{ $record->rejected_hatch_data['rotten']['percentage'] ?? 0 }}">
                    </div>
                </div>

                <div class="input-container column">
                    <label for="pullout_date">Pull-out Date <span></span></label>
                    <input type="date" id="pullout_date" name="pullout_date" value="{{ $record->pullout_date->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="hatch_date">Hatch Date <span></span></label>
                    <input type="date" id="hatch_date" name="hatch_date" value="{{ $record->hatch_date->format('Y-m-d') }}">
                </div>
                <div class="input-container row">

                    <div class="input-group">
                        <label for="rejected_total">Rejected Total</label>
                        <input type="number" id="rejected_total" name="rejected_total" value="{{ $record->rejected_total }}" placeholder="0" readonly>
                    </div>
                    <div class="input-group prcnt">
                        <label for="rejected_total_prcnt">%</label>
                        <input type="number" id="rejected_total_prcnt" name="rejected_total_prcnt" value="{{ $record->rejected_total_percentage }}" placeholder="0" readonly>
                    </div>
                    
                </div>

            </div>

            <div class="form-action">
                <button class="save-btn">Save</button>
                <button class="reset-btn" type="reset">Reset</button>
            </div>

        </form>
    @endif

    <script>
        const form = document.querySelector(".body"); // Main form container
        const inputs = form.querySelectorAll("input, select"); // All form fields

        const formAction = form.querySelector(".form-action"); // Form action buttons
        const resetButton = form.querySelector(".reset-btn"); // Reset button

        const modal = document.getElementById("modal"); // Modal
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF token

        let targetForm = document.getElementById("targetForm").value;

        //make every input type number prevent user from entering special characters just purely number
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            })  
        })

        // Function to check if any input has a value
        function checkFormValues() {
            let hasValue = false;

            inputs.forEach(input => {
                if (input.value.trim() !== "") {
                    hasValue = true;
                }
            });

            // Show or hide the form-action buttons
            formAction.style.display = hasValue ? "flex" : "none";
        }

        // Event listeners for inputs and selects
        inputs.forEach(input => {
            input.addEventListener("input", checkFormValues);
            input.addEventListener("change", checkFormValues); // For select and date/time inputs
        });

        // Store the original values of the form fields
        const originalValues = {};
        form.querySelectorAll("input, select").forEach(input => {
            if (input.type === "checkbox" || input.type === "radio") {
                originalValues[input.name] = input.checked;
            } else {
                originalValues[input.name] = input.value;
            }
        });

        // Reset button functionality
        resetButton.addEventListener("click", function () {
            form.querySelectorAll("input, select").forEach(input => {
                if (input.type === "checkbox" || input.type === "radio") {
                    input.checked = originalValues[input.name];
                } else {
                    input.value = originalValues[input.name];
                }
            });

            // hide the form-action buttons
            formAction.style.display = "none";
        });

        document.querySelector("form").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent form submission initially
            let isValid = true;

            let requiredFields = [];

            if (targetForm === "egg-collection") {
                requiredFields = ["ps_no", "house_no", "production_date", "collection_time", "collection_eggs_quantity"];
            } else if (targetForm === "egg-temperature") {
                requiredFields = ["ps_no", "setting_date", "incubator_no", "location", "temp_check_date", "temperature", "quantity"];
            } else if (targetForm === "rejected-hatch") {
                requiredFields = ["ps_no", "production_date", "set_eggs_qty", "incubator_no", "hatcher_no", "pullout_date", "hatch_date"];;
            } else if (targetForm === "rejected-pullets") {
                requiredFields = ["ps_no", "production_date", "set_eggs_qty", "incubator_no", "hatcher_no", "pullout_date", "hatch_date", "qc_date"];
            }

            requiredFields.forEach(id => {
                let field = document.getElementById(id);
                if (field) {
                    let labelSpan = field.closest(".input-container")?.querySelector("label span");

                    if (!field.value.trim()) {
                        field.style.border = "2px solid #ea4435d7";
                        if (labelSpan) {
                            labelSpan.textContent = "(This field is required)";
                            labelSpan.style.color = "#ea4435d7";
                        }
                        isValid = false;
                    } else {
                        field.style.border = "";
                        if (labelSpan) {
                            labelSpan.textContent = "";
                        }
                    }
                }
            });

            if (isValid) {
                showModal('save');
            }
        });


        function showModal(){
            modal.classList.add("active");
            modal.innerHTML = `
                <div class="modal-content">
                    <i class="fa-solid fa-xmark" id="close-button"></i>
                    <div class="modal-header">
                        <i class="fa-solid fa-circle-check success"></i>
                        <h2>Update Record</h2>
                        <h4>Are you sure you want to update this record?</h4>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="confirm-button save-btn">
                            Update
                        </button>
                        <button type="button" class="cancel-button">Cancel</button>
                    </div>
                </div>
            `;

            document.querySelector('.save-btn').addEventListener('click', () => {
                document.querySelector('form').submit();
            });
        }

        document.addEventListener("click", function (event) {

            if (!modal.classList.contains("active")) return;

            if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
                modal.classList.remove("active");
            }

        });

        // Reset button functionality
        resetButton.addEventListener("click", function () {
            inputs.forEach(input => {
                let inputContainer = input.closest(".input-container");

                if (inputContainer) {
                    let labelSpan = inputContainer.querySelector("label span");
                    if (labelSpan) {
                        labelSpan.textContent = ""; // Clear the label span
                    }
                }

                input.style.border = "";  // Reset border styling
            });

        });

        if(targetForm === "rejected-hatch"){
            document.addEventListener("DOMContentLoaded", function () {
                const setEggsQtyInput = document.getElementById("set_eggs_qty");
                const totalRejectedInput = document.getElementById("rejected_total");
                const fields = ["unhatched", "pips", "rejected_chicks", "dead_chicks", "rotten"];

                // Add event listeners for all fields
                fields.forEach(field => {
                    document.getElementById(field).addEventListener("input", updatePercentages);
                });

                // Update percentages when set_eggs_qty changes
                setEggsQtyInput.addEventListener("change", updatePercentages);

                function updatePercentages() {
                    let setEggsQty = parseFloat(setEggsQtyInput.value) || 1; // Avoid division by zero
                    let totalRejected = 0;

                    // Reset if setEggsQty is empty or invalid
                    if (!setEggsQtyInput.value.trim() || totalRejectedInput.value > setEggsQty) {
                        fields.forEach(field => {
                            document.getElementById(field).value = 0;
                            document.getElementById(`${field}_prcnt`).value = "0.0"; // Keep decimal
                        });
                        totalRejectedInput.value = 0;
                        document.getElementById("rejected_total_prcnt").value = "0.0"; // Keep decimal
                        return;
                    }

                    fields.forEach(field => {
                        let fieldInput = document.getElementById(field);
                        let value = parseInt(fieldInput.value) || 0;

                        // Prevent input values from exceeding setEggsQty
                        if (value > setEggsQty) {
                            fieldInput.value = setEggsQty;
                            value = setEggsQty;
                        }

                        let percentage = ((value / setEggsQty) * 100).toFixed(1); // Keep 1 decimal
                        document.getElementById(`${field}_prcnt`).value = percentage; // Keep decimal
                        totalRejected += value;
                    });

                    // Update Rejected Total and Percentage
                    totalRejectedInput.value = totalRejected;
                    let rejectedPercentage = ((totalRejected / setEggsQty) * 100).toFixed(1);
                    document.getElementById("rejected_total_prcnt").value = rejectedPercentage; // Keep decimal
                }
            });
        } else if(targetForm === "rejected-pullets") {
            document.addEventListener("DOMContentLoaded", function () {
              const setEggsQtyInput = document.getElementById("set_eggs_qty"); // Make sure the ID matches in your HTML
              const totalRejectedInput = document.getElementById("rejected_total");
              const fields = ["singkit_mata", "wala_mata", "maliit_mata", "malaki_mata", "unhealed_navel", "cross_beak", "small_chick", "weak_chick", "black_bottons", "string_navel", "bloated"];

              // Add event listeners for all fields
              fields.forEach(field => {
                  document.getElementById(field).addEventListener("input", updatePercentages);
              });

              // Update percentages when set_eggs_qty changes
              setEggsQtyInput.addEventListener("change", updatePercentages);

              function updatePercentages() {
                  let setEggsQty = parseFloat(setEggsQtyInput.value) || 1; // Avoid division by zero
                  let totalRejected = 0;

                  // Reset if setEggsQty is empty or invalid
                  if (!setEggsQtyInput.value.trim()) {
                      return; // Do nothing if the input is empty
                  }

                  if (parseInt(totalRejectedInput.value) > setEggsQty) {
                      // Only reset if total rejections exceed the new total eggs
                      fields.forEach(field => {
                          document.getElementById(field).value = 0;
                          document.getElementById(`${field}_prcnt`).value = "0.0";
                      });
                      totalRejectedInput.value = 0;
                      document.getElementById("rejected_total_percentage").value = "0.0";
                  }

                  fields.forEach(field => {
                      let fieldInput = document.getElementById(field);
                      let value = parseInt(fieldInput.value) || 0;

                      // Prevent input values from exceeding setEggsQty
                      if (value > setEggsQty) {
                          fieldInput.value = setEggsQty;
                          value = setEggsQty; 
                      }

                      let percentage = ((value / setEggsQty) * 100).toFixed(1); // Keep 1 decimal
                      document.getElementById(`${field}_prcnt`).value = percentage; // Keep decimal
                      totalRejected += value;
                  });

                  // Update Rejected Total and Percentage
                  totalRejectedInput.value = totalRejected;
                  let rejectedPercentage = ((totalRejected / setEggsQty) * 100).toFixed(1);
                  document.getElementById("rejected_total_percentage").value = rejectedPercentage; // Keep decimal
              }
          });
        }
        
    </script>
</body>
</html>