class Queen extends Piece{
	constructor(id,x,y){
		super(id,x,y);
		this.score = 9;//debatable
		this.bishop = new Bishop(id,x,y);
		this.rook = new Rook(id,x,y);
	}
	getPossibleMoves(){
		let moves=[];
		let likeBishop = this.bishop.getPossibleMoves();
		for(let i=0;i<likeBishop.length;i++){
			moves.push(likeBishop[i]);
		}
		let likeRook = this.rook.getPossibleMoves();
		for(let i=0;i<likeRook.length;i++){
			moves.push(likeRook[i]);
		}
		
		return moves;
	}
	move(p){
		super.move(p);
		this.hasMoved = true;
		[this.bishop.x,this.bishop.y]=[this.x,this.y];
		[this.rook.x,this.rook.y]=[this.x,this.y];
	}
}