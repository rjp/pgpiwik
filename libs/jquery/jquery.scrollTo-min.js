/**
 * jQuery.ScrollTo - Easy element scrolling using jQuery.
 * Copyright (c) 2008 Ariel Flesler - aflesler(at)gmail(dot)com
 * Licensed under GPL license (http://www.opensource.org/licenses/gpl-license.php).
 * Date: 1/2/2008
 * @author Ariel Flesler
 * @version 1.3
 */
;(function($){$.scrollTo=function(a,b,c){$($.browser.safari?'body':'html').scrollTo(a,b,c)};$.scrollTo.defaults={axis:'y',duration:1};$.fn.scrollTo=function(c,d,f){if(typeof d=='object'){f=d;d=0}f=$.extend({},$.scrollTo.defaults,f);if(!d)d=f.speed||f.duration;f.queue=f.queue&&f.axis.length==2;if(f.queue)d=Math.ceil(d/2);if(typeof f.offset=='number')f.offset={left:f.offset,top:f.offset};return this.each(function(){var e=this,$e=$(e),t=c,toff,j={},w=$e.is('html,body');switch(typeof t){case'number':case'string':if(/^([+-]=)?\d+(px)?$/.test(t)){t={top:t,left:t};break}t=$(t,this);case'object':if(t.is||t.style)toff=(t=$(t)).offset()}$.each(f.axis.split(''),parse);animate(f.onAfter);function parse(i,a){var P=a=='x'?'Left':'Top',p=P.toLowerCase(),k='scroll'+P,u=e[k];if(toff){j[k]=toff[p]+(w?0:u-$e.offset()[p]);if(f.margin){j[k]-=parseInt(t.css('margin'+P))||0;j[k]-=parseInt(t.css('border'+P+'Width'))||0}if(f.offset&&f.offset[p])j[k]+=f.offset[p]}else{j[k]=t[p]}if(/^\d+$/.test(j[k]))j[k]=j[k]<=0?0:Math.min(j[k],max(a));if(!i&&f.queue){if(u!=j[k])animate(f.onAfterFirst);delete j[k]}};function animate(a){$e.animate(j,d,f.easing,function(){if(a)a.call(this,$e,j,t)})};function max(a){var b=w?$.browser.opera?document.body:document.documentElement:e,D=a=='x'?'Width':'Height';return b['scroll'+D]-b['client'+D]}})}})(jQuery);
