function CustomMarker(latlng, map, args, type) {
	this.latlng = latlng;
	this.args = args;
	this.type = type;
	this.setMap(map);
}

CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function () {

	var self = this;

	var div = this.div;
	var span = this.span;
	if (!div) {

		div = this.div = document.createElement('div');

		div.className = 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored  map-marker';
		div.style.position = 'absolute';
		span = this.span = document.createElement('span');
		span.className = "map-marker__arrow"
		if (typeof (self.args.title) !== 'undefined' && self.type !== "property") {
			div.innerHTML += self.args.title;
		}
		if (self.type === "property") {
			div.innerHTML += self.args.details.price;
		}

		google.maps.event.addDomListener(div, "click", function (event) {
			google.maps.event.trigger(self, "click");
			let type = this.dataset.type;
			let id = this.dataset.id;
			if (type == "region") {
				
				
				$.get(url + '/api/v1/regions/'+id+'', function (data) {
					data.data.forEach(function (el) {
						var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), self.map, el, 'district');
					});
					self.map.setCenter(new google.maps.LatLng(self.latlng.lat(), (self.latlng.lng())));
					self.map.setZoom(12);
				}) 
			}
			if (type == "district") {
				$.get(url + '/api/v1/properties/district/'+id+'', function (data) {
					console.log(data)
					data.data.forEach(function (el) {
						var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), self.map, el, 'property');
					});
					self.map.setCenter(new google.maps.LatLng(self.latlng.lat(), (self.latlng.lng())));
					self.map.setZoom(12);
				}) 
			}
			if (type === "property") {
				self.map.setCenter(new google.maps.LatLng(self.latlng.lat(), (self.latlng.lng() - .02)));
				setTimeout(function(){ self.drawProperty(id); }, 10);
				
			}
		});

		var panes = this.getPanes();
		div.appendChild(span);
		panes.overlayImage.appendChild(div);



	}

	var point = this.getProjection().fromLatLngToDivPixel(this.latlng);

	if (point) {
		div.style.left = (point.x - 32) + 'px';
		div.style.top = (point.y - 30) + 'px';
	}
	if (typeof (self.args.id) !== 'undefined') {
		div.dataset.id = self.args.id;
	}
	if (typeof (self.type) !== 'undefined') {
		div.dataset.type = self.type;
	}
};

CustomMarker.prototype.remove = function () {
	var self = this;
	if (this.div) {
		self.span.parentNode.removeChild(self.span)
		this.div.parentNode.removeChild(this.div);
		this.div = null;
		this.span = null;
	}
};

CustomMarker.prototype.getPosition = function () {
	return this.latlng;
};
CustomMarker.prototype.drawProperty = function (id) {
	var self = this;
	self.div.classList.add('marker-hidden')
	var propertyCard = this.propertyCard =  document.createElement('div');
	propertyCard.className = "card horizontal mdl-card mdl-shadow--2dp h-card property-card"
	var content ='<div class="card-image">'
	+ ' <img src='+ self.args.pictures[0] +'>' 
	+ '</div>' 
	+ ' <div class="card-stacked">' 
	+ ' <div class="card-content">' 
	+ '<h5 class="card--title">'+ self.args.title +'</h5>'
	+ '<h6 class="card--sub-title">'+ self.args.details.description +'</h6>'
	+ ' <span class="card--text__size"> '+ self.args.details.area +'م<sup>2</sup></span>'
	+ ' </div>'
	+ '<div class="card-footer">'
	+ '<div class="card-footer__price">'
	+ ' <span class="price--text">'
	+ ''+ self.args.details.price +' ريال'
	+ '</span>'
	+ '</div>'
	+ '<div class="footer-contet">'	
	+ '<span>'+ self.args.details.bathrooms + '</span>'
	+ '<img src=' + bathroom + ' '+'alt="">'
	+ '<span>'+ self.args.details.rooms + '</span>'
	+ '<i class="material-icons md-18">local_hotel</i>'
    + '</div>'                                                                       
	+ '</div>'
	+ '<span class="card-arrow"></span>'
	+ '</div>'
	propertyCard.innerHTML = content;
	var panes = this.getPanes();
		panes.overlayImage.appendChild(propertyCard);
		propertyCard.dataset.id = id;
		google.maps.event.addDomListener(propertyCard, "click", function (event) {
			google.maps.event.trigger(self, "click");
			let id = this.dataset.id;
			location = url + "/Properties/show/" + id ;
			
		});
		var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
		if (point) {
			propertyCard.style.left = (point.x - 190) + 'px';
			propertyCard.style.top = (point.y  - 155) + 'px';
		}
}