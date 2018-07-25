// Coded by Travis Beckham
// Heavily modified by Craig Erskine
// extended to TagName img by reddog (and little personal tip)
tooltip = {
	name : "tooltipDiv",
	offsetX : -30,
	offsetY : 26,
	tip : null
};
tooltip.init = function () {

	var tipNameSpaceURI = "http://www.w3.org/1999/xhtml";
	if(!tipContainerID){ var tipContainerID = "tooltipDiv";}
	var tipContainer = document.getElementById(tipContainerID);

	if(!tipContainer){
		tipContainer = document.createElementNS ? document.createElementNS(tipNameSpaceURI, "div") : document.createElement("div");
		tipContainer.setAttribute("id", tipContainerID);
		tipContainer.style.display = "none";
		document.getElementsByTagName("body").item(0).appendChild(tipContainer);
	}

	if (!document.getElementById) return;

	this.tip = document.getElementById (this.name);
	if (this.tip) document.onmousemove = function (evt) {tooltip.move (evt)};

	var a, sTitle;
	var anchors = document.getElementsByTagName ("a");

	for (var i = 0; i < anchors.length; i ++) {
		a = anchors[i];
		sTitle = a.getAttribute("title");
		if(sTitle) {
			a.setAttribute("tiptitle", sTitle);
			a.removeAttribute("title");
			a.removeAttribute("alt");
			a.onmouseover = function() {tooltip.show(this.getAttribute('tiptitle'))};
			a.onmouseout = function() {tooltip.hide()};
		}
	}

	var img, iTitle, iClass;
	var anchors = document.getElementsByTagName ("img");

	for (var i = 0; i < anchors.length; i ++) {
		img = anchors[i];
		iTitle = img.getAttribute("title");
		iClass = (document.all) ? img.getAttribute("className") : img.getAttribute("class");
		if(iTitle) {
			img.setAttribute("tiptitle", iTitle);
			img.removeAttribute("title");
			img.removeAttribute("alt");
			if (iClass == "gradualshine") {
				img.onmouseover = function() {tooltip.show(this.getAttribute('tiptitle')); slowhigh(this);};
				img.onmouseout = function() {tooltip.hide(); slowlow(this);};
			} else {
				img.onmouseover = function() {tooltip.show(this.getAttribute('tiptitle'))};
				img.onmouseout = function() {tooltip.hide()};
			}
		}
	}
};

tooltip.move = function (evt) {
	var x=0, y=0;
	if (document.all) {// IE

		x = (document.documentElement && document.documentElement.scrollLeft) ? document.documentElement.scrollLeft : document.body.scrollLeft;
		y = (document.documentElement && document.documentElement.scrollTop) ? document.documentElement.scrollTop : document.body.scrollTop;
		x += window.event.clientX;
		y += window.event.clientY;
      
	} else {// Mozilla
		x = evt.pageX;
		y = evt.pageY;
	}
	this.tip.style.left = (x + this.offsetX) + "px";
	this.tip.style.top = (y + this.offsetY) + "px";
};

tooltip.show = function (text) {
	if (!this.tip) return;
	this.tip.innerHTML = text;
	this.tip.style.visibility = "visible";
	this.tip.style.display = "block";
};

tooltip.hide = function () {
	if (!this.tip) return;
	this.tip.style.visibility = "hidden";
	this.tip.style.display = "none";
	this.tip.innerHTML = "";
};

window.onload = function () {
   tooltip.init ();
} 