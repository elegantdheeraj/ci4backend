var s_principal = 200000;
var s_duration = 30;
var s_rate = 8.5;
var s_interest = 0;
var emi_principal = 200000;
var emi_duration = 3;
var emi_rate = 8.5;
var emi_type = "Reducing";
var principal = 200000;
var duration = 3;
var flat_rate = 12;
var reducing_rate = 12;

$(document).ready(function () {
    supply_chain();
    calculateEMI();
    flatVsReducing();
});
function supply_chain() {
    s_interest = (s_principal * (s_rate / 100) * s_duration) / (365);
    $("#s_principal_amount").html("&#8377; " + s_principal.toLocaleString('en-IN'));
    $("#s_interest_amount").html("&#8377; " + Math.ceil(s_interest).toLocaleString('en-IN'));
    $(".s_total_amount").html("&#8377; " + (s_principal + Math.ceil(s_interest)).toLocaleString('en-IN'));
    updateData();
}

$("#s_principal").on('input', function () {
    $("#s_principal_text").val($(this).val());
    s_principal = parseFloat($(this).val());
    supply_chain();
});
$("#s_principal_text").on('input', function () {
    if ($(this).val() > 10000000) {
        $(this).val(10000000);
    }
    $("#s_principal").val($(this).val());
    s_principal = parseFloat($(this).val());
    supply_chain();
});
$("#s_duration").on('input', function () {
    $("#s_duration_text").val($(this).val());
    s_duration = parseInt($(this).val());
    supply_chain();
});

$("#s_duration_text").on('input', function () {
    if ($(this).val() > 90) {
        $(this).val(90);
    }
    $("#s_duration").val($(this).val());
    s_duration = parseInt($(this).val());
    supply_chain();
});

$("#s_rate").on('input', function () {
    $("#s_rate_text").val($(this).val());
    s_rate = parseFloat($(this).val());
    supply_chain();
});

$("#s_rate_text").on('input', function () {
    if ($(this).val() > 32) {
        $(this).val(32);
    }
    $("#s_rate").val($(this).val());
    s_rate = parseFloat($(this).val());
    supply_chain();
});
//----------------------EMI Graph----------------------//

const data = {
    datasets: [{
        data: [2.33, 1000],
        backgroundColor: ['#4463ad', '#e9e9e9'],
    }],
};

const options = {
    responsive: true,
    maintainAspectRatio: false,
    cutout: 80,
    plugins: {
        legend: {
            display: false, // Hide the legend
        },
        tooltip: {
            enabled: false, // Disable tooltips
        },
        datalabels: {
            color: 'red', // Label text color
            font: {
                size: 15, // Label text size
            },
            formatter: function (value, context) {
                return context.chart.data.labels[context.dataIndex] + ': ' + value + '%';
            },
        },
    },
};

const ctx = document.getElementById('doughnutChart').getContext('2d');
const doughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: options,
});
function updateData() {
    var newData = {
        datasets: [{
            data: [s_interest.toFixed(2), parseFloat(s_principal + s_interest).toFixed(2)],
            backgroundColor: ['#4463ad', '#e9e9e9']
        }]
    };

    // Update chart data and redraw
    doughnutChart.data = newData;
    doughnutChart.update('none');
}

/***
 * EMI calculation
 */
$("#emi_principal").on('input', function () {
    $("#emi_principal_text").val($(this).val());
    emi_principal = parseFloat($(this).val());
    calculateEMI();
});
$("#emi_principal_text").on('input', function () {
    if ($(this).val() > 10000000) {
        $(this).val(10000000);
    }
    $("#emi_principal").val($(this).val());
    emi_principal = parseFloat($(this).val());
    calculateEMI();
});
$("#emi_duration").on('input', function () {
    $("#emi_duration_text").val($(this).val());
    emi_duration = parseInt($(this).val());
    calculateEMI();
});

$("#emi_duration_text").on('input', function () {
    if ($(this).val() > 90) {
        $(this).val(90);
    }
    $("#emi_duration").val($(this).val());
    emi_duration = parseInt($(this).val());
    calculateEMI();
});

$("#emi_rate").on('input', function () {
    $("#emi_rate_text").val($(this).val());
    emi_rate = parseFloat($(this).val());
    calculateEMI();
});

$("#emi_rate_text").on('input', function () {
    if ($(this).val() > 32) {
        $(this).val(32);
    }
    $("#emi_rate").val($(this).val());
    emi_rate = parseFloat($(this).val());
    calculateEMI();
});
$("#emi_type").change(function () {
    calculateEMI();
});
function calculateEMI() {

    $("#emi_principal_amount").html("&#8377; " + emi_principal.toLocaleString('en-IN'));
    // Convert annual interest rate to monthly rate
    let monthlyInterestRate = (emi_rate / 12) / 100;
    /*** Reducing calculation  ****/
    // Calculate EMI using the formula
    let emi = Math.round((emi_principal * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, - emi_duration)));
    // end Reducing calculation  
    if ($("#emi_type").is(":checked")) {
        //flat calculation 
        // Calculate EMI using the formula
        emi = Math.round((emi_principal + (emi_principal * monthlyInterestRate * emi_duration)) / emi_duration);
        // end calculation 
    }
    emi_total_payable = emi * emi_duration;

    $("#emi_amount").html("&#8377; " + emi.toLocaleString('en-IN'));
    $("#emi_interest").html("&#8377; " + (emi_total_payable - emi_principal).toLocaleString('en-IN'));
    $(".emi_total_payable").html("&#8377; " + (emi_total_payable).toLocaleString('en-IN'));
    updateData1();
}

const data1 = {
    labels: ['Payable Amount'],
    datasets: [{
        data: [20, 80],
        backgroundColor: ['#4463ad', '#e9e9e9'],
    }],
};

const ctx1 = document.getElementById('doughnutChart_1').getContext('2d');
const doughnutChart1 = new Chart(ctx1, {
    type: 'doughnut',
    data: data1,
    options: options,
});
function updateData1() {
    var newData = {
        datasets: [{
            data: [Math.round(emi_total_payable - emi_principal), Math.round(emi_total_payable)],
            backgroundColor: ['#4463ad', '#e9e9e9']
        }]
    };

    // Update chart data and redraw
    doughnutChart1.data = newData;
    doughnutChart1.update('none');
}
$("#principal").on('input', function () {
    $("#principal_text").val($(this).val());
    principal = parseFloat($(this).val());
    flatVsReducing();
});
$("#principal_text").on('input', function () {
    if ($(this).val() > 10000000) {
        $(this).val(10000000);
    }
    $("#principal").val($(this).val());
    principal = parseFloat($(this).val());
    flatVsReducing();
});
$("#duration").on('input', function () {
    $("#duration_text").val($(this).val());
    duration = parseInt($(this).val());
    flatVsReducing();
});

$("#duration_text").on('input', function () {
    if ($(this).val() > 90) {
        $(this).val(90);
    }
    $("#duration").val($(this).val());
    duration = parseInt($(this).val());
    flatVsReducing();
});
$("#flat_rate").on('input', function () {
    $("#flat_rate_text").val($(this).val());
    flat_rate = parseFloat($(this).val());
    flatVsReducing();
});

$("#flat_rate_text").on('input', function () {
    if ($(this).val() > 32) {
        $(this).val(32);
    }
    $("#flat_rate").val($(this).val());
    flat_rate = parseFloat($(this).val());
    flatVsReducing();
});
$("#reducing_rate").on('input', function () {
    $("#reducing_rate_text").val($(this).val());
    reducing_rate = parseFloat($(this).val());
    flatVsReducing();
});

$("#reducing_rate_text").on('input', function () {
    if ($(this).val() > 32) {
        $(this).val(32);
    }
    $("#reducing_rate").val($(this).val());
    reducing_rate = parseFloat($(this).val());
    flatVsReducing();
});
function flatVsReducing() {
    $(".principal_amount").html("&#8377; " + principal);
    // Convert annual interest rate to monthly rate
    let reducingMonthlyInterestRate = (reducing_rate / 12) / 100;
    // Calculate EMI using the formula
    let reducing_emi = (principal * reducingMonthlyInterestRate) / (1 - Math.pow(1 + reducingMonthlyInterestRate, - duration));
    $("#reducing_emi").html("&#8377; " + Math.round(reducing_emi).toLocaleString('en-IN'));
    let reducing_total_payable = Math.round(reducing_emi) * duration;
    $("#reducing_interest").html("&#8377; " + Math.round(reducing_total_payable - principal).toLocaleString('en-IN'));


    let flatMonthlyInterestRate = (flat_rate / 12) / 100;
    // Calculate total interest
    let flatEMI = Math.round((principal + (principal * flatMonthlyInterestRate * duration)) / duration);

    let totalInterest = (flatEMI * duration - principal);
    // Calculate total amount payable
    let totalAmountPayable = flatEMI * duration;
    // Calculate flat EMI
    $("#flat_emi").html("&#8377; " + Math.round(flatEMI).toLocaleString('en-IN'));
    $("#flat_interest").html("&#8377; " + Math.round(totalInterest).toLocaleString('en-IN'));
    if ((totalAmountPayable - reducing_total_payable) > 0) {
        $("#pay_diff1").html(Math.abs(totalAmountPayable - reducing_total_payable).toFixed(2).toLocaleString('en-IN') + " more");
        $("#pay_diff1").parent().addClass('text-danger').removeClass('text-success');
        $("#pay_diff2").html(Math.abs(totalAmountPayable - reducing_total_payable).toFixed(2).toLocaleString('en-IN') + " less").parent().addClass('text-success').removeClass('text-danger');
    } else {
        $("#pay_diff1").html(Math.abs(totalAmountPayable - reducing_total_payable).toFixed(2).toLocaleString('en-IN') + " less").parent().addClass('text-success').removeClass('text-danger');
        $("#pay_diff2").html(Math.abs(totalAmountPayable - reducing_total_payable).toFixed(2).toLocaleString('en-IN') + " more").parent().addClass('text-danger').removeClass('text-success');
    }
    $("#reducing_interest_rate2").html(reducing_rate.toLocaleString('en-IN'));
    $("#flat_interest_rate1").html(flat_rate.toLocaleString('en-IN'));
    //$("#reducing_interest_rate1").html(reducing_rate);
    $("#flat_interest_rate2").html(calculateFlatEMIRate(principal, duration, reducing_total_payable - principal).toLocaleString('en-IN'));
    $("#reducing_interest_rate1").html(calculateReducingEMIRate(duration, flatEMI, principal).toLocaleString('en-IN'));
}

// Function to calculate Flat EMI Interest Rate
function calculateFlatEMIRate(principal, tenureMonths, totalInterest) {
    let rate = (totalInterest / tenureMonths) * 1200 / principal;
    return rate.toFixed(2); // Convert to annual rate
}
// Function to calculate Reducing EMI Interest Rate
function calculateReducingEMIRate(duration, payment, principal)
{
    // make an initial guess
    var error = 0.0000001; 
    var high = 1.00; 
    var low = 0.00;
    var rate = (2.0 * (duration * payment - principal)) / (principal * duration);

    while(true) {
        // check for error margin
        var calc = Math.pow(1 + rate, duration);
        calc = (rate * calc) / (calc - 1.0);
        calc -= payment / principal;

        if (calc > error) {
            // guess too high, lower the guess
            high = rate;
            rate = (high + low) / 2;
        } else if (calc < -error) {
            // guess too low, higher the guess
            low = rate;
            rate = (high + low) / 2;
        } else {
            // acceptable guess
            break;
        }
    }

    return (rate * 12* 100).toFixed(2);
}


