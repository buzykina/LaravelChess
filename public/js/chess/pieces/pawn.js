class Pawn extends Piece{
	constructor(id,x,y){
		super(id,x,y);
		this.score = 1;
		this.hasMoved=false;
		this.hasMoved2=false;
	}
	getPossibleMoves(clicked = true){
		if(this.hasMoved && clicked){//not perfect but works for now // kinda
			this.hasMoved2=true;
		}
		
		let s = this.side==0?1:-1;
		let moves = [];
		
		let currPos = getPositionString(this.x,this.y,false);
		let newPosY = (parseInt(currPos[1])+s);
		if(between2nums(newPosY,1,9)){
			currPos = currPos[0]+newPosY;
			let cp = getPositionXY(currPos);//cp is short for current position
			if(field[cp.y][cp.x] == null){// if space infront is empty
				moves.push(currPos);// add it to possible moves
				
				
				if(!this.hasMoved){//2 up
					newPosY = (parseInt(currPos[1])+s);
					if(between2nums(newPosY,1,9)){
						currPos = currPos[0]+newPosY;
						cp = getPositionXY(currPos);
						let wantedMove = field[cp.y][cp.x];
						if(wantedMove==null){
							moves.push(getPositionString(cp.x,cp.y,false));
						}
					}
				}
			}
			
			currPos = getPositionString(this.x,this.y,false);
			newPosY = (parseInt(currPos[1])+s);
			currPos = currPos[0]+newPosY;
			cp = getPositionXY(currPos);//cp is short for current position
			
			for(let i=-1;i<2;i+=2){// attacks
				if(between2nums(cp.x+i,0,9)){
					let wantedMove = field[cp.y][cp.x+i];
					if(wantedMove!=null && wantedMove.side!=this.side){
						moves.push(getPositionString(cp.x+i,cp.y,false));
					}else if(this.isAnpassan(i)){
						moves.push(getPositionString(cp.x+i,cp.y,false));
					}
				}
			}
		}
		
		return moves;
	}
	isAnpassan(offset){
		return (field[this.y][this.x+offset] instanceof Pawn && 
			field[this.y][this.x+offset].side!=this.side && 
			!field[this.y][this.x+offset].hasMoved2);
	}
	move(p){
		super.move(p);
		this.hasMoved = true;
	}
}