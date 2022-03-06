class Player {
    /**
     * The constructor initialization
     * @param {x cordinates} x 
     * @param {y Cordinates} y 
     * @param {*} radius 
     * @param {*} color 
     * @param {*} health 
     */
    constructor(x, y, radius, color, health) {
        this.x = x
        this.y = y
        this.radius = radius
        this.color = color
        this.health=health
        this.velocity = {
            x: 0,
            y: 0
        }
        this.friction = 0.99
    }

    draw() {
        c.beginPath()
        c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false)
        c.fillStyle = this.color
        c.fill()
    }

    update() {
        this.draw()
        this.velocity.x *= this.friction
        this.velocity.y *= this.friction

        if (
            this.x - this.radius + this.velocity.x > 0 &&
            this.x + this.radius + this.velocity.x < canvas.width
        ) {
            this.x = this.x + this.velocity.x
        } else {
            this.velocity.x = 0
        }

        if (
            this.y - this.radius + this.velocity.y > 0 &&
            this.y + this.radius + this.velocity.y < canvas.height
        ) {
            this.y = this.y + this.velocity.y
        } else {
            this.velocity.y = 0
        }
        this.x = this.x + this.velocity.x
        this.y = this.y + this.velocity.y
    }

    shoot(mouse, color = 'white') {
        const angle = Math.atan2(mouse.y - this.y, mouse.x - this.x)
        const velocity = {
            x: Math.cos(angle) * 6,
            y: Math.sin(angle) * 6
        }
        projectiles.push(new Projectile(this.x, this.y, 5, color, velocity))
        shootAudio.play()
    }
}