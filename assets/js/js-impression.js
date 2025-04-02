document.addEventListener( 'DOMContentLoaded', function () {
   var body = document.querySelector( 'body' );
   body.classList.remove( 'no-js' );
} );


window.addEventListener( 'load', function () {
   headerDarkorLight();
} );


function headerDarkorLight() {
   const topImage = document.getElementById( 'top-image' );
   const header = document.getElementById( 'header' );

   if ( !topImage ) {
      return;
   }

   // Create a canvas element to analyze the image
   const canvas = document.createElement( 'canvas' );
   const context = canvas.getContext( '2d' );
   canvas.width = topImage.width;
   canvas.height = topImage.height;

   context.drawImage( topImage, 0, 0, topImage.width, topImage.height );

   const imageData = context.getImageData( 0, 0, topImage.width, topImage.height );
   const pixels = imageData.data;

   // Calculate the average brightness of the image
   let totalBrightness = 0;
   for ( let i = 0; i < pixels.length; i += 4 ) {
      const r = pixels[i];
      const g = pixels[i + 1];
      const b = pixels[i + 2];
      const brightness = ( r + g + b ) / 3;
      totalBrightness += brightness;
   }
   const averageBrightness = totalBrightness / ( pixels.length / 4 );

   if ( averageBrightness < 128 ) {
      header.classList.add( 'dark' );
   } else {
      header.classList.add( 'light' );
   }
}

function toggleMenu() {
   var hamburgerMenu = document.querySelector( '.burg-menu' );
   hamburgerMenu.classList.toggle( 'open' );
}