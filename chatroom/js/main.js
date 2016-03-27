//alert("Hello JavaScript");
var j = 5;
var messages = document.querySelector("div");
//Messages.innerHTML == "";
console.log("This is how we are going to degub JavaScript");
console.info("This is information");
//console.debug("This is debug info");
console.debug("page:", window.location.href);
//console.error("This is error");

var source = new EventSource("http://push.koodur.com/ev/chatroom")

source.onmessage = function(event) {
console.log("Received server-sent event:", event.data);
document.querySelector("div").innerHTML += "<br/>" + event.data;
}
//function somename(event) {
//}
//source.onmessage = somename;

function sendMessage() {
	console.log("About to send stuff");
	var request = new XMLHttpRequest();
	request.open('POST', 'http://push.koodur.com/pub?id=chatroom', true);


	request.send(document.querySelector("#name").value + ": " + document.querySelector("#msg").value);
}
