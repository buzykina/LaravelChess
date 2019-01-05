class Rook extends Piece{
	constructor(id,x,y){
		super(id,x,y);
		this.score = 7;//debatable
		this.hasMoved=false;
	}
	getPossibleMoves(){
		let moves=[];
		for(let i=this.x+1;i<8;i++){
			let wantedMove = field[this.y][i];
			if(wantedMove==null){
				moves.push(getPositionString(i,this.y,false));
				continue;
			}
			if(wantedMove.side!=this.side){ moves.push(getPositionString(i,this.y,false));}
			break;
		}
		for(let i=this.x-1;i>=0;i--){
			let wantedMove = field[this.y][i];
			if(wantedMove==null){
				moves.push(getPositionString(i,this.y,false));
				continue;
			}
			if(wantedMove.side!=this.side){ moves.push(getPositionString(i,this.y,false));}
			break;
		}
		
		for(let i=this.y-1;i>=0;i--){
			let wantedMove = field[i][this.x];
			if(wantedMove==null){
				moves.push(getPositionString(this.x,i,false));
				continue;
			}
			if(wantedMove.side!=this.side){ moves.push(getPositionString(this.x,i,false));}
			break;
		}
		
		for(let i=this.y+1;i<8;i++){
			let wantedMove = field[i][this.x];
			if(wantedMove==null){
				moves.push(getPositionString(this.x,i,false));
				continue;
			}
			if(wantedMove.side!=this.side){ moves.push(getPositionString(this.x,i,false));}
			break;
		}
		
		return moves;
	}
	move(p){
		super.move(p);
		this.hasMoved = true;
	}
}