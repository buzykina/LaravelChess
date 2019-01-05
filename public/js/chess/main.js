///////////////////////////// Variables
let can = document.getElementById("canvas");
let ctx = can.getContext("2d");
let w = can.width;
let h = can.height;
let img = new Image();
img.src = "./img/textures.png";
let images=[];
let side=Math.random()>0.5?0:1;
let playerSide = side;
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
let possibleMoves=[];
let currField=[];


let mod=2;
let gameId=-1;

////////////////////////// Functions


function between2nums(num,min,max){//excluding max and including min
	return num>=min && num<max;
}
function checkIfWin(s){
	let moves = [];
	let temp = selected;
	for(let i=0;i<8;i++){
		for(let j=0;j<8;j++){
			if(field[i][j]!= null && field[i][j].side==s){
				selected = getPositionString(j,i,false);
				findPossibleMoves(true);//so that an passion works
				for(let k=0;k<possibleMoves.length;k++){
					moves.push(possibleMoves[k]);
				}
				selected = temp;
			}
		}
	}
	//console.log(moves.length);
	if(moves.length==0 && s==playerSide){
		win();
	}else if(moves.length==0){
		lose();
	}
}

function win(){
	can.onclick = function(){};
	document.getElementById("choose").style.zIndex="100000";
	document.getElementById("choose").style.background="black";
	document.getElementById("choose").innerHTML="<span class='is-vcentered'>"+(side!=0?"White":"Black")+" wins!</span>";
	document.getElementById("choose").innerHTML+="<br><br><br><button class='button is-dark' onclick='location.reload()'>Play again</button>";
}

function lose(){
	can.onclick = function(){};
	document.getElementById("choose").style.zIndex="100000";
	document.getElementById("choose").style.background="black";
	document.getElementById("choose").innerHTML="<span class='is-vcentered'>"+(side!=0?"White":"Black")+" wins!</span>";
	document.getElementById("choose").innerHTML+="<br><br><br><button class='button is-dark' onclick='location.reload()'>Play again</button>";
}
function drawNumbers(){
	let numbs = document.getElementById("numbs");
	let numbsctx = numbs.getContext("2d");
	let cl1 = "magenta";
	let cl2 = "navy";
	let s = playerSide==0?1:0;
	numbsctx.font = "30px Arial";
	for(let i=0;i<h;i+=ts){
		numbsctx.fillStyle=(i/ts)%2==0?cl1:cl2;
		numbsctx.fillRect(510,i+50,ts,ts);
		numbsctx.fillStyle=(i/ts)%2==0?cl2:cl1;
		numbsctx.fillRect(25,i+50,ts,ts);
		
		numbsctx.fillStyle=(i/ts)%2==0?cl1:cl2;
		numbsctx.fillText(Math.abs((i/ts+1)-9*s),25,i+90);
		numbsctx.fillStyle=(i/ts)%2==0?cl2:cl1;
		numbsctx.fillText(Math.abs((i/ts+1)-9*s),555,i+90);
	}
	for(let j=0;j<w;j+=ts){
		numbsctx.fillStyle=(j/ts)%2==1?cl1:cl2;
		numbsctx.fillRect(j+50,15,ts,ts);
		numbsctx.fillStyle=(j/ts)%2==1?cl2:cl1;
		numbsctx.fillRect(j+50,520,ts,ts);
		
		numbsctx.fillStyle=(j/ts)%2==1?cl1:cl2;
		numbsctx.fillText(numsToLetters[j/ts],j+75,575);
		numbsctx.fillStyle=(j/ts)%2==1?cl2:cl1;
		numbsctx.fillText(numsToLetters[j/ts],j+75,40);
	}
}
function findPossibleMoves(extra=false){
	if(selected!=undefined){
		let moves = getPiece(selected).getPossibleMoves(extra);
		
		possibleMoves=[];
		for(let i=0;i<moves.length;i++){
			if(!checkPosition(selected,moves[i])){
				possibleMoves.push(moves[i]);
			}
		}
	}
}
function getPositionString(x,y,mouseClick=true){
	let m = x/ts|0;
	let k = (y/ts)|0;
	if(!mouseClick){[m,k]=[x,y];}
	if(playerSide==1){ return numsToLetters[m]+""+(k+1);}
	return numsToLetters[m]+""+(8-k);
}
function getPositionXY(pos){
	let x = numsToLetters.indexOf(pos[0]);
	let y = parseInt(pos[1]-1);
	if(playerSide==0){ y = 7-y;}
	return {x: x, y: y};
}
function getPiece(pos){
	pos = getPositionXY(pos);
	return field[pos.y][pos.x];
}
function movePiece(pos1,pos2){
	if(pos1!=pos2 && getPiece(pos1)!=null && possibleMoves.indexOf(pos2)>-1){
		let l = document.getElementById("moves").children.length;
		document.getElementById("moves").innerHTML+="<div><a onclick='draw(stateOfGame["+l+"]);'>"+(pos1)+" --> "+(pos2)+"</a></div>";
		let s = getPositionXY(pos1);//start
		let e = getPositionXY(pos2);//end
		let mover = field[s.y][s.x];
		
		if(mover instanceof Pawn){//an passion
			if(field[e.y][e.x]==null && e.x!=s.x){//goes to an empty field with different x pos
				if(field[e.y-1][e.x] instanceof Pawn){
					field[e.y-1][e.x] = null;
				}else if(field[e.y+1][e.x] instanceof Pawn){
					field[e.y+1][e.x] = null;
				}
			}
			
			if(e.y==0 || e.y==7){//if it goes to the end of the field
				mover.move(e);
				changePawn(pos2);
				stateOfGame.push(copy2dArr(field));
				return;
			}
		}
		
		mover.move(e);
		if(mover instanceof King && Math.abs(s.x-e.x)==2){//fortress
			for(let i=0;i<8;i+=7){
				let rook = field[i][mover.y];
				if(rook instanceof Rook && rook.side==mover.side && !rook.hasMoved){
					let coef = i==0?1:-1
					let goal={x:mover.x+coef,y:mover.y};
					rook.move(goal);
				}	
			}
		}
		
		stateOfGame.push(copy2dArr(field));
		
		side=side==0?1:0;
		checkIfWin(side);
	}
}
function changePawn(pos){
	document.getElementById("choose").style.zIndex="100000";
	document.getElementById("choose").style.background="#000000";
	document.getElementById("choose").innerHTML="Choose your figure:<br>";
	document.getElementById("choose").innerHTML+="<span onclick = 'changeIt(\""+pos+"\",0)' class = 'button is-dark'>Queen</span><br>";
	document.getElementById("choose").innerHTML+="<span onclick = 'changeIt(\""+pos+"\",1)' class = 'button is-dark'>Rook</span><br>";
	document.getElementById("choose").innerHTML+="<span onclick = 'changeIt(\""+pos+"\",2)' class = 'button is-dark'>Bishop</span><br>";
	document.getElementById("choose").innerHTML+="<span onclick = 'changeIt(\""+pos+"\",3)' class = 'button is-dark'>Knight</span><br>";
}
function changeIt(pos,id){
	let pawn = getPiece(pos);
	if(id==0){//queen
		field[pawn.y][pawn.x] = new Queen(pawn.id-4,pawn.x,pawn.y);
	}else if(id==1){//rook
		field[pawn.y][pawn.x] = new Rook(pawn.id-1,pawn.x,pawn.y);
	}else if(id==2){//bishop
		field[pawn.y][pawn.x] = new Bishop(pawn.id-3,pawn.x,pawn.y);
	}else if(id==3){//knight
		field[pawn.y][pawn.x] = new Knight(pawn.id-2,pawn.x,pawn.y);
	}
	
	
	document.getElementById("choose").style.zIndex="-100000";
	document.getElementById("choose").style.background="#00000000";
	document.getElementById("choose").innerHTML="";
	
	side=side==0?1:0;
	checkIfWin(side);
	draw();
}

function checkPosition(pos1,pos2){
	let isChecked = false;
	let s = getPositionXY(pos1);//start
	let e = getPositionXY(pos2);//end
	let mover = field[s.y][s.x];
	let temp = field[e.y][e.x];
	
	let hasMoved=false;
	if(mover instanceof Pawn || mover instanceof King || mover instanceof Rook){
		hasMoved = mover.hasMoved;
	}
	mover.move(e);
	
	isChecked = isThereCheck(mover.side);
	
	mover.move(s);
	field[e.y][e.x] = temp;
	
	if(mover instanceof Pawn || mover instanceof King || mover instanceof Rook){
		mover.hasMoved = hasMoved;
	}
	return isChecked;
}


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
function reverse1dArr(arr){
	let newArr=[];
	for(let i=0;i<arr.length;i++){
		newArr.push(arr[arr.length-i-1]);
	}
	return newArr;
}





	
	

///////////////////////// cool functions with no real functionality
let hue = 0;
function colorParty(){
	hue+=15;
	can.style.filter = "hue-rotate("+(hue)+"deg)";
}

///////////////////////// Events

function clickHandler(e){
	let x = e.clientX - can.offsetLeft - window.scrollX;
	let y = e.clientY - can.offsetTop - window.scrollY;
	let pos = getPositionString(x,y);
	if(selected==undefined){//if it's not defined yet
		if(getPiece(pos)!=null){
			if(gameId<0 && getPiece(pos).side == side){//if it's a local game only the player who has a  turn currently can move
				selected = pos;
			}else if(gameId>0 && getPiece(pos).side == playerSide){//if it's an online game only the player can move his stuff
				selected = pos;
			}
		}
	}else if(possibleMoves.indexOf(pos)>-1){//if it's a possible move
		if(gameId>0 && getPiece(selected).side==playerSide && playerSide==side){//move  if the piece belongs to the player and it's his turn
			moveOnline(selected,pos);
		}else if(gameId<0){
			movePiece(selected,pos);
		}
		selected = undefined;
	}else{
		selected = undefined;
	}
	draw();
}
can.onclick = function(event){
	clickHandler(event);
};
		

function disappearChoose(){
	document.getElementById("choose").style.background = "#0000";
	document.getElementById("choose").style.zIndex = "-10000";
}

window.onload = function(){//// mod - > 0 is Against bot, 1 is Against another person online, 2 is local
	if(side==1){
		field = reverse2dArr(field);
		numsToLetters = reverse1dArr(numsToLetters);
	}
	field = numberFieldToPieces(field);
	setImage();
	draw();
	stateOfGame.push(copy2dArr(field));
	document.getElementById("moves").innerHTML+="<div><a onclick='draw(stateOfGame[0]);'>Beggining</a></div>";
	setInterval(colorParty,100);
	drawNumbers();
	document.getElementById("choose").style.top = (can.offsetTop + window.scrollY)+"px";
	document.getElementById("choose").style.width = can.width+100+"px";
	document.getElementById("choose").style.height = can.height+100+"px";
	if(mod==2){
		side=0;
	}
}