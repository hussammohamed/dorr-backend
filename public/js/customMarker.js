function CustomMarker(latlng, map, args) {
	this.latlng = latlng;	
	this.args = args;	
	this.setMap(map);	
}

CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function() {
	
	var self = this;
	
	var div = this.div;
	var span = this.span;
	if (!div) {
	
		div = this.div = document.createElement('div');
		
		div.className = 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored map-marker';
		div.style.position = 'absolute';
		span = this.span = document.createElement('span');
		span.className = "map-marker__arrow"
		if (typeof(self.args.name) !== 'undefined') {
			div.innerHTML += self.args.name;
		}
		
		google.maps.event.addDomListener(div, "click", function(event) {			
			//console.log("hossam")
		});
		
		var panes = this.getPanes();
		panes.overlayImage.appendChild(div);
		panes.overlayImage.appendChild(span);

		
	}
	
	var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
	
	if (point) {
		div.style.left = (point.x - 32) + 'px';
		div.style.top = (point.y - 32) + 'px';
		span.style.left = (point.x - 6) + 'px'
		span.style.top =  (point.y - 8) + 'px';               
	}
	if (typeof(self.args.id) !== 'undefined') {
		div.dataset.id = self.args.id;
	}
};

CustomMarker.prototype.remove = function() {
	if (this.div) {
		this.div.parentNode.removeChild(this.div);
		this.div = null;
	}	
};

CustomMarker.prototype.getPosition = function() {
	return this.latlng;	
};