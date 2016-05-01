window.onload=function(){
if(window.initShowHideDivs) initShowHideDivs();
if(window.fillup) fillup();
if(window.initialize) initialize();
if(window.initEzrMapCom) initEzrMapCom();
if(window.initEzrMapMod) initEzrMapMod();
}

window.onunload=function(){
if(GUnload) GUnload();
}
