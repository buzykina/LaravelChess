function draw(f=field){
	drawBoard();
	drawPieces(f);
	drawPossibleMoves();
}
function drawBoard(){
	for(let i=0;i<h;i+=ts){
		for(let j=0;j<w;j+=ts){
			ctx.fillStyle=((i/ts+j/ts)%2==0?"darkgoldenrod":"lime");
			ctx.fillRect(j,i,ts,ts);
			ctx.strokeRect(j,i,ts,ts);
		}
	}
	if(selected!=undefined){
		ctx.fillStyle="magenta";
		let pos = getPositionXY(selected);
		ctx.fillRect(pos.x*ts,pos.y*ts,ts,ts);
	}
}
function drawPieces(f){
	for(let i=0;i<8;i++){
		for(let j=0;j<8;j++){
			if(f[i][j]!=null){
				let con = images[f[i][j].id-1];
				ctx.drawImage(img,con.cl,con.ct,con.cw,con.ch,j*ts,i*ts,ts,ts);
			}
		}
	}
}
function drawPossibleMoves(){
	if(selected!=undefined){
		findPossibleMoves();
		for(let i=0;i<possibleMoves.length;i++){
			let pos = getPositionXY(possibleMoves[i]);
			ctx.beginPath();
			ctx.arc(pos.x*ts+ts/2, pos.y*ts+ts/2, ts/4, 0, 2 * Math.PI, false);
			ctx.fillStyle = 'navy';
			ctx.fill();
		}
	}
}
function setImage(){
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
}