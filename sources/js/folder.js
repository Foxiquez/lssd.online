						var property = true;
						var susps = 1;
						var witness = 1;
						var victim = 1;
						var investigators = 2;
						function generate() {
							document.getElementById("form").style.display = "none";
							document.getElementById("code").style.display = "";
							document.getElementById("btn").style.display = "";
							var xhr = new XMLHttpRequest()
							xhr.open(
							  'GET',
							  '/sources/forms/folder-dvr.bbcode',
							  true
							)
							xhr.send()
							xhr.onreadystatechange = function() {
							  if (xhr.readyState != 4) {
								return
							  }

								  if (xhr.status === 200) {
									var Response = xhr.responseText
									
									var Suspect = '[divbox=#BBBBBB][imgalign=Right]<URL-IMG>[/imgalign][b]СТАТУС:[/b] [color=#FF0000][u]ПОДОЗРЕВАЕМЫЙ[/u][/color].\n[b]КОПИЯ ЛИЧНОГО ДЕЛА:[/b] [url=<URL>]<BADGE-NUMBER>[/url].\n\n[b]ИМЯ:[/b] <NAME>\n[b]ФАМИЛИЯ:[/b] <SURNAME>\n[b]ЗВАНИЕ:[/b] <RANK>\n[b]ДОЛЖНОСТЬ:[/b] <POSITION>\n\n[b]ДЕЙСТВУЮЩИЙ АДРЕС:[/b] <ADRESS>\n[b]НОМЕР ТЕЛЕФОНА:[/b] <NUMBER>[/divbox] \n[hr][/hr]';
									var Victim = '\n[divbox=#BBBBBB][imgalign=Right]<URL-IMG>[/imgalign][b]СТАТУС:[/b]  [color=#00BF00][u]ПОТЕРПЕВШИЙ[/u][/color].\n[b]КОПИЯ ЛИЧНОГО ДЕЛА:[/b] [url=<URL>]<BADGE-NUMBER>[/url].\n\n[b]ИМЯ:[/b] <NAME>\n[b]ФАМИЛИЯ:[/b] <SURNAME>\n[b]ЗВАНИЕ:[/b] <RANK>\n[b]ДОЛЖНОСТЬ:[/b] <POSITION>\n\n[b]ДЕЙСТВУЮЩИЙ АДРЕС:[/b] <ADRESS>\n[b]НОМЕР ТЕЛЕФОНА:[/b] <NUMBER>[/divbox]\n[hr][/hr]';
									var WitnessFinal = '\n[divbox=#BBBBBB][imgalign=Right]<URL-IMG>[/imgalign][b]СТАТУС:[/b] [color=#FF8000] [u]СВИДЕТЕЛЬ[/u][/color].\n[b]КОПИЯ ЛИЧНОГО ДЕЛА:[/b] [url=<URL>]<BADGE-NUMBER>[/url].\n\n[b]ИМЯ:[/b] <NAME>\n[b]ФАМИЛИЯ:[/b] <SURNAME>\n[b]ЗВАНИЕ:[/b] <RANK>\n[b]ДОЛЖНОСТЬ:[/b] <POSITION>\n\n[b]ДЕЙСТВУЮЩИЙ АДРЕС:[/b] <ADRESS>\n[b]НОМЕР ТЕЛЕФОНА:[/b] <NUMBER>[/divbox]\n[hr][/hr]';
									
									var propertyF = '\n[center][b]ИМУЩЕСТВО[/b][/center]\n\n[divbox=#BBBBBB][b]МОДЕЛЬ[/b]: <MODEL-NAME>\n[b]НОМЕР[/b]: <NUMBER>\n[b]ВЛАДЕЛЕЦ[/b]: <OWNER>\n[b]ЦВЕТ[/b]: <COLOR>[/divbox]\n';
									
										Response = Response.replace("<HEADER-NUMBER>",document.getElementById("number").value)
										Response = Response.replace("<HEADER-TITLE>",document.getElementById("title").value)
										
										var codeSusps = susps;
										var finalSuspsHeader = "[color=#FF0040]" + document.getElementById("susp-name-1").value + " " + document.getElementById("susp-surname-1").value + "[/color]";
										var Susp = Suspect;	
											if (document.getElementById("susp-photo-url-1").value != "" ) {
												Susp = Susp.replace("<URL-IMG>",document.getElementById("susp-photo-url-1").value)
											}
											else {
												Susp = Susp.replace("<URL-IMG>","https://i.imgur.com/OUaPj2o.png")
											}
											Susp = Susp.replace("<URL>",document.getElementById("susp-badge-url-1").value)
											Susp = Susp.replace("<BADGE-NUMBER>",document.getElementById("susp-badge-1").value)
											Susp = Susp.replace("<NAME>",document.getElementById("susp-name-1").value)
											Susp = Susp.replace("<SURNAME>",document.getElementById("susp-surname-1").value)
											Susp = Susp.replace("<RANK>",document.getElementById("susp-rank-1").value)
											Susp = Susp.replace("<POSITION>",document.getElementById("susp-position-1").value)
											Susp = Susp.replace("<ADRESS>",document.getElementById("susp-adress-1").value)
											Susp = Susp.replace("<NUMBER>",document.getElementById("susp-number-1").value)
										var finalSusps = Susp;
										while (codeSusps != 0) {
											if (codeSusps != 1) {
											finalSuspsHeader = finalSuspsHeader + ", [color=#FF0040]" + document.getElementById("susp-name-" + codeSusps).value + " " + document.getElementById("susp-surname-" + codeSusps).value + "[/color]";
												var Susp = Suspect;	
												if (document.getElementById("susp-photo-url-" + codeSusps).value != "" ) {
													Susp = Susp.replace("<URL-IMG>",document.getElementById("susp-photo-url-" + codeSusps).value)
												}
												else {
													Susp = Susp.replace("<URL-IMG>","https://i.imgur.com/OUaPj2o.png")
												}
												Susp = Susp.replace("<URL>",document.getElementById("susp-badge-url-" + codeSusps).value)
												Susp = Susp.replace("<BADGE-NUMBER>",document.getElementById("susp-badge-" + codeSusps).value)
												Susp = Susp.replace("<NAME>",document.getElementById("susp-name-" + codeSusps).value)
												Susp = Susp.replace("<SURNAME>",document.getElementById("susp-surname-" + codeSusps).value)
												Susp = Susp.replace("<RANK>",document.getElementById("susp-rank-" + codeSusps).value)
												Susp = Susp.replace("<POSITION>",document.getElementById("susp-position-" + codeSusps).value)
												Susp = Susp.replace("<ADRESS>",document.getElementById("susp-adress-" + codeSusps).value)
												Susp = Susp.replace("<NUMBER>",document.getElementById("susp-number-" + codeSusps).value)
												var finalSusps = Susp + finalSusps;
											}
											codeSusps = codeSusps-1;
										}
										Response = Response.replace("<SECTION-SUSPS(ARRAY)>",finalSusps)
										Response = Response.replace("<HEADER-TITLE-SUSPS(ARRAY)>",finalSuspsHeader)
										
										var codeWitness = witness;
										var finalWitnessHeader = "";
										var finalWitness = "";
										while (codeWitness != 0) {
											finalWitnessHeader = finalWitnessHeader + ", [color=#FF8000]" + document.getElementById("witness-name-" + codeWitness).value + " " + document.getElementById("witness-surname-" + codeWitness).value + "[/color]";
													var Witn = WitnessFinal;	
													if (document.getElementById("witness-photo-url-" + codeWitness).value != "" ) {
														Witn = Witn.replace("<URL-IMG>",document.getElementById("witness-photo-url-" + codeWitness).value)
													}
													else {
														Witn = Witn.replace("<URL-IMG>","https://i.imgur.com/OUaPj2o.png")
													}
													Witn = Witn.replace("<URL>",document.getElementById("witness-badge-url-" + codeWitness).value)
													Witn = Witn.replace("<BADGE-NUMBER>",document.getElementById("witness-badge-" + codeWitness).value)
													Witn = Witn.replace("<NAME>",document.getElementById("witness-name-" + codeWitness).value)
													Witn = Witn.replace("<SURNAME>",document.getElementById("witness-surname-" + codeWitness).value)
													Witn = Witn.replace("<RANK>",document.getElementById("witness-rank-" + codeWitness).value)
													Witn = Witn.replace("<POSITION>",document.getElementById("witness-position-" + codeWitness).value)
													Witn = Witn.replace("<ADRESS>",document.getElementById("witness-adress-" + codeWitness).value)
													Witn = Witn.replace("<NUMBER>",document.getElementById("witness-number-" + codeWitness).value)
													var finalWitness = Witn + finalWitness;
											codeWitness = codeWitness-1;
										}
										Response = Response.replace("<SECTION-WITNESS(ARRAY)>",finalWitness)
										Response = Response.replace("<HEADER-TITLE-WITNESS(ARRAY)>",finalWitnessHeader)
										document.getElementById("final-code").innerHTML = Response;
										
										var codeVictim = victim;
										var finalVictimHeader = "";
										var finalVictim = "";
										while (codeVictim != 0) {
											finalVictimHeader = finalVictimHeader + ", [color=#00BF00]" + document.getElementById("victim-name-" + codeVictim).value + " " + document.getElementById("victim-surname-" + codeVictim).value + "[/color]";
													var Vict = Victim;	
													if (document.getElementById("victim-photo-url-" + codeVictim).value != "" ) {
														Vict = Vict.replace("<URL-IMG>",document.getElementById("victim-photo-url-" + codeVictim).value)
													}
													else {
														Vict = Vict.replace("<URL-IMG>","https://i.imgur.com/OUaPj2o.png")
													}
													Vict = Vict.replace("<URL>",document.getElementById("victim-badge-url-" + codeVictim).value)
													Vict = Vict.replace("<BADGE-NUMBER>",document.getElementById("victim-badge-" + codeVictim).value)
													Vict = Vict.replace("<NAME>",document.getElementById("victim-name-" + codeVictim).value)
													Vict = Vict.replace("<SURNAME>",document.getElementById("victim-surname-" + codeVictim).value)
													Vict = Vict.replace("<RANK>",document.getElementById("victim-rank-" + codeVictim).value)
													Vict = Vict.replace("<POSITION>",document.getElementById("victim-position-" + codeVictim).value)
													Vict = Vict.replace("<ADRESS>",document.getElementById("victim-adress-" + codeVictim).value)
													Vict = Vict.replace("<NUMBER>",document.getElementById("victim-number-" + codeVictim).value)
													var finalVictim = Vict + finalVictim;
											codeVictim = codeVictim-1;
										}
										Response = Response.replace("<SECTION-VICTIM(ARRAY)>",finalVictim)
										Response = Response.replace("<HEADER-TITLE-VICTIMS(ARRAY)>",finalVictimHeader)
										
										Response = Response.replace("<HEADER-OPEN-DATE>",document.getElementById("open-date").value)
										
										var invests = 1;
										var finalInvestigators = "";
										while (invests <= investigators) {
											finalInvestigators = finalInvestigators + "[*]" + document.getElementById("invest-" + invests).value;
											invests = invests+1;
										}
										Response = Response.replace("<HEADER-INVESTIGATORS(ARRAY)>",finalInvestigators)
										
										Response = Response.replace("<SECTION-INCEDENT-DATE>",document.getElementById("incedent-date").value)
										Response = Response.replace("<SECTION-INCEDENT-TIME>",document.getElementById("incedent-time").value)
										Response = Response.replace("<SECTION-INCEDENT-REPORT>",document.getElementById("incedent-text").value)
										
										if (property == true) {
											propertyF = propertyF.replace("<MODEL-NAME>",document.getElementById("model").value)
											propertyF = propertyF.replace("<NUMBER>",document.getElementById("car-number").value)
											propertyF = propertyF.replace("<OWNER>",document.getElementById("owner").value)
											propertyF = propertyF.replace("<COLOR>",document.getElementById("owner").value)
											Response = Response.replace("<SECTION-PROPERTY>",propertyF)
										} 
										else {
											Response = Response.replace("<SECTION-PROPERTY>","")
										}
										
										if (document.getElementById("add-one").value != "" || document.getElementById("add-two").value != "" ||  document.getElementById("add-three").value != "") {
											Response = Response.replace("<ADD-TITLE>","[center][b]ВЛОЖЕНИЯ[/b][/center]\n\n");
											if (document.getElementById("add-one").value != ""){
												Response = Response.replace("<ADD-ONE>",'[spoiler="ОСМОТР МЕСТА ПРОИСШЕСТВИЯ"]' + document.getElementById("add-one").value + '[/spoiler]\n\n');
											}
											else { Response = Response.replace("<ADD-ONE>",""); }
											if (document.getElementById("add-two").value != ""){
												Response = Response.replace("<ADD-TWO>",'[spoiler="ЗАКЛЮЧЕНИЕ ЭКСПЕРТИЗ"]' + document.getElementById("add-two").value + '[/spoiler]\n\n');
											}
											else { Response = Response.replace("<ADD-TWO>",""); }
											if (document.getElementById("add-three").value != ""){
												Response = Response.replace("<ADD-THREE>",'[spoiler="СТЕНОГРАММА ДОПРОСА ПОТЕРПЕВШЕГО/СВИДЕТЕЛЯ/ПОДОЗРЕВАЕМОГО"]' + document.getElementById("add-three").value + '[/spoiler]\n');
											}
											else { Response = Response.replace("<ADD-THREE>",""); }
										}
										else { 
											Response = Response.replace("<ADD-TITLE>","");
											Response = Response.replace("<ADD-ONE>","");
											Response = Response.replace("<ADD-TWO>","");
											Response = Response.replace("<ADD-THREE>","");
										}
										
											Response = Response.replace("<LAST-DATE>",document.getElementById("last-date").value);
											Response = Response.replace("<LAST-INVEST>",document.getElementById("last-invest").value);
										
										document.getElementById("final-code").innerHTML = Response;
										}
									}
						}
						function back() {
							document.getElementById("form").style.display = "";
							document.getElementById("code").style.display = "none";
							document.getElementById("btn").style.display = "none";
						}
						function addInvestigator() {
							investigators = investigators+1;
							document.getElementById("investigators-area").innerHTML = document.getElementById("investigators-area").innerHTML + '<span id="investigator-' + investigators + '"><li><input style="width:225px;height:18px;" id="invest-' + investigators + '" placeholder="INVESTIGATOR NAME SURNAME"></input></li></span> ';
						}
						function dellInvestigator() {
							if (investigators > 1) {
							document.getElementById("investigator-" + investigators).parentNode.removeChild(document.getElementById("investigator-" + investigators));
							investigators = investigators-1;
							}
						}
						function changePhotoSusp(n) {
							document.getElementById("susp-photo-" + n).src = document.getElementById("susp-photo-url-" + n).value;
						}
						function changePhotoWitness(n) {
							document.getElementById("witness-photo-" + n).src = document.getElementById("witness-photo-url-" + n).value;
						}
						function changePhotoVictim(n) {
							document.getElementById("victim-photo-" + n).src = document.getElementById("victim-photo-url-" + n).value;
						}
						function changeProperty() {
							if (property == true){
								document.getElementsByClassName("property-area")[0].style.display = "none";	
								document.getElementsByClassName("property-area")[1].style.display = "none";	
								document.getElementById("property").value = "Добавить имущество";	
								property = false;
							}
							else {
								document.getElementsByClassName("property-area")[0].style.display = "";	
								document.getElementsByClassName("property-area")[1].style.display = "";	
								document.getElementById("property").value = "Убрать имущество";	
								property = true;
							}
						}
						function addSusp(){
							susps = susps+1;
							document.getElementById("susp-head-area").innerHTML = document.getElementById("susp-head-area").innerHTML + '<span id="susp-head-' + susps + '">, <span style="color: #FF0040"><span id="susp-head-name-' + susps + '">NAME</span> <span id="susp-head-surname-' + susps + '">SURNAME</span></span></span>';
							document.getElementById("susp-area").innerHTML = document.getElementById("susp-area").innerHTML + '<span id="susp-' + susps +'"><div style="background-color:#BBBBBB; border:1px solid black; margin:10px 10px; padding-left: 5px; padding-right: 5px;"><img src="https://i.imgur.com/OUaPj2o.png" id="susp-photo-' + susps +'" style="float: Right;margin: 10px 10px 10px 10px"><span style="font-weight: bold">СТАТУС:</span> <span style="color: #FF0000"><span style="text-decoration: underline">ПОДОЗРЕВАЕМЫЙ</span></span>.<br><span style="font-weight: bold">КОПИЯ ЛИЧНОГО ДЕЛА:</span> <input placeholder="http://URL" id="susp-badge-url-' + susps +'" style="height:18px;width:70px;"></input><input id="susp-badge-' + susps +'" placeholder="BADGE NUMBER" style="height:18px;width:120px;"></input><input onkeyup="changePhotoSusp(' + susps +')" id="susp-photo-url-' + susps +'" placeholder="URL ФОТО" style="height:18px;width:120px;"></input>.<br><br><span style="font-weight: bold">ИМЯ:</span> <input onkeyup="setSuspName(' + susps + ')" id="susp-name-' + susps +'" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">ФАМИЛИЯ:</span> <input onkeyup="setSuspSurname(' + susps + ')" id="susp-surname-' + susps +'" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">ЗВАНИЕ:</span> <input id="susp-rank-' + susps +'" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">ДОЛЖНОСТЬ:</span> <input id="susp-position-' + susps +'" placeholder="TEXT" style="width:40px;height:17px;"></input><br><br><span style="font-weight: bold">ДЕЙСТВУЮЩИЙ АДРЕС:</span> <input id="susp-adress-' + susps +'" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">НОМЕР ТЕЛЕФОНА:</span> <input id="susp-number-' + susps +'" placeholder="TEXT" style="width:40px;height:17px;"></input></div><br><hr><br><br></span>';
						}
						function addVictim(){
							victim = victim+1;
							document.getElementById("victim-head-area").innerHTML = document.getElementById("victim-head-area").innerHTML + '<span id="victim-head-' + victim + '">, <span style="color: #00BF00"><span id="victim-head-name-' + victim + '">NAME</span> <span id="victim-head-surname-' + victim + '">SURNAME</span></span></span>';
							document.getElementById("victim-area").innerHTML = document.getElementById("victim-area").innerHTML + '<span id="victim-' + victim + '"><div style="background-color:#BBBBBB; border:1px solid black; margin:10px 10px; padding-left: 5px; padding-right: 5px;"><img src="https://i.imgur.com/OUaPj2o.png" id="victim-photo-' + victim + '" style="float: Right;margin: 10px 10px 10px 10px"><span style="font-weight: bold">СТАТУС:</span> <span style="color: #00BF00"><span style="text-decoration: underline">ПОТЕРПЕВШИЙ</span></span>.<br><span style="font-weight: bold">КОПИЯ ЛИЧНОГО ДЕЛА:</span> <input placeholder="http://URL" id="victim-badge-url-' + victim + '" style="height:18px;width:70px;"><input id="victim-badge-' + victim + '" placeholder="BADGE NUMBER" style="height:18px;width:120px;"><input onkeyup="changePhotoVictim(' + victim + ')" id="victim-photo-url-' + victim + '" placeholder="URL ФОТО" style="height:18px;width:120px;"></input>.<br><br><span style="font-weight: bold">ИМЯ:</span> <input onkeyup="setVictimName(' + victim + ')" id="victim-name-' + victim + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">ФАМИЛИЯ:</span> <input onkeyup="setVictimSurname(' + victim + ')" id="victim-surname-' + victim + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">ЗВАНИЕ:</span> <input id="Victim-rank-' + victim + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">ДОЛЖНОСТЬ:</span> <input id="victim-position-' + victim + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><br><span style="font-weight: bold">ДЕЙСТВУЮЩИЙ АДРЕС:</span> <input id="victim-adress-' + victim + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">НОМЕР ТЕЛЕФОНА:</span> <input id="victim-number-' + victim + '" placeholder="TEXT" style="width:40px;height:17px;"></input></div><br><hr><br><br></span>';
						}
						function addWitness(){
							witness = witness+1;
							document.getElementById("witness-head-area").innerHTML = document.getElementById("witness-head-area").innerHTML + '<span id="witness-head-' + witness + '">, <span style="color: #FF8000"><span id="witness-head-name-' + witness + '">NAME</span> <span id="witness-head-surname-' + witness + '">SURNAME</span></span></span>';
							document.getElementById("witness-area").innerHTML = document.getElementById("witness-area").innerHTML + '<span id="witness-' + witness + '"><div style="background-color:#BBBBBB; border:1px solid black; margin:10px 10px; padding-left: 5px; padding-right: 5px;"><img src="https://i.imgur.com/OUaPj2o.png" id="witness-photo-' + witness + '" style="float: Right;margin: 10px 10px 10px 10px"><span style="font-weight: bold">СТАТУС:</span> <span style="color: #FF8000"> <span style="text-decoration: underline">СВИДЕТЕЛЬ</span></span>.<br><span style="font-weight: bold">КОПИЯ ЛИЧНОГО ДЕЛА:</span> <input placeholder="http://URL" id="witness-badge-url-' + witness + '" style="height:18px;width:70px;"><input id="witness-badge-' + witness + '" placeholder="BADGE NUMBER" style="height:18px;width:120px;"><input onkeyup="changePhotoWitness(' + witness + ')" id="witness-photo-url-' + witness + '" placeholder="URL ФОТО" style="height:18px;width:120px;"></input>.<br><br><span style="font-weight: bold">ИМЯ:</span> <input onkeyup="setWitnessName(' + witness + ')" id="witness-name-' + witness + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">ФАМИЛИЯ:</span> <input onkeyup="setWitnessSurname(' + witness + ')" id="witness-surname-' + witness + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">ЗВАНИЕ:</span> <input id="witness-rank-' + witness + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">ДОЛЖНОСТЬ:</span> <input id="witness-position-' + witness + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><br><span style="font-weight: bold">ДЕЙСТВУЮЩИЙ АДРЕС:</span> <input id="witness-adress-' + witness + '" placeholder="TEXT" style="width:40px;height:17px;"></input><br><span style="font-weight: bold">НОМЕР ТЕЛЕФОНА:</span> <input id="witness-number-' + witness + '" placeholder="TEXT" style="width:40px;height:17px;"></input></div><br><hr><br><br><span></span>';
						}
						function dellSusp() {
							if (susps > 1) {
								document.getElementById("susp-" + susps).parentNode.removeChild(document.getElementById("susp-" + susps));
								document.getElementById("susp-head-" + susps).parentNode.removeChild(document.getElementById("susp-head-" + susps));
								susps = susps-1;
							}
						}
						function dellVictim() {
							if (victim > 0) {
								document.getElementById("victim-" + victim).parentNode.removeChild(document.getElementById("victim-" + victim));
								document.getElementById("victim-head-" + victim).parentNode.removeChild(document.getElementById("victim-head-" + victim));
								victim = victim-1;
							}
						}
						function dellWitness() {
							if (witness > 0) {
								document.getElementById("witness-" + witness).parentNode.removeChild(document.getElementById("witness-" + witness));
								document.getElementById("witness-head-" + witness).parentNode.removeChild(document.getElementById("witness-head-" + witness));
								witness = witness-1;
							}
						}
						function setSuspName(n) {
							document.getElementById("susp-head-name-" + n).innerHTML = document.getElementById("susp-name-" + n).value;	
						}
						function setSuspSurname(n) {
							document.getElementById("susp-head-surname-" + n).innerHTML = document.getElementById("susp-surname-" + n).value;	
						}
						function setVictimName(n) {
							document.getElementById("victim-head-name-" + n).innerHTML = document.getElementById("victim-name-" + n).value;	
						}
						function setVictimSurname(n) {
							document.getElementById("victim-head-surname-" + n).innerHTML = document.getElementById("victim-surname-" + n).value;	
						}
						function setWitnessName(n) {
							document.getElementById("witness-head-name-" + n).innerHTML = document.getElementById("witness-name-" + n).value;	
						}
						function setWitnessSurname(n) {
							document.getElementById("witness-head-surname-" + n).innerHTML = document.getElementById("witness-surname-" + n).value;	
						}