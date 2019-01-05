//let gameId=-1;
function init2playerOnline(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			let j = JSON.parse(this.responseText);
			side=j["side"]==0?1:0;
			playerSide = j["side"];
			gameId=j["id"];
			
			if(field[0][0].side==playerSide){//kinda useless if the code was better
				field = [					 // but it ain't 
					[11,10,9,7,8,9,10,11],   // in the future might update it
					[12,12,12,12,12,12,12,12],
					[0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0],
					[6,6,6,6,6,6,6,6],
					[5,4,3,1,2,3,4,5],
				];
				numsToLetters=['a','b','c','d','e','f','g','h'];
				if(playerSide!=0){       
					field = reverse2dArr(field);
					numsToLetters = reverse1dArr(numsToLetters);
				}
				
					
				field = numberFieldToPieces(field);
				drawNumbers();
			}
			
			
			let BKing=getPiece("d8");
			let BQueen=getPiece("e8");
			
			
			let WKing=getPiece("d1");
			let WQueen=getPiece("e1");
			
			if(BKing instanceof Queen){
				field[BKing.y][BKing.x]=BQueen;
				field[BKing.y][BQueen.x]=BKing;
				
				field[WKing.y][WKing.x]=WQueen;
				field[WKing.y][WQueen.x]=WKing;
				
				let pos = getPositionXY("e8");//Queen's place
				
				BKing.x = BQueen.x;
				WKing.x = WQueen.x;
				
				BQueen.x = pos.x;
				WQueen.x = pos.x;
			}
			
			draw();
			stateOfGame[0]= copy2dArr(field);
			
			var xht = new XMLHttpRequest();
			xht.open("GET", "./start/"+gameId, true);
			xht.send();
			
			
			//start2playerOnline();
		}
	};
	xhttp.open("GET", "./api/chessinit", true);
	xhttp.send();
}
function start2playerOnline(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			let j = JSON.parse(this.responseText);
			//if(j["start"]==0){
			//	setTimeout(start2playerOnline,1000);
			//}
			if(j["start"]==1){
				side=0;//white's turn
				alert("The game starts!");
				if(side!=playerSide){
					waitForMoveOnline();
				}
			}
		}
	}
	xhttp.open("POST", "./api/chessinit", true);
	let jsonTxt = "{'id':"+gameId+"}";
	jsonTxt = jsonTxt.replace(/'/g,'"');
	xhttp.send(jsonTxt);
}

function moveOnline(fr,to){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		//if(this.status == 429){//too many requests => continue
			//setTimeout(moveOnline(fr,to),1500);
		//}else{
			//waitForMoveOnline();
		//}
		
		var xht = new XMLHttpRequest();
		xht.open("GET", "./move/"+gameId, true);
		xht.send();
	}
	xhttp.open("POST", "./api/move", true);
	let jsonTxt = "{'id':"+gameId+",'from':'"+fr+"','to':'"+to+"'}";
	jsonTxt = jsonTxt.replace(/'/g,'"');
	xhttp.send(jsonTxt);
	
	//move it tho;
	movePiece(fr,to);	
}

function waitForMoveOnline(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			let j = JSON.parse(this.responseText);
			if(j["move"]==1){
				console.log(j);
				let temp = selected;
				selected = j["from"];
				if(getPiece(selected)!=null){
					findPossibleMoves(selected);
					movePiece(j["from"],j["to"]);
				}
				selected = temp;
				draw();
			}//else if(j["move"]==0){
				//setTimeout(waitForMoveOnline,1500);
			//}
		}
	}
	xhttp.open("POST", "./api/moveget", true);
	let jsonTxt = "{'id':"+gameId+"}";
	jsonTxt = jsonTxt.replace(/'/g,'"');
	xhttp.send(jsonTxt);
}
