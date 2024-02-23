const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");

const sliderMass = document.getElementById("mass");
const outputMass = document.getElementById("massVal");
outputMass.innerHTML = sliderMass.value;

const sliderLen = document.getElementById("lenght");
const outputLen = document.getElementById("lenVal");
outputLen.innerHTML = sliderLen.value;

const sliderGravity = document.getElementById("gravity");
const outputGravity = document.getElementById("gravityVal");
outputGravity.innerHTML = sliderGravity.value;

const dampingCheck = document.getElementById("dampingCheck");

var mass = sliderMass.value;
var g = sliderGravity.value;
var length = sliderLen.value;
var dampingFactor = dampingCheck.checked ? 0.9 : 1;
var angle = Math.PI / 4;
var angleVelocity = 0;

sliderMass.oninput = function () {
    outputMass.innerHTML = this.value;
    mass = parseInt(this.value);
}

sliderLen.oninput = function () {
    outputLen.innerHTML = this.value;
    length = parseInt(this.value);
}

sliderGravity.oninput = function () {
    outputGravity.innerHTML = this.value;
    g = parseFloat(this.value);
}

dampingCheck.oninput = function () {
    dampingFactor = dampingCheck.checked ? 0.9 : 1;
    if(!dampingCheck.checked)
    {
        angle = Math.PI / 4;
        angleVelocity = 0;
    }
}

function loadParams(newMass, newLen, newG)
{
    sliderMass.value = parseInt(newMass);
    outputMass.innerHTML = newMass;
    mass = parseInt(newMass);
    sliderLen.value = parseInt(newLen);
    outputLen.innerHTML = newLen;
    length = parseInt(newLen);
    sliderGravity.value = parseFloat(newG);
    outputGravity.innerHTML = newG;
    g = parseFloat(newG);
}

function drawPendulum() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    const pivotX = canvas.width / 2;
    const pivotY = 50;

    const ballX = pivotX + length * Math.sin(angle);
    const ballY = pivotY + length * Math.cos(angle);

    ctx.beginPath();
    ctx.moveTo(pivotX, pivotY);
    ctx.lineTo(ballX, ballY);
    ctx.strokeStyle = '#FFFFFF';
    ctx.stroke();

    ctx.beginPath();
    ctx.arc(ballX, ballY, mass, 0, 2 * Math.PI);
    ctx.fillStyle = '#FFFFFF';
    ctx.fill();
}

function animatePendulum() {
    const gravityTorque = -mass * g * length * Math.sin(angle);
    const dampingTorque = -0.1 * angleVelocity; 
    const torque = gravityTorque + dampingTorque;

    const angularAcceleration = torque / (mass * length * length);
    angleVelocity += angularAcceleration;
    angle += angleVelocity;

    angleVelocity *= dampingFactor;

    drawPendulum();
    setTimeout(() => {
        requestAnimationFrame(animatePendulum);
    }, 25);
}

animatePendulum();