function render() {
	var grey = '#bdc3c7';
	if (gameState === 0) {
		grey = "rgb(220, 223, 225)";
	}
	
	ctx.clearRect(0, 0, trueCanvas.width, trueCanvas.height);
	clearGameBoard();
	if (gameState === 1 || gameState === 2 || gameState === -1 || gameState === 0) {
		if (op < 1) {
			op += 0.01;
		}
		ctx.globalAlpha = op;
		drawPolygon(trueCanvas.width / 2 , trueCanvas.height / 2 , 6, (settings.rows * settings.blockHeight) * (2/Math.sqrt(3)) + settings.hexWidth, 30, grey, false,6);
		drawTimer();
		ctx.globalAlpha = 1;
	}

	var i;
	for (i = 0; i < MainHex.blocks.length; i++) {
		for (var j = 0; j < MainHex.blocks[i].length; j++) {
			var block = MainHex.blocks[i][j];
			block.draw(true, j);
		}
	}

	for (i = 0; i < blocks.length; i++) {
		blocks[i].draw();
	}

	MainHex.draw();
        if (gameState ==1 || gameState ==-1 || gameState === 0) {
            drawScoreboard();
        }

	for (i = 0; i < MainHex.texts.length; i++) {
		var alive = MainHex.texts[i].draw();
		if(!alive){
			MainHex.texts.splice(i,1);
			i--;
		}
	}

	if ((MainHex.ct < 650 && (gameState !== 0) && !MainHex.playThrough)) {
		if (MainHex.ct > (650 - 50)) {
			ctx.globalAlpha = (50 - (MainHex.ct - (650 - 50)))/50;
		}

		if (MainHex.ct < 50) {
			ctx.globalAlpha = (MainHex.ct)/50;
		}

		renderBeginningText();
		ctx.globalAlpha = 1;
	}

	if (gameState == -1) {
		ctx.globalAlpha = 0.9;
		ctx.fillStyle = 'rgb(236,240,241)';
		ctx.fillRect(0, 0, trueCanvas.width, trueCanvas.height);
		ctx.globalAlpha = 1;
	}

	settings.prevScale = settings.scale;
	settings.hexWidth = settings.baseHexWidth * settings.scale;
	settings.blockHeight = settings.baseBlockHeight * settings.scale;
}

function renderBeginningText() {
	renderText((trueCanvas.width)/2 + 1.5 * settings.scale, (trueCanvas.height)/2 - 120 - 208 * settings.scale, 40, '#2c3e50', '小提示', '40px Roboto');
	renderText((trueCanvas.width)/2 - 85 * settings.scale, (trueCanvas.height)/2 - 120 - 169 * settings.scale + 10, 22, '#2c3e50', '旋转:', '22px Roboto');
	renderText((trueCanvas.width)/2 - 21 * settings.scale, (trueCanvas.height)/2 - 120 - 141 * settings.scale + 20, 14, '#2c3e50', '向左', '14px Roboto');
	renderText((trueCanvas.width)/2 + 25 * settings.scale, (trueCanvas.height)/2 - 120 - 141 * settings.scale + 20, 14, '#2c3e50', '向右', '14px Roboto');
	drawKey("right",(trueCanvas.width)/2 + 23 * settings.scale - 35/2 * settings.scale, (trueCanvas.height)/2 - 120 - 195 * settings.scale + 10);
	drawKey("left",(trueCanvas.width)/2 - 23 * settings.scale - 35/2 * settings.scale, (trueCanvas.height)/2 - 120 - 195 * settings.scale + 10);
	renderText((trueCanvas.width)/2 + 1.5 * settings.scale, (trueCanvas.height)/2 - 120 - 125 * settings.scale + 30, 22, '#2c3e50', '旋转中心六角形来消除颜色相同的三个（以上）小矩形块!', '22px Roboto');
	renderText((trueCanvas.width)/2 + 1.5 * settings.scale, (trueCanvas.height)/2 - 120 - 105 * settings.scale + 40, 22, '#2c3e50', '连续消除会获得连击分数哦！', '22px Roboto');
	renderText((trueCanvas.width)/2 + 1.5 * settings.scale, (trueCanvas.height)/2 - 120 - 85 * settings.scale + 50, 22, '#2c3e50', '小矩形块堆叠到灰色六边形外游戏即可结束', '22px Roboto');
	renderText((trueCanvas.width)/2 + 1.5 * settings.scale, (trueCanvas.height)/2 - 120 - 65 * settings.scale + 60, 22, '#2c3e50', '点击中心六角形会加速小矩形块下落速度', '22px Roboto');
}

function drawKey(key, x, y) {
	ctx.save();
	ctx.beginPath();
	ctx.fillStyle = '#2c3e50';
	ctx.strokeStyle = '#2c3e50';
	ctx.lineWidth = 4 * settings.scale;
	ctx.rect(x + 2.5 * settings.scale, y + 2.5 * settings.scale, 35 * settings.scale, 35 * settings.scale);
	ctx.stroke();

	switch (key) {
		case "left":
			ctx.translate(x + settings.scale * 28, y + settings.scale * 13);
			ctx.rotate(3.14159);
			ctx.font = "20px Fontawesome";
			ctx.scale(settings.scale, settings.scale);
			ctx.fillText(String.fromCharCode("0xf04b"), 0, 0);
			break;
		case "right":
			ctx.font = "20px Fontawesome";
			ctx.translate(x + settings.scale * 12.5, y + settings.scale * 27.5);
			ctx.scale(settings.scale, settings.scale);
			ctx.fillText(String.fromCharCode("0xf04b"), 0, 0);
			break;
		
		default:
			ctx.font = "35px Roboto";
			ctx.translate(x + settings.scale * 25 , y + settings.scale * 39.5);
			ctx.scale(settings.scale, settings.scale);
			ctx.fillText(key, 0, 0);
	}

	ctx.restore();
}
