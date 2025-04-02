@include('components.modal-notification-loader')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Temperature Check Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/modal-notification-loader.css">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->

</head>
<body id="body">

    @yield('modal-notification-loader')

    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>EGG SHELL TEMPERATURE CHECK ENTRY</h2>
        <div class="exit-icon">
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/home'">
        </div>
    </div>

    <form class="body">
        <div class="form-header">
            <h4>Entry Form</h4>
        </div>

        <div class="form-input col-4">

            <!-- <div class="input-container column">
                <label for="ps_no">PS No. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <x-dropdown :data-category="'ps_no'" />
            </div> -->
            
            <div class="input-container column">
                <label for="setting_date">Setting Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input type="date" name="setting_date" id="setting_date" value="{{ session('form_data.setting_date', date('Y-m-d')) }}">
            </div>
            <div class="input-container column">
                <label for="incubator_no">Incubator No. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <select name="incubator_no" id="incubator_no" multiple multiselect-select-all="true" multiselect-search="true" >
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="temp_check_date">Temperature Check Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="temp_check_date" id="temp_check_date" type="date" value="{{ session('form_data.temp_check_date', date('Y-m-d')) }}">
            </div>
            <!-- <div class="input-container column">
                <label for="location">Location <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <select name="location" id="location">
                    <option value="">Select Location</option>
                    <option value="Top" {{ session('form_data.location', '') == 'Top' ? 'selected' : ''}}>Top</option>
                    <option value="Mid" {{ session('form_data.location', '') == 'Mid' ? 'selected' : ''}}>Mid</option>
                    <option value="Low" {{ session('form_data.location', '') == 'Low' ? 'selected' : ''}}>Low</option>
                </select>
            </div> -->
            <!-- <div class="input-container column">
                <label for="temperature">Temperature <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <select name="temperature" id="temperature">
                    <option value="">Select Temperature</option>
                    <option value="37.8 Above" {{ session('form_data.temperature', '') == '37.8 Above' ? 'selected' : ''}}>37.8 Above</option>
                    <option value="37.7 Below" {{ session('form_data.temperature', '') == '37.7 Below' ? 'selected' : ''}}>37.7 Below</option>
                </select>
            </div> -->
            <!-- <div class="input-container column">
                <label for="quantity">Quantity <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0">
            </div> -->
        </div>

        <div class="form-header chamber">
            <h4>LEFT</h4>
            <div class="line"></div>
        </div>

        <div class="form-input col-5">
            <div class="input-container column">
                <label for="ps_no">PS No. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <x-dropdown :data-category="'ps_no'" />
            </div>

            <div class="input-container column">
                <label for="quantity">Quantity <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0">
            </div>

            <div class="input-container column">
                <label for="quantity">Below 99.86 °F<i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0">
            </div>

            <div class="input-container column">
                <label for="quantity">Above 100.04 °F<i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0">
            </div>

            <div class="input-container column">
                <label for="quantity">%<i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0">
            </div>

        </div>

        <div class="form-header chamber">
            <h4>RIGHT</h4>
            <div class="line"></div>
        </div>

        <div class="form-input col-5">
            <div class="input-container column">
                <label for="ps_no">PS No. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <x-dropdown :data-category="'ps_no'" />
            </div>

            <div class="input-container column">
                <label for="quantity">Quantity <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0">
            </div>

            <div class="input-container column">
                <label for="quantity">Below 99.86 °F<i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0">
            </div>

            <div class="input-container column">
                <label for="quantity">Above 100.04 °F<i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0">
            </div>

            <div class="input-container column">
                <label for="quantity">%<i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0">
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

                <!-- <label for="sort-btn">Sort By:</label> -->
                <select class="sort-btn" name="sort-btn" id="sort-btn">
                    <option value="created_at_desc">Sort By: Date (Newest)</option>
                    <option value="created_at_asc">Sort By: Date (Oldest)</option>
                    <option value="temperature_asc">Sort By: Temperature (High-Low)</option>
                    <option value="temperature_desc">Sort By: Temperature (Low-High)</option>
                    <option value="quantity_desc">Sort By: Quantity (Desc)</option>
                    <option value="quantity_asc">Sort By: Quantity (Asc)</option>
                </select>

                <div class="table-icons">
                    <i class="fa-solid fa-share-from-square" onclick="showModal('print')"></i>
                    <i class="fa-solid fa-rotate-right" onclick="refreshTable()"></i>
                </div>
                
            </div>

        </div>
        <div class="table-body">

            <livewire:egg-temperature-table />

        </div>
        <div class="table-footer">
            <div class="pagination">
            </div>
        </div>
    </div>

    <script src="{{asset('js/egg-temperature.js')}}" defer></script>

    <script src="{{asset('js/push-notification.js')}}" defer></script>
    <script src="{{asset('js/loading-screen.js')}}" defer></script>

    <script>
        var style = document.createElement('style');
        style.setAttribute("id", "multiselect_dropdown_styles");
        style.innerHTML = `
        .multiselect-dropdown {
            display: inline-block;
            background-color: #F6F4F1;
            border: solid 2px #e2e2e2;
            border-radius: 5px;
            padding: 7px 12px;

            font-size: 15px;
            font-weight: 300;

            position: relative;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 8px 12px;
        }
        .multiselect-dropdown span.optext,
        .multiselect-dropdown span.placeholder {
            margin-right: 0.5em;
            margin-bottom: 2px;
            padding: 1px 0;
            border-radius: 2px;
            display: inline-block;
        }
        .multiselect-dropdown span.optext {
            background-color: #dfdfdf;
            padding: 1px 0.75em;
        }
        .multiselect-dropdown span.optext .optdel {
            float: right;
            margin: 0 -6px 1px 5px;
            font-size: 0.7em;
            margin-top: 2px;
            cursor: pointer;
            color: #666;
        }
        .multiselect-dropdown span.optext .optdel:hover {
            color: #c66;
        }
        .multiselect-dropdown span.placeholder {
            color: #ced4da;
        }
        .multiselect-dropdown-list-wrapper {
            box-shadow: gray 0 3px 8px;
            z-index: 100;
            padding: 2px;
            border-radius: 4px;
            border: solid 1px #ced4da;
            display: none;
            margin: -1px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: white;
        }
        .multiselect-dropdown-list-wrapper .multiselect-dropdown-search {
            margin-bottom: 5px;
        }
        .multiselect-dropdown-list {
            padding: 2px;
            height: 15rem;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .multiselect-dropdown-list::-webkit-scrollbar {
            width: 6px;
        }
        .multiselect-dropdown-list::-webkit-scrollbar-thumb {
            background-color: #bec4ca;
            border-radius: 3px;
        }

        .multiselect-dropdown-list div {
            padding: 5px;
            display: flex;
            align-items: center;
        }
        .multiselect-dropdown-list input {
            height: 1.15em;
            width: 1.15em;
            margin-right: 0.35em;
        }
        .multiselect-dropdown-list div.checked {
        }
        .multiselect-dropdown-list div:hover {
            background-color: #ced4da;
        }
        .multiselect-dropdown span.maxselected {
            width: 100%;
        }
        .multiselect-dropdown-all-selector {
            border-bottom: solid 1px #999;
        }

        `;
        document.head.appendChild(style);

        function MultiselectDropdown(options) {
            console.log(options)
            var config = {
                search: true,
                height: '15rem',
                placeholder: 'Select Value',
                txtSelected: 'selected',
                txtAll: 'All',
                txtRemove: 'Remove',
                txtSearch: 'Search',
                ...options
            };

            function newEl(tag, attrs) {
                var e = document.createElement(tag);
                if (attrs !== undefined) Object.keys(attrs).forEach(k => {
                    if (k === 'class') {
                        Array.isArray(attrs[k]) ? attrs[k].forEach(o => o !== '' ? e.classList.add(o) : 0) : (attrs[k] !== '' ? e.classList.add(attrs[k]) : 0)
                    } else if (k === 'style') {
                        Object.keys(attrs[k]).forEach(ks => {
                            e.style[ks] = attrs[k][ks];
                        });
                    } else if (k === 'text') {
                        attrs[k] === '' ? e.innerHTML = '&nbsp;' : e.innerText = attrs[k]
                    } else e[k] = attrs[k];
                });
                return e;
            }


            document.querySelectorAll("select[multiple]").forEach((el, k) => {

                var div = newEl('div', {
                    class: 'multiselect-dropdown'
                });
                el.style.display = 'none';
                el.parentNode.insertBefore(div, el.nextSibling);
                var listWrap = newEl('div', {
                    class: 'multiselect-dropdown-list-wrapper'
                });
                var list = newEl('div', {
                    class: 'multiselect-dropdown-list',
                    style: {
                        height: config.height
                    }
                });
                var search = newEl('input', {
                    class: ['multiselect-dropdown-search'].concat([config.searchInput?.class ?? 'form-control']),
                    style: {
                        width: '100%',
                        display: el.attributes['multiselect-search']?.value === 'true' ? 'block' : 'none'
                    },
                    placeholder: config.txtSearch
                });
                listWrap.appendChild(search);
                div.appendChild(listWrap);
                listWrap.appendChild(list);

                el.loadOptions = () => {
                    list.innerHTML = '';

                    if (el.attributes['multiselect-select-all']?.value == 'true') {
                        var op = newEl('div', {
                            class: 'multiselect-dropdown-all-selector'
                        })
                        var ic = newEl('input', {
                            type: 'checkbox'
                        });
                        op.appendChild(ic);
                        op.appendChild(newEl('label', {
                            text: config.txtAll
                        }));

                        op.addEventListener('click', () => {
                            op.classList.toggle('checked');
                            op.querySelector("input").checked = !op.querySelector("input").checked;

                            var ch = op.querySelector("input").checked;
                            list.querySelectorAll(":scope > div:not(.multiselect-dropdown-all-selector)")
                                .forEach(i => {
                                    if (i.style.display !== 'none') {
                                        i.querySelector("input").checked = ch;
                                        i.optEl.selected = ch
                                    }
                                });

                            el.dispatchEvent(new Event('change'));
                        });
                        ic.addEventListener('click', (ev) => {
                            ic.checked = !ic.checked;
                        });
                        el.addEventListener('change', (ev) => {
                            let itms = Array.from(list.querySelectorAll(":scope > div:not(.multiselect-dropdown-all-selector)")).filter(e => e.style.display !== 'none')
                            let existsNotSelected = itms.find(i => !i.querySelector("input").checked);
                            if (ic.checked && existsNotSelected) ic.checked = false;
                            else if (ic.checked == false && existsNotSelected === undefined) ic.checked = true;
                        });

                        list.appendChild(op);
                    }

                    Array.from(el.options).map(o => {
                        var op = newEl('div', {
                            class: o.selected ? 'checked' : '',
                            optEl: o
                        })
                        var ic = newEl('input', {
                            type: 'checkbox',
                            checked: o.selected
                        });
                        op.appendChild(ic);
                        op.appendChild(newEl('label', {
                            text: o.text
                        }));

                        op.addEventListener('click', () => {
                            op.classList.toggle('checked');
                            op.querySelector("input").checked = !op.querySelector("input").checked;
                            op.optEl.selected = !!!op.optEl.selected;
                            el.dispatchEvent(new Event('change'));
                        });
                        ic.addEventListener('click', (ev) => {
                            ic.checked = !ic.checked;
                        });
                        o.listitemEl = op;
                        list.appendChild(op);
                    });
                    div.listEl = listWrap;

                    div.refresh = () => {
                        div.querySelectorAll('span.optext, span.placeholder').forEach(t => div.removeChild(t));
                        var sels = Array.from(el.selectedOptions);
                        if (sels.length > (el.attributes['multiselect-max-items']?.value ?? 5)) {
                            div.appendChild(newEl('span', {
                                class: ['optext', 'maxselected'],
                                text: sels.length + ' ' + config.txtSelected
                            }));
                        } else {
                            sels.map(x => {
                                var c = newEl('span', {
                                    class: 'optext',
                                    text: x.text,
                                    srcOption: x
                                });
                                if ((el.attributes['multiselect-hide-x']?.value !== 'true'))
                                    c.appendChild(newEl('span', {
                                        class: 'optdel',
                                        text: '🗙',
                                        title: config.txtRemove,
                                        onclick: (ev) => {
                                            c.srcOption.listitemEl.dispatchEvent(new Event('click'));
                                            div.refresh();
                                            ev.stopPropagation();
                                        }
                                    }));

                                div.appendChild(c);
                            });
                        }
                        if (0 == el.selectedOptions.length) div.appendChild(newEl('span', {
                            class: 'placeholder',
                            text: el.attributes['placeholder']?.value ?? config.placeholder
                        }));
                    };
                    div.refresh();
                }
                el.loadOptions();

                search.addEventListener('input', () => {
                    list.querySelectorAll(":scope div:not(.multiselect-dropdown-all-selector)").forEach(d => {
                        var txt = d.querySelector("label").innerText.toUpperCase();
                        d.style.display = txt.includes(search.value.toUpperCase()) ? 'block' : 'none';
                    });
                });

                div.addEventListener('click', () => {
                    div.listEl.style.display = 'block';
                    search.focus();
                    search.select();
                });

                document.addEventListener('click', function (event) {
                    if (!div.contains(event.target)) {
                        listWrap.style.display = 'none';
                        div.refresh();
                    }
                });
            });
        }

        window.addEventListener('load', () => {
            MultiselectDropdown(window.MultiselectDropdownOptions);
        });
    </script>

</body>
</html>