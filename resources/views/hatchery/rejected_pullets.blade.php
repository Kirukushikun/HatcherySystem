@include('components.modal-notification-loader')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejected Pullets Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/modal-notification-loader.css">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->

</head>
<body>

    @yield('modal-notification-loader')

    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>REJECTED PULLETS ENTRY</h2>
        <div class="exit-icon">
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/home'">
        </div>
    </div>
    <form class="body" action="{{route('rejected.pullets.store')}}" method="POST">
        @csrf
        <div class="form-header">
            <h4>Entry Form</h4>
        </div>

        <div class="form-input col-5">
            <div class="input-container column">
                <label for="ps_no">PS No. <span></span></label>
                <x-dropdown :data-category="'ps_no'" />
            </div>

            <div class="input-container column">
                <label for="production_date"> Production Date <span></span> </label>
                <input type="date" name="production_date" id="production_date" value="{{ session('form_data.production_date', date('Y-m-d')) }}" />
            </div>

            <div class="input-container column">
                <label for="set_eggs_qty">Settable Eggs Quantity <span></span></label>
                <input type="number" name="set_eggs_qty" id="set_eggs_qty" value="{{ session('form_data.set_eggs_qty', '') }}" placeholder="0">
            </div>

            <div class="input-container column">
                <label for="incubator_no">Incubator No. <span></span></label>
                <x-dropdown :data-category="'incubator_no'" />
            </div>

            <div class="input-container column">
                <label for="hatcher_no">Hatcher No. <span></span></label>
                <x-dropdown :data-category="'hatcher_no'" />
            </div>

            <div class="input-container row">

                <div class="input-group">
                    <label for="singkit_mata">One Eye closed</label>
                    <input type="number" name="singkit_mata" id="singkit_mata" value="{{ session('form_data.singkit_mata', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="singkit_mata_prcnt">%</label>
                    <input type="number" placeholder="0" name="singkit_mata_prcnt" id="singkit_mata_prcnt" readonly>
                </div>

            </div>

            <div class="input-container row">

                <div class="input-group">
                    <label for="wala_mata">No Eyes </label>
                    <input type="number" name="wala_mata" id="wala_mata" value="{{ session('form_data.wala_mata', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="wala_mata_prcnt">%</label>
                    <input type="number" placeholder="0" name="wala_mata_prcnt" id="wala_mata_prcnt" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="maliit_mata">Small Eyes </label>
                    <input type="number" name="maliit_mata" id="maliit_mata" value="{{ session('form_data.maliit_mata', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="maliit_mata_prcnt">%</label>
                    <input type="number" placeholder="0" name="maliit_mata_prcnt" id="maliit_mata_prcnt" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="malaki_mata">Large Eyes </label>
                    <input type="number" name="malaki_mata" id="malaki_mata" value="{{ session('form_data.malaki_mata', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="malaki_mata_prcnt">%</label>
                    <input type="number" placeholder="0" name="malaki_mata_prcnt" id="malaki_mata_prcnt" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="unhealed_navel">Unhealed Navel </label>
                    <input type="number" name="unhealed_navel" id="unhealed_navel" value="{{ session('form_data.unhealed_navel', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="unhealed_navel_prcnt">%</label>
                    <input type="number" placeholder="0" name="unhealed_navel_prcnt" id="unhealed_navel_prcnt" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="cross_beak">Crossed Beak </label>
                    <input type="number" name="cross_beak" id="cross_beak" value="{{ session('form_data.cross_beak', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="cross_beak_prcnt">%</label>
                    <input type="number" placeholder="0" name="cross_beak_prcnt" id="cross_beak_prcnt" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="small_chick">Small Chick </label>
                    <input type="number" name="small_chick" id="small_chick" value="{{ session('form_data.small_chick', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="small_chick_prcnt">%</label>
                    <input type="number" placeholder="0" name="small_chick_prcnt" id="small_chick_prcnt" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="weak_chick">Weak Chick </label>
                    <input type="number" name="weak_chick" id="weak_chick" value="{{ session('form_data.weak_chick', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="weak_chick_prcnt">%</label>
                    <input type="number" placeholder="0" name="weak_chick_prcnt" id="weak_chick_prcnt" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="black_bottons">Black Bottons </label>
                    <input type="number" name="black_bottons" id="black_bottons" value="{{ session('form_data.black_bottons', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="black_bottons_prcnt">%</label>
                    <input type="number" placeholder="0" name="black_bottons_prcnt" id="black_bottons_prcnt" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="string_navel">String Navel </label>
                    <input type="number" name="string_navel" id="string_navel" value="{{ session('form_data.string_navel', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="string_navel_prcnt">%</label>
                    <input type="number" placeholder="0" name="string_navel_prcnt" id="string_navel_prcnt" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="bloated">Bloated </label>
                    <input type="number" name="bloated" id="bloated" value="{{ session('form_data.bloated', '') }}" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="bloated_prcnt">%</label>
                    <input type="number" placeholder="0" name="bloated_prcnt" id="bloated_prcnt" readonly>
                </div>

            </div>
        </div>

        <div class="form-result">
            <div class="input-container column">
                <label for="pullout_date"> Pull-out Date <span></span> </label>
                <input type="date" name="pullout_date" id="pullout_date" value="{{ session('form_data.pullout_date', date('Y-m-d')) }}" />
            </div>
            <div class="input-container column">
                <label for="hatch_date"> Hatch Date <span></span> </label>
                <input type="date" name="hatch_date" id="hatch_date" value="{{ session('form_data.hatch_date', date('Y-m-d')) }}" />
            </div>
            <div class="input-container column">
                <label for="qc_date"> QC Date <span></span> </label>
                <input type="date" name="qc_date" id="qc_date" value="{{ session('form_data.qc_date', date('Y-m-d')) }}" />
            </div>
            <div class="input-container row">
                <div class="input-group">
                    <label for="rejected_total">Rejected Total </label>
                    <input type="number" name="rejected_total" id="rejected_total" value="{{ session('form_data.rejected_total', '') }}" placeholder="0" readonly />
                </div>
                <div class="input-group prcnt">
                    <label for="rejected_total_prcnt">%</label>
                    <input type="number" name="rejected_total_prcnt" id="rejected_total_prcnt" value="{{ session('form_data.rejected_total_prcnt', '') }}" placeholder="0" readonly />
                </div>
            </div>
        </div>

        <div class="form-action">
        <button class="save-btn" type="submit">Save</button>
        <button class="reset-btn" type="reset">Reset</button>
        </div>

    </form>

    <div class="datalist">
        <div class="table-header">
            <h4>Data List</h4>

            <div class="table-action">
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <select class="sort-btn" name="sort_by" id="sort_by">
                    <option value="production_date_desc">Sort By: Date (Newest)</option>
                    <option value="production_date_asc">Sort By: Date (Oldest)</option>
                    <option value="ps_no_asc">Sort By: PS No.</option>
                    <option value="incubator_no_asc">Sort By: Incubator No.</option>
                    <option value="hatcher_no_asc">Sort By: Hatch No.</option>
                    <option value="set_eggs_qty_desc">Sort By: Set Eggs Quantity (Highest)</option>
                    <option value="set_eggs_qty_asc">Sort By: Set Eggs Quantity (Lowest)</option>
                    <option value="rejected_total_desc">Sort By: Rejected Total (Highest)</option>
                    <option value="rejected_total_asc">Sort By: Rejected Total (Lowest)</option>
                </select>

                <div class="table-icons">
                    <i class="fa-solid fa-share-from-square" onclick="showModal('print')"></i>
                    <i class="fa-solid fa-rotate-right" onclick="refreshTable()"></i>
                </div>
            </div>

        </div>
        <div class="table-body">
           <livewire:rejected-pullets-table />
        </div>
        <div class="table-footer">
            <div class="pagination">
            </div>
        </div>
    </div>

    <script src="{{asset('js/rejected-pullets.js')}}" defer></script>
    <script src="{{asset('js/push-notification.js')}}" defer></script>
    <script src="{{asset('js/loading-screen.js')}}" defer></script>

</body>
</html>