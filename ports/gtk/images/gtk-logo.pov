#include "colors.inc"

camera {
  location  <2.5, 2.5, -2>
  look_at   <0.5, 0.5, 0.5>
}

// Light source

light_source { 	<2, 5, -5>  color White }
light_source { 	<5, 5, -2>  color White }
light_source { 	<-5, 5, -2>  color White }

// The "G"
polygon {
	5,
	<0,1,0>,
	<1,1,0>,
	<1,1,1>,
	<0,1,1>,
	<0,1,0>
	texture {
		pigment {
			image_map { gif "gtk-texture.gif"
				filter 0, 1.0 }
			rotate <90,-90,0>
			scale <2, 2, 2>
			translate <0, 0, 1>
		}
	}
}

// The "T"
polygon {
	5,
	<0,0,0>,
	<1,0,0>,
	<1,1,0>,
	<0,1,0>,
	<0,0,0>
	texture {
		pigment {
			image_map { gif "gtk-texture.gif"
				filter 0, 1.0 }
			scale <2, 2, 2>
		}
	}
}

// The "K"
polygon {
	5,
	<1,0,0>,
	<1,1,0>,
	<1,1,1>,
	<1,0,1>,
	<1,0,0>
	texture {
		pigment {
			image_map { gif "gtk-texture.gif"
				filter 0, 1.0 }
			rotate <0,270,0>
			scale <2, 2, 2>
			translate <1,0,1>
		}
	}
}

box {
	<0.1, 0.1, 0.1>, <0.9, 0.9, 0.9>
	texture { pigment { color White } }
}

plane {
	y, 0
	texture { pigment { color White } }
}