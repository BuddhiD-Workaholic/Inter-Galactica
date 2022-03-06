/**
 * Select the Canavs element form the HTML and Setting it to 2D
 */
const canvas = document.querySelector('canvas')
const c = canvas.getContext('2d')
//Canvas Width and Height
canvas.width = document.getElementById("main").clientWidth
canvas.height = document.getElementById("main").clientHeight
/**
 * Selecting different elements
 */
const scoreEl = document.querySelector('#scoreEl')
const startGameBtn = document.querySelector('#startGameBtn')
const modalEl = document.querySelector('#modalEl')
const bigScoreEl = document.querySelector('#bigScoreEl')
const soundOffEl = document.querySelector('#soundOffEl')
const soundOnEl = document.querySelector('#soundOnEl')
/**
 * Audio Files Manage with Howler functions
*/
const shootAudio = new Howl({ src: ['./audio/shoot.mp3'] })
const enemyHitAudio = new Howl({ src: ['./audio/enemyHit.mp3'] })
const enemyEliminatedAudio = new Howl({ src: ['./audio/enemyEliminated.mp3'] })
Howler.volume(0.1);


const scene = {
  active: false
}

const friction = 0.99;
let player
let projectiles = []
let enemies = []
let particles = []
let backgroundParticles = []

function init() {
  const x = canvas.width / 2
  const y = canvas.height / 2
  player = new Player(x, y, 20, 'yellow')
  projectiles = []
  enemies = []
  particles = []
  backgroundParticles = []

  for (let x = 0; x < canvas.width; x += 30) {
    for (let y = 0; y < canvas.height; y += 30) {
      backgroundParticles.push(new BackgroundParticle(x, y, 3, 'blue'))
    }
  }
}

function spawnEnemies() {
  const radius = Math.random() * 30; 
  let x;
  let y;

  if (Math.random() < 0.5) {
    x = Math.random() < 0.5 ? 0 - radius : canvas.width + radius
    y = Math.random() * canvas.height
  } else {
    x = Math.random() * canvas.width
    y = Math.random() < 0.5 ? 0 - radius : canvas.height + radius
  }

  const color = `hsl(${Math.random() * 360}, 50%, 50%)`
  const angle = Math.atan2(canvas.height / 2 - y, canvas.width / 2 - x)
  const velocity = {x: Math.cos(angle),y: Math.sin(angle)}
  enemies.push(new Enemy(x, y, radius, color, velocity))
}

/**
 * Score Updation
 * @param {*} projectile 
 * @param {*} score 
 */
function createScoreLabel(projectile, score) {
  const scoreLabel = document.createElement('label')
  scoreLabel.innerHTML = score
  scoreLabel.style.position = 'absolute'
  scoreLabel.style.color = 'white'
  scoreLabel.style.userSelect = 'none'
  scoreLabel.style.left = projectile.x + 'px'
  scoreLabel.style.top = projectile.y + 'px'
  document.body.appendChild(scoreLabel)

  //Gsap01
  gsap.to(scoreLabel, {
    opacity: 0,
    y: -30,
    duration: 0.75,
    onComplete: () => {
      scoreLabel.parentNode.removeChild(scoreLabel)
    }
  })
}

let animationId
let score = 0
let frame = 0

/**
 * Animate Function --> Main Function 
 */
function animate() {
  animationId = requestAnimationFrame(animate)
  frame++
  c.fillStyle = 'rgba(0, 0, 0, 0.1)'
  c.fillRect(0, 0, canvas.width, canvas.height)

  if (frame % 70 === 0) spawnEnemies()

  backgroundParticles.forEach((backgroundParticle) => {
    const dist = Math.hypot(
      player.x - backgroundParticle.x,
      player.y - backgroundParticle.y
    )

    const hideRadius = 100
    if (dist < hideRadius) {
      if (dist < 70) {
        backgroundParticle.alpha = 0
      } else {
        backgroundParticle.alpha = 0.5
      }
    } else if (
      dist >= hideRadius &&
      backgroundParticle.alpha < backgroundParticle.initialAlpha
    ) {
      backgroundParticle.alpha += 0.01
    } else if (
      dist >= hideRadius &&
      backgroundParticle.alpha > backgroundParticle.initialAlpha
    ) {
      backgroundParticle.alpha -= 0.01
    }

    backgroundParticle.update()
  })

  player.update()
  particles.forEach((particle, index) => {
    if (particle.alpha <= 0) {
      particles.splice(index, 1)
    } else {
      particle.update()
    }
  })

  projectiles.forEach((projectile, index) => {
    projectile.update()

    // remove from edges of screen
    if (
      projectile.x + projectile.radius < 0 ||
      projectile.x - projectile.radius > canvas.width ||
      projectile.y + projectile.radius < 0 ||
      projectile.y - projectile.radius > canvas.height
    ) {
      setTimeout(() => {
        projectiles.splice(index, 1)
      }, 0)
    }
  })

  enemies.forEach((enemy, index) => {
    enemy.update()

    const dist = Math.hypot(player.x - enemy.x, player.y - enemy.y)
    // end game
    if (dist - enemy.radius - player.radius < 1) {
      cancelAnimationFrame(animationId)
      modalEl.style.display = 'flex'
      bigScoreEl.innerHTML = score
      scene.active = false

      //Gsap02
      gsap.to('#whiteModalEl', {
        opacity: 1,
        scale: 1,
        duration: 0.45,
        ease: 'expo'
      })
    }

    projectiles.forEach((projectile, projectileIndex) => {
      const dist = Math.hypot(projectile.x - enemy.x, projectile.y - enemy.y)

      // hit enemy
      // when projectiles touch enemy
      if (dist - enemy.radius - projectile.radius < 0.03) {
        // create explosions
        for (let i = 0; i < enemy.radius * 2; i++) {
          particles.push(
            new Particle(
              projectile.x,
              projectile.y,
              Math.random() * 2,
              enemy.color,
              {
                x: (Math.random() - 0.5) * (Math.random() * 6),
                y: (Math.random() - 0.5) * (Math.random() * 6)
              }
            )
          )
        }

        // shrink enemy
        if (enemy.radius - 10 > 5) {
          // enemyHitAudio.play()

          // increase our score
          score += 100
          scoreEl.innerHTML = score

          createScoreLabel(projectile, 100)

          //Gsap03
          gsap.to(enemy, {
            radius: enemy.radius - 10
          })
          setTimeout(() => {
            projectiles.splice(projectileIndex, 1)
          }, 0)
        } else {
          // eliminate enemy
          enemyEliminatedAudio.play()

          // remove from scene altogether
          score += 250
          scoreEl.innerHTML = score
          createScoreLabel(projectile, 250)

          setTimeout(() => {
            const enemyFound = enemies.find((enemyValue) => {
              return enemyValue === enemy
            })

            if (enemyFound) {
              enemies.splice(index, 1)
              projectiles.splice(projectileIndex, 1)
            }
          }, 0)
        }
      }
    })
  })
}

/**
 * Mouse Events
 */
const mouse = {
  down: false,
  x: undefined,
  y: undefined
}

const element = document.querySelector('#main');

element.addEventListener('mousedown', ({ clientX, clientY }) => {
  mouse.x = clientX
  mouse.y = clientY
  mouse.down = true
})

element.addEventListener('mousemove', ({ clientX, clientY }) => {
  mouse.x = clientX
  mouse.y = clientY
})

element.addEventListener('mouseup', () => {
  mouse.down = false
})

element.addEventListener('touchstart', (event) => {
  mouse.x = event.touches[0].clientX
  mouse.y = event.touches[0].clientY

  mouse.down = true
})

element.addEventListener('touchmove', (event) => {
  mouse.x = event.touches[0].clientX
  mouse.y = event.touches[0].clientY
})

element.addEventListener('touchend', () => {
  mouse.down = false
})

/**
 * Add event Listener for Mouse clicks
 * From the event object it returns, The function takes only { clientX, clientY } cordinates and calls the the Player class shoot method
 */
element.addEventListener('click', ({ clientX, clientY }) => {
  if (scene.active !== 'Automatic') {
    mouse.x = clientX
    mouse.y = clientY
    player.shoot(mouse)
  }
})

addEventListener('resize', () => {
  canvas.width = document.getElementById("main").clientWidth;
  canvas.height = document.getElementById("main").clientHeight;
  init()
})

startGameBtn.addEventListener('click', () => {
  init()
  animate()
  scene.active = true

  score = 0
  scoreEl.innerHTML = score
  bigScoreEl.innerHTML = score
  //Gsap05
  gsap.to('#whiteModalEl', {
    opacity: 0,
    scale: 0.75,
    duration: 0.25,
    ease: 'expo.in',
    onComplete: () => {
      modalEl.style.display = 'none'
    }
  })
})

addEventListener('keydown', ({ keyCode }) => {
  if (keyCode === 87) {
    player.velocity.y -= 1
  } else if (keyCode === 65) {
    player.velocity.x -= 1
  } else if (keyCode === 83) {
    player.velocity.y += 1
  } else if (keyCode === 68) {
    player.velocity.x += 1
  }

  switch (keyCode) {
    case 37:
      player.velocity.x -= 1
      break
    case 40:
      player.velocity.y += 1
      break
    case 39:
      player.velocity.x += 1
      break
    case 38:
      player.velocity.y -= 1
      break
  }
})

//Sounds
soundOffEl.addEventListener('click', () => {
  Howler.mute(true);
  soundOnEl.style.display = 'block';
  soundOffEl.style.display = 'none';
})

soundOnEl.addEventListener('click', () => {
  Howler.mute(false);
  soundOnEl.style.display = 'none';
  soundOffEl.style.display = 'block';
})


/**
 * Math API class 
 */
const getMATHQuetions = async () => {
  try {
    let url = "https://math-api-app.herokuapp.com/getmath";
    const resp = await axios.get(url);
    return resp.data;
  } catch (err) {
    console.log(err);
    return (err);
  }
}

async function MATHQuestion(time, titile) {
  getMATHQuetions().then(response => {
    const question = response.MathAPI.question;
    const answer = Math.round(response.MathAPI.answer);
    console.log(answer)
    swal({
      title: `${titile}`,
      text: `Your Quetions is: ${question}`,
      content: "input",
      timer: time,
    }).then((value) => {
      if (value == answer) {
        swal("Good job!", "Your answer is Correct!", "success");
      } else if (value == null) {
        swal("We are Sorry!", "Your time is Up!", "error");
      } else {
        swal("We are Sorry!", "Your answer is Wrong!", "error");
      }
    });
  })
}

/**
 * Progress bar 
 * https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_progressbar_labels_js
 */
function Health() {
  var elem = document.getElementById("myBar");
  var width = 20;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++;
      elem.style.width = width + '%';
      elem.innerHTML = width * 1 + '%';
    }
  }
}

function Xp() {
  var elem = document.getElementById("myBar");
  var width = 20;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++;
      elem.style.width = width + '%';
      elem.innerHTML = width * 1 + '%';
    }
  }
}