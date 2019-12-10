var cost_sum;
var slotid;

function pageLoad() {
	document.getElementById("choice").innerHTML = 0;
	document.getElementById("cost").innerHTML = '0.00';
	slotid = document.getElementById("infoli").innerHTML;
}

function seatClick() {
	var boxes = document.querySelectorAll('input[type = "checkbox"]:checked');
	console.log(boxes);
	var order = document.getElementById('add');
	if (boxes.length) {
		order.removeAttribute('disabled');
		var price = document.getElementById("ticket_price").innerHTML;
		var count = boxes.length;
		if (count) {
			var sum = count * price;
			cost_sum = sum.toFixed(2);
		}
		else {
			sum = 0;
			cost_sum = sum.toFixed(2);
		}

		var res = Array.from(boxes);
		var seats_chosen = '';
		for (i = 0; i < res.length; i++) {
			seats_chosen = seats_chosen + ',  ' + res[i].value;
		}
		seats_chosen = seats_chosen.substring(1);
		document.getElementById("choice").innerHTML = seats_chosen;
		document.getElementById("cost").innerHTML = cost_sum;
	}
	else {
		order.setAttribute('disabled', 'disabled');
	}
}

function add() {
	var boxes = document.querySelectorAll('input[type = "checkbox"]:checked');
	var res = Array.from(boxes);
	var seats_chosen = [];
	for (i = 0; i < res.length; i++) {
		seats_chosen[i] = res[i].value;
	}
	window.location.href = "index.php?seat=" + seats_chosen + "&cost_sum=" +cost_sum + "&slotid=" + slotid;
}

function confirm(){
	var boxes = document.querySelectorAll('input[type = "checkbox"]:checked');
	var res = Array.from(boxes);
	var seats_chosen = [];
	for (i = 0; i < res.length; i++) {
		seats_chosen[i] = res[i].value;
	}
	window.location.href = "index.php?seats_chosen=" + seats_chosen + "&slotid=" + slotid;
}