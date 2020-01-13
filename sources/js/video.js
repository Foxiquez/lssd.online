document.getElementById("more-btn").addEventListener("click", function(event){
	event.preventDefault()
});
	setTimeout(function () {document.getElementById('video-first').play() }, 2500)
	setTimeout(function () {document.getElementById('video-first').play() }, 3500)
		document.getElementById('video-first').onended = function() {
			document.getElementById("video-first").style.display = "none"
			document.getElementById("video-second").style.display = "block"
			document.getElementById('video-second').play()
		}
		document.getElementById('video-second').onended = function() {
			document.getElementById("video-second").style.display = "none"
			document.getElementById("video-third").style.display = "block"
			document.getElementById('video-third').play()
		}
		document.getElementById('video-third').onended = function() {
			document.getElementById("video-third").style.display = "none"
			document.getElementById("video-first").style.display = "block"
			document.getElementById('video-first').play()
}
function down(event) {
	document.getElementById("more-btn").addEventListener("click", function(event){
		event.preventDefault()
	});
	h = document.getElementById("header").clientHeight + document.getElementById("video-container").clientHeight + 1475
	$("body,html").animate({scrollTop: h}, 1750);
}