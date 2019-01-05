class Knight extends Piece{
	constructor(id,x,y){
		super(id,x,y);
		this.score = 3;//debatable
	}
	getPossibleMoves(){
		let moves=[];
		for(let i=-1;i<2;i+=2){		
			if(this.x+i*2>=0 && this.x+i*2<8){
				for(let j=-1;j<2;j+=2){
					if(this.y+j>=0 && this.y+j<8){
						let wantedMove = field[this.y+j][this.x+i*2];
						if(wantedMove==null || wantedMove.side != this.side){
							moves.push(getPositionString(this.x+i*2,this.y+j,false));
						}
					}
				}
			}
		}
		for(let i=-1;i<2;i+=2){		
			if(this.x+i>=0 && this.x+i<8){
				for(let j=-1;j<2;j+=2){
					if(this.y+j*2>=0 && this.y+j*2<8){
						let wantedMove = field[this.y+j*2][this.x+i];
						if(wantedMove==null || wantedMove.side != this.side){
							moves.push(getPositionString(this.x+i,this.y+j*2,false));
						}
					}
				}
			}
		}		
		return moves;
	}
}