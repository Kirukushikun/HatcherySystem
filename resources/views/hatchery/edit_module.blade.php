<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{asset('images/BGC icon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/modal-notification-loader.css')}}">
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

            /* padding: 15px 30px; */

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
                  <label for="ps_no">PS No. <span></span></label>
                  <x-dropdown :data-category="'ps_no'" :data-value="$record->ps_no" />
              </div>
              <div class="input-container column">
                  <label for="house_no">House No. <span></span></label>
                  <x-dropdown :data-category="'house_no'" :data-value="$record->house_no" />
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
                    <label for="temp_check_date">Temperature Check Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                    <input name="temp_check_date" id="temp_check_date" type="date" value="{{ $record->temp_check_date->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="setting_date">Setting Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                    <input name="setting_date" id="setting_date" type="date" value="{{ $record->setting_date->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="hatch_date">Hatch Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                    <input name="hatch_date" id="hatch_date" type="date" value="{{ $record->hatch_date->format('Y-m-d') }}">
                </div>
            </div>

            <div class="form-header chamber">
                <h4>OVERALL</h4>
                <div class="line"></div>
            </div>

            <div class="form-input col-4">
                <div class="input-container column">
                    <label for="temp_check_qty">Temperature Check QTY <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                    <input name="temp_check_qty" id="temp_check_qty" type="number" value="{{ $record->temp_check_qty }}" placeholder="0">
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="ovrl_above_temp_qty">Above <b>100.5 °F</b>  QTY <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                        <input type="number" id="ovrl_above_temp_qty" name="ovrl_above_temp_qty" value="{{ $record->ovrl_above_temp_qty }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="ovrl_above_temp_prcnt">%</label>
                        <input type="number" id="ovrl_above_temp_prcnt" name="ovrl_above_temp_prcnt" value="{{ (int) $record->ovrl_above_temp_prcnt }}" placeholder="0" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="ovrl_below_temp_qty">Below <b>100.4 °F</b> QTY<span></span></label>
                        <input type="number" id="ovrl_below_temp_qty" name="ovrl_below_temp_qty" value="{{ $record->ovrl_below_temp_qty }}" placeholder="0" readonly>
                    </div>
                    <div class="input-group prcnt">
                        <label for="ovrl_below_temp_prcnt">%</label>
                        <input type="number" id="ovrl_below_temp_prcnt" name="ovrl_below_temp_prcnt" value="{{ (int) $record->ovrl_below_temp_prcnt }}" placeholder="0" readonly>
                    </div>
                </div>
            </div>

            <div class="form-header chamber">
                <h4>LEFT</h4>
                <div class="line"></div>
            </div>

            <div class="form-input col-4">
                <div class="input-container column">
                    <label for="left_ps_no">PS No. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                    <x-dropdown :data-category="'left_ps_no'" :data-value="$record->egg_temperature_data['left']['ps_no'] ?? ''" />
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="left_above_temp_qty">Above <b>100.5 °F</b>  QTY<span></span></label>
                        <input type="number" id="left_above_temp_qty" name="left_above_temp_qty" value="{{ $record->egg_temperature_data['left']['above_temp_qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="left_above_temp_prcnt">%</label>
                        <input type="number" id="left_above_temp_prcnt" name="left_above_temp_prcnt" value="{{ $record->egg_temperature_data['left']['above_temp_prcnt'] ?? 0 }}" placeholder="0" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="left_below_temp_qty">Below <b>100.4 °F</b> QTY<span></span></label>
                        <input type="number" id="left_below_temp_qty" name="left_below_temp_qty" value="{{ $record->egg_temperature_data['left']['below_temp_qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="left_below_temp_prcnt">%</label>
                        <input type="number" id="left_below_temp_prcnt" name="left_below_temp_prcnt" value="{{ $record->egg_temperature_data['left']['below_temp_prcnt'] ?? 0 }}" placeholder="0" readonly>
                    </div>
                </div>

                <div class="input-container column">
                    <label for="total_left_qty">Total Left QTY</label>
                    <input name="total_left_qty" id="total_left_qty" type="number" value="{{ $record->egg_temperature_data['left']['total_qty'] ?? 0 }}" placeholder="0" readonly>
                </div>
            </div>

            <div class="form-header chamber">
                <h4>RIGHT</h4>
                <div class="line"></div>
            </div>

            <div class="form-input col-4">
                <div class="input-container column">
                    <label for="right_ps_no">PS No. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                    <x-dropdown :data-category="'right_ps_no'" :data-value="$record->egg_temperature_data['right']['ps_no'] ?? ''" />
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="right_above_temp_qty">Above <b>100.5 °F</b>  QTY<span></span></label>
                        <input type="number" id="right_above_temp_qty" name="right_above_temp_qty" value="{{ $record->egg_temperature_data['right']['above_temp_qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="right_above_temp_prcnt">%</label>
                        <input type="number" id="right_above_temp_prcnt" name="right_above_temp_prcnt" value="{{ $record->egg_temperature_data['right']['above_temp_prcnt'] ?? 0 }}" placeholder="0" readonly>
                    </div>
                </div>

                <div class="input-container row">
                    <div class="input-group">
                        <label for="right_below_temp_qty">Below <b>100.4 °F</b> QTY<span></span></label>
                        <input type="number" id="right_below_temp_qty" name="right_below_temp_qty" value="{{ $record->egg_temperature_data['right']['below_temp_qty'] ?? 0 }}" placeholder="0">
                    </div>
                    <div class="input-group prcnt">
                        <label for="right_below_temp_prcnt">%</label>
                        <input type="number" id="right_below_temp_prcnt" name="right_below_temp_prcnt" value="{{ $record->egg_temperature_data['right']['below_temp_prcnt'] ?? 0 }}" placeholder="0" readonly>
                    </div>
                </div>

                <div class="input-container column">
                    <label for="total_right_qty">Total Left QTY</label>
                    <input name="total_right_qty" id="total_right_qty" type="number" value="{{ $record->egg_temperature_data['right']['total_qty'] ?? 0 }}" placeholder="0" readonly>
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

            <div class="form-input col-4">

                <div class="input-container column">
                    <label for="ps_no">PS No. <span></span></label>
                    <x-dropdown :data-category="'ps_no'" :data-value="$record->ps_no" />
                </div>

                <div class="input-container column">
                    <label for="set_eggs_qty">Settable Eggs Quantity <span></span></label>
                    <input type="number" name="set_eggs_qty" id="set_eggs_qty" value="{{ $record->set_eggs_qty }}" placeholder="0">
                </div>

                <div class="input-container column">
                    <label for="incubator_no">Incubator No. <span></span></label>
                    <select name="incubator_no[]" id="incubator_no" multiple multiselect-select-all="true" multiselect-search="true">
                        <x-multiselect-dropdown :data-category="'incubator_no'" :data-value="$record->incubator_no" />
                    </select>
                </div>

                <div class="input-container column">
                    <label for="hatcher_no">Hatcher No. <span></span></label>
                    <select name="hatcher_no[]" id="hatcher_no" multiple multiselect-select-all="true" multiselect-search="true">
                        <x-multiselect-dropdown :data-category="'hatcher_no'" :data-value="$record->hatcher_no" />
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

            <div class="form-input col-5">
                <div class="input-container column">
                    <label for="production_date_from">Production Date <span></span></label>
                    <input type="date" id="production_date_from" name="production_date_from" value="{{ $record->production_date_from->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="production_date_to">Production Date <span></span></label>
                    <input type="date" id="production_date_to" name="production_date_to" value="{{ $record->production_date_to->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="hatch_date">Hatch Date <span></span></label>
                    <input type="date" id="hatch_date" name="hatch_date" value="{{ $record->hatch_date->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="qc_date">QC Date <span></span></label>
                    <input type="date" id="qc_date" name="qc_date" value="{{ $record->qc_date->format('Y-m-d') }}">
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

            <div class="form-input col-4">
                <div class="input-container column">
                    <label for="ps_no">PS No. <span></span></label>
                    <x-dropdown :data-category="'ps_no'" :data-value="$record->ps_no" />
                </div>

                <div class="input-container column">
                    <label for="set_eggs_qty">Set Egg Qty <span></span></label>
                    <input type="number" id="set_eggs_qty" name="set_eggs_qty" placeholder="0" value="{{ $record->set_eggs_qty }}">
                </div>

                <div class="input-container column">
                    <label for="incubator_no">Incubator No. <span></span></label>
                    <select name="incubator_no[]" id="incubator_no" multiple multiselect-select-all="true" multiselect-search="true">
                        <x-multiselect-dropdown :data-category="'incubator_no'" :data-value="$record->incubator_no" />
                    </select>
                </div>

                <div class="input-container column">
                    <label for="hatcher_no">Hatcher No. <span></span></label>
                    <select name="hatcher_no[]" id="hatcher_no" multiple multiselect-select-all="true" multiselect-search="true">
                        <x-multiselect-dropdown :data-category="'hatcher_no'" :data-value="$record->hatcher_no" />
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

            </div>

            <div class="form-input col-5">
                <div class="input-container column">
                    <label for="production_date_from">Production Date <span></span></label>
                    <input type="date" id="production_date_from" name="production_date_from" value="{{ $record->production_date_from->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="production_date_to">Production Date <span></span></label>
                    <input type="date" id="production_date_to" name="production_date_to" value="{{ $record->production_date_to->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="hatch_date">Hatch Date <span></span></label>
                    <input type="date" id="hatch_date" name="hatch_date" value="{{ $record->hatch_date->format('Y-m-d') }}">
                </div>
                <div class="input-container column">
                    <label for="qc_date">QC Date <span></span></label>
                    <input type="date" id="qc_date" name="qc_date" value="{{ $record->qc_date->format('Y-m-d') }}">
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
    @elseif ($targetForm == 'maintenance-value' && $targetForm != null)
        <div class="form-header">
            <img class="logo" src="/Images/BDL.png" alt="">
            <h2>MAINTENANCE VALUE (EDIT FORM)</h2>
            <div class="exit-icon">
                <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/admin'">
            </div>
        </div>
            <form class="body" action="{{ route('edit.record.update', ['targetForm' => 'maintenance-value', 'targetID' => $record->id]) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="table-form">
                    <div class="form-header">
                        <h4>Add Maintenance Value</h4>
                    </div>
                    <div class="form-input col-2">  
                        <div class="input-container column">
                            <label for="data_category">Dynamic Fields<span></span></label>
                            <select name="data_category" id="data_category">
                                <option value="" selected></option>
                                <option value="ps_no" {{ $record->data_category == 'ps_no' ? 'selected' : ''}}>PS No.</option>
                                <option value="hatcher_no" {{ $record->data_category == 'hatcher_no' ? 'selected' : ''}}>Hatcher No.</option>
                                <option value="house_no" {{ $record->data_category == 'house_no' ? 'selected' : ''}}>House No.</option>
                                <option value="incubator_no" {{ $record->data_category == 'incubator_no' ? 'selected' : ''}}>Incubator No.</option>
                            </select>
                        </div>
                        <div class="input-container column">
                            <label for="data_value">Value<span></span></label>
                            <input type="text" name="data_value" id="data_value" value="{{ $record->data_value }}" placeholder="0">
                        </div>
                    </div>
                    <div class="form-action active">
                        <button class="save-btn" type="submit">Save</button>
                        <button class="reset-btn" type="reset">Reset</button>
                    </div>
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
                requiredFields = ["temp_check_date", "setting_date" , "hatch_date", "temp_check_qty", "ovrl_above_temp_qty", "left_ps_no", "right_ps_no"];
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
                      document.getElementById("rejected_total_prcnt").value = "0.0";
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
        } else if (targetForm === "egg-temperature"){
            let temp_check_qty = document.getElementById("temp_check_qty");

            let ovrl_above_temp_qty = document.getElementById("ovrl_above_temp_qty");
            let ovrl_above_temp_prcnt = document.getElementById("ovrl_above_temp_prcnt");

            let ovrl_below_temp_qty = document.getElementById("ovrl_below_temp_qty");
            let ovrl_below_temp_prcnt = document.getElementById("ovrl_below_temp_prcnt");

            let left_above_temp_qty = document.getElementById("left_above_temp_qty");
            let left_above_temp_prcnt = document.getElementById("left_above_temp_prcnt");

            let left_below_temp_qty = document.getElementById("left_below_temp_qty");
            let left_below_temp_prcnt = document.getElementById("left_below_temp_prcnt");

            let right_above_temp_qty = document.getElementById("right_above_temp_qty");
            let right_above_temp_prcnt = document.getElementById("right_above_temp_prcnt");

            let right_below_temp_qty = document.getElementById("right_below_temp_qty");
            let right_below_temp_prcnt = document.getElementById("right_below_temp_prcnt");

            let total_left_qty = document.getElementById("total_left_qty");
            let total_right_qty = document.getElementById("total_right_qty");

            function calculateOverallTemps() {
                let total = parseInt(temp_check_qty.value) || 0;
                let aboveQty = parseInt(ovrl_above_temp_qty.value) || 0;

                if (aboveQty > total) {
                    aboveQty = total;
                    ovrl_above_temp_qty.value = total;
                } else if (aboveQty < 0) {
                    aboveQty = 0;
                    ovrl_above_temp_qty.value = 0;
                }

                let abovePrcnt = Math.round((aboveQty / total) * 100);
                let belowQty = total - aboveQty;
                let belowPrcnt = 100 - abovePrcnt;

                ovrl_above_temp_prcnt.value = abovePrcnt;
                ovrl_below_temp_qty.value = belowQty;
                ovrl_below_temp_prcnt.value = belowPrcnt;

                calculateLeftRightTemps(aboveQty, belowQty);
            }

            function calculateLeftRightTemps(aboveQty, belowQty) {
                let leftAbove = parseInt(left_above_temp_qty.value) || 0;
                let leftBelow = parseInt(left_below_temp_qty.value) || 0;

                // Clamp left inputs
                if (leftAbove > aboveQty) {
                    leftAbove = aboveQty;
                    left_above_temp_qty.value = aboveQty;
                }
                if (leftBelow > belowQty) {
                    leftBelow = belowQty;
                    left_below_temp_qty.value = belowQty;
                }

                let leftTotal = leftAbove + leftBelow;
                let rightAbove = aboveQty - leftAbove;
                let rightBelow = belowQty - leftBelow;
                let rightTotal = rightAbove + rightBelow;

                // Percentages
                let leftAbovePercent = leftTotal > 0 ? Math.round((leftAbove / leftTotal) * 100) : 0;
                let leftBelowPercent = leftTotal > 0 ? 100 - leftAbovePercent : 0;

                let rightAbovePercent = rightTotal > 0 ? Math.round((rightAbove / rightTotal) * 100) : 0;
                let rightBelowPercent = rightTotal > 0 ? 100 - rightAbovePercent : 0;

                // Set values
                left_above_temp_prcnt.value = leftAbovePercent;
                left_below_temp_prcnt.value = leftBelowPercent;

                right_above_temp_qty.value = rightAbove;
                right_above_temp_prcnt.value = rightAbovePercent;

                right_below_temp_qty.value = rightBelow;
                right_below_temp_prcnt.value = rightBelowPercent;

                total_left_qty.value = leftTotal;
                total_right_qty.value = rightTotal;
            }

            ovrl_above_temp_qty.addEventListener("input", calculateOverallTemps);
            left_above_temp_qty.addEventListener("input", () => {
                let aboveQty = parseInt(ovrl_above_temp_qty.value) || 0;
                let belowQty = parseInt(ovrl_below_temp_qty.value) || 0;
                calculateLeftRightTemps(aboveQty, belowQty);
            });

            left_below_temp_qty.addEventListener("input", () => {
                let aboveQty = parseInt(ovrl_above_temp_qty.value) || 0;
                let belowQty = parseInt(ovrl_below_temp_qty.value) || 0;
                calculateLeftRightTemps(aboveQty, belowQty);
            });
        }


        
    </script>

    <script src="{{asset('js/multiselect-dropdown-module.js')}}" defer></script>
</body>
</html>