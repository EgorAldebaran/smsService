 class Prototype
{
    fire() {
	console.log ('---fire---')
    }
}

class Object
{
    sfira() {
	console.log ('---just object---')
    }
}

class Unit
{
    constructor() {
	this.object = new Object;
	this.prototype = new Prototype; 
    }

    start() {
	this.object.sfira()
	this.prototype.fire()
    }
}


const unit = new Unit;
unit.start()
