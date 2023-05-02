//--------------------------------------- Đưa dữ liệu ACB ---------------------------------------
var screenshotButton_acb = document.getElementById("create_bill-acb");
var create_bill_acb = document.querySelector('#create_to_img-1')
if(create_bill_acb) {
    create_bill_acb.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill1")).then(canvas => {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_acb.jpg';
            a.click();
        });
    })
}
if(screenshotButton_acb) {
    screenshotButton_acb.addEventListener("click", function() {
        const value_clock_acb = document.querySelector('#input_clock-acb').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_total_number_acb = document.querySelector('#input_total_number-acb').value
        const value_total_text_acb = document.querySelector('#input_total_text-acb').value
        const value_time_acb = document.querySelector('#input_time-acb').value
        const value_day_acb = document.querySelector('#input_day-acb').value
        const value_transferer_name_acb = document.querySelector('#input_transferer_name-acb').value
        const value_transferer_number_acb = document.querySelector('#input_transferer_number-acb').value
        const value_recipient_name_acb = document.querySelector('#input_recipient_name-acb').value
        const value_recipient_bank_acb = document.querySelector('#input_recipient_bank-acb').value
        const value_recipient_number_acb = document.querySelector('#input_recipient_number-acb').value
    
        const output_clock_acb = document.querySelector('#output_clock-acb')
        output_clock_acb.innerHTML = value_clock_acb
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_total_number_acb = document.querySelector('#output_total_number-acb')
        output_total_number_acb.innerHTML = value_total_number_acb
        const output_total_text_acb = document.querySelector('#output_total_text-acb')
        output_total_text_acb.innerHTML = value_total_text_acb
        const output_time_acb = document.querySelector('#output_time-acb')
        output_time_acb.innerHTML = value_time_acb
        const output_day_acb = document.querySelector('#output_day-acb')
        output_day_acb.innerHTML = value_day_acb
        const output_transferer_name_acb = document.querySelector('#output_transferer_name-acb')
        output_transferer_name_acb.innerHTML = value_transferer_name_acb
        const output_transferer_number_acb = document.querySelector('#output_transferer_number-acb')
        output_transferer_number_acb.innerHTML = value_transferer_number_acb
        const output_recipient_name_acb = document.querySelector('#output_recipient_name-acb')
        output_recipient_name_acb.innerHTML = value_recipient_name_acb
        const output_recipient_bank_acb = document.querySelector('#output_recipient_bank-acb')
        output_recipient_bank_acb.innerHTML = value_recipient_bank_acb
        const output_recipient_number_acb = document.querySelector('#output_recipient_number-acb')
        output_recipient_number_acb.innerHTML = value_recipient_number_acb

        const div_add = document.querySelector('#new_bill1')
        // Tạo sóng điện thoại
        const value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            const signalDiv = document.querySelector('#output_signal')
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            const newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(let i = 0; i < value_sim_waves; i++) {
                const newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        const value_wifi = document.querySelector('#input_wifi').value
        const signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        const new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        const new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            const img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_white.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    })
}

//--------------------------------------- Đưa dữ liệu Agribank ---------------------------------------
var screenshotButton_agribank = document.getElementById("create_bill-2");
var create_bill_agribank = document.querySelector('#create_to_img-2')
if(create_bill_agribank) {
    create_bill_agribank.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill2")).then(canvas => {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_agribank.jpg';
            a.click();
        });
    })
}
if(screenshotButton_agribank) {
    screenshotButton_agribank.addEventListener("click", function() {
        const value_clock_agribank = document.querySelector('#input_clock-agribank').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_total_price_agribank = document.querySelector('#input_total_price-agribank').value
        const value_recipient_number_agribank = document.querySelector('#input_recipient_number-agribank').value
        const value_recipient_name_agribank = document.querySelector('#input_recipient_name-agribank').value
        const value_trade_code_agribank = document.querySelector('#input_trade_code-agribank').value
        const value_recipient_bank_agribank = document.querySelector('#input_recipient_bank-agribank').value
        const value_trade_time_agribank = document.querySelector('#input_trade_time-agribank').value
        
        const output_clock_agribank = document.querySelector('#output_clock-agribank')
        output_clock_agribank.innerHTML = value_clock_agribank
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_total_price_agribank = document.querySelector('#output_total_price-agribank')
        output_total_price_agribank.innerHTML = value_total_price_agribank
        const output_recipient_number_agribank = document.querySelector('#output_recipient_number-agribank')
        output_recipient_number_agribank.innerHTML = value_recipient_number_agribank
        const output_recipient_name_agribank = document.querySelector('#output_recipient_name-agribank')
        output_recipient_name_agribank.innerHTML = value_recipient_name_agribank
        const output_trade_code_agribank = document.querySelector('#output_trade_code-agribank')
        output_trade_code_agribank.innerHTML = value_trade_code_agribank
        const output_recipient_bank_agribank = document.querySelector('#output_recipient_bank-agribank')
        output_recipient_bank_agribank.innerHTML = value_recipient_bank_agribank
        const output_trade_time_agribank = document.querySelector('#output_trade_time-agribank')
        output_trade_time_agribank.innerHTML = value_trade_time_agribank

      
        const div_add = document.querySelector('#new_bill2')
        // Tạo sóng điện thoại
        const value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            const signalDiv = document.querySelector('#output_signal')
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            const newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(let i = 0; i < value_sim_waves; i++) {
                const newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        const value_wifi = document.querySelector('#input_wifi').value
        const signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        const new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        const new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            const img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_white.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    })
}

//--------------------------------------- Đưa dữ liệu BIDV ---------------------------------------
var screenshotButton_bidv = document.getElementById("create_bill-bidv");
var create_bill_bidv = document.querySelector('#create_to_img-3')
if (screenshotButton_bidv) {
    screenshotButton_bidv.addEventListener("click", function() {
        const value_clock_bidv = document.querySelector('#input_clock-bidv').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_total_price_bidv = document.querySelector('#input_total_price-bidv').value
        const value_recipient_number_bidv = document.querySelector('#input_recipient_number-bidv').value
        const value_recipient_name_bidv = document.querySelector('#input_recipient_name-bidv').value
        const value_recipient_bank_bidv = document.querySelector('#input_recipient_bank-bidv').value
        const value_time_bidv = document.querySelector('#input_time-bidv').value
        const value_content_bidv = document.querySelector('#input_content-bidv').value
        const value_code_number = document.querySelector('#input_code_number-bidv').value
    
        const output_clock_bidv = document.querySelector('#output_clock-bidv')
        output_clock_bidv.innerHTML = value_clock_bidv
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.classList.add = 'black'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_total_price_bidv = document.querySelector('#output_total_price-bidv')
        output_total_price_bidv.innerHTML = value_total_price_bidv
        const output_recipient_number_bidv = document.querySelector('#output_recipient_number-bidv')
        output_recipient_number_bidv.innerHTML = value_recipient_number_bidv
        const output_recipient_name_bidv = document.querySelector('#output_recipient_name-bidv')
        output_recipient_name_bidv.innerHTML = value_recipient_name_bidv
        const output_recipient_bank_bidv = document.querySelector('#output_recipient_bank-bidv')
        output_recipient_bank_bidv.innerHTML = value_recipient_bank_bidv
        const output_time_bidv = document.querySelector('#output_time-bidv')
        output_time_bidv.innerHTML = value_time_bidv
        const output_content_bidv = document.querySelector('#output_content-bidv')
        output_content_bidv.innerHTML = value_content_bidv
        const output_code_number = document.querySelector('#output_code_number-bidv')
        output_code_number.innerHTML = value_code_number

        const div_add = document.querySelector('#new_bill3')
        // Tạo sóng điện thoại
        const value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            const signalDiv = document.querySelector('#output_signal')
            console.log(signalDiv)
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            const newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(let i = 0; i < value_sim_waves; i++) {
                const newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_black');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        const value_wifi = document.querySelector('#input_wifi').value
        const signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        const new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        const new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'black'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            const img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_black.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    });
}
if (create_bill_bidv) {
    create_bill_bidv.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill3")).then(canvas => {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_bidv.jpg';
            a.click();
        });
    })
}

//--------------------------------------- Đưa dữ liệu MB bank ---------------------------------------
var screenshotButton_mbbank = document.getElementById("create_bill-mbbank");
if(screenshotButton_mbbank) {
    screenshotButton_mbbank.addEventListener("click", function() {
        const value_clock_mbbank = document.querySelector('#input_clock-mbbank').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_total_price_mbbank = document.querySelector('#input_total_price-mbbank').value
        const value_recipient_number_mbbank = document.querySelector('#input_recipient_number-mbbank').value
        const value_recipient_name_mbbank = document.querySelector('#input_recipient_name-mbbank').value
        const value_recipient_bank_mbbank = document.querySelector('#input_recipient_bank-mbbank').value
        const value_source_account_mbbank = document.querySelector('#input_source_account-mbbank').value
        const value_source_name_mbbank = document.querySelector('#input_source_name-mbbank').value
        const value_content_mbbank = document.querySelector('#input_content-mbbank').value
        const value_time_mbbank = document.querySelector('#input_time-mbbank').value
        const value_code_number = document.querySelector('#input_code_number-mbbank').value
    
        const output_clock_mbbank = document.querySelector('#output_clock-mbbank')
        output_clock_mbbank.innerHTML = value_clock_mbbank
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            console.log(value_battery)
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_total_price_mbbank = document.querySelector('#output_total_price-mbbank')
        output_total_price_mbbank.innerHTML = value_total_price_mbbank
        const output_recipient_name_mbbank = document.querySelector('#output_recipient_name-mbbank')
        output_recipient_name_mbbank.innerHTML = value_recipient_name_mbbank
        const output_recipient_number_mbbank = document.querySelector('#output_recipient_number-mbbank')
        output_recipient_number_mbbank.innerHTML = value_recipient_number_mbbank
        const output_recipient_bank_mbbank = document.querySelector('#output_recipient_text-mbbank')
        output_recipient_bank_mbbank.innerHTML = value_recipient_bank_mbbank
        const output_source_account_mbbank = document.querySelector('#output_source_account-mbbank')
        output_source_account_mbbank.innerHTML = value_source_account_mbbank
        const output_source_name_mbbank = document.querySelector('#output_source_name-mbbank')
        output_source_name_mbbank.innerHTML = value_source_name_mbbank
        const output_content_mbbank = document.querySelector('#output_content-mbbank')
        output_content_mbbank.innerHTML = value_content_mbbank
        const output_time_mbbank = document.querySelector('#output_time-mbbank')
        output_time_mbbank.innerHTML = value_time_mbbank
        const output_code_number = document.querySelector('#output_trade_code-mbbank')
        output_code_number.innerHTML = value_code_number
    })
}

//--------------------------------------- Đưa dữ liệu Momo ---------------------------------------
var screenshotButton_momo = document.getElementById('create_bill-momo')
var create_bill_momo = document.querySelector('#create_to_img-5')
if(screenshotButton_momo) {
    screenshotButton_momo.addEventListener("click", function() {
        const value_clock_momo = document.querySelector('#input_clock-momo').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_recipient_name_momo = document.querySelector('#input_recipient_name-momo').value
        const value_recipient_bank_momo = document.querySelector('#input_recipient_bank-momo').value
        const value_total_price_momo = document.querySelector('#input_total_price-momo').value
        const value_time_momo = document.querySelector('#input_time-momo').value
        const value_trade_code_momo = document.querySelector('#input_trade_code-momo').value
        const value_overheads_momo = document.querySelector('#input_overheads-momo').value
        const value_recipient_number_momo = document.querySelector('#input_recipient_number-momo').value
        const value_banking_name_momo = document.querySelector('#input_banking_name-momo').value
        const value_message_momo = document.querySelector('#input_message-momo').value
        const value_banking_banking_momo = document.querySelector('#input_banking_bank-momo').value

        const output_clock_momo = document.querySelector('#output_clock-momo')
        output_clock_momo.innerHTML = value_clock_momo
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            console.log(value_battery)
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_recipient_name_momo = document.querySelector('#output_recipient_name-momo')
        output_recipient_name_momo.innerHTML = value_recipient_name_momo
        const output_recipient_bank_momo = document.querySelector('#output_recipient_bank-momo')
        output_recipient_bank_momo.innerHTML = value_recipient_bank_momo
        const output_total_price_momo = document.querySelector('#output_total_price-momo')
        output_total_price_momo.innerHTML = value_total_price_momo
        const ouput_total_price2_momo = document.querySelector('#output_total_price2-momo')
        ouput_total_price2_momo.innerHTML = value_total_price_momo
        const output_time_momo = document.querySelector('#output_time-momo')
        output_time_momo.innerHTML = value_time_momo
        const output_trade_code_momo = document.querySelector('#output_trade_code-momo')
        output_trade_code_momo.innerHTML = value_trade_code_momo
        const output_overheads_momo = document.querySelector('#output_overheads-momo')
        output_overheads_momo.innerHTML = value_overheads_momo
        const output_recipient_number_momo = document.querySelector('#output_recipient_number-momo')
        output_recipient_number_momo.innerHTML = value_recipient_number_momo
        const output_banking_name_momo = document.querySelector('#output_banking_name-momo')
        output_banking_name_momo.innerHTML = value_banking_name_momo
        const output_message_momo = document.querySelector('#output_message-momo')
        output_message_momo.innerHTML = value_message_momo
        const output_banking_banking_momo = document.querySelector('#output_banking_bank-momo')
        output_banking_banking_momo.innerHTML = value_banking_banking_momo

        const div_add = document.querySelector('#new_bill5')
        // Tạo sóng điện thoại
        const value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            const signalDiv = document.querySelector('#output_signal')
            console.log(signalDiv)
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            const newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(let i = 0; i < value_sim_waves; i++) {
                const newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        const value_wifi = document.querySelector('#input_wifi').value
        const signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        const new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        const new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            const img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_white.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    })
}   
if(create_bill_momo) {
    create_bill_momo.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill5")).then(canvas => {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_momo.jpg';
            a.click();
        });
    })
}

// --------------------------------------- Đưa dữ liệu MSB ---------------------------------------
var screenshotButton_msb = document.querySelector('#create_bill-msb')
var create_bill_msb = document.querySelector('#create_to_img-6')
if(screenshotButton_msb) {
    screenshotButton_msb.addEventListener("click", function() {
        const value_clock_msb = document.querySelector('#input_clock-msb').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_holder_name_msb = document.querySelector('#input_holder_name-msb').value
        const value_total_price_msb = document.querySelector('#input_total_price-msb').value
        const value_recipient_number_msb = document.querySelector('#input_recipient_number-msb').value
        const value_recipient_name_msb = document.querySelector('#input_recipient_name-msb').value
        const value_message_msb = document.querySelector('#input_message-msb').value

        const output_clock_msb = document.querySelector('#output_clock-msb')
        output_clock_msb.innerHTML = value_clock_msb
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'black'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
	    output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_holder_name_msb = document.querySelector('#output_holder_name-msb')
        output_holder_name_msb.innerHTML = value_holder_name_msb
        const output_total_price_msb = document.querySelector('#output_total_price-msb')
        output_total_price_msb.innerHTML = value_total_price_msb
        const output_recipient_number_msb = document.querySelector('#output_recipient_number-msb')
        output_recipient_number_msb.innerHTML = value_recipient_number_msb
        const output_recipient_name_msb = document.querySelector('#output_recipient_name-msb')
        output_recipient_name_msb.innerHTML = value_recipient_name_msb
        const output_message_msb = document.querySelector('#output_message-msb')
        output_message_msb.innerHTML = value_message_msb

        const div_add = document.querySelector('#new_bill6')
        // Tạo sóng điện thoại
        const value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            const signalDiv = document.querySelector('#output_signal')
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            const newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(let i = 0; i < value_sim_waves; i++) {
                const newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_black');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        const value_wifi = document.querySelector('#input_wifi').value
        const signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        const new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        const new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'black'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            const img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_black.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    })
}
if(create_bill_msb) {
    create_bill_msb.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill6")).then(canvas => {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_msb.jpg';
            a.click();
        });
    })
}

// --------------------------------------- Đưa dữ liệu Sacombank --------------------------------------- 
var screenshotButton_sacombank = document.querySelector('#create_bill-sacombank')
var create_bill_sacombank = document.querySelector('#create_to_img-7')
if(screenshotButton_sacombank) {
    screenshotButton_sacombank.addEventListener("click", function() {
        const value_clock_sacombank = document.querySelector('#input_clock-sacombank').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_recipient_number_sacombank = document.querySelector('#input_recipient_number-sacombank').value
        const value_recipient_name_sacombank = document.querySelector('#input_recipient_name-sacombank').value
        const value_total_price_sacombank = document.querySelector('#input_total_price-sacombank').value
        const value_time_sacombank = document.querySelector('#input_time-sacombank').value
        const value_trade_code_sacombank = document.querySelector('#input_trade_code-sacombank').value
        const value_from_number = document.querySelector('#input_from_number-sacombank').value
        const value_recipient_bank_sacombank = document.querySelector('#input_recipient_bank-sacombank').value
        const value_message_sacombank = document.querySelector('#input_message-sacombank').value

        const output_clock_sacombank = document.querySelector('#output_clock-sacombank')
        output_clock_sacombank.innerHTML = value_clock_sacombank
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            console.log(value_battery)
            output_battery.style.background = '#fd465e'
        }
	    output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_recipient_number_sacombank = document.querySelector('#output_recipient_number-sacombank')
        output_recipient_number_sacombank.innerHTML = value_recipient_number_sacombank
        const output_recipient_number2_sacombank = document.querySelector('#output_recipient_number2-sacombank')
        output_recipient_number2_sacombank.innerHTML = value_recipient_number_sacombank
        const output_recipient_name_sacombank = document.querySelector('#output_recipient_name-sacombank')
        output_recipient_name_sacombank.innerHTML = value_recipient_name_sacombank
        const output_total_price_sacombank = document.querySelector('#output_total_price-sacombank')
        output_total_price_sacombank.innerHTML = value_total_price_sacombank
        const output_total_price2_sacombank = document.querySelector('#output_total_price2-sacombank')
        output_total_price2_sacombank.innerHTML = value_total_price_sacombank
        const output_total_price3_sacombank = document.querySelector('#output_total_price3-sacombank')
        output_total_price3_sacombank.innerHTML = value_total_price_sacombank
        const output_time_sacombank = document.querySelector('#output_time-sacombank')
        output_time_sacombank.innerHTML = value_time_sacombank
        const output_trade_code_sacombank = document.querySelector('#output_trade_code-sacombank')
        output_trade_code_sacombank.innerHTML = value_trade_code_sacombank
        const output_from_number = document.querySelector('#output_from_number-sacombank')
        output_from_number.innerHTML = value_from_number
        const output_recipient_bank_sacombank = document.querySelector('#output_recipient_bank-sacombank')
        output_recipient_bank_sacombank.innerHTML = value_recipient_bank_sacombank
        const output_message_sacombank = document.querySelector('#output_message-sacombank')
        output_message_sacombank.innerHTML = value_message_sacombank

        const div_add = document.querySelector('#new_bill7')
        // Tạo sóng điện thoại
        const value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            const signalDiv = document.querySelector('#output_signal')
            console.log(signalDiv)
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            const newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(let i = 0; i < value_sim_waves; i++) {
                const newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        const value_wifi = document.querySelector('#input_wifi').value
        const signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        const new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        const new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            const img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_white.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    })
}
if(create_bill_sacombank) {
    create_bill_sacombank.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill7")).then(canvas => {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_sacombank.jpg';
            a.click();
        });
    })
}

// --------------------------------------- Đưa dữ liệu Techcombank --------------------------------------- 
var screenshotButton_techcombank = document.querySelector('#create_bill-techcombank')
var create_bill_techcombank = document.querySelector('#create_to_img-8')
if(screenshotButton_techcombank) {
    screenshotButton_techcombank.addEventListener("click", function() {
        const value_clock_techcombank = document.querySelector('#input_clock-techcombank').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_recipient_name_techcombank = document.querySelector('#input_recipient_name-techcombank').value
        const value_total_price_techcombank = document.querySelector('#input_total_price-techcombank').value
        const value_recipient_bank_techcombank = document.querySelector('#input_recipient_bank-techcombank').value
        const value_recipient_number_techcombank = document.querySelector('#input_recipient_number-techcombank').value
        const value_message_techcombank = document.querySelector('#input_message-techcombank').value
        const value_time_techcombank = document.querySelector('#input_time-techcombank').value
        const value_trade_code_techcombank = document.querySelector('#input_trade_code-techcombank').value

        const output_clock_techcombank = document.querySelector('#output_clock-techcombank')
        output_clock_techcombank.innerHTML = value_clock_techcombank
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'black'
        if(value_battery <= 20) {
            console.log(value_battery)
            output_battery.style.background = '#fd465e'
        }
	    output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_recipient_name_techcombank = document.querySelector('#output_recipient_name-techcombank')
        output_recipient_name_techcombank.innerHTML = value_recipient_name_techcombank
        const output_total_price_techcombank = document.querySelector('#output_total_price-techcombank')
        output_total_price_techcombank.innerHTML = value_total_price_techcombank
        const output_recipient_bank_techcombank = document.querySelector('#output_recipient_bank-techcombank')
        output_recipient_bank_techcombank.innerHTML = value_recipient_bank_techcombank
        const output_recipient_number_techcombank = document.querySelector('#output_recipient_number-techcombank')
        output_recipient_number_techcombank.innerHTML = value_recipient_number_techcombank
        const output_message_techcombank = document.querySelector('#output_message-techcombank')
        output_message_techcombank.innerHTML = value_message_techcombank
        const output_time_techcombank = document.querySelector('#output_time-techcombank')
        output_time_techcombank.innerHTML = value_time_techcombank
        const output_trade_code_techcombank = document.querySelector('#output_trade_code-techcombank')
        output_trade_code_techcombank.innerHTML = value_trade_code_techcombank

        const div_add = document.querySelector('#new_bill8')
        // Tạo sóng điện thoại
        const value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            const signalDiv = document.querySelector('#output_signal')
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            const newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            newsignalDiv.style.left = '304px'
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(let i = 0; i < value_sim_waves; i++) {
                const newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_black');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        const value_wifi = document.querySelector('#input_wifi').value
        const signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        const new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.style.left = '331px'
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        const new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'black'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            const img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_black.jpg"
            new_spanWifi.appendChild(img_wifi)
            new_wifiDiv.style.top = '14px'
        }
    })
}
if(create_bill_techcombank) {
    create_bill_techcombank.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill8")).then(canvas => {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_techcombank.jpg';
            a.click();
        });
    })
}

// --------------------------------------- Đưa dữ liệu Vietcombank --------------------------------------- 
var screenshotButton_vietcombank = document.querySelector('#create_bill-vietcombank')
var create_bill_vietcombank = document.querySelector('#create_to_img-10')
if(screenshotButton_vietcombank) {
    screenshotButton_vietcombank.addEventListener("click", function() {
        const value_clock_vietcombank = document.querySelector('#input_clock-vietcombank').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_total_price_vietcombank = document.querySelector('#input_total_price-vietcombank').value
        const value_recipient_name_vietcombank = document.querySelector('#input_recipient_name-vietcombank').value
        const value_recipient_number_vietcombank = document.querySelector('#input_recipient_number-vietcombank').value
        const value_recipient_bank_name_vietcombank = document.querySelector('#input_recipient_bank_name-vietcombank').value
        const value_recipient_bank_code_vietcombank = document.querySelector('#input_recipient_bank_code-vietcombank').value
        const value_trade_code_vietcombank = document.querySelector('#input_trade_code-vietcombank').value
        const value_message_vietcombank = document.querySelector('#input_message-vietcombank').value

        const output_clock_vietcombank = document.querySelector('#output_clock-vietcombank')
        output_clock_vietcombank.innerHTML = value_clock_vietcombank
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            console.log(value_battery)
            output_battery.style.background = '#fd465e'
        }
	    output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_total_price_vietcombank = document.querySelector('#output_total_price-vietcombank')
        output_total_price_vietcombank.innerHTML = value_total_price_vietcombank
        const output_recipient_name_vietcombank = document.querySelector('#output_recipient_name-vietcombank')
        output_recipient_name_vietcombank.innerHTML = value_recipient_name_vietcombank
        const output_recipient_number_vietcombank = document.querySelector('#output_recipient_number-vietcombank')
        output_recipient_number_vietcombank.innerHTML = value_recipient_number_vietcombank
        const output_recipient_bank_name_vietcombank = document.querySelector('#output_recipient_bank_name-vietcombank')
        output_recipient_bank_name_vietcombank.innerHTML = value_recipient_bank_name_vietcombank
        const output_recipient_bank_code_vietcombank = document.querySelector('#output_recipient_bank_code-vietcombank')
        output_recipient_bank_code_vietcombank.innerHTML = value_recipient_bank_code_vietcombank
        const output_trade_code_vietcombank = document.querySelector('#output_trade_code-vietcombank')
        output_trade_code_vietcombank.innerHTML = value_trade_code_vietcombank
        const output_message_vietcombank = document.querySelector('#output_message-vietcombank')
        output_message_vietcombank.innerHTML = value_message_vietcombank

        const div_add = document.querySelector('#new_bill10')
        // Tạo sóng điện thoại
        const value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            const signalDiv = document.querySelector('#output_signal')
            console.log(signalDiv)
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            const newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            newsignalDiv.style.left = '304px'
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(let i = 0; i < value_sim_waves; i++) {
                const newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        const value_wifi = document.querySelector('#input_wifi').value
        const signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        const new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.style.left = '331px'
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        const new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            const img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_white.jpg"
            new_spanWifi.appendChild(img_wifi)
            new_wifiDiv.style.top = '14px'
        }
    })
}
if(create_bill_vietcombank) {
    create_bill_vietcombank.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill10")).then(canvas => {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_vietcombank.jpg';
            a.click();
        });
    })
}
// --------------------------------------- Đưa dữ liệu Vietinbank --------------------------------------- 
var screenshotButton_vietinbank = document.querySelector('#create_bill-vietinbank')
var create_bill_vietinbank = document.querySelector('#create_to_img-11')
if(screenshotButton_vietinbank) {
    screenshotButton_vietinbank.addEventListener("click", function() {
        const value_clock_vietinbank = document.querySelector('#input_clock-vietinbank').value
        const value_battery = document.querySelector('#input_battery_level').value
        const value_time_vietinbank = document.querySelector('#input_time-vietinbank').value
        const value_trade_code_vietinbank = document.querySelector('#input_trade_code-vietinbank').value
        const value_from_number_vietinbank = document.querySelector('#input_from_number-vietinbank').value
        const value_from_name_vietinbank = document.querySelector('#input_from_name-vietinbank').value
        const value_recipient_number_vietinbank = document.querySelector('#input_recipient_number-vietinbank').value
        const value_recipient_name_vietinbank = document.querySelector('#input_recipient_name-vietinbank').value
        const value_recipient_bank_vietinbank = document.querySelector('#input_recipient_bank-vietinbank').value
        const value_total_number_vietinbank = document.querySelector('#input_total_number-vietinbank').value
        const value_total_text_vietinbank = document.querySelector('#input_total_text-vietinbank').value
        const value_message_vietinbank = document.querySelector('#input_message-vietinbank').value

        const output_clock_vietinbank = document.querySelector('#output_clock-vietinbank')
        output_clock_vietinbank.innerHTML = value_clock_vietinbank
        const output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            console.log(value_battery)
            output_battery.style.background = '#fd465e'
        }
	    output_battery.style.width = 19.7*value_battery/100 +'px'
        const output_time_vietinbank = document.querySelector('#output_time-vietinbank')
        output_time_vietinbank.innerHTML = value_time_vietinbank
        const output_trade_code_vietinbank = document.querySelector('#output_trade_code-vietinbank')
        output_trade_code_vietinbank.innerHTML = value_trade_code_vietinbank
        const output_from_number_vietinbank = document.querySelector('#output_from_number-vietinbank')
        output_from_number_vietinbank.innerHTML = value_from_number_vietinbank
        const output_from_name_vietinbank = document.querySelector('#output_from_name-vietinbank')
        output_from_name_vietinbank.innerHTML = value_from_name_vietinbank
        const output_recipient_number_vietinbank = document.querySelector('#output_recipient_number-vietinbank')
        output_recipient_number_vietinbank.innerHTML = value_recipient_number_vietinbank
        const output_recipient_name_vietinbank = document.querySelector('#output_recipient_name-vietinbank')
        output_recipient_name_vietinbank.innerHTML = value_recipient_name_vietinbank
        const output_recipient_bank_vietinbank = document.querySelector('#output_recipient_bank-vietinbank')
        output_recipient_bank_vietinbank.innerHTML = value_recipient_bank_vietinbank
        const output_total_number_vietinbank = document.querySelector('#output_total_number-vietinbank')
        output_total_number_vietinbank.innerHTML = value_total_number_vietinbank
        const output_total_text_vietinbank = document.querySelector('#output_total_text-vietinbank')
        output_total_text_vietinbank.innerHTML = value_total_text_vietinbank
        const output_message_vietinbank = document.querySelector('#output_message-vietinbank')
        output_message_vietinbank.innerHTML = value_message_vietinbank

        const div_add = document.querySelector('#new_bill11')
        // Tạo sóng điện thoại
        const value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            const signalDiv = document.querySelector('#output_signal')
            console.log(signalDiv)
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            const newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            newsignalDiv.style.left = '304px'
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(let i = 0; i < value_sim_waves; i++) {
                const newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        const value_wifi = document.querySelector('#input_wifi').value
        const signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        const new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.style.left = '331px'
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        const new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            const img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_white.jpg"
            new_spanWifi.appendChild(img_wifi)
            new_wifiDiv.style.top = '14px'
        }
    })
}
if(create_bill_vietinbank) {
    create_bill_vietinbank.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill11")).then(canvas => {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_vietinbank.jpg';
            a.click();
        });
    })
}