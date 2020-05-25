
var configHandler = setInterval(setConfig, 100);
function setConfig() {
    if (typeof mtcaptchaConfig != "undefined") {         
        // push the random id in render queue
        var captchaContainer = document.getElementsByClassName("mtcaptcha-container");
        Array.prototype.forEach.call(captchaContainer, function(el) {
          if(el.id.indexOf("mtcaptcha") != -1  && 
          ((mtcaptchaConfig.renderQueue.length > 0 && mtcaptchaConfig.renderQueue.indexOf(el.id) == -1) || typeof mtcaptchaConfig.renderQueue != "undefined")) {
            if(!mtcaptchaConfig.renderQueue.push(el.id)) {
               clearInterval(configHandler);
            } 
          }
        }); 
      }
}
//Clear the set interval call by force after 10 seconds if it is not cleared by nature..
setTimeout(function(){ clearInterval(configHandler); }, 10000);

