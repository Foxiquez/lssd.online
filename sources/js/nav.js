var Navigation = false;

document.getElementById("backtop").addEventListener("click", function(event){
	event.preventDefault()
});

function up(event) {
	c = document.body.clientHeight + document.getElementById("backtop").clientHeight;
	$("body,html").animate({scrollTop: 0}, 1750);
}

function Menu() {
	var xhr = new XMLHttpRequest()
				xhr.open(
				  'GET',
				  '/debug?changemenuview',
				  true
				)
			xhr.send()

			xhr.onreadystatechange = function() {
			  if (xhr.readyState != 4) {
				return
			  }
			  location.reload()
			}
}

function Nav() {
	if (Navigation == false) {
		Navigation = true;
		for (var i = 0; i < document.getElementsByClassName("menu-item").length; i++) {
			document.getElementsByClassName("menu-item")[i].style.display = "block";
		}
		document.getElementsByClassName('title-container')[0].style.top = '40%';
	}
	else {
		Navigation = false;
		for (var i = 0; i < document.getElementsByClassName("menu-item").length; i++) {
			document.getElementsByClassName("menu-item")[i].style.display = "none";
		}
		document.getElementsByClassName('title-container')[0].style.top = '20%';
	}
}