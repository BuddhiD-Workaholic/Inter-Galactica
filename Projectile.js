class Projectile {
    /**
     * Constructor is initalize
     * @param {x cordinates} x 
     * @param {y cordinates} y 
     * @param {*} radius 
     * @param {*} color 
     * @param {velocity is added since the projectiles are moving} velocity 
     */
    constructor(x, y, radius, color, velocity) {
        this.x = x
        this.y = y
        this.radius = radius
        this.color = 'yellow'
        this.velocity = velocity
    }

    draw() {
        c.beginPath()
        c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false)
        c.fillStyle = this.color
        c.fill()
    }

    update() {
        this.draw()
        this.x = this.x + this.velocity.x
        this.y = this.y + this.velocity.y
    }
}
