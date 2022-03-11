class GameServer {
	getRandomGame() {
		this.i = new Random().nextInt(1000);
		this.urlLocation = "https://sanfoh.com/heartgame/sixeqgame_" + i + ".png";
		this.url = new URL(urlLocation);
		this.solution = i % 10;
		return new Game(url, solution);
	}
}
