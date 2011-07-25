/**
 * Abandon hope all ye who enter here
 *
 * This code is pretty rough as it's just an Easter egg. Reading it, you might
 * learn something, or you might go insane. There are many ugly hacks.
 *
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2010 Mozilla Corporation
 * @license   http://www.mozilla.org/MPL/ Mozilla Public License
 */
(function() {

var Scene = function(gl, width, height)
{
	this.gl           = gl;
	this.models       = [];
	this.shaders      = [];
	this.textures     = [];
	this.w            = width;
	this.h            = height;
	this.clearDepth   = 1.0;

	this.angle        = 0;

	this.setClearColor(1.0, 1.0, 1.0, 1.0);

	this.pMatrix  = new J3DIMatrix4();
	this.mvMatrix = new J3DIMatrix4();
	this.nMatrix  = new J3DIMatrix4();

	this.refreshRate   = 30;
	this.interval      = null;
	this.startTime     = null;
	this.lastFrameTime = null;
}

Scene.getGLContext = function(canvas)
{
	var gl = null;

	try {
		gl = canvas.getContext('webgl');
	} catch (e) {
	}

	if (!gl) {
		try {
			gl = canvas.getContext('experimental-webgl');
		} catch (e) {
		}
	}

	if (typeof WebGLDebugUtils !== 'undefined') {
		gl = WebGLDebugUtils.makeDebugContext(gl);
	}

	return gl;
}

Scene.prototype.addModel = function(model)
{
	this.models.push(model);
	return this;
}

Scene.prototype.addShader = function(shader)
{
	this.shaders.push(shader);
	return this;
}

Scene.prototype.addTexture = function(texture)
{
	this.textures.push(texture);
	return this;
}

Scene.prototype.setRefreshRate = function(rate)
{
	this.refreshRate = rate;

	if (this.interval) {
		clearInterval(this.interval);
		var that = this;
		this.interval = window.setInterval(
			function () { that.draw() },
			this.refreshRate
		);
	}
}

Scene.prototype.initShaders = function()
{
	var fs = new Scene.Shader(this.gl, this.gl.FRAGMENT_SHADER);
	fs.setSource(
		  "#ifdef GL_ES\n"
		+ "    precision highp float;\n"
		+ "#endif\n"
		+ "varying vec3 vLightWeighting;\n"
		+ "varying vec2 vTextureCoord;\n"
		+ "uniform sampler2D uSampler;\n"
		+ "void main(void) {\n"
		+ "    gl_FragColor = texture2D(uSampler, vec2(vTextureCoord.s, vTextureCoord.t)) * vec4(vLightWeighting, 1.0);\n"
		+ "}\n"
	);
	this.addShader(fs);

	var vs = new Scene.Shader(this.gl, this.gl.VERTEX_SHADER);
	vs.setSource(
		  "attribute vec3 aVertexPosition;\n"
		+ "attribute vec3 aVertexNormal;\n"
		+ "attribute vec2 aTextureCoord;\n"
		+ "uniform mat4 uMVMatrix;\n"
		+ "uniform mat4 uPMatrix;\n"
		+ "uniform mat4 uNMatrix;\n"
		+ "uniform vec3 uAmbientColor;\n"
		+ "uniform vec3 uLightingDirection;\n"
		+ "uniform vec3 uDirectionalColor;\n"
		+ "varying vec3 vLightWeighting;\n"
		+ "varying vec2 vTextureCoord;\n"
		+ "void main(void) {\n"
		+ "    gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition, 1.0);\n"
		+ "    vec4 transformedNormal = uNMatrix * vec4(aVertexNormal, 1.0);\n"
		+ "    float directionalLightWeighting = max(dot(transformedNormal.xyz, uLightingDirection), 0.0);\n"
		+ "    vLightWeighting = uAmbientColor + uDirectionalColor * directionalLightWeighting;\n"
		+ "    vTextureCoord = aTextureCoord;\n"
		+ "}\n"
	);
	this.addShader(vs);

	this.shaderProgram = this.gl.createProgram();
	for (var i = 0; i < this.shaders.length; i++) {
		this.gl.attachShader(this.shaderProgram, this.shaders[i].shader);
	}
	this.gl.linkProgram(this.shaderProgram);
	if (!this.gl.getProgramParameter(this.shaderProgram, this.gl.LINK_STATUS)) {
		return false;
	}
	this.gl.useProgram(this.shaderProgram);

	this.gl.enableVertexAttribArray(0);
	this.gl.enableVertexAttribArray(1);
	this.gl.enableVertexAttribArray(2);

	this.pMatrixLocation  = this.gl.getUniformLocation(
		this.shaderProgram,
		'uPMatrix'
	);

	this.mvMatrixLocation = this.gl.getUniformLocation(
		this.shaderProgram,
		'uMVMatrix'
	);

	this.nMatrixLocation = this.gl.getUniformLocation(
		this.shaderProgram,
		'uNMatrix'
	);

	this.ambientColorUniform = this.gl.getUniformLocation(
		this.shaderProgram,
		'uAmbientColor'
	);

	this.lightingDirectionUniform = this.gl.getUniformLocation(
		this.shaderProgram,
		'uLightingDirection'
	);

	this.directionalColorUniform = this.gl.getUniformLocation(
		this.shaderProgram,
		'uDirectionalColor'
	);

	this.samplerUniform = this.gl.getUniformLocation(
		this.shaderProgram,
		'uSampler'
	);
}

Scene.prototype.setClearColor = function(red, green, blue, alpha)
{
	this.clearColor = [red, green, blue, alpha];
	this.gl.clearColor(
		this.clearColor[0],
		this.clearColor[1],
		this.clearColor[2],
		this.clearColor[3]
	);
}

Scene.prototype.init = function()
{
	if (!this.gl) {
		return;
	}

	this.initShaders();

	this.gl.clearDepth(this.clearDepth);
	this.gl.depthFunc(this.gl.LEQUAL);
	this.gl.enable(this.gl.DEPTH_TEST);

	this.gl.viewport(0, 0, this.w, this.h);

	this.pMatrix.perspective(30, this.w / this.h, 1, 10000);
	this.pMatrix.lookat(0, 0, 2570, 0, 0, 0, 0, 1, 0);
}

Scene.prototype.draw = function()
{
	this.gl.clear(this.gl.COLOR_BUFFER_BIT | this.gl.DEPTH_BUFFER_BIT);

	for (var i = 0; i < this.models.length; i++) {

		this.mvMatrix.makeIdentity();
		this.mvMatrix.rotate(7, 1, 0, 0);
		this.mvMatrix.rotate(5, 0, 0, 1);
		this.mvMatrix.rotate(-this.angle + 13.0, 0, 1, 0);
		this.mvMatrix.rotate(Math.sin(this.angle / 6.0) * 1.5, 0, 0, 1);
		this.mvMatrix.scale(2.8, 2.8, 2.8);
		this.mvMatrix.translate(0, -25, 0);

		this.models[i].bindVertices();
		this.gl.vertexAttribPointer(0, 3, this.gl.FLOAT, false, 0, 0);

		this.models[i].bindNormals();
		this.gl.vertexAttribPointer(1, 3, this.gl.FLOAT, false, 0, 0);

		this.models[i].bindTextureCoords();
		this.gl.vertexAttribPointer(2, 2, this.gl.FLOAT, false, 0, 0);

		this.gl.uniform3f(this.ambientColorUniform, 0.7, 0.7, 0.7);
		this.gl.uniform3f(this.lightingDirectionUniform, 0.0, 1.0, 0.0);
		this.gl.uniform3f(this.lightingDirectionUniform, 0.0, 0.0, 1.0);
		this.gl.uniform3f(this.directionalColorUniform, 1.0, 1.0, 1.0);

		this.gl.activeTexture(this.gl.TEXTURE0);
		this.gl.bindTexture(this.gl.TEXTURE_2D, this.textures[0].texture);
		this.gl.uniform1i(this.samplerUniform, 0);

		this.pMatrix.setUniform(this.gl, this.pMatrixLocation, false);
		this.mvMatrix.setUniform(this.gl, this.mvMatrixLocation, false);

		this.nMatrix.load(this.mvMatrix);
		this.nMatrix.invert();
		this.nMatrix.transpose();
		this.nMatrix.setUniform(this.gl, this.nMatrixLocation, false);

		this.models[i].bindVertexIndices();
		this.gl.drawElements(
			this.gl.TRIANGLES,
			this.models[i].numVertexIndices,
			this.gl.UNSIGNED_SHORT,
			0
		);
	}

	var time = new Date();
	var totalTime = time.valueOf() - this.startTime.valueOf();
	this.lastFrameTime = time;

	this.gl.flush();

	this.angle = 360.0 / 90000 * totalTime;
}

Scene.prototype.start = function()
{
	if (!this.interval) {
		this.angle = 0; // so captions keep in sync

		this.startTime = new Date();

		this.draw();

		var that = this;
		this.interval = window.setInterval(
			function () { that.draw() },
			this.refreshRate
		);
	}
}

Scene.prototype.stop = function()
{
	if (this.interval) {
		clearInterval(this.interval);
		this.interval = null;
	}
}

Scene.Shader = function(gl, type)
{
	this.gl     = gl;
	this.shader = gl.createShader(type);
}

Scene.Shader.prototype.setSource = function(source)
{
	this.gl.shaderSource(this.shader, source);
	this.gl.compileShader(this.shader);
	if (!this.gl.getShaderParameter(this.shader, this.gl.COMPILE_STATUS)) {
		return false;
	}

	return this;
}

Scene.Model = function(gl)
{
	this.gl               = gl;
	this.vertices         = [];
	this.normals          = [];
	this.vertexIndices    = [];
	this.textureCoords    = []
	this.itemSize         = 3;
	this.numVertices      = 0;
	this.numVertexIndices = 0;

	this.verticesBuffer      = null;
	this.vertexIndicesBuffer = null;
	this.normalsBuffer       = null;
	this.textureCoordsBuffer = null;
}

Scene.Model.prototype.setVertices = function(vertices)
{
	if (vertices.length % this.itemSize !== 0) {
		return false;
	}

	if (this.verticesBuffer) {
		this.gl.deleteBuffer(this.verticesBuffer);
	}

	this.vertices = vertices;
	this.numVertices = vertices.length / this.itemSize;

	this.verticesBuffer = this.gl.createBuffer();
	this.bindVertices();
	this.gl.bufferData(
		this.gl.ARRAY_BUFFER,
		new Float32Array(this.vertices),
		this.gl.STATIC_DRAW
	);

	return this;
}

Scene.Model.prototype.setVertexIndices = function(vertexIndices)
{
	this.vertexIndices = vertexIndices;

	if (this.vertexIndicesBuffer) {
		this.gl.deleteBuffer(this.vertexIndicesBuffer);
	}

	this.vertexIndicesBuffer = this.gl.createBuffer();
	this.bindVertexIndices();
	this.gl.bufferData(
		this.gl.ELEMENT_ARRAY_BUFFER,
		new Uint16Array(this.vertexIndices),
		this.gl.STATIC_DRAW
	);

	this.numVertexIndices = vertexIndices.length;

	return this;
}

Scene.Model.prototype.setNormals = function(normals)
{
	if (normals.length != this.numVertices * this.itemSize) {
		return false;
	}

	if (this.normalsBuffer) {
		this.gl.deleteBuffer(this.normalsBuffer);
	}

	this.normals = normals;

	this.normalsBuffer = this.gl.createBuffer();
	this.bindNormals();
	this.gl.bufferData(
		this.gl.ARRAY_BUFFER,
		new Float32Array(this.normals),
		this.gl.STATIC_DRAW
	);

	return this;
}

Scene.Model.prototype.setTextureCoords = function(textureCoords)
{
	if (textureCoords.length != this.numVertices * 2) {
		return false;
	}

	if (this.textureCoordsBuffer) {
		this.gl.deleteBuffer(this.textureCoordsBuffer);
	}

	this.textureCoords = textureCoords;

	this.textureCoordsBuffer = this.gl.createBuffer();
	this.bindTextureCoords();
	this.gl.bufferData(
		this.gl.ARRAY_BUFFER,
		new Float32Array(this.textureCoords),
		this.gl.STATIC_DRAW
	);
}

Scene.Model.prototype.bindVertices = function()
{
	if (this.verticesBuffer) {
		this.gl.bindBuffer(this.gl.ARRAY_BUFFER, this.verticesBuffer);
	}
}

Scene.Model.prototype.bindVertexIndices = function()
{
	if (this.vertexIndicesBuffer) {
		this.gl.bindBuffer(
			this.gl.ELEMENT_ARRAY_BUFFER,
			this.vertexIndicesBuffer
		);
	}
}

Scene.Model.prototype.bindNormals = function()
{
	if (this.normalsBuffer) {
		this.gl.bindBuffer(this.gl.ARRAY_BUFFER, this.normalsBuffer);
	}
}

Scene.Model.prototype.bindTextureCoords = function()
{
	if (this.textureCoordsBuffer) {
		this.gl.bindBuffer(this.gl.ARRAY_BUFFER, this.textureCoordsBuffer);
	}
}

Scene.Texture = function(gl, src)
{
	this.gl      = gl;
	this.texture = gl.createTexture();
	this.image   = new Image();

	var that = this;
	this.image.onload = function()
	{
		gl.bindTexture(gl.TEXTURE_2D, that.texture);
		gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL, true);
		gl.texImage2D(
			gl.TEXTURE_2D,
			0,
			gl.RGBA,
			gl.RGBA,
			gl.UNSIGNED_BYTE,
			that.image
		);
		gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
		gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
		gl.bindTexture(gl.TEXTURE_2D, null);
	}

	this.image.src = src;
}

function Demo(scene, captioner)
{
	this.scene     = scene;
	this.captioner = captioner;
}

Demo.prototype.start = function()
{
	container.style.display = 'block';
	if (this.scene) {
		this.scene.start();
	}
	if (this.captioner) {
		this.captioner.start();
	}
};

Demo.prototype.stop = function()
{
	container.style.display = 'none';
	if (this.scene) {
		this.scene.stop();
	}
	if (this.captioner) {
		this.captioner.stop();
	}
};

var container = document.createElement('div');
container.style.position = 'absolute';
container.style.margin   = '0 0 0 -360px';
container.style.top      = '100px';
container.style.left     = '50%';
container.style.zIndex   = '3000';
try {
	container.style.border = '10px solid rgba(255, 255, 255, 0.4)';
} catch (e) {
	container.style.border = '10px solid #555';
}
container.style.boxShadow = '0 0 30px rgba(0, 0, 0, 0.5), 0 0 10px rgba(0, 0, 0, 0.7), 0 0 1px rgba(0, 0, 0, 0.7)';
container.style.webkitBoxShadow = '0 0 30px rgba(0, 0, 0, 0.5), 0 0 10px rgba(0, 0, 0, 0.7), 0 0 1px rgba(0, 0, 0, 0.7)';

var closeLink = document.createElement('a');
closeLink.href = '#close';
closeLink.title = 'Close';
closeLink.style.position = 'absolute';
closeLink.style.display = 'block';
closeLink.style.top = '-25px';
closeLink.style.right = '-25px';
closeLink.style.width = '20px';
closeLink.style.height = '20px';
closeLink.style.MozBorderRadius = '20px';
closeLink.style.textAlign = 'center';
closeLink.style.borderRadius = '20px';
try {
	closeLink.style.border = '10px solid rgba(255,255,255,0.4)';
} catch (e) {
	closeLink.style.border = '10px solid #888';
}
closeLink.style.boxShadow = '0 0 30px rgba(0, 0, 0, 0.5), 0 0 10px rgba(0, 0, 0, 0.7), 0 0 1px rgba(0, 0, 0, 0.7)';
closeLink.style.webkitBoxShadow = '0 0 30px rgba(0, 0, 0, 0.5), 0 0 10px rgba(0, 0, 0, 0.7), 0 0 1px rgba(0, 0, 0, 0.7)';

var closeSpan = document.createElement('span');
closeSpan.appendChild(document.createTextNode('×'));
closeSpan.style.background = '#000';
closeSpan.style.color = '#fff';
closeSpan.style.display = 'block';
closeSpan.style.borderRadius = '20px';
closeSpan.style.width = '20px';
closeSpan.style.height = '20px';
closeSpan.style.cursor = 'pointer';

$(closeLink).hover(
	function() {
		this.style.textDecoration = 'none';
		try {
			this.style.borderColor = 'rgba(255,255,255,0.8)';
		} catch (e) {
			this.style.borderColor = '#bbb';
		}
	},
	function() {
		try {
			this.style.borderColor = 'rgba(255,255,255,0.4)';
		} catch (e) {
			this.style.borderColor = '#888';
		}
	}
);

$(closeLink).click(function(e) {
	e.preventDefault();
	window.mozWebGLDemo.stop();
});

closeLink.appendChild(closeSpan);
container.appendChild(closeLink);

var canvas = document.createElement('canvas');

if (!canvas.getContext) {
	var link = document.createElement('a');
	link.href = 'http://www.mozilla.com/';
	link.appendChild(document.createTextNode('Upgrade to Firefox'));

	container.appendChild(
		document.createTextNode(
			  'The verdict is in—users of modern browsers see more cool '
			+ 'Easter eggs! '
		)
	);
	container.appendChild(link);
	container.appendChild(document.createTextNode(' today.'));

	container.style.width      = '300px';
	container.style.margin     = '0 0 0 -155px';
	container.style.padding    = '10px';
	container.style.top        = '300px';
	container.style.left       = '50%';
	container.style.border     = '10px solid #555';
	container.style.background = '#fff';
	container.style.zIndex     = '3000';

	document.body.appendChild(container);

	if (!window.mozWebGLDemo) {
		window.mozWebGLDemo = new Demo(null, null);
		mozWebGLDemo.start();
	}
	return;
}

document.body.appendChild(container);

canvas.width            = '700';
canvas.height           = '600';
canvas.style.display    = 'block';

container.appendChild(canvas);

var gl = Scene.getGLContext(canvas);

if (!gl) {

	canvas.height = '180';
	canvas.style.background = '#fff';

	var titleEl = document.createElement('div');
	titleEl.style.position   = 'absolute';
	titleEl.style.top        = '13px';
	titleEl.style.left       = '50%';
	titleEl.style.margin     = '0 0 0 -350px';
	titleEl.style.fontSize   = '50px';
	titleEl.style.width      = '700px';
	titleEl.style.textAlign  = 'center';
	titleEl.style.color      = '#a5151e';
	titleEl.style.zIndex     = '3001';
	titleEl.style.fontFamily = 'MetaBold, \'Trebuchet MS\', sans-serif';
	titleEl.style.fontWeight = 'bold';
	titleEl.appendChild(document.createTextNode('ಠ_ಠ'));
	container.appendChild(titleEl);

	var textEl = document.createElement('div');
	textEl.style.position    = 'absolute';
	textEl.style.top         = '75px';
	textEl.style.left        = '50%';
	textEl.style.margin      = '0 0 0 -335px';
	textEl.style.fontSize    = '18px';
	textEl.style.width       = '670px';
	textEl.style.textAlign   = 'center';
	textEl.style.color       = '#69645c';
	textEl.style.zIndex      = '3001';
	textEl.style.fontFamily = 'Georgia, serif';

	var glLink = document.createElement('a');
	glLink.href = 'http://www.khronos.org/webgl/';
	glLink.appendChild(document.createTextNode('WebGL'));

	textEl.appendChild(
		document.createTextNode(
			'This Easter egg is brought to you by '
		)
	);
	textEl.appendChild(glLink);
	textEl.appendChild(
		document.createTextNode(
			  '. Unfortunately, it looks like you’re using a browser that '
			+ 'doesn’t yet support WebGL.'
		)
	);
	textEl.appendChild(document.createElement('br'));
	textEl.appendChild(
		document.createTextNode(
			'Get the most out of the Web, '
		)
	);

	var ffLink = document.createElement('a');
	ffLink.href = 'http://www.mozilla.com/';
	ffLink.appendChild(document.createTextNode('get Firefox'));
	textEl.appendChild(ffLink);
	textEl.appendChild(document.createTextNode('.'));

	container.appendChild(textEl);

	if (!window.mozWebGLDemo) {
		window.mozWebGLDemo = new Demo(null, null);
		mozWebGLDemo.start();
	}

	return;
}

var scene  = new Scene(gl, canvas.width, canvas.height);

var carousel = new Scene.Model(gl);

carousel.setVertices([
	// Front face
	-100.0, -65.5,  241.4214,
	 100.0, -65.5,  241.4214,
	 100.0,  65.5,  241.4214,
	-100.0,  65.5,  241.4214,

	// Front-Right face
	 100.0000, -65.5,  241.4214,
	 241.4214, -65.5,  100.0000,
	 241.4214,  65.5,  100.0000,
	 100.0000,  65.5,  241.4214,

	// Right face
	 241.4214, -65.5,  100.0,
	 241.4214, -65.5, -100.0,
	 241.4214,  65.5, -100.0,
	 241.4214,  65.5,  100.0,

	// Right-Back face
	 241.4214, -65.5, -100.0000,
	 100.0000, -65.5, -241.4214,
	 100.0000,  65.5, -241.4214,
	 241.4214,  65.5, -100.0000,

	// Back face
	 100.0, -65.5, -241.4214,
	-100.0, -65.5, -241.4214,
	-100.0,  65.5, -241.4214,
	 100.0,  65.5, -241.4214,

	// Back-Left face
	-100.0000, -65.5, -241.4214,
	-241.4214, -65.5, -100.0000,
	-241.4214,  65.5, -100.0000,
	-100.0000,  65.5, -241.4214,

	// Left face
	-241.4214, -65.5, -100.0,
	-241.4214, -65.5,  100.0,
	-241.4214,  65.5,  100.0,
	-241.4214,  65.5, -100.0,

	// Left-Front face
	-241.4214, -65.5,  100.0000,
	-100.0000, -65.5,  241.4214,
	-100.0000,  65.5,  241.4214,
	-241.4214,  65.5,  100.0000
]);

carousel.setNormals([
	// Front face
	 0.0,  0.0,  1.0,
	 0.0,  0.0,  1.0,
	 0.0,  0.0,  1.0,
	 0.0,  0.0,  1.0,

	// Front-Right face
	 0.7071,  0.0,  0.7071,
	 0.7071,  0.0,  0.7071,
	 0.7071,  0.0,  0.7071,
	 0.7071,  0.0,  0.7071,

	// Right face
	 1.0,  0.0,  0.0,
	 1.0,  0.0,  0.0,
	 1.0,  0.0,  0.0,
	 1.0,  0.0,  0.0,

	// Right-Back face
	 0.7071,  0.0, -0.7071,
	 0.7071,  0.0, -0.7071,
	 0.7071,  0.0, -0.7071,
	 0.7071,  0.0, -0.7071,

	// Back face
	 0.0,  0.0, -1.0,
	 0.0,  0.0, -1.0,
	 0.0,  0.0, -1.0,
	 0.0,  0.0, -1.0,

	// Back-Left face
	 -0.7071,  0.0, -0.7071,
	 -0.7071,  0.0, -0.7071,
	 -0.7071,  0.0, -0.7071,
	 -0.7071,  0.0, -0.7071,

	// Left face
	-1.0,  0.0,  0.0,
	-1.0,  0.0,  0.0,
	-1.0,  0.0,  0.0,
	-1.0,  0.0,  0.0,

	// Left-Front face
	 -0.7071,  0.0,  0.7071,
	 -0.7071,  0.0,  0.7071,
	 -0.7071,  0.0,  0.7071,
	 -0.7071,  0.0,  0.7071
]);

carousel.setVertexIndices([
	0,  1,  2,    0,  2,  3,
	4,  5,  6,    4,  6,  7,
	8,  9,  10,   8,  10, 11,
	12, 13, 14,   12, 14, 15,
	16, 17, 18,   16, 18, 19,
	20, 21, 22,   20, 22, 23,
	24, 25, 26,   24, 26, 27,
	28, 29, 30,   28, 30, 31
]);

carousel.setTextureCoords([
	// Front face
	0.00, 0.50,
	0.25, 0.50,
	0.25, 1.00,
	0.00, 1.00,

	// Front-Right face
	0.25, 0.50,
	0.50, 0.50,
	0.50, 1.00,
	0.25, 1.00,

	// Right face
	0.50, 0.50,
	0.75, 0.50,
	0.75, 1.00,
	0.50, 1.00,

	// Right-Back face
	0.75, 0.50,
	1.00, 0.50,
	1.00, 1.00,
	0.75, 1.00,

	// Back face
	0.00, 0.00,
	0.25, 0.00,
	0.25, 0.50,
	0.00, 0.50,

	// Back-Left face
	0.25, 0.00,
	0.50, 0.00,
	0.50, 0.50,
	0.25, 0.50,

	// Left face
	0.50, 0.00,
	0.75, 0.00,
	0.75, 0.50,
	0.50, 0.50,

	// Left-Front face
	0.75, 0.00,
	1.00, 0.00,
	1.00, 0.50,
	0.75, 0.50
]);

scene.addModel(carousel);
scene.addTexture(new Scene.Texture(gl, '/images/webgl-beards.png'));
scene.init();

function Captioner(el)
{
	this.index    = 0;
	this.interval = null;
	this.drawn    = false;
	this.el       = el;
}

Captioner.captions = [
	{
		title: 'Lumberjack Beard',
		text:  'The Lumberjack began as a plucky upstart that grew quickly to capture over 90% facial market share.'
	},
	{
		title: 'Horseshoe Mustache',
		text:  'Sadly this marketing initiative fell just short of growing an \'m\' to promote Mozilla\'s mission.'
	},
	{
		title: 'Swedish Beard',
		text:  'This happy beard is always available with a smile and helpful trouble shooting information.'
	},
	{
		title: 'Classy Goatee',
		text:  'Behind and a little above this refined tuft lies the mind of a shaving innovator.'
	},
	{
		title: 'Long Beard',
		text:  'This beard started growing in March 1998 on the day the Mozilla source code was released.'
	},
	{
		title: '70s Mustache',
		text:  'This retro-chic 70s era mustache is not only attractive, but has the power to coordinate large dinosaurs.'
	},
	{
		title: 'Chris Beard',
		text:  'Not an actual beard style, but rather a real person!'
	},
	{
		title: 'Fake Mustache',
		text:  'An honorable mention goes to this attempt to fit in with the community\'s hairier members.'
	}
];

Captioner.prototype.draw = function()
{
	if (this.drawn) {
		return;
	}

	var maintitleEl = document.createElement('div');
	maintitleEl.style.position   = 'absolute';
	maintitleEl.style.top        = '20px';
	maintitleEl.style.left       = '50%';
	maintitleEl.style.margin     = '0 0 0 -350px';
	maintitleEl.style.fontSize   = '42px';
	maintitleEl.style.width      = '700px';
	maintitleEl.style.textAlign  = 'center';
	maintitleEl.style.color      = '#a5151e';
	maintitleEl.style.zIndex     = '3001';
	maintitleEl.style.fontFamily = 'MetaBold, \'Trebuchet MS\', sans-serif';
	maintitleEl.style.fontWeight = 'bold';
	maintitleEl.appendChild(
		document.createTextNode(
			'The Many Beards of Mozilla'
		)
	);
	this.el.appendChild(maintitleEl);

	var mainsubtitleEl = document.createElement('div');
	mainsubtitleEl.style.position    = 'absolute';
	mainsubtitleEl.style.top         = '73px';
	mainsubtitleEl.style.left        = '50%';
	mainsubtitleEl.style.margin      = '0 0 0 -260px';
	mainsubtitleEl.style.fontSize    = '16px';
	mainsubtitleEl.style.lineHeight  = '1.4';
	mainsubtitleEl.style.width       = '520px';
	mainsubtitleEl.style.textAlign   = 'center';
	mainsubtitleEl.style.color       = '#444';
	mainsubtitleEl.style.zIndex      = '3001';
	mainsubtitleEl.style.fontFamily  = 'Arial, sans-serif';
	mainsubtitleEl.appendChild(
		document.createTextNode(
			  'Get to know the different beard styles of the Mozilla '
			+ 'project, and find out how you can grow one too!'
		)
	);
	this.el.appendChild(mainsubtitleEl);

	this.titleEl = document.createElement('div');
	this.titleEl.style.position   = 'absolute';
	this.titleEl.style.top        = '135px';
	this.titleEl.style.left       = '50%';
	this.titleEl.style.margin     = '0 0 0 -350px';
	this.titleEl.style.fontSize   = '24px';
	this.titleEl.style.width      = '700px';
	this.titleEl.style.textAlign  = 'center';
	this.titleEl.style.color      = '#444';
	this.titleEl.style.zIndex     = '3001';
	this.titleEl.style.fontFamily = 'Georgia, serif';
	this.titleEl.style.fontStyle  = 'italic';
	this.el.appendChild(this.titleEl);

	this.textEl = document.createElement('div');
	this.textEl.style.position    = 'absolute';
	this.textEl.style.top         = '170px';
	this.textEl.style.left        = '50%';
	this.textEl.style.margin      = '0 0 0 -335px';
	this.textEl.style.fontSize    = '14px';
	this.textEl.style.lineHeight  = '1.4';
	this.textEl.style.width       = '670px';
	this.textEl.style.textAlign   = 'center';
	this.textEl.style.color       = '#444';
	this.textEl.style.zIndex      = '3001';
	this.textEl.style.fontFamily  = 'Arial, sans-serif';
	this.el.appendChild(this.textEl);

	var subtextEl = document.createElement('div');
	subtextEl.style.position    = 'absolute';
	subtextEl.style.top         = '530px';
	subtextEl.style.left        = '50%';
	subtextEl.style.margin      = '0 0 0 -335px';
	subtextEl.style.fontSize    = '14px';
	subtextEl.style.lineHeight  = '1.4';
	subtextEl.style.width       = '670px';
	subtextEl.style.textAlign   = 'left';
	subtextEl.style.color       = '#444';
	subtextEl.style.zIndex      = '3001';
	subtextEl.style.fontFamily  = 'Arial, sans-serif';
	subtextEl.appendChild(
		document.createTextNode(
			  'You can make your face hairer by getting involved with '
			+ 'Mozilla. You don’t have to be a pogonotrophist (or even '
			+ 'know what that means!) and you don’t need to spend lots of '
			+ 'time. Just stop shaving and '
		)
	);
	var submitLink = document.createElement('a');
	submitLink.href = 'http://noshavingindecember.org/';
	submitLink.appendChild(document.createTextNode('show us'));
	subtextEl.appendChild(submitLink);
	subtextEl.appendChild(document.createTextNode(' the results.'));
	this.el.appendChild(subtextEl);

	this.drawn = true;
};

Captioner.prototype.update = function()
{
	this.titleEl.innerHTML = Captioner.captions[this.index].title;
	this.textEl.innerHTML  = Captioner.captions[this.index].text;
	this.index++;

	if (this.index >= Captioner.captions.length) {
		this.index = 0;
	}
},

Captioner.prototype.start = function()
{
	if (!this.interval) {
		this.draw();
		this.update();
		var that = this;
		this.interval = setInterval(
			function() { that.update(); },
			11250
		);
	}
};

Captioner.prototype.stop = function()
{
	if (this.interval) {
		clearInterval(this.interval);
		this.interval = null;
	}
};

var captioner = new Captioner(container);

if (!window.mozWebGLDemo) {
	window.mozWebGLDemo = new Demo(scene, captioner);
	mozWebGLDemo.start();
}

})();

