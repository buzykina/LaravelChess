class Piece{
	constructor(id,x,y){
		this.id=id;
		this.score;
		this.x=x;
		this.y=y;
		this.side=this.id<=6?0:1;
	}
	getPossibleMoves(){throw new Error('You have to implement the method doSomething!');}
	
	move(p){
		//console.log(p);
		field[p.y][p.x] = this;
		field[this.y][this.x] = null;
		[this.x,this.y]=[p.x,p.y];
	}
}
function numberFieldToPieces(arr){
	let newarr=[];
	for(let i=0;i<arr.length;i++){
			newarr.push([]);
		for(let j=0;j<arr[i].length;j++){
			let id = arr[i][j];
			if(id==6||id==12){
				newarr[i].push(new Pawn(id,j,i));
			}else if(id==5 || id==11){
				newarr[i].push(new Rook(id,j,i));
			}else if(id==4 || id==10){
				newarr[i].push(new Knight(id,j,i));
			}else if(id==3 || id==9){
				newarr[i].push(new Bishop(id,j,i));
			}else if(id==2 || id==8){
				newarr[i].push(new Queen(id,j,i));
			}else if(id==1 || id==7){
				newarr[i].push(new King(id,j,i));
			}else{
				newarr[i].push(null);
			}
		}
	}
	return newarr;
}

function getPiecesArr(arr){
	let newarr=[];
	for(let i=0;i<arr.length;i++){
		newarr[i]=getPiece(arr[i]);
	}
	return newarr;
}
function isAttacked(pos,attacker){//attacker side
	let currSide = attacker==0?1:0;
	let posxy = getPositionXY(pos);
	//check diagonals for bishop and queen and pawn and king(put bishop and same solution as knight)	
	let bis = new Bishop(currSide*6+1,posxy.x,posxy.y);
	let moves = bis.getPossibleMoves();
	let figures = getPiecesArr(moves);
	
	for(let i=0;i<moves.length;i++){
		if(figures[i] instanceof Queen || figures[i] instanceof Bishop){
			return true;
		}
		if(figures[i] instanceof King){
			if(Math.abs(parseInt(moves[i][1])-parseInt(pos[1]))<=1){ //if it's one difference (so next to it)
				return true;
			}
		}
		if(figures[i] instanceof Pawn){
			let s = attacker==0?1:-1;
			if(parseInt(moves[i][1])+s == parseInt(pos[1])){ // if it's just next to the pos and it's attacking the correct direction
				return true;
			}
		}
	}
	//check up, down, left, right for rook and queen and king(put rook and same solution as knight)
	let rook = new Rook(currSide*6+1,posxy.x,posxy.y);
	moves = rook.getPossibleMoves();
	figures = getPiecesArr(moves);
	for(let i=0;i<moves.length;i++){
		if(figures[i] instanceof Queen || figures[i] instanceof Rook){
			return true;
		}
		if(figures[i] instanceof King){
			if(Math.abs(numsToLetters.indexOf(moves[i][0]) - numsToLetters.indexOf(pos[0]))<=1 && Math.abs(parseInt(moves[i][1])-parseInt(pos[1]))<=1){
				//if it's one or less difference (so next to it)
				return true;
			}
		}
	}
	//check for knight(put a knight on a position and if in possible moves you find a knight -> gg)
	let knight = new Knight(currSide*6+1,posxy.x,posxy.y);
	moves = knight.getPossibleMoves();
	figures = getPiecesArr(moves);
	for(let i=0;i<moves.length;i++){
		if(figures[i] instanceof Knight){
			return true;
		}
	}
	//if it isn't attacked 
	return false;
}

function isThereCheck(checkSide){
	let pos = "";
	for(let i=0;i<8;i++){
		for(let j=0;j<8;j++){
			if(field[i][j] instanceof King && field[i][j].side==checkSide){
				return isAttacked(getPositionString(j,i,false),checkSide==0?1:0);
			}
		}
	}
	console.error("There was an error with the game logic. Make sure you have stable internet connection.")
	return false;
}