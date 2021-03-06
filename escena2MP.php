<html>
<head>
	<title>Nivel 1</title>
	<script type="text/javascript" src="js/libs/jquery/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/libs/three/three2.js"></script>
	<script type="text/javascript" src="js/libs/three/MTLLoader.js"></script>
	<script type="text/javascript" src="js/libs/three/OBJLoader.js"></script>
	<script type="text/javascript" src="js/libs/three/FBXLoader.js"></script>
	<script type="text/javascript" src="js/libs/three/inflate.min.js"></script>
	<script
	src="https://code.jquery.com/jquery-3.6.0.js"
	integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
	crossorigin="anonymous"
  ></script>
	<link rel="stylesheet" href="./modal.css">
	<link rel="stylesheet" href="./main.css">
	<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
	crossorigin="anonymous"
  />
	<script type="text/javascript">
	var hard = localStorage.getItem("hard");
	var storedTime = localStorage.getItem("time");
	var storedTimeInt = parseInt(storedTime);
	console.log(hard);
	
	var scene;
	var loader;
	var visibleSize;
	var controls;
	var objects = [];
	var objs = [];
	var mixers = [];
	var mixers_2=[];
	var clock;
	var deltaTime;	
	var keys = {};
	var cube;
	var jugadores = [];
	var enemies = [];
	var particleSystem;
	var particleSystem2;
	var particleCount = 1000;
	var particles;
	var reproducirParticulas = false;
	var reproducirParticulasSpell = false;
	var yaTerminamosLaClase = false;
	var contadorAnim = 0;
	var contadorAnimSpell = 0;
	var duracionParticula = 1;
	var duracionParticulaSpell = 0.1;
	var secondBB;
	var wall;
	var wall2;
	var wall3;
	var wall4;
	var playerIndex = [];
	var enemyRate = 0;
	var hasWon = false;
	var hasLost = false;
	var killedEnemies = 0;
	var isPaused = false;
	var playerSpeed = 7;
	var playerDamage = 1;
	var player1Health = 2;
	var player2Health = 2;
	var enemySpeed = 0.5;
	var enemyDamage = 1;
	var enemiesToKill = 4;
	var totalTime = 0;
	var isImmuneP1 = false;
	var isImmuneP2 = false;
	var maxAmountEnemies = 6;
	var hasItem = false;
	var itemHasSpawned = false;
	var isFollowing = false;
	var BBitem;

	if(hard == "true"){
		 enemyDamage = 2;
		 enemySpeed = 1.3;

	}else{
		enemyDamage = 1;
		enemySpeed = 0.9;

	}
	
	console.log("enemy dmg: "+enemyDamage);


	$(document).ready(function() {

		setupScene();

		render();

		document.addEventListener('keydown', onKeyDown);
		document.addEventListener('keyup', onKeyUp);		
	});

	function loadOBJWithMTL(path, objFile, mtlFile, onLoadCallback) {
		
	}

	function onKeyDown(event) {
		keys[String.fromCharCode(event.keyCode)] = true;
	}
	function onKeyUp(event) {
		keys[String.fromCharCode(event.keyCode)] = false;
	}

	function spawnParticulas(target) {

		// create the particle variables

		particles = new THREE.Geometry();

		var pMaterial = new THREE.PointsMaterial({
			color: 0xFFFFFF,
			size: 1,
			map: THREE.ImageUtils.loadTexture(
			"./imgs//smoke.png"
			),
			blending: THREE.AdditiveBlending,
			transparent: true
		});


		// now create the individual particles
		for (var p = 0; p < particleCount; p++) {

		// create a particle with random
		// position values, -250 -> 250
		var pX = getRandomArbitrary(target.x - 0.5, target.x + 0.5),
			pY = getRandomArbitrary(target.y - 0.5, target.y + 0.5),
			pZ = getRandomArbitrary(target.z - 0.5, target.z + 0.5),
			particle = new THREE.Vector3(pX, pY, pZ)
			
			// create a velocity vector
		particle.velocity = new THREE.Vector3(0, -Math.random(), 0);            

		particles.vertices.push(particle);
		}

		// create the particle system
		particleSystem = new THREE.Points(particles,pMaterial);

		particleSystem.sortParticles = true;
		particleSystem.material.opacity = 0.1;
		// add it to the scene
		scene.add(particleSystem);

	}

	function spawnParticulas2(target) {

			// create the particle variables

			particles = new THREE.Geometry();

			var pMaterial = new THREE.PointsMaterial({
				color: 0xFFFFFF,
				size: 1,
				map: THREE.ImageUtils.loadTexture(
				"./imgs//magic.png"
				),
				blending: THREE.AdditiveBlending,
				transparent: true
			});


			// now create the individual particles
			for (var p = 0; p < particleCount; p++) {

			// create a particle with random
			// position values, -250 -> 250
			var pX = getRandomArbitrary(target.x - 0.5, target.x + 0.5),
				pY = getRandomArbitrary(target.y - 0.5, target.y + 0.5),
				pZ = getRandomArbitrary(target.z - 0.5, target.z + 0.5),
				particle = new THREE.Vector3(pX, pY, pZ)
				
				// create a velocity vector
			particle.velocity = new THREE.Vector3(0, -Math.random(), 0);            

			particles.vertices.push(particle);
			}

			// create the particle system
			particleSystem2 = new THREE.Points(particles,pMaterial);

			particleSystem2.sortParticles = true;
			particleSystem2.material.opacity = 0.1;
			// add it to the scene
			scene.add(particleSystem2);

			}

	function getRandomArbitrary(min, max) {
	  return Math.random() * (max - min) + min;
	}


	
	function render() {
		requestAnimationFrame(render);
		deltaTime = clock.getDelta();	

		

		for(var i=0; i< jugadores.length; i++){
			jugadores[i].yaw =0;
			jugadores[i].forward = 0;

		}


		if(mixers.length>0){
			for(var i=0; i<mixers.length; i++){
				mixers[i].update(deltaTime);
			}

		}
	
		
		
		if (keys["A"]) {
			jugadores[0].yaw = 5;
		} else if (keys["D"]) {
			jugadores[0].yaw = -5;
		}
		if (keys["W"]) {
			jugadores[0].forward = -playerSpeed;
		} else if (keys["S"]) {
			jugadores[0].forward = playerSpeed;
		}

		if (keys["J"]) {
			jugadores[1].yaw = 5;
		} else if (keys["L"]) {
			jugadores[1].yaw = -5;
		}
		if (keys["I"]) {
			jugadores[1].forward = -playerSpeed;
		} else if (keys["K"]) {
			jugadores[1].forward = playerSpeed;
		}


		////DISPARAR

		if(keys["F"]&& canShootP1 == true){
			disparar(jugadores[0]);
			
		
			
		}

		if(keys["H"] && canShootP2 == true){
			dispararP2(jugadores[1]);

		}

		if(keys["P"] && isPaused == false){
				isPaused = true;

		} else if(keys["U"] && isPaused == true){
			isPaused = false;
		}

		
		if(isFollowing == false){
			isFollowing=true;
			followPlayer();
		}
            
		///FOLLOW PLAYER
		if(jugadores[0].isAlive && jugadores[1].isAlive){
		for(var i=0; i<enemies.length; i++){
		enemies[i].lookAt(jugadores[playerIndex[i]].position);
		enemies[i].translateZ(enemySpeed * deltaTime);
		}}

		for(var i=0; i<jugadores.length; i++){
			jugadores[i].rotation.y += jugadores[i].yaw * deltaTime;
			jugadores[i].translateZ(jugadores[i].forward * deltaTime);

			cameras[i].position.x = jugadores[i].position.x;
			cameras[i].position.z = jugadores[i].position.z + 10;

			cameras[i].lookAt(jugadores[i].position);

			renderers[i].render(scene, cameras[i]);
		
		}

		var wall1BB = new THREE.Box3().setFromObject(wall);
		var wall2BB = new THREE.Box3().setFromObject(wall2);
		var wall3BB = new THREE.Box3().setFromObject(wall3);
		var wall4BB = new THREE.Box3().setFromObject(wall4);
		var P1BB = new THREE.Box3().setFromCenterAndSize(jugadores[0].position, new THREE.Vector3( 1, 1, 1 ));
		var P2BB = new THREE.Box3().setFromCenterAndSize(jugadores[1].position, new THREE.Vector3( 1, 1, 1 ));
		 
		
		var playerCollision = P1BB.intersectsBox(P2BB);

		var P1wall1Collision = wall1BB.intersectsBox(P1BB);
		var P1wall2Collision = wall2BB.intersectsBox(P1BB);
		var P1wall3Collision = wall3BB.intersectsBox(P1BB);
		var P1wall4Collision = wall4BB.intersectsBox(P1BB);

		var P2wall1Collision = wall1BB.intersectsBox(P2BB);
		var P2wall2Collision = wall2BB.intersectsBox(P2BB);
		var P2wall3Collision = wall3BB.intersectsBox(P2BB);
		var P2wall4Collision = wall4BB.intersectsBox(P2BB);

		if(P1wall1Collision || P1wall2Collision  || P1wall3Collision  || P1wall4Collision || playerCollision){
			jugadores[0].translateZ(-(jugadores[0].forward * deltaTime));
		}

		if(P2wall1Collision || P2wall2Collision ||  P2wall3Collision  || P2wall4Collision  || playerCollision){
			jugadores[1].translateZ(-(jugadores[1].forward * deltaTime));
		}


		if(itemHasSpawned==true && hasItem == false){
			var itemP1Collision = P1BB.intersectsBox(BBitem);
			var itemP2Collision = P2BB.intersectsBox(BBitem);
			if(itemP1Collision || itemP2Collision){
				console.log("item");
				hasItem = true;
				playerDamage = 2;
				var item = scene.getObjectByName("item");
				scene.remove(item);
				
			}
		}


		//ENEMY COLLISION WITH PLAYER 1
		for(var j=0; j<enemies.length; j++){
			
			var enemyBB = new THREE.Box3().setFromCenterAndSize(enemies[j].position, new THREE.Vector3( 1, 1.5, 1 ));
			
		

			var enemyPlayer1Collision = P1BB.intersectsBox(enemyBB);
			var enemyPlayer2Collision = P2BB.intersectsBox(enemyBB);

			if(enemyPlayer1Collision && enemies[j].isAlive && isImmuneP1 == false && jugadores[0].isAlive == true){
				console.log("colision con enemigo");
				isImmuneP1 = true;
				jugadores[0].health = jugadores[0].health - enemyDamage;
				console.log("salud jugador 1: " + jugadores[0].health);
				jugadores[0].translateZ(-(jugadores[0].forward * deltaTime * 10));
				enemies[j].translateZ(-(enemySpeed * deltaTime* 80));
				decreasePlayer1Health();
				
			}

			if(enemyPlayer2Collision && enemies[j].isAlive && isImmuneP2 == false && jugadores[1].isAlive == true){
				console.log("colision con enemigo");
				isImmuneP2 = true;
				jugadores[1].health = jugadores[1].health - enemyDamage;
				console.log("salud jugador 2: " + jugadores[1].health);
				jugadores[1].translateZ(-(jugadores[1].forward * deltaTime * 10));
				enemies[j].translateZ(-(enemySpeed * deltaTime* 80));
				decreasePlayer2Health();
			}

		}

		
		
		if(reproducirParticulas == false){
			for(var i=0; i<balas.length; i++){

				for(var j=0; j<enemies.length; j++){
				
				if(balas[i].isAlive){
				balas[i].translateZ(velocidadBala * deltaTime);
				

				var firstBB = new THREE.Box3().setFromObject(balas[i]);
				secondBB = new THREE.Box3().setFromCenterAndSize(enemies[j].position, new THREE.Vector3( 1, 1, 1 ));
				var collision = firstBB.intersectsBox(secondBB);

				//  var helper = new THREE.Box3Helper( secondBB, 0xffff00 );
		 		//  scene.add(helper);
			

				if(collision && enemies[j].isAlive){
						balas[i].isAlive = false;
						
					
						enemies[j].health = enemies[j].health - playerDamage;

						if(enemies[j].health <= 0){
							spawnItem();
							
							enemies[j].isAlive = false;
							reproducirParticulas = true;
						spawnParticulas(balas[i].position);
						
						scene.remove(enemies[j]);
						killedEnemies++;
						
						console.log("mataste al enemigo " + j);
						}
					
						console.log(enemies[j].health)
					console.log("le diste al enemigo " + j);
					scene.remove(balas[i]);
					
					
					
								
					
					
				}
			}

			
				}
			}
		}

		for(var i=0; i<balas.length; i++){

			if(balas[i].isAlive && reproducirParticulasSpell==false){

			reproducirParticulasSpell = true;
			spawnParticulas2(balas[i].position);

			}


		}

		

		if(reproducirParticulasSpell && reproducirParticulas == false){

		contadorAnimSpell += deltaTime;
		particleSystem2.material.opacity += 0.01;

		if (contadorAnimSpell > duracionParticulaSpell) {
			
			contadorAnimSpell = 0;

			scene.remove(particleSystem2);
			reproducirParticulasSpell = false;
			
		}

		}

			
		if (reproducirParticulas) {
			
			contadorAnim += deltaTime;
			particleSystem.rotation.y += 0.01;
			particleSystem.material.opacity += 0.01;

			if (contadorAnim > duracionParticula) {
				
				contadorAnim = 0;

				scene.remove(particleSystem);
				reproducirParticulas = false;
			}
		
		}


		

		if(killedEnemies >= enemiesToKill && hasWon == false){
			hasWon = true;
			
			document.getElementById('id01').style.display='block';
			totalTime = clock.elapsedTime;
			
	
			totalTime = Math.round(totalTime);
			totalTime = totalTime + storedTimeInt;
			console.log("tiempo: " + totalTime);
			localStorage.setItem('time', totalTime);
			
		}

		if(hasWon){
			clock.running = false;
		}

	
	
	
		if(isPaused){
		
			document.getElementById('pauseMenu').style.display='block';
			
			
			clock.running = false;

			
			
			
		}else if(isPaused == false){
			document.getElementById('pauseMenu').style.display='none';
			
			
			
		}


		if(jugadores[0].health <=0 ){
			scene.remove(jugadores[0]);
			jugadores[0].isAlive = false;
			canShootP1 = false;
			for(var i=0; i<enemies.length; i++){
		enemies[i].lookAt(jugadores[1].position);
		enemies[i].translateZ(enemySpeed * deltaTime);
		}
		}

		if(jugadores[1].health <=0 ){
			scene.remove(jugadores[1]);
			jugadores[1].isAlive = false;
			canShootP2 = false;
			for(var i=0; i<enemies.length; i++){
		enemies[i].lookAt(jugadores[0].position);
		enemies[i].translateZ(enemySpeed * deltaTime);
		}
			
		}

		if(jugadores[1].health <= 0 && jugadores[0].health <=0 ){
			hasLost = true;
		}

		if(hasLost == true){
			document.getElementById('gameOver').style.display='block';
		}

		

		//console.log(enemyRate * deltaTime);
		enemyRate = enemyRate + 1.5;

		if((enemyRate*deltaTime >= 10) && enemies.length < maxAmountEnemies){
			createEnemy();
			enemyRate = 0;
		}

		 
		
			

	} 	//TERMINA RENDER()



	var velocidadBala = -10;

	var cameras = [];

	function crearCamara(){
		camera = new THREE.PerspectiveCamera(75, visibleSize.width / visibleSize.height, 0.1, 100);
		
		camera.yaw = 0;
		camera.forward = 0;

		cameras.push(camera);

	}

	function followPlayer(){

		
		for(var i=0; i<enemies.length; i++){

		playerIndex[i] = Math.floor( getRandomArbitrary(0,2));
					
		console.log(playerIndex[i]);
		}
		

		

		
	}

	

	

	function spawnItem(){
		if(killedEnemies == 1 && itemHasSpawned == false){
			itemHasSpawned = true;
			loader.load('assets/sword.fbx',function(rayo){

				rayo.scale.set(0.3,0.3,0.3);

			rayo.position.x = 0
			rayo.position.z = 0
			rayo.position.y = 0;

			rayo.name = "item";

			console.log(rayo.position);

		
			scene.add(rayo);
			BBitem = new THREE.Box3().setFromObject(rayo);

			});
		}
	}

	function createEnemy(){
		var enemyMaterial = new THREE.MeshLambertMaterial({color: new THREE.Color(0.0,0.5,0.0)});
		var enemyGeometry =  new THREE.BoxGeometry(1,1,1);
		enemy = new THREE.Mesh(enemyGeometry, 0);
		enemy.position.x =  getRandomArbitrary(5,20);
		enemy.position.z =  getRandomArbitrary(5,20);
		enemy.isAlive = true;
		enemy.health = 2;
		
		
		enemies.push(enemy);
		scene.add(enemies[enemies.length-1]);

		loader.load('assets/CorrerInPlace.fbx',function(skeleton){

			skeleton.mixer =  new THREE.AnimationMixer(skeleton);

			mixers.push(skeleton.mixer);

			var action = skeleton.mixer.clipAction(skeleton.animations[0]);
			action.play();
			
			

			

			
			skeleton.scale.set(0.05,0.05,0.05);
			
			enemies[enemies.length-1].add(skeleton);
			

			

			

			});

			

		followPlayer();
	
	}

	balas = [];
	var canShootP1 = true;
	var canShootP2 = true;
	

	function decreasePlayer1Health(){
				setTimeout(() => {
			
					isImmuneP1 = false;
			
			}, 2000); 

	}

	function decreasePlayer2Health(){
		setTimeout(() => {
			
			isImmuneP2 = false;
	
	}, 2000); 


	}



	function disparar(jugador){

		

		var balaGeometry = new THREE.SphereGeometry(0.3, 32, 32);
		var material =  new THREE.MeshBasicMaterial({color: new THREE.Color(0,0,1)});
		var bala = new THREE.Mesh(balaGeometry,material);

		bala.position.x = jugador.position.x;
		bala.position.y = jugador.position.y;
		bala.position.z = jugador.position.z;

		bala.rotation.x = jugador.rotation.x;
		bala.rotation.y = jugador.rotation.y;
		bala.rotation.z = jugador.rotation.z;

		bala.isAlive = true;

		balas.push(bala);

		scene.add(bala);

		canShootP1 = false;
		setTimeout(() => {
  
			canShootP1 = true;
			bala.isAlive = false;
			scene.remove(bala);
            
		}, 1000); 


	}

	function dispararP2(jugador){

		var balaGeometry = new THREE.SphereGeometry(0.3, 32, 32);
		var material =  new THREE.MeshBasicMaterial({color: new THREE.Color(0,0,1)});
		var bala = new THREE.Mesh(balaGeometry,material);

		bala.position.x = jugador.position.x;
		bala.position.y = jugador.position.y;
		bala.position.z = jugador.position.z;

		bala.rotation.x = jugador.rotation.x;
		bala.rotation.y = jugador.rotation.y;
		bala.rotation.z = jugador.rotation.z;

		bala.isAlive = true;
		balas.push(bala);

		scene.add(bala);

		canShootP2 = false;
		setTimeout(() => {

			canShootP2 = true;
			bala.isAlive = false;
			scene.remove(bala);
			
		}, 1000); 



		}

	

	var renderers = [];

	function crearRenderer(clearColor){

		
		var renderer = new THREE.WebGLRenderer( {precision: "mediump" } );
		renderer.setClearColor(clearColor);

		renderer.setPixelRatio((visibleSize.width/2) / visibleSize.height);
		renderer.setSize(visibleSize.width/2, visibleSize.height);

		renderers.push(renderer);

	}


	function setupScene() {		
		visibleSize = { width: window.innerWidth, height: window.innerHeight};
		clock = new THREE.Clock();		
		scene = new THREE.Scene();

		crearCamara();
		crearCamara();

		crearRenderer(new THREE.Color(0,0,0));
		crearRenderer(new THREE.Color(0,0,0));

		var ambientLight = new THREE.AmbientLight(new THREE.Color(1, 1, 1), 1.0);
		scene.add(ambientLight);

		var directionalLight = new THREE.DirectionalLight(new THREE.Color(1, 1, 0), 0.4);
		directionalLight.position.set(0, 0, 1);
		scene.add(directionalLight);

		var grid = new THREE.GridHelper(100, 30, 0xffffff, 0xffffff);
		grid.position.y = -1;
		//scene.add(grid);

		
		loader = new THREE.FBXLoader();


		


	


	


		
	

		// loader.load('assets/medkit.fbx',function(medkit){

		// 	medkit.position.z = -10;
		// 	medkit.position.x = 42;
		// 	medkit.position.y = 0;

		// 	medkit.scale.set(0.2,0.2,0.2);



		// 	scene.add(medkit);

		// });

		

		// loader.load('assets/sword.fbx',function(espada){

		// 	espada.position.z = -10;
		// 	espada.position.x = 44;
		// 	espada.position.y = -0.4;

		// 	espada.scale.set(0.2,0.2,0.2);



		// 	scene.add(espada);

		// });

		

		var cubeMaterial = new THREE.MeshLambertMaterial({color: new THREE.Color(0.0,0.0,0.5)});
		var cubeGeometry =  new THREE.BoxGeometry(1,1,1);
		var jugador1 = new THREE.Mesh(cubeGeometry, 0);
		
		var wallMaterial = new THREE.MeshLambertMaterial({color: new THREE.Color(0.0,0.5,0.5)});
		
		var wallGeometry =  new THREE.BoxGeometry(150,1,1);
	
		 wall = new THREE.Mesh(wallGeometry,0 );
		 wall2 = new THREE.Mesh(wallGeometry, 0);
		 wall3 = new THREE.Mesh(wallGeometry, 0);
		 wall4 = new THREE.Mesh(wallGeometry, 0);

		wall.position.z = -41;
		wall.position.x= -20;
		scene.add(wall);

		
		
		
		scene.add(wall2);

		wall2.rotation.y = THREE.Math.degToRad(90);
		wall2.position.x = 28;

		scene.add(wall3);
		wall3.rotation.y = THREE.Math.degToRad(90);
		wall3.position.x = -36;


		scene.add(wall4);
		wall4.position.z = 30;
		
		scene.add(jugador1);

		var jugador2 = jugador1.clone();
		//jugador2.material =  new THREE.MeshLambertMaterial({color: new THREE.Color(0.5,0.0,0.0)});

		
		scene.add(jugador2);

		jugador1.health = 2;
		jugador2.health = 2;

		jugador1.isAlive = true;
		jugador2.isAlive = true;
		
		jugador1.name = "jugador1";

		jugador1.position.x =jugador1.position.x - 10;
		jugador2.position.x =jugador2.position.x - 5;
	

		jugadores.push(jugador1);
		jugadores.push(jugador2);


		cameras[0].position.y = 10;
		cameras[1].position.y = 10;

		console.log(jugadores[0].name);

		
		loader.load('assets/Corriendo.fbx',function(wizardRunning){

		wizardRunning.mixer =  new THREE.AnimationMixer(wizardRunning);

		mixers.push(wizardRunning.mixer);

		var action = wizardRunning.mixer.clipAction(wizardRunning.animations[0]);
		action.play();

		wizardRunning.scale.set(0.04,0.04,0.04);
		wizardRunning.rotation.y = THREE.Math.degToRad(180);

		
		
			jugadores[0].add(wizardRunning);

		});

		loader.load('assets/runInPlace.fbx',function(redWizardRunning){

			redWizardRunning.mixer =  new THREE.AnimationMixer(redWizardRunning);

			mixers.push(redWizardRunning.mixer);

			var action = redWizardRunning.mixer.clipAction(redWizardRunning.animations[0]);
			action.play();

			redWizardRunning.scale.set(0.04,0.04,0.04);
			redWizardRunning.rotation.y = THREE.Math.degToRad(180);

			

				jugadores[1].add(redWizardRunning);

			});


			
			loader.load('assets/test2.fbx',function(escenario){

				escenario.position.z = -20;
				escenario.position.x = 10;
				escenario.position.y = 7;

				escenario.scale.set(0.05,0.05,0.05);



				scene.add(escenario);

			});
						
		
		
		
		//followPlayer();

		$("#scene-section").append(renderers[0].domElement);
		$("#scene-section-2").append(renderers[1].domElement);
		

	} // TERMINA SETUP


	</script>
</head>

<body>

	<div style="display: flex; height: 100px;"> 
	<div style="width: 50%;" id="scene-section"></div>
	<div style="flex-grow: 1" id="scene-section-2"></div>
	</div>

	

<div id="id01" class="modal">
 
  <form class="modal-content" action="./escena3MP.php">
    <div class="container">
      <h1>Has superado el nivel!</h1>
      <p>Presiona el boton para seguir con tu aventura:</p>

      <div class="clearfix">
        <button type="submit" class="cancelbtn">Continuar</button>
      </div>
    </div>
  </form>
</div>

<div id="gameOver" class="modal">
	
	<form class="modal-content" action="./index.php">
	  <div class="container">
		<h1>GAME OVER</h1>
		<p>Presiona el boton para volver al menu principal:</p>
  
		<div class="clearfix">
		  <button type="submit" class="cancelbtn">Menu Principal</button>
		</div>
	  </div>
	</form>
  </div>


        
	<div id="pauseMenu" class="modal">
	
		<form class="modal-content" action="./escena2MP.php">
		  <div class="container">
			<h1>PAUSA</h1>
			
			</div>
		  </div>
		</form>
	  </div>
 
	

</body>
<script>
	
	</script>
</html>