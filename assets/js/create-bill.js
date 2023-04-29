
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


var screenshotButton_mbbank = document.getElementById("create_bill-mbbank");
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