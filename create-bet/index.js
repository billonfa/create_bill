window.addEventListener('load', function () {
    document.querySelector('#loading').style.display = 'flex'
    setTimeout(function() {
        document.querySelector('#loading').style.display = 'none'
    }, 1000);
    var numberInput = document.getElementById("input_price");
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
            event.preventDefault(); // Chặn sự kiện mặc định
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

    const update_img = this.document.querySelector('#buttun-create-bet-ball')
    update_img.addEventListener('click', function() {
        const value_name_team1 = document.querySelector('#input_name_team1').value
        const value_name_team2 = document.querySelector('#input_name_team2').value
        const value_league = document.querySelector('#input_name_league').value
        const value_match = document.querySelector('#input_match').value
        const value_detail_match = document.querySelector('#input_detail_match').value
        const value_time_start = document.querySelector('#input_time_start').value
        const value_time = document.querySelector('#input_time').value
        const value_cate = document.querySelector('#input_cate').value
        let value_percent = document.querySelector('#input_percent').value 
        
        const value_half = document.querySelector('#input_half').value
        const value_price = document.querySelector('#input_price').value
        const value_cate_bill = document.querySelector('#cate_bill').value - 1
        // const trade_code = document.querySelector('#input_trade_code').value
        let value_total_win = parseInt(value_price.replace(/,/g, '') * value_percent)
        value_total_win = value_total_win.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 })
        if (value_cate == 2) {
            value_percent = parseFloat(value_percent) + (1)
            value_percent = value_percent.toFixed(2)
        } 
        let text_cate = 'Kèo Hồng Kông'
        if(value_cate == 2) {
            text_cate = 'Kèo Châu Âu'
        }
        //------------------------------------------Nhập dữ liệu ảnh 0---------------------------------------------------
        const price_0 = document.querySelector('#bet_price-0')
        price_0.textContent = value_price
        const total_win_0 = document.querySelector('#total_win-0')
        total_win_0.textContent = value_total_win
        const detail_match_0 = document.querySelector('#detail_match-0')
        detail_match_0.textContent = value_detail_match
        const percent_0 = document.querySelector('#percent-0')
        percent_0.textContent = value_percent
        const match_0 = document.querySelector('#match-0')
        match_0.textContent = value_match
        const half_0 = document.querySelector('#half-0')
        half_0.textContent = value_half
        const name_team1_0 = document.querySelector('#name_team1-0')
        name_team1_0.textContent = value_name_team1
        const name_team2_0 = document.querySelector('#name_team2-0')
        name_team2_0.textContent = value_name_team2
        const league_0 = document.querySelector('#league-0')
        league_0.textContent = value_league
        const time_start_0 = document.querySelector('#time_start-0')
        time_start_0.textContent = value_time_start
        
        //------------------------------------------Nhập dữ liệu ảnh 1---------------------------------------------------
        for(let i = 1; i <= 5; i++) {
            let bet_price = document.querySelector(`#bet_price-${i}`)
            bet_price.textContent = value_price
            let detail_match = document.querySelector(`#detail_match-${i}`)
            detail_match.textContent = value_detail_match
            let percent = document.querySelector(`.percent-${i}`)
            percent.textContent = value_percent
            let match = document.querySelector(`#match-${i}`)
            match.textContent =value_match
            let half = document.querySelector(`#half-${i}`)
            half.textContent = "-" + value_half + " "
            if (value_half === "Cả Trận") {
                half.textContent = " "
            }
            let cate = document.querySelector(`#cate-${i}`)
            cate.textContent = text_cate
            let name_t1 = document.querySelector(`#name_team1-${i}`)
            name_t1.textContent = value_name_team1
            let name_t2 = document.querySelector(`#name_team2-${i}`)
            name_t2.textContent = value_name_team2
            let league = document.querySelector(`.league-${i}`)
            league.textContent = value_league
            let bet_price2 = document.querySelector(`#bet_price2-${i}`)
            bet_price2.textContent = value_price
            let total_win = document.querySelector(`#total_win-${i}`)
            total_win.textContent = value_total_win
            let time_start = document.querySelector(`#time_start-${i}`)
            time_start.textContent = value_time_start.slice(0, -3)
            let time = document.querySelector(`.time-${i}`)
            time.textContent = value_time.slice(5, -3)
        }

        var options = {
            
        }
        console.log(document.querySelector(`#new-bet-ball-${value_cate_bill}`))
        // document.querySelector(`#new-bet-ball-${value_cate_bill}`).style.width = '725px'
        html2canvas(document.querySelector(`#new-bet-ball-${value_cate_bill}`), options).then(canvas => {
            let a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 1.0);
            a.download = 'new_bet_ball.jpg';
            a.click();
        });
    });
    
     // //------------------------------------------Xuất ảnh------------------------------------------

});
//--------------------------------------- Đưa dữ liệu BET 3 ---------------------------------------
var screenshotButton_bet = document.getElementById("create_bill2");
var create_bill_bet = document.querySelector('#create_to_img-2')
if(create_bill_bet) {
    var custom_icon = document.querySelector('#custom-icon')
    create_bill_bet.addEventListener("click", function() {
        window.scrollTo(0,0);
        
        html2canvas(document.querySelector("#new_bill2")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL('image/jpeg', 0.9);
            a.download = 'new_bet_bill.jpg';
            a.click();
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

        var value_date = document.querySelector('#input_today').value

        var value_name_g1 = document.querySelector('#input_name_game_1').value
        var value_time_g1 = document.querySelector('#input_detail_date_1').value
        var value_price_g1 = document.querySelector('#input_price_1').value
        var value_win_lose_g1 = document.querySelector('#input_win_1').value
        
        var value_name_g2 = document.querySelector('#input_name_game_2').value
        var value_time_g2 = document.querySelector('#input_detail_date_2').value
        var value_price_g2 = document.querySelector('#input_price_2').value
        var value_win_lose_g2 = document.querySelector('#input_win_2').value

        var value_name_g3 = document.querySelector('#input_name_game_3').value
        var value_time_g3 = document.querySelector('#input_detail_date_3').value
        var value_price_g3 = document.querySelector('#input_price_3').value
        var value_win_lose_g3 = document.querySelector('#input_win_3').value

        var date = document.querySelector('#date-b3')
        date.textContent = value_date

        var name_g1 = document.querySelector('#name_g1-b3')
        name_g1.textContent = value_name_g1
        var time_g1 = document.querySelector('#time_g1-b3')
        time_g1.textContent = value_time_g1

        var percent1 = document.querySelector('#input_percent1').value
        percent1 = percent1.replace('%', '');
        
        var price_g1 = document.querySelectorAll('.out_price_g1-b3')
        price_g1[0].textContent = value_price_g1
        price_g1[1].textContent = value_price_g1 / 100 * percent1
        price_g1[2].textContent = value_price_g1 / 100 * percent1


        var total_price_g1 = document.querySelector('#total_price_g1-b3')
        if(value_win_lose_g1 == 1) {
            document.querySelector('.price_g1-b3').style.color = '#2fe120'
            total_price_g1.textContent = (parseFloat(value_price_g1) + (value_price_g1 / 100 * percent1))
            total_price_g1.style.color = '#2fe120'
            document.querySelector('.togger').style.display = 'inline-block'
        }
        else {
            document.querySelector('.price_g1-b3').style.color = 'red'
            price_g1[2].textContent = '-' + (value_price_g1 / 100 * percent1)
            total_price_g1.textContent = '-'
            total_price_g1.style.color = 'black'
            var togger = document.querySelector('.togger')
            togger.style.display = 'none'
        }


        var name_g2 = document.querySelector('#name_g2-b3')
        name_g2.textContent = value_name_g2
        var time_g2 = document.querySelector('#time_g2-b3')
        time_g2.textContent = value_time_g2

        var percent2 = document.querySelector('#input_percent2').value
        percent2 = percent2.replace('%', '');
        
        var price_g2 = document.querySelectorAll('.out_price_g2-b3')
        price_g2[0].textContent = value_price_g2
        price_g2[1].textContent = value_price_g2 / 100 * percent2
        price_g2[2].textContent = value_price_g2 / 100 * percent2


        var total_price_g2 = document.querySelector('#total_price_g2-b3')
        if(value_win_lose_g2 == 1) {
            document.querySelector('.price_g2-b3').style.color = '#2fe120'
            total_price_g2.textContent = (parseFloat(value_price_g2) + (value_price_g2 / 100 * percent2))
            total_price_g2.style.color = '#2fe120'
            document.querySelector('.togger2').style.display = 'inline-block'
        }
        else {
            document.querySelector('.price_g2-b3').style.color = 'red'
            price_g2[2].textContent = '-' + (value_price_g2 / 100 * percent2)
            total_price_g2.textContent = '-'
            total_price_g2.style.color = 'black'
            document.querySelector('.togger2').style.display = 'none'
        }



        var name_g3 = document.querySelector('#name_g3-b3')
        name_g3.textContent = value_name_g3
        var time_g3 = document.querySelector('#time_g3-b3')
        time_g3.textContent = value_time_g3
        var price_g3 = document.querySelectorAll('.out_price_g3-b3')
        price_g3.forEach(function (item) {
            item.textContent = value_price_g3
        })

        var percent3 = document.querySelector('#input_percent3').value
        percent3 = percent3.replace('%', '');
        
        var price_g3 = document.querySelectorAll('.out_price_g3-b3')
        price_g3[0].textContent = value_price_g3
        price_g3[1].textContent = value_price_g3 / 100 * percent3
        price_g3[2].textContent = value_price_g3 / 100 * percent3
        var total_price_g3 = document.querySelector('#total_price_g3-b3')
        if(value_win_lose_g3 == 1) {
            document.querySelector('.price_g3-b3').style.color = '#2fe120'
            total_price_g3.textContent = (parseFloat(value_price_g3) + (value_price_g3 / 100 * percent3))
            total_price_g3.style.color = '#2fe120'
            document.querySelector('.togger3').style.display = 'inline-block'
        }
        else {
            document.querySelector('.price_g3-b3').style.color = 'red'
            price_g3[2].textContent = '-' + (value_price_g3 / 100 * percent3)
            total_price_g3.textContent = '-'
            total_price_g3.style.color = 'black'
            document.querySelector('.togger3').style.display = 'none'
        }
    })
}