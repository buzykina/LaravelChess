let can = document.getElementById("canvas");
let ctx = can.getContext("2d");
let w = can.width;
let h = can.height;
let img = new Image();
img.src = "./img/textures.png";
let images=[];
let side=0;
let field=[
	[11,10,9,7,8,9,10,11],
	[12,12,12,12,12,12,12,12],
	[0,0,0,0,0,0,0,0],
	[0,0,0,0,0,0,0,0],
	[0,0,0,0,0,0,0,0],
	[0,0,0,0,0,0,0,0],
	[6,6,6,6,6,6,6,6],
	[5,4,3,1,2,3,4,5],
];
let numsToLetters=['a','b','c','d','e','f','g','h'];
let ts = w/8;
let idOfGame;
let canPlay = true;
let selected = undefined;
let stateOfGame=[];
let lookingAtOldGame=false;
let possibleMoves = [];


///////////////////////////////////////////////////////////////////////////////////////POSITION FUNCTIONS////////////////////////////////////////////////////

function getChessPosition(x,y){
	let ex = numsToLetters[(Math.floor(x/ts))];
	let ey = Math.floor(y/ts)+1;
	return {x:ex, y:ey};
}
function stringToChessPosition(st){
	return {x:st[0],y:(parseInt(st[1]))};
}
function positionToChessPosition(pos){
	return {x:numsToLetters[pos.x],y:(pos.y+1)};
}
function chessPositionToPosition(pos){
	return {x:numsToLetters.indexOf(pos.x),y:(pos.y-1)};
}
function chessPositionToString(st){
	return st.x+""+st.y;
}
function positionToString(pos){
	if(pos.x !== parseInt(pos.x,10)){ return chessPositionToString(pos)}//if not an int
	return chessPositionToString(positionToChessPosition(pos));
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function copy2dArr(arr){
	let newArr = [];
	for(let i=0;i<arr.length;i++){
		newArr.push([]);
		for(let j=0;j<arr[i].length;j++){
			newArr[i].push(arr[i][j]);
		}
	}
	return newArr;
}
function reverse2dArr(arr){
	let newArr = [];
	for(let i=0;i<arr.length;i++){
		newArr.push([]);
		for(let j=0;j<arr[arr.length-1-i].length;j++){
			newArr[i].push(arr[arr.length-i-1][arr[j].length-j-1]);
		}
	}
	return newArr;
}



function draw(arr){
	if(arr != field){
		lookingAtOldGame=true;
	}
	drawBoard();
	if(selected != undefined){
		ctx.fillStyle="gold";
		ctx.strokeStyle="black";
		ctx.fillRect((selected.x)*ts,(selected.y)*ts,ts,ts);
		ctx.strokeRect((selected.x)*ts,(selected.y)*ts,ts,ts);
		ctx.fillStyle="magenta";
		for(let i=0;i<possibleMoves.length;i++){
			ctx.fillRect((possibleMoves[i].x)*ts,(possibleMoves[i].y)*ts,ts,ts);
			ctx.strokeRect((possibleMoves[i].x)*ts,(possibleMoves[i].y)*ts,ts,ts);
		}
	}
	//ctx.drawImage(img,40,70,250,250,0,0,w,h);
	drawPieces(arr);
}

function drawBoard(){
	ctx.strokeStyle="black";
	for(let i=0;i<8;i++){
		for(let j=0;j<8;j++){
			ctx.fillStyle=(i+j)%2?"lime":"darkgoldenrod";
			ctx.fillRect(i*ts,j*ts,ts,ts);
			ctx.strokeRect(i*ts,j*ts,ts,ts);
		}
	}
}
function drawPieces(arr){
	for(let i=0;i<8;i++){
		for(let j=0;j<8;j++){
			if(arr[i][j]!=0){
				let k = images[arr[i][j]-1];
				ctx.drawImage(img,k.cl,k.ct,k.cw,k.ch,j*ts,i*ts,ts,ts);
			}
		}
	}
}


function selection(x,y){
	pos = chessPositionToPosition(getChessPosition(x,y));
	if(pos.x !== parseInt(pos.x, 10)){//is not an int
		pos = (pos);
	}
	console.log(pos);
	if(field[pos.y][pos.x] != 0){
		selected = pos;
		showMoves();
		draw(field);
	}
}

function showMoves(){
	let piece = field[selected.y][selected.x];
	
	if(piece == 6+6*side){// pawn
		newMoveY = selected.y-1;
		if(field[newMoveY][selected.x] == 0){
			possibleMoves.push({x:selected.x,y:newMoveY});
		}
		if(selected.y+1==7 && field[newMoveY][selected.x] == 0 && field[newMoveY-1][selected.x] == 0){
			possibleMoves.push({x:selected.x,y:newMoveY-1});
		}
		for(let i=-1;i<2;i+=2){
			let newMoveX = selected.x + i;
			if(newMoveX>= 0 && newMoveX<8 && field[newMoveY][newMoveX] > (1-side)*6 &&  field[newMoveY][newMoveX] <= (1-side)*6+6){
				possibleMoves.push({x:newMoveX,y:newMoveY});
			}
		}
		for(let i=-1;i<2;i+=2){
			let newMoveX = selected.x + i;
			if(pawnMovedLastTurn(newMoveX,newMoveY+1) && newMoveX>= 0 && newMoveX<8 && field[newMoveY][newMoveX] == 0){
				possibleMoves.push({x:newMoveX,y:newMoveY});
			}
		}
	}
	else if(piece == 5+6*side){// rook
		
	}
	else if(piece == 4+6*side){// knight
		
	}
	else if(piece == 3+6*side){// bishop
		
	}
	else if(piece == 2+6*side){// queen
		
	}
	else if(piece == 1+6*side){// king
		
	}
}
//////////////////////////stuuf to add later/////////////

function countNrOfMoves(side){
	
}

function isInCheck(side){
	
}

function isAvailable(chessPos){
	return true;
	// for () possible moves
	// if chessPos == posmoves[i]
	// return true
	// after loop return false
}






////////////////////////end stuff to add later/////////////

function pawnMovedLastTurn(x,y){
	return stateOfGame[stateOfGame.length - 1][y][x]==((1-side)*6 + 6) && field[y][x]==0;
}


function deselection(){
	selected = undefined;
}


function movePiece(here,there){
	if(here.x !== parseInt(here.x, 10)){//is not an int
		here = chessPositionToPosition(here);
	}
	if(there.x !== parseInt(there.x, 10)){//is not an int
		there = chessPositionToPosition(there);
	}
	
	
	let x1=here.x;
	let y1=here.y;
	
	let x2=there.x;
	let y2=there.y;
	
	console.log(y1+"  "+x1);
	
	let piece = field[y1][x1];
	field[y1][x1]=0;
	field[y2][x2]=piece;
	
	let l = document.getElementById("moves").children.length;
	document.getElementById("moves").innerHTML+="<div><a onclick='draw(stateOfGame["+l+"]);'>"+(positionToString(here))+" --> "+(positionToString(there))+"</a></div>";
	stateOfGame.push(copy2dArr(field));
	draw(field);
}



can.onclick = function(){
	possibleMoves = [];
	let x = event.clientX-can.getBoundingClientRect().x;
	let y = event.clientY-can.getBoundingClientRect().y;
	if(!lookingAtOldGame){
		let xh = new XMLHttpRequest();
		xh.onreadystatechange = function() {}
		if(selected == undefined){
			selection(x,y);
		}else{
			let toPos = getChessPosition(x,y);
			if(isAvailable(toPos)){
				movePiece(selected,toPos);
				let xh = new XMLHttpRequest();
				xh.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						let f = JSON.parse(this.responseText)["from"];
						let t = JSON.parse(this.responseText)["to"];
						movePiece(stringToChessPosition(f),stringToChessPosition(t));
					}
				}
				xh.open("POST","http://127.0.0.1:5000/bot/",true);
				console.log('{"id":'+idOfGame+',"from":"'+positionToString(selected)+'","to":"'+positionToString(toPos)+'"}');
				xh.send('{"id":'+idOfGame+',"from":"'+positionToString(selected)+'","to":"'+positionToString(toPos)+'"}');
			}
			deselection();
		}
	}
	draw(field);
	lookingAtOldGame=false;
}
window.onload = function (){
	idOfGame = document.getElementById("aidi").value;
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			side = JSON.parse(this.responseText)["player"]
			for(let j=0;j<2;j++){
			for(let i=0;i<6;i++){
					images.push({
						cl:i*333,
						ct:j*333,
						cw:333,
						ch:333
					});
				}
			}
			if(side==1){
				field=reverse2dArr(field);
				let xh = new XMLHttpRequest();
				xhttp.onreadystatechange = function(){}
				xh.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						let f = JSON.parse(this.responseText)["from"];
						let t = JSON.parse(this.responseText)["to"];
						movePiece(stringToChessPosition(f),stringToChessPosition(t));
					}
				}
				xh.open("POST","http://127.0.0.1:5000/bot/",true);
				xh.send('{"id":'+idOfGame+'}');
			}
			stateOfGame.push(copy2dArr(field));
			document.getElementById("moves").innerHTML+="<div><a onclick='draw(stateOfGame[0]);'>Beginning</a></div>";
			draw(field);
		}else{ 
			console.log("This is a 2 player local game.")
		}
	};
	xhttp.open("GET","./api/chessinit/"+idOfGame,true);
	xhttp.send();
}





function readSingleFile(e){
	var file = e.target.files[0];
	if (!file) {
		return;
	}
	var reader = new FileReader();
	reader.onload = function(e) {
		var contents = e.target.result;
		console.log(contents);
		let xh = new XMLHttpRequest();
		xh.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let stuf = contents.split("\n");
				for(let i=0;i<stuf.length;i++){
					if(!('player' in JSON.parse(stuf[i]))){
						let f = JSON.parse(stuf[i])["from"];
						let t = JSON.parse(stuf[i])["to"];
						movePiece(stringToChessPosition(f),stringToChessPosition(t));
					}
				}
			}
		}
		xh.open("POST","http://127.0.0.1:5000/init/",true);
		xh.send(contents);
	};
	reader.readAsText(file);
}


document.getElementById('file-input').addEventListener('change', readSingleFile, false);