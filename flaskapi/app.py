from flask import Flask, jsonify, request, abort
import json
from flask_cors import CORS
from random import randint
import os
from copy import copy, deepcopy

app = Flask(__name__)
CORS(app)
nog = 0;#number of games
side0=[
	[5,4,3,2,1,3,4,5],
	[6,6,6,6,6,6,6,6],
	[0,0,0,0,0,0,0,0],
	[0,0,0,0,0,0,0,0],
	[0,0,0,0,0,0,0,0],
	[0,0,0,0,0,0,0,0],
	[12,12,12,12,12,12,12,12],
	[11,10,9,8,7,9,10,11],
]
side1=[
	[11,10,9,7,8,9,10,11],
	[12,12,12,12,12,12,12,12],
	[0,0,0,0,0,0,0,0],
	[0,0,0,0,0,0,0,0],
	[0,0,0,0,0,0,0,0],
	[0,0,0,0,0,0,0,0],
	[6,6,6,6,6,6,6,6],
	[5,4,3,1,2,3,4,5],
]
numsToLetters=['a','b','c','d','e','f','g','h'];

def move(here,there,arr):
	x1 = numsToLetters.index(here[0]);
	y1 = int(here[1])-1;
	
	x2 = numsToLetters.index(there[0]);
	y2 = int(there[1])-1;
	
	val = arr[y1][x1];
	arr[y1][x1]=0;
	arr[y2][x2]=val;
	
	return arr;
	
def moveToCurrPlace(path):
	botside=0;
	field=[];
	with open(path,"r") as f:
		line = f.readline();
		jsonString = json.loads(line);
		botside=jsonString["bot"];
		if botside==0:
			field = deepcopy(side0);
		else:
			field = deepcopy(side1);
		line = f.readline();
		for l in f:
			jsonString = json.loads(l);
			if 'from' in jsonString and 'player' not in jsonString:
				field = move(jsonString["from"],jsonString["to"],field);
				
	return findBestMove(field,botside,path);

	
def findBestMove(arr,botside,path):
	maks={"score":-100000,"x":-1,"y":-1};
	possiblePieces=[];
	for i in range(0,8):
		for j in range(0,8):
			if arr[i][j]>botside*6 and arr[i][j]<=botside*6+6:
				possiblePieces.append([i,j]);
	for i in range(0,len(possiblePieces)):
		score = findBestMoveForPiece(possiblePieces[i][1],possiblePieces[i][0],arr);
		if score["score"]>maks["score"]:
			maks={"score":score["score"],"x":possiblePieces[i][1],"y":possiblePieces[i][0],"toX":score["x"],"toY":score["y"]};
	line = '{"from":"'+(numsToLetters[maks["x"]]+str(maks["y"]+1))+'","to":"'+(numsToLetters[maks["toX"]]+str(maks["toY"]+1))+'"}';
	with open(path,"a") as f:
		f.write("\n"+line);
		
	return jsonify(json.loads(line));
	
def findBestMoveForPiece(sx,sy,arr):
	maxscore = -100000;
	posmoves = getPossibleMoves(sx,sy,arr);
	ex=-1;
	ey=-1;
	for i in range(len(posmoves)):
		newField = deepcopy(arr);
		newField = move(numsToLetters[sx]+str(sy+1),numsToLetters[posmoves[i][1]]+str(posmoves[i][0]+1),newField);
		score = calcScore(newField);
		if score>maxscore:
			maxscore=score;
			ex = posmoves[i][1];
			ey = posmoves[i][0];
	return {"x":ex,"y":ey,"score":maxscore};
	
	
def getPossibleMoves(x,y,arr):
	if x<7 and y<7:
		return [[x,y+1]];
	else:
		return [[0,0]];
	

def calcScore(arr):
	return 100;
	
@app.route("/init/", methods = ['GET','POST','OPTIONS'])
def index2():
	global nog;
	if(request.method == 'GET'):
		side=randint(0,1);
		here = os.path.dirname(os.path.realpath(__file__))
		subdir = "Games";
		filename = str(nog)+".json";
		filepath = os.path.join(here, subdir, filename);
		with open(filepath,"w") as f:
			f.write('{"bot":'+str(side)+',"player":'+str(1-side)+'}');
		nog = nog+1;
		return jsonify({"id":(nog-1),"player":+(1-side)});
	if(request.method == 'POST'):
		s = str(request.data)[2:]
		s = s[:len(s)-1];
		side=randint(0,1);
		here = os.path.dirname(os.path.realpath(__file__))
		subdir = "Games";
		filename = str(j["id"])+".json";#fix diss
		filepath = os.path.join(here, subdir, filename);
		with open(filepath,"w") as f:
			f.write(s);
		return "",200;
		
		
@app.route("/bot/", methods = ['PUT','POST','OPTIONS'])
def index():
	if(request.method == 'POST'):
		#return jsonify({"gg":"gg"});
		s = str(request.data)[2:]
		j = json.loads(s[:len(s)-1]);
		#j = request.get_json();
		if j is None:
			return j,405;
		here = os.path.dirname(os.path.realpath(__file__))
		subdir = "Games";
		filename = str(j["id"])+".json";
		filepath = os.path.join(here, subdir, filename);
		with open(filepath,"a") as f:
			f.write("\n"+s[:len(s)-1]);
		return moveToCurrPlace(filepath);
	else:
		return "",200
	
if __name__ == '__main__':
	app.run(debug=True)