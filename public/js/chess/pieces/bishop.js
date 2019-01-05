class Bishop extends Piece{
	constructor(id,x,y){
		super(id,x,y);
		this.score = 3;//debatable
	}
	getPossibleMoves(){
		let moves=[];
		for(let sideY=-1;sideY<2;sideY+=2){
			for(let sideX=-1;sideX<2;sideX+=2){
				for(let i=1;i<8;i++){
					if(between2nums(this.x+i*sideX,0,8) && between2nums(this.y+i*sideY,0,8)){
						let wantedMove = field[this.y+i*sideY][this.x+i*sideX];
						if(wantedMove==null){
							moves.push(getPositionString(this.x+i*sideX,this.y+i*sideY,false));
							continue;
						}
						if(wantedMove.side!=this.side){ moves.push(getPositionString(this.x+i*sideX,this.y+i*sideY,false));}
						break;
					}
				}
			}
		}
		
		return moves;
	}
}