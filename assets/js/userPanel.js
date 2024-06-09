console.log("User Panel is Running");

const panel_bid = document.querySelector('.panel-bid');
const panel_pay = document.querySelector('.panel-pay');
const panel_sell = document.querySelector('.panel-sell');


panel_bid.addEventListener('click', function(){
    swal("Bidding details .", "", "");
    window.location.href = 'bidDetails.php';
})

panel_pay.addEventListener('click', function(){
    swal("Bidding section", "", "");
})

panel_sell.addEventListener('click', function(){
    // console.log("clicked");
    swal("Bidding section", "", "");
    window.location.href = 'sell.php';
})