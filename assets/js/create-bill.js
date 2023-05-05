window.addEventListener('load', function () {
    document.querySelector('#input_battery_level').value = Math.floor(Math.random() * 100)
    document.querySelector('#input_clock').value = (new Date().getHours() < 10 ? ("0") : ("")) + new Date().getHours() + ":" + (new Date().getMinutes() < 10 ? ("0") : ("")) + new Date().getMinutes()
    
    var numberInput = document.getElementById("input_total_number");
    if(numberInput) {
        numberInput.addEventListener("input", function() {
            var userInput = numberInput.value;
            var formatted = userInput.replace(/,/g, ''); // xóa tất cả dấu phẩy có sẵn
            formatted = formatted.replace(/\D/g, ""); // xóa tất cả ký tự không phải số
            formatted = parseFloat(formatted);
            if (!isNaN(formatted)) { // kiểm tra nếu giá trị là một số hợp lệ
            formatted = formatted.toLocaleString(); // định dạng số
                numberInput.value = formatted;
            } else { // nếu giá trị không hợp lệ
            numberInput.value = ""; // xóa giá trị trong ô input
            }
        });
    }

    var numberInput2 = document.getElementById("input_total_price");
    if(numberInput2) {
        numberInput2.addEventListener("input", function() {
            var userInput = numberInput2.value;
            var formatted = userInput.replace(/,/g, ''); // xóa tất cả dấu phẩy có sẵn
            formatted = formatted.replace(/\D/g, ""); // xóa tất cả ký tự không phải số
            formatted = parseFloat(formatted);
            if (!isNaN(formatted)) { // kiểm tra nếu giá trị là một số hợp lệ
                formatted = formatted.toLocaleString(); // định dạng số
                numberInput2.value = formatted;
            } else { // nếu giá trị không hợp lệ
                numberInput2.value = ""; // xóa giá trị trong ô input
            }
        });
    }

    const inputElements = document.querySelectorAll('input'); // Tìm tất cả các thẻ input trên trang web

    inputElements.forEach(inputElement => { // Lặp qua từng thẻ input
    if (inputElement.value !== '') { // Kiểm tra giá trị của từng ô input, nếu nó khác rỗng thì đổi màu nền thành màu xanh
        inputElement.style.backgroundColor = '#c4cdd1';
    }
    });
});

//--------------------------------------- Đưa dữ liệu ACB ---------------------------------------
var screenshotButton_acb = document.getElementById("create_bill-acb");
var create_bill_acb = document.querySelector('#create_to_img-1')
if(create_bill_acb) {
    create_bill_acb.addEventListener("click", function() {
        window.scrollTo(0,0);
        var out_wifi = document.querySelector('#output_wifi')
        out_wifi.style.top = '13px'
        html2canvas(document.querySelector("#new_bill1")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_acb.jpg';
            a.click();
            out_wifi.style.top = '14px'
        });
    })
}
if(screenshotButton_acb) {
    screenshotButton_acb.addEventListener("click", function() {
        var value_clock_acb = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_total_number_acb = document.querySelector('#input_total_number').value
        var value_total_text_acb = document.querySelector('#input_total_text-acb').value
        var value_time_acb = document.querySelector('#input_time-acb').value
        var value_day_acb = document.querySelector('#input_day-acb').value
        var value_transferer_name_acb = document.querySelector('#input_transferer_name-acb').value
        var value_transferer_number_acb = document.querySelector('#input_transferer_number-acb').value
        var value_recipient_name_acb = document.querySelector('#input_recipient_name-acb').value
        var value_recipient_bank_acb = document.querySelector('#input_recipient_bank-acb').value
        var value_recipient_number_acb = document.querySelector('#input_recipient_number-acb').value
    
        var output_clock_acb = document.querySelector('#output_clock-acb')
        output_clock_acb.innerHTML = value_clock_acb
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_total_number_acb = document.querySelector('#output_total_number-acb')
        output_total_number_acb.innerHTML = value_total_number_acb
        var output_total_text_acb = document.querySelector('#output_total_text-acb')
        output_total_text_acb.innerHTML = value_total_text_acb
        var output_time_acb = document.querySelector('#output_time-acb')
        output_time_acb.innerHTML = value_time_acb
        var output_day_acb = document.querySelector('#output_day-acb')
        output_day_acb.innerHTML = value_day_acb
        var output_transferer_name_acb = document.querySelector('#output_transferer_name-acb')
        output_transferer_name_acb.innerHTML = value_transferer_name_acb
        var output_transferer_number_acb = document.querySelector('#output_transferer_number-acb')
        output_transferer_number_acb.innerHTML = value_transferer_number_acb
        var output_recipient_name_acb = document.querySelector('#output_recipient_name-acb')
        output_recipient_name_acb.innerHTML = value_recipient_name_acb
        var output_recipient_bank_acb = document.querySelector('#output_recipient_bank-acb')
        output_recipient_bank_acb.innerHTML = value_recipient_bank_acb
        var output_recipient_number_acb = document.querySelector('#output_recipient_number-acb')
        output_recipient_number_acb.innerHTML = value_recipient_number_acb

        var div_add = document.querySelector('#new_bill1')
        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            newsignalDiv.style.left = '304px'
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        var value_wifi = document.querySelector('#input_wifi').value
        var signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        var new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.style.left = '331px'
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_white.jpg"
            new_spanWifi.appendChild(img_wifi)
            new_wifiDiv.style.top = '12px'
        }
    })
}

//--------------------------------------- Đưa dữ liệu Agribank ---------------------------------------
var screenshotButton_agribank = document.getElementById("create_bill-2");
var create_bill_agribank = document.querySelector('#create_to_img-2')
if(create_bill_agribank) {
    create_bill_agribank.addEventListener("click", function() {
        window.scrollTo(0,0);
        var out_wifi = document.querySelector('#output_wifi')
        out_wifi.style.top = '13px'
        html2canvas(document.querySelector("#new_bill2")).then(canvas => {
            
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_agribank.jpg';
            a.click();
            out_wifi.style.top = '14px'
        });
    })
}
if(screenshotButton_agribank) {
    screenshotButton_agribank.addEventListener("click", function() {
        var value_clock_agribank = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_total_price_agribank = document.querySelector('#input_total_number').value
        var value_recipient_number_agribank = document.querySelector('#input_recipient_number-agribank').value
        var value_recipient_name_agribank = document.querySelector('#input_recipient_name-agribank').value
        var value_trade_code_agribank = document.querySelector('#input_trade_code-agribank').value
        var value_recipient_bank_agribank = document.querySelector('#input_recipient_bank-agribank').value
        var value_trade_time_agribank = document.querySelector('#input_trade_time-agribank').value
        
        var output_clock_agribank = document.querySelector('#output_clock-agribank')
        output_clock_agribank.innerHTML = value_clock_agribank
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_total_price_agribank = document.querySelector('#output_total_price-agribank')
        output_total_price_agribank.innerHTML = value_total_price_agribank
        var output_recipient_number_agribank = document.querySelector('#output_recipient_number-agribank')
        output_recipient_number_agribank.innerHTML = value_recipient_number_agribank
        var output_recipient_name_agribank = document.querySelector('#output_recipient_name-agribank')
        output_recipient_name_agribank.innerHTML = value_recipient_name_agribank
        var output_trade_code_agribank = document.querySelector('#output_trade_code-agribank')
        output_trade_code_agribank.innerHTML = value_trade_code_agribank
        var output_recipient_bank_agribank = document.querySelector('#output_recipient_bank-agribank')
        output_recipient_bank_agribank.innerHTML = value_recipient_bank_agribank
        var output_trade_time_agribank = document.querySelector('#output_trade_time-agribank')
        output_trade_time_agribank.innerHTML = value_trade_time_agribank

        var div_add = document.querySelector('#new_bill2')
        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        var value_wifi = document.querySelector('#input_wifi').value
        var signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        var new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
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
        var value_clock_bidv = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_total_price_bidv = document.querySelector('#input_total_number').value
        var value_recipient_number_bidv = document.querySelector('#input_recipient_number-bidv').value
        var value_recipient_name_bidv = document.querySelector('#input_recipient_name-bidv').value
        var value_recipient_bank_bidv = document.querySelector('#input_recipient_bank-bidv').value
        var value_time_bidv = document.querySelector('#input_time-bidv').value
        var value_content_bidv = document.querySelector('#input_content-bidv').value
        var value_code_number = document.querySelector('#input_code_number-bidv').value
    
        var output_clock_bidv = document.querySelector('#output_clock-bidv')
        output_clock_bidv.innerHTML = value_clock_bidv
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.classList.add = 'black'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_total_price_bidv = document.querySelector('#output_total_price-bidv')
        output_total_price_bidv.innerHTML = value_total_price_bidv
        var output_recipient_number_bidv = document.querySelector('#output_recipient_number-bidv')
        output_recipient_number_bidv.innerHTML = value_recipient_number_bidv
        var output_recipient_name_bidv = document.querySelector('#output_recipient_name-bidv')
        output_recipient_name_bidv.innerHTML = value_recipient_name_bidv
        var output_recipient_bank_bidv = document.querySelector('#output_recipient_bank-bidv')
        output_recipient_bank_bidv.innerHTML = value_recipient_bank_bidv
        var output_time_bidv = document.querySelector('#output_time-bidv')
        output_time_bidv.innerHTML = value_time_bidv
        var output_content_bidv = document.querySelector('#output_content-bidv')
        output_content_bidv.innerHTML = value_content_bidv
        var output_code_number = document.querySelector('#output_code_number-bidv')
        output_code_number.innerHTML = value_code_number

        var div_add = document.querySelector('#new_bill3')
        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_black');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        var value_wifi = document.querySelector('#input_wifi').value
        var signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        var new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'black'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_black.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    });
}
if (create_bill_bidv) {
    create_bill_bidv.addEventListener("click", function() {
        window.scrollTo(0,0);
        var out_wifi = document.querySelector('#output_wifi')
        out_wifi.style.top = '13px'
        html2canvas(document.querySelector("#new_bill3")).then(canvas => {
            
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_bidv.jpg';
            a.click();
            out_wifi.style.top = '14px'
        });
    })
}

//--------------------------------------- Đưa dữ liệu MB bank ---------------------------------------
var screenshotButton_mbbank = document.getElementById("create_bill-mbbank");
if(screenshotButton_mbbank) {
    screenshotButton_mbbank.addEventListener("click", function() {
        var value_clock_mbbank = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_total_price_mbbank = document.querySelector('#input_total_price-mbbank').value
        var value_recipient_number_mbbank = document.querySelector('#input_recipient_number-mbbank').value
        var value_recipient_name_mbbank = document.querySelector('#input_recipient_name-mbbank').value
        var value_recipient_bank_mbbank = document.querySelector('#input_recipient_bank-mbbank').value
        var value_source_account_mbbank = document.querySelector('#input_source_account-mbbank').value
        var value_source_name_mbbank = document.querySelector('#input_source_name-mbbank').value
        var value_content_mbbank = document.querySelector('#input_content-mbbank').value
        var value_time_mbbank = document.querySelector('#input_time-mbbank').value
        var value_code_number = document.querySelector('#input_code_number-mbbank').value
    
        var output_clock_mbbank = document.querySelector('#output_clock-mbbank')
        output_clock_mbbank.innerHTML = value_clock_mbbank
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_total_price_mbbank = document.querySelector('#output_total_price-mbbank')
        output_total_price_mbbank.innerHTML = value_total_price_mbbank
        var output_recipient_name_mbbank = document.querySelector('#output_recipient_name-mbbank')
        output_recipient_name_mbbank.innerHTML = value_recipient_name_mbbank
        var output_recipient_number_mbbank = document.querySelector('#output_recipient_number-mbbank')
        output_recipient_number_mbbank.innerHTML = value_recipient_number_mbbank
        var output_recipient_bank_mbbank = document.querySelector('#output_recipient_text-mbbank')
        output_recipient_bank_mbbank.innerHTML = value_recipient_bank_mbbank
        var output_source_account_mbbank = document.querySelector('#output_source_account-mbbank')
        output_source_account_mbbank.innerHTML = value_source_account_mbbank
        var output_source_name_mbbank = document.querySelector('#output_source_name-mbbank')
        output_source_name_mbbank.innerHTML = value_source_name_mbbank
        var output_content_mbbank = document.querySelector('#output_content-mbbank')
        output_content_mbbank.innerHTML = value_content_mbbank
        var output_time_mbbank = document.querySelector('#output_time-mbbank')
        output_time_mbbank.innerHTML = value_time_mbbank
        var output_code_number = document.querySelector('#output_trade_code-mbbank')
        output_code_number.innerHTML = value_code_number
    })
}

//--------------------------------------- Đưa dữ liệu Momo ---------------------------------------
var screenshotButton_momo = document.getElementById('create_bill-momo')
var create_bill_momo = document.querySelector('#create_to_img-5')
if(screenshotButton_momo) {
    screenshotButton_momo.addEventListener("click", function() {
        var value_clock_momo = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_recipient_name_momo = document.querySelector('#input_recipient_name-momo').value
        var value_recipient_bank_momo = document.querySelector('#input_recipient_bank-momo').value
        var value_total_price_momo = document.querySelector('#input_total_price').value
        var value_time_momo = document.querySelector('#input_time-momo').value
        var value_trade_code_momo = document.querySelector('#input_trade_code-momo').value
        var value_recipient_number_momo = document.querySelector('#input_recipient_number-momo').value
        var value_banking_name_momo = document.querySelector('#input_banking_name-momo').value
        var value_message_momo = document.querySelector('#input_message-momo').value
        var value_banking_banking_momo = document.querySelector('#input_banking_bank-momo').value

        var output_clock_momo = document.querySelector('#output_clock-momo')
        output_clock_momo.innerHTML = value_clock_momo
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_recipient_name_momo = document.querySelector('#output_recipient_name-momo')
        output_recipient_name_momo.innerHTML = value_recipient_name_momo
        var output_recipient_bank_momo = document.querySelector('#output_recipient_bank-momo')
        output_recipient_bank_momo.innerHTML = value_recipient_bank_momo
        var output_total_price_momo = document.querySelector('#output_total_price-momo')
        value_total_price_momo = value_total_price_momo.replace(/,/g, ".")
        output_total_price_momo.innerHTML = value_total_price_momo
        var ouput_total_price2_momo = document.querySelector('#output_total_price2-momo')
        ouput_total_price2_momo.innerHTML = value_total_price_momo
        var output_time_momo = document.querySelector('#output_time-momo')
        output_time_momo.innerHTML = value_time_momo
        var output_trade_code_momo = document.querySelector('#output_trade_code-momo')
        output_trade_code_momo.innerHTML = value_trade_code_momo
        var output_recipient_number_momo = document.querySelector('#output_recipient_number-momo')
        output_recipient_number_momo.innerHTML = value_recipient_number_momo
        var output_banking_name_momo = document.querySelector('#output_banking_name-momo')
        output_banking_name_momo.innerHTML = value_banking_name_momo
        var output_message_momo = document.querySelector('#output_message-momo')
        output_message_momo.innerHTML = value_message_momo
        var output_banking_banking_momo = document.querySelector('#output_banking_bank-momo')
        output_banking_banking_momo.innerHTML = value_banking_banking_momo

        var div_add = document.querySelector('#new_bill5')
        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        var value_wifi = document.querySelector('#input_wifi').value
        var signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        var new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_white.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    })
}   
if(create_bill_momo) {
    create_bill_momo.addEventListener("click", function() {
        var out_wifi = document.querySelector('#output_wifi')
        out_wifi.style.top = '13px'
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill5")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_momo.jpg';
            a.click();
            out_wifi.style.top = '14px'
        });
    })
}

// --------------------------------------- Đưa dữ liệu MSB ---------------------------------------
var screenshotButton_msb = document.querySelector('#create_bill-msb')
var create_bill_msb = document.querySelector('#create_to_img-6')
if(screenshotButton_msb) {
    screenshotButton_msb.addEventListener("click", function() {
        var value_clock_msb = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_holder_name_msb = document.querySelector('#input_holder_name-msb').value
        var value_total_price_msb = document.querySelector('#input_total_number').value
        var value_recipient_number_msb = document.querySelector('#input_recipient_number-msb').value
        var value_recipient_name_msb = document.querySelector('#input_recipient_name-msb').value
        var value_message_msb = document.querySelector('#input_message-msb').value

        var output_clock_msb = document.querySelector('#output_clock-msb')
        output_clock_msb.innerHTML = value_clock_msb
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'black'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
	    output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_holder_name_msb = document.querySelector('#output_holder_name-msb')
        output_holder_name_msb.innerHTML = value_holder_name_msb
        var output_total_price_msb = document.querySelector('#output_total_price-msb')
        output_total_price_msb.innerHTML = value_total_price_msb
        var output_recipient_number_msb = document.querySelector('#output_recipient_number-msb')
        output_recipient_number_msb.innerHTML = value_recipient_number_msb
        var output_recipient_name_msb = document.querySelector('#output_recipient_name-msb')
        output_recipient_name_msb.innerHTML = value_recipient_name_msb
        var output_message_msb = document.querySelector('#output_message-msb')
        output_message_msb.innerHTML = value_message_msb

        var div_add = document.querySelector('#new_bill6')
        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_black');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        var value_wifi = document.querySelector('#input_wifi').value
        var signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        var new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'black'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_black.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    })
}
if(create_bill_msb) {
    create_bill_msb.addEventListener("click", function() {
        window.scrollTo(0,0);
        var out_wifi = document.querySelector('#output_wifi')
        out_wifi.style.top = '13px'
        html2canvas(document.querySelector("#new_bill6")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_msb.jpg';
            a.click();
            out_wifi.style.top = '14px'
        });
    })
}

// --------------------------------------- Đưa dữ liệu Sacombank --------------------------------------- 
var screenshotButton_sacombank = document.querySelector('#create_bill-sacombank')
var create_bill_sacombank = document.querySelector('#create_to_img-7')
if(screenshotButton_sacombank) {
    screenshotButton_sacombank.addEventListener("click", function() {
        var value_clock_sacombank = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_recipient_number_sacombank = document.querySelector('#input_recipient_number-sacombank').value
        var value_recipient_name_sacombank = document.querySelector('#input_recipient_name-sacombank').value
        var value_total_price_sacombank = document.querySelector('#input_total_number').value
        var value_time_sacombank = document.querySelector('#input_time-sacombank').value
        var value_trade_code_sacombank = document.querySelector('#input_trade_code-sacombank').value
        var value_from_number = document.querySelector('#input_from_number-sacombank').value
        var value_recipient_bank_sacombank = document.querySelector('#input_recipient_bank-sacombank').value
        var value_message_sacombank = document.querySelector('#input_message-sacombank').value

        var output_clock_sacombank = document.querySelector('#output_clock-sacombank')
        output_clock_sacombank.innerHTML = value_clock_sacombank
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
	    output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_recipient_number_sacombank = document.querySelector('#output_recipient_number-sacombank')
        output_recipient_number_sacombank.innerHTML = value_recipient_number_sacombank
        var output_recipient_number2_sacombank = document.querySelector('#output_recipient_number2-sacombank')
        output_recipient_number2_sacombank.innerHTML = value_recipient_number_sacombank
        var output_recipient_name_sacombank = document.querySelector('#output_recipient_name-sacombank')
        output_recipient_name_sacombank.innerHTML = value_recipient_name_sacombank
        var output_total_price_sacombank = document.querySelector('#output_total_price-sacombank')
        output_total_price_sacombank.innerHTML = value_total_price_sacombank
        var output_total_price2_sacombank = document.querySelector('#output_total_price2-sacombank')
        output_total_price2_sacombank.innerHTML = value_total_price_sacombank
        var output_total_price3_sacombank = document.querySelector('#output_total_price3-sacombank')
        output_total_price3_sacombank.innerHTML = value_total_price_sacombank
        var output_time_sacombank = document.querySelector('#output_time-sacombank')
        output_time_sacombank.innerHTML = value_time_sacombank
        var output_trade_code_sacombank = document.querySelector('#output_trade_code-sacombank')
        output_trade_code_sacombank.innerHTML = value_trade_code_sacombank
        var output_from_number = document.querySelector('#output_from_number-sacombank')
        output_from_number.innerHTML = value_from_number
        var output_recipient_bank_sacombank = document.querySelector('#output_recipient_bank-sacombank')
        output_recipient_bank_sacombank.innerHTML = value_recipient_bank_sacombank
        var output_message_sacombank = document.querySelector('#output_message-sacombank')
        output_message_sacombank.innerHTML = value_message_sacombank

        var div_add = document.querySelector('#new_bill7')
        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        var value_wifi = document.querySelector('#input_wifi').value
        var signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        var new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="photo/icon_wifi_white.jpg"
            new_spanWifi.appendChild(img_wifi)
        }
    })
}
if(create_bill_sacombank) {
    create_bill_sacombank.addEventListener("click", function() {
        window.scrollTo(0,0);
        var out_wifi = document.querySelector('#output_wifi')
        out_wifi.style.top = '13px'
        html2canvas(document.querySelector("#new_bill7")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_sacombank.jpg';
            a.click();
            out_wifi.style.top = '14px'
        });
    })
}

// --------------------------------------- Đưa dữ liệu Techcombank --------------------------------------- 
var screenshotButton_techcombank = document.querySelector('#create_bill-techcombank')
var create_bill_techcombank = document.querySelector('#create_to_img-8')
if(screenshotButton_techcombank) {
    screenshotButton_techcombank.addEventListener("click", function() {
        var value_clock_techcombank = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_recipient_name_techcombank = document.querySelector('#input_recipient_name-techcombank').value
        var value_total_price_techcombank = document.querySelector('#input_total_number').value
        var value_recipient_bank_techcombank = document.querySelector('#input_recipient_bank-techcombank').value
        var value_recipient_number_techcombank = document.querySelector('#input_recipient_number-techcombank').value
        var value_message_techcombank = document.querySelector('#input_message-techcombank').value
        var value_time_techcombank = document.querySelector('#input_time-techcombank').value
        var value_trade_code_techcombank = document.querySelector('#input_trade_code-techcombank').value

        var output_clock_techcombank = document.querySelector('#output_clock-techcombank')
        output_clock_techcombank.innerHTML = value_clock_techcombank
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'black'
        if(value_battery <= 20) {
          
            output_battery.style.background = '#fd465e'
        }
	    output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_recipient_name_techcombank = document.querySelector('#output_recipient_name-techcombank')
        output_recipient_name_techcombank.innerHTML = value_recipient_name_techcombank
        var output_total_price_techcombank = document.querySelector('#output_total_price-techcombank')
        output_total_price_techcombank.innerHTML = value_total_price_techcombank
        var output_recipient_bank_techcombank = document.querySelector('#output_recipient_bank-techcombank')
        output_recipient_bank_techcombank.innerHTML = value_recipient_bank_techcombank
        var output_recipient_number_techcombank = document.querySelector('#output_recipient_number-techcombank')
        output_recipient_number_techcombank.innerHTML = value_recipient_number_techcombank
        var output_message_techcombank = document.querySelector('#output_message-techcombank')
        output_message_techcombank.innerHTML = value_message_techcombank
        var output_time_techcombank = document.querySelector('#output_time-techcombank')
        output_time_techcombank.innerHTML = value_time_techcombank
        var output_trade_code_techcombank = document.querySelector('#output_trade_code-techcombank')
        output_trade_code_techcombank.innerHTML = value_trade_code_techcombank

        var div_add = document.querySelector('#new_bill8')
        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            newsignalDiv.style.left = '304px'
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_black');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        var value_wifi = document.querySelector('#input_wifi').value
        var signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        var new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.style.left = '331px'
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'black'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
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
        var out_wifi = document.querySelector('#output_wifi')
        out_wifi.style.top = '13px'
        html2canvas(document.querySelector("#new_bill8")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_techcombank.jpg';
            a.click();
            out_wifi.style.top = '14px'
        });
    })
}

// --------------------------------------- Đưa dữ liệu Vietcombank --------------------------------------- 
var screenshotButton_vietcombank = document.querySelector('#create_bill-vietcombank')
var create_bill_vietcombank = document.querySelector('#create_to_img-10')
if(screenshotButton_vietcombank) {
    screenshotButton_vietcombank.addEventListener("click", function() {
        var value_clock_vietcombank = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_total_price_vietcombank = document.querySelector('#input_total_number').value
        var value_recipient_name_vietcombank = document.querySelector('#input_recipient_name-vietcombank').value
        var value_recipient_number_vietcombank = document.querySelector('#input_recipient_number-vietcombank').value
        var value_recipient_bank_name_vietcombank = document.querySelector('#input_recipient_bank_name-vietcombank').value
        var value_recipient_bank_code_vietcombank = document.querySelector('#input_recipient_bank_code-vietcombank').value
        var value_trade_code_vietcombank = document.querySelector('#input_trade_code-vietcombank').value
        var value_message_vietcombank = document.querySelector('#input_message-vietcombank').value

        var output_clock_vietcombank = document.querySelector('#output_clock-vietcombank')
        output_clock_vietcombank.innerHTML = value_clock_vietcombank
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_total_price_vietcombank = document.querySelector('#output_total_price-vietcombank')
        output_total_price_vietcombank.innerHTML = value_total_price_vietcombank
        var output_recipient_name_vietcombank = document.querySelector('#output_recipient_name-vietcombank')
        output_recipient_name_vietcombank.innerHTML = value_recipient_name_vietcombank
        var output_recipient_number_vietcombank = document.querySelector('#output_recipient_number-vietcombank')
        output_recipient_number_vietcombank.innerHTML = value_recipient_number_vietcombank
        var output_recipient_bank_name_vietcombank = document.querySelector('#output_recipient_bank_name-vietcombank')
        output_recipient_bank_name_vietcombank.innerHTML = value_recipient_bank_name_vietcombank
        var output_recipient_bank_code_vietcombank = document.querySelector('#output_recipient_bank_code-vietcombank')
        output_recipient_bank_code_vietcombank.innerHTML = value_recipient_bank_code_vietcombank
        var output_trade_code_vietcombank = document.querySelector('#output_trade_code-vietcombank')
        output_trade_code_vietcombank.innerHTML = value_trade_code_vietcombank
        var output_message_vietcombank = document.querySelector('#output_message-vietcombank')
        output_message_vietcombank.innerHTML = value_message_vietcombank

        var div_add = document.querySelector('#new_bill10')
        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            newsignalDiv.style.left = '304px'
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        var value_wifi = document.querySelector('#input_wifi').value
        var signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        var new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.style.left = '331px'
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
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
        var out_wifi = document.querySelector('#output_wifi')
        out_wifi.style.top = '13px'
        html2canvas(document.querySelector("#new_bill10")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_vietcombank.jpg';
            a.click();
            out_wifi.style.top = '14px'
        });
    })
}
// --------------------------------------- Đưa dữ liệu Vietinbank --------------------------------------- 
var screenshotButton_vietinbank = document.querySelector('#create_bill-vietinbank')
var create_bill_vietinbank = document.querySelector('#create_to_img-11')
if(screenshotButton_vietinbank) {
    screenshotButton_vietinbank.addEventListener("click", function() {
        var value_clock_vietinbank = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var value_time_vietinbank = document.querySelector('#input_time-vietinbank').value
        var value_trade_code_vietinbank = document.querySelector('#input_trade_code-vietinbank').value
        var value_from_number_vietinbank = document.querySelector('#input_from_number-vietinbank').value
        var value_from_name_vietinbank = document.querySelector('#input_from_name-vietinbank').value
        var value_recipient_number_vietinbank = document.querySelector('#input_recipient_number-vietinbank').value
        var value_recipient_name_vietinbank = document.querySelector('#input_recipient_name-vietinbank').value
        var value_recipient_bank_vietinbank = document.querySelector('#input_recipient_bank-vietinbank').value
        var value_total_number_vietinbank = document.querySelector('#input_total_number').value
        var value_total_text_vietinbank = document.querySelector('#input_total_text-vietinbank').value
        var value_message_vietinbank = document.querySelector('#input_message-vietinbank').value

        var output_clock_vietinbank = document.querySelector('#output_clock-vietinbank')
        output_clock_vietinbank.innerHTML = value_clock_vietinbank
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'white'
        if(value_battery <= 20) {
          
            output_battery.style.background = '#fd465e'
        }
	    output_battery.style.width = 19.7*value_battery/100 +'px'
        var output_time_vietinbank = document.querySelector('#output_time-vietinbank')
        output_time_vietinbank.innerHTML = value_time_vietinbank
        var output_trade_code_vietinbank = document.querySelector('#output_trade_code-vietinbank')
        output_trade_code_vietinbank.innerHTML = value_trade_code_vietinbank
        var output_from_number_vietinbank = document.querySelector('#output_from_number-vietinbank')
        output_from_number_vietinbank.innerHTML = value_from_number_vietinbank
        var output_from_name_vietinbank = document.querySelector('#output_from_name-vietinbank')
        output_from_name_vietinbank.innerHTML = value_from_name_vietinbank
        var output_recipient_number_vietinbank = document.querySelector('#output_recipient_number-vietinbank')
        output_recipient_number_vietinbank.innerHTML = value_recipient_number_vietinbank
        var output_recipient_name_vietinbank = document.querySelector('#output_recipient_name-vietinbank')
        output_recipient_name_vietinbank.innerHTML = value_recipient_name_vietinbank
        var output_recipient_bank_vietinbank = document.querySelector('#output_recipient_bank-vietinbank')
        output_recipient_bank_vietinbank.innerHTML = value_recipient_bank_vietinbank
        var output_total_number_vietinbank = document.querySelector('#output_total_number-vietinbank')
        output_total_number_vietinbank.innerHTML = value_total_number_vietinbank
        var output_total_text_vietinbank = document.querySelector('#output_total_text-vietinbank')
        output_total_text_vietinbank.innerHTML = value_total_text_vietinbank
        var output_message_vietinbank = document.querySelector('#output_message-vietinbank')
        output_message_vietinbank.innerHTML = value_message_vietinbank

        var div_add = document.querySelector('#new_bill11')
        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal');
            newsignalDiv.id=('output_signal');
            newsignalDiv.style.left = '304px'
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_white');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        //Tạo sóng wifi
        var value_wifi = document.querySelector('#input_wifi').value
        var signalDiv = document.querySelector('#output_wifi')
        if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)

        //Tạo mới wifi
        var new_wifiDiv = document.createElement('div')
        new_wifiDiv.classList.add('wifi')
        new_wifiDiv.style.left = '331px'
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'white'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
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
        var out_wifi = document.querySelector('#output_wifi')
        out_wifi.style.top = '13px'
        html2canvas(document.querySelector("#new_bill11")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bill_vietinbank.jpg';
            a.click();
            out_wifi.style.top = '14px'
        });
    })
}