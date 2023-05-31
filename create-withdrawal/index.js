window.addEventListener('load', function () {
    document.querySelector('#loading').style.display = 'flex'
    setTimeout(function() {
        document.querySelector('#loading').style.display = 'none'
    }, 1000);
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
            var userInput2 = numberInput2.value;
            var formatted = userInput2.replace(/,/g, ''); // xóa tất cả dấu phẩy có sẵn
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

    const buttons = document.querySelectorAll('button');

    for (let i = 0; i < buttons.length; i++) {
        if(buttons[i].id === 'page-header-user-dropdown' || buttons[i].id === 'back-to-top') {
            continue
        }
        buttons[i].addEventListener('click', function(event) {
            document.querySelector('#loading').style.display = 'flex'
            setTimeout(function() {
                document.querySelector('#loading').style.display = 'none'
            }, 500);
        });
    }

    const links = document.querySelectorAll('a');

    for (let i = 0; i < links.length; i++) {
        links[i].addEventListener('click', function(event) {
            document.querySelector('#loading').style.display = 'flex'
            setTimeout(function() {
                document.querySelector('#loading').style.display = 'none'
            }, 500);
        });
    }


    var win_lose_g1 = document.querySelector('#input_win_1')
    if(win_lose_g1) {
            win_lose_g1.addEventListener('change', function() {
            // Lấy giá trị của tùy chọn được chọn
            var selectedOption = this.value;
            document.querySelector('#input_win_1').style.color = 'green'
            if(selectedOption == 2) {
                document.querySelector('#input_win_1').style.color = 'red'
            }
        });
    }
    var win_lose_g2 = document.querySelector('#input_win_2')

    
    if(win_lose_g2) {
        win_lose_g2.addEventListener('change', function() {
            // Lấy giá trị của tùy chọn được chọn
            var selectedOption = this.value;
            document.querySelector('#input_win_2').style.color = 'green'
            if(selectedOption == 2) {
                document.querySelector('#input_win_2').style.color = 'red'
            }
        });
    }
    var win_lose_g3 = document.querySelector('#input_win_3')
    if(win_lose_g3) {
        win_lose_g3.addEventListener('change', function() {
            // Lấy giá trị của tùy chọn được chọn
            var selectedOption = this.value;
            document.querySelector('#input_win_3').style.color = 'green'
            if(selectedOption == 2) {
                document.querySelector('#input_win_3').style.color = 'red'
            }
        });
    }

});

//--------------------------------------- Đưa dữ liệu đơn rút Bongvip ---------------------------------------
var screenshotButton_bet = document.getElementById("create_bill1");
var create_bill_bet = document.querySelector('#create_to_img-1')
if(create_bill_bet) {
    var custom_icon = document.querySelector('#custom-icon')
    create_bill_bet.addEventListener("click", function() {
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill1")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_withdrawal_Bongvip.jpg';
            a.click();
            // window.location.href = "https://help.onfa.asia/create-bank-bill.php?id=1";
        });
    })
}
if(screenshotButton_bet) {
    screenshotButton_bet.addEventListener("click", function() {
        var value_clock = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        var output_clock = document.querySelector('#output_clock')
        output_clock.innerHTML = value_clock
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'black'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 20.7*value_battery/100 +'px'
        
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
            div_add.appendChild(newsignalDiv)

            //Thêm thẻ bar vào signal
            for(var i = 0; i < value_sim_waves; i++) {
                var newbarDiv = document.createElement('div');
                newbarDiv.classList.add('bar');
                newbarDiv.classList.add('background_black');
                newsignalDiv.appendChild(newbarDiv);
            }
        }
        
        // Sim 2 điện thoại
        var value_sim2 = document.querySelector('#total_sim').value
        var signal2 = document.querySelector('#output_signal2')
        var signal__1  = document.querySelector('#output_signal-1')
        if (value_sim2 == 1) {
            signal2.style.display = 'none'
            signal__1.style.display = 'none'
            document.querySelector('#output_signal_invi').style.display = 'block'
            newsignalDiv.style.display = 'block'
        }
        else {
            signal2.style.display = 'block'
            signal__1.style.display = 'block'
            document.querySelector('#output_signal_invi').style.display = 'none'
            newsignalDiv.style.display = 'none'
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
            new_wifiDiv.style.top = '12px'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
            new_wifiDiv.style.top = '12px'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="../photo/icon_wifi_black.jpg"
            new_spanWifi.appendChild(img_wifi)
            new_wifiDiv.style.top = '11px'
        }

        var value_today = document.querySelector('#input_today').value
        var value_bank = document.querySelector('#input_bank').value
        var value_detail_date = document.querySelector('#input_detail_date').value
        var value_total_price = document.querySelector('#input_total_price').value
        var value_trade_code = document.querySelector('#input_trade_code').value
        var value_trade_status = document.querySelector('#input_trade_status').value

        var today = document.querySelector('#date-b1')
        today.textContent = value_today
        var bank = document.querySelector('#bank_name-b1')
        bank.textContent = value_bank
        var detail_date = document.querySelector('#detail_date-b1')
        detail_date.textContent = value_detail_date
        var total_price = document.querySelector('#total_price-b1')
        total_price.textContent = value_total_price
        var total_price2 = document.querySelector('#total_price2')
        total_price2.textContent = value_total_price
        var trade_code = document.querySelector('#trade_code-b1')
        trade_code.textContent = value_trade_code
        var trade_status = document.querySelector('#trade_status-b1')
        trade_status.textContent =  value_trade_status == 1 ? "Rút tiền thành công" :
                                    value_trade_status == 2 ? "Đang xử lý" :
                                    value_trade_status == 3 ? "Rút tiền thất bại" :
                                    "Kiểm duyệt thành công"
        
    })
}

//--------------------------------------- Đưa dữ liệu Đơn rút Mg ---------------------------------------
var screenshotButton_bet = document.getElementById("create_bill3");
var create_bill_bet = document.querySelector('#create_to_img-3')
if(create_bill_bet) {
    var custom_icon = document.querySelector('#custom-icon')
    create_bill_bet.addEventListener("click", function() {
        
        var black_white = document.querySelector('#background_color-mg3').value
        document.querySelector('.pin_number').style.top = '9.4px'
        if(black_white == 1) {
            document.querySelector('.pin_number').style.top = '10px'
        }
        window.scrollTo(0,0);
        html2canvas(document.querySelector("#new_bill3")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_withdrawal_MG.jpg';
            a.click();
            location.reload();
        });
    })
}
if(screenshotButton_bet) {
    screenshotButton_bet.addEventListener("click", function() {
        var value_clock = document.querySelector('#input_clock').value
        var value_battery = document.querySelector('#input_battery_level').value
        document.querySelector('.pin_number').textContent = value_battery
        var output_clock = document.querySelector('#output_clock')
        output_clock.innerHTML = value_clock
        var output_battery = document.querySelector('#output_battery_level')
        output_battery.style.background = 'black'
        if(value_battery <= 20) {
            output_battery.style.background = '#fd465e'
        }
        output_battery.style.width = 25.7*value_battery/100 +'px'
        
        var div_add = document.querySelector('#new_bill3')

        // Tạo sóng điện thoại
        var value_sim_waves = document.querySelector('#input_sim_waves').value
        if(value_sim_waves) {
            //Xoá thẻ signal cũ
            var signalDiv = document.querySelector('#output_signal')
            
            if(signalDiv) signalDiv.parentNode.removeChild(signalDiv)
            //Tạo mới thẻ signal
            var newsignalDiv = document.createElement('div');
            newsignalDiv.classList.add('signal-mg');
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
        new_wifiDiv.classList.add('wifi-mg')
        new_wifiDiv.id = "output_wifi"
        div_add.appendChild(new_wifiDiv)
        var new_spanWifi = document.createElement('span')
        new_wifiDiv.appendChild(new_spanWifi)
        new_spanWifi.style.color = 'black'
        new_wifiDiv.style.top = '10.9px'
        if(value_wifi == 1) {
            new_spanWifi.textContent = 'LTE'
        }
        if(value_wifi == 2) {
            new_spanWifi.textContent = '4G'
        }
        if(value_wifi == 3) {
            var img_wifi = document.createElement('img')
            img_wifi.classList.add('img_wifi')
            img_wifi.src="../photo/icon_wifi_black.jpg"
            new_wifiDiv.style.top = '8.9px'
            new_spanWifi.appendChild(img_wifi)
        }


        var value_time1 = document.querySelector('#input_detail_date_1').value
        var value_price1 = document.querySelector('#input_price_1').value
        var value_status1 = document.querySelector('#input_win_1').value

        var value_time2 = document.querySelector('#input_detail_date_2').value
        var value_price2 = document.querySelector('#input_price_2').value
        var value_status2 = document.querySelector('#input_win_2').value

        var value_time3 = document.querySelector('#input_detail_date_3').value
        var value_price3 = document.querySelector('#input_price_3').value

        var time_mg1 = document.querySelector('#time_mg1-mg')
        time_mg1.textContent = value_time1
        var price_mg1 = document.querySelector('#price_mg1-mg')
        price_mg1.textContent = value_price1
        var status_mg1_1 = document.querySelector('#status_mg1_1-mg')
        var status_mg2_1 = document.querySelector('#status_mg2_1-mg')
        status_mg1_1.textContent = 'Đóng Đơn (Trả Về)'
        status_mg2_1.textContent = 'Vui lòng liên hệ CSKH'
        if(value_status1 == 1) {
            status_mg1_1.textContent = 'Thành công'
            status_mg2_1.textContent = 'thành công'
        }

        var time_mg2 = document.querySelector('#time_mg2-mg')
        time_mg2.textContent = value_time2
        var price_mg2 = document.querySelector('#price_mg2-mg')
        price_mg2.textContent = value_price2
        var status_mg1_2 = document.querySelector('#status_mg1_2-mg')
        var status_mg2_2 = document.querySelector('#status_mg2_2-mg')
        status_mg1_2.textContent = 'Đóng Đơn (Trả Về)'
        status_mg2_2.textContent = 'Vui lòng liên hệ CSKH'
        if(value_status2 == 1) {
            status_mg1_2.textContent = 'Thành Công'
            status_mg2_2.textContent = 'thành công'
        }

        var time_mg3 = document.querySelector('#time_mg3-mg')
        time_mg3.textContent = value_time3
        var price_mg3 = document.querySelector('#price_mg3-mg')
        price_mg3.textContent = value_price3

        var background = document.querySelector('#background_color-mg3').value
        if(background == 2) {
            document.querySelector('.photo_style').src = "photo-bet/mg188_black.png"
            document.querySelector('#custom-icon').style.display = 'none'
            document.querySelector('.img_wifi').src = "../photo/icon_wifi_white.jpg"
            document.querySelector('#output_clock').style.color = 'white'
            let pin_number = document.querySelector('.pin_number')
            pin_number.style.color = '#353638'
            pin_number.style.top = '10px'
            let black = document.querySelectorAll('.background_black')
            black.forEach(function (item) {
                item.style.background = 'white'
            })
            let invi = document.querySelectorAll('.background_invi')
            invi.forEach(function (item) {
                item.style.background = '#7c7c7c'
            })
            let number_page = document.querySelector('.number_page')
            number_page.style.top = '805px'
            number_page.style.left = '274.5px'
            number_page.style.color = 'white'

            let battery = document.querySelector('#output_battery_level')
            battery.style.top = '11.9px'
            battery.style.left = '337px'
            if(value_battery <= 20) {
                output_battery.style.background = '#fd465e'
            }
        }
    })
}