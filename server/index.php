<?php ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>	<header id="header">
		<div style="padding: 2px; background-color: #E7B467;"></div>
			<div class="header-wrapper">
				<div class="container">
				   <div class="pull-left">
						<a href="/">
							<img src="sources/img/lasd-logo.png" class="lasd-logo">
						</a>
				   </div>    
				   <div class="header-right">
						<a href="#" class="header-bio">
							<img src="sources/img/kazah.png" class="pic">
							<div class="header-bio-text">
								<span class="title">Sheriff</span>
								<span class="name">Sherry<br>Wilson</span><br>
							</div>
						</a>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-inverse">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Отключить навигацию</span>
							<span class="icon-bar top-bar"></span>
							<span class="icon-bar middle-bar"></span>
							<span class="icon-bar bottom-bar"></span>
							<span class="menu-bar">Меню</span>
						</button>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<center>
							<ul class="nav navbar-nav"><?php
								if (($URL == '/ucp' or $URL == '/dispatch') and isset($_SESSION['loggedIN'])) {?>
								<li>
									<a href=" <?php echo "http://$exist_url"; ?> class="hvr-fade">К обратному виду</a>
								</li>
								<li>
									<a href="http://ls-sd.online/forum/viewtopic.php?f=18&t=1" target="_blank" class="hvr-fade">Работа с новостной лентой</a>                           
								</li>
								<li>
									<a href="/dispatch" class="hvr-fade">Диспетчерская</a>                           
								</li>
								<li>
									<a href="http://ls-sd.online/forum/viewforum.php?f=19" target="_blank" class="hvr-fade">Работа с базой</a>
								</li><?php } ?>
								<li>
									<a href="/" class="hvr-fade">Домашняя страница</a>
								</li>
								<li>
									<a href="http://ls-sd.online/forum/viewforum.php?f=19" class="hvr-fade">Новостная лента</a>
								</li>
								<li>
									<a href="/aboutus" class="hvr-fade">Информация о нас</a>                           
								</li>
								<li>
									<a href="/forum" class="hvr-fade">Форум сообщества</a>                           
								</li>
								<li>
									<a href="/request" class="hvr-fade">Обратная связь</a>
								</li>
								 <?php if (isset($_SESSION['loggedIN'])) { echo "<li><a href='/ucp' class='hvr-fade'>$name</a></li>"; }?>
							</ul>
						</center>
					</div>
				</div>
			</nav>
    </header>	
	<section class="nopadding nomargin">
		<canvas onmousemove="saveCoords(event.pageX,event.pageY)" id="canvas" width="1349" height="976.77">Перезагрузите страницу...</canvas>
		<style>#canvas{width:100%;height:auto;}</style> 
	</section>
	<script type="text/javascript">
		globalX = 0;
		globalY = 0;
		var canvas = document.getElementById("canvas");
		if (canvas.getContext){
			var ctx = canvas.getContext("2d")
			var img = new Image()
			img.src = "../sources/img/rc&ls.png"
			ctx.drawImage(img,0,0,1349,976.77)
		}
		function map () {						
			setTimeout(function () {    
								
				ctx.drawImage(img,0,0,1349,976.77)

				w = document.getElementById("canvas").clientWidth
				h = document.getElementById("canvas").clientHeight
				hHeader = document.getElementById("header").clientHeight

			var xhr = new XMLHttpRequest()
			xhr.open(
			  'GET',
			  'log.txt',
			  true
			)
			xhr.send()

			xhr.onreadystatechange = function() {
			  if (xhr.readyState != 4) {
				return
			  }

				  if (xhr.status === 200) {
					var Response = xhr.responseText
						document.getElementById("log").innerHTML = Response;
					}
					
				  }
					
				$.getJSON("tmp.json", (responseJson) => { 
					document.getElementById("patrol").innerHTML = ""
					for (let p in responseJson) { 
						responseJson[p] = JSON.parse(responseJson[p]); 
					if (responseJson[p].driver != "null" && responseJson[p].driver != null){
								responseJson[p].driver = responseJson[p].driver.replace(/_/g, " ")
								if (responseJson[p].passanger != "N/A"){
									responseJson[p].passanger = responseJson[p].passanger.replace(/_/g, " ")
									if (responseJson[p].code3 == "null"){
										document.getElementById("patrol").innerHTML = document.getElementById("patrol").innerHTML + "<span class=unit id=" + responseJson[p].mark + ">&nbsp[" + responseJson[p].mark + "][" + responseJson[p].ip + "] " + responseJson[p].driver + " & " + responseJson[p].passanger + "</span><br>"
									}
									else document.getElementById("patrol").innerHTML = document.getElementById("patrol").innerHTML + "<span class=unit id=" + responseJson[p].mark + ">&nbsp[" + responseJson[p].mark + "][" + responseJson[p].ip + "] " + responseJson[p].driver + " & " + responseJson[p].passanger + " [CODE-3]</span><br>"
								}
								else {
									if (responseJson[p].code3 == "null"){
									document.getElementById("patrol").innerHTML = document.getElementById("patrol").innerHTML + "<span class=unit id=" + responseJson[p].mark + ">&nbsp[" + responseJson[p].mark + "][" + responseJson[p].ip + "] " + responseJson[p].driver + "</span><br>"
									}
									else document.getElementById("patrol").innerHTML = document.getElementById("patrol").innerHTML + "<span class=unit id=" + responseJson[p].mark + ">&nbsp[" + responseJson[p].mark + "][" + responseJson[p].ip + "] " + responseJson[p].driver + " [CODE-3]</span><br>" 
								}
								if (responseJson[p].type == "patrol"){
									ctx.fillStyle = "rgb(0,255,0)";
								}
								if (responseJson[p].type == "seb"){
									ctx.fillStyle = "rgb(200,0,0)";
								}
								else if (responseJson[p].type == "aero"){
									ctx.fillStyle = "rgb(0,0,200)";
								}
								else if (responseJson[p].type == "iid"){
									ctx.fillStyle = "rgb(255, 192, 203)";
								}
								else if (responseJson[p].type == "det"){
									ctx.fillStyle = "rgb(255,128,200)";
								}
								
								var realProcX = ((Number(responseJson[p].x)+1090)*100)/4006
								var numberMapX = ((1349*realProcX)/100)-22
								
								var realProcY = (responseJson[p].y*100)/3573
								var numberMapY = ((((976.77*realProcY)/100)*-1)+168)
								
								var procW = (numberMapX*100)/1349
								var procH = (numberMapY*100)/976
								
								var endW = (w*procW)/100
								var endH = (h*procH)/100
								
								ctx.fillRect (numberMapX, numberMapY, 7.5, 7.5)
										if (responseJson[p].code3 != "null"){
											setTimeout(function () {    
												ctx.fillStyle = "rgb(0,0,200)"
												ctx.fillRect (numberMapX, numberMapY, 7.5, 7.5)
											}, 500)
										}
								
								x=document.documentElement.clientWidth
								y=document.documentElement.clientHeight
								
								if ( ((globalX > endW) && (globalX < endW+7.5)) && ((globalY-hHeader > endH) && (globalY-hHeader < endH+7.5)) ){
									document.getElementById(responseJson[p].mark).style.color = "rgb(195, 27, 41)"
								}
								else { document.getElementById(responseJson[p].mark).style.color = "#333;" }
							}
				}});                          
			 map();                             
			}, 1000)
		}	map(); 
		function saveCoords(x,y){
		globalX = x;
		globalY = y;
		}
	</script>
	
    <section class="top-section">
            <div class="container">
            
            <div class="row">
                <div class="col-sm-6 col-xs-6 top-section-col">
                    <div class="cat-item">
                        <div class="overlay-wrapper">
						<br><br><br>44
                            <div class="overlay">
                                <div class="overlay-btn hvr-fade"><span>Список действующих диспетчеров</span></div>
                            </div>
                        </div>
                    </div>
                </div>
				
                <div class="col-sm-6 col-xs-6 top-section-col">
                    <a href="#" class="cat-item">
                        <div class="overlay-wrapper"><br><br><br>
							<span id="patrol"></span>
                            <div class="overlay">
                                <div class="overlay-btn hvr-fade"><span>Список патрульных</span></div>
                            </div>
                        </div>
                    </a>
                </div>
				
                <div class="col-sm-6 col-xs-6 top-section-col" style="width:100%">
                    <a href="#" class="cat-item">
                        <div class="overlay-wrapper"><br><br><br>
							<span id="log"></span>
                            <div class="overlay">
                                <div class="overlay-btn hvr-fade"><span>Лог действий</span></div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
	<style>
	@media (min-width: 992px) .col-md-3 {widht:100%}
	.hvr-fade {width:100%}
	.cat-item:hover .overlay{background-color:initial}
	.unit:hover {text-decoration: none;}
	</style>
            
        
        </div>
        
    </section>
	<script src="../sources/jquery.js"></script>