//Đưa dữ liệu ACB
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
    })
}
//Đưa dữ liệu BIDV
var screenshotButton_bidv = document.getElementById("create_bill-bidv");
if (screenshotButton_bidv) {
    screenshotButton_bidv.addEventListener("click", function() {
        const value_clock_bidv = document.querySelector('#input_clock-bidv').value
        const value_total_price_bidv = document.querySelector('#input_total_price-bidv').value
        const value_recipient_number_bidv = document.querySelector('#input_recipient_number-bidv').value
        const value_recipient_name_bidv = document.querySelector('#input_recipient_name-bidv').value
        const value_recipient_bank_bidv = document.querySelector('#input_recipient_bank-bidv').value
        const value_time_bidv = document.querySelector('#input_time-bidv').value
        const value_content_bidv = document.querySelector('#input_content-bidv').value
        const value_code_number = document.querySelector('#input_code_number-bidv').value
    
        const output_clock_bidv = document.querySelector('#output_clock-bidv')
        output_clock_bidv.innerHTML = value_clock_bidv
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
    });
}

//Đưa dữ liệu MB bank
var screenshotButton_mbbank = document.getElementById("create_bill-mbbank");
if(screenshotButton_mbbank) {
    screenshotButton_mbbank.addEventListener("click", function() {
        const value_clock_mbbank = document.querySelector('#input_clock-mbbank').value
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
