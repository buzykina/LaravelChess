class King extends Piece{
	constructor(id,x,y){
		super(id,x,y);
		this.score = 1;
		this.hasMoved=false;
	}
	getPossibleMoves(){
		let s = this.side==side? 1: -1;
		let moves = [];
		
		for(let i=-1;i<2;i++){
			for(let j=-1;j<2;j++){
				if(!(i==0 && j==0) && between2nums(this.x+j,0,8) && between2nums(this.y+i,0,8)){
					let wantedMove = field[this.y+i][this.x+j];
					if(wantedMove == null || wantedMove.side != this.side){
						moves.push(getPositionString(this.x+j,this.y+i,false));
					}
				}
			}
		}
		if(!this.hasMoved){
			let rook = field[this.y][0];
			if(this.readyForFortress(rook)){
				moves.push(getPositionString(this.x-2,this.y,false));
			}
			rook = field[this.y][7];
			if(this.readyForFortress(rook)){
				moves.push(getPositionString(this.x+2,this.y,false));
			}
		}
		
		return moves;
	}
	readyForFortress(rook){
		if(rook==null){return false;}
		let attacker = this.side==0?1:0;
		if(rook.hasMoved){return false;}
		if(rook.x==0){//++
			for(let i=1;i<this.x;i++){
				if(field[rook.y][i]!=null){ return false;}
				if(isAttacked(getPositionString(i,rook.y,false), attacker)){return false;}
			}
		}else{//--
			for(let i=this.x+1;i<rook.x;i++){
				if(field[rook.y][i]!=null){ return false;}
				if(isAttacked(getPositionString(i,rook.y,false), attacker)){return false;}
			}
		}
		return true;
	}
	move(p){
		super.move(p);
		this.hasMoved = true;
	}
}