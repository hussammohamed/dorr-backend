var reformNumber = function (n) {
	if (n[n.length - 1] === '0') {
		return n.substr(0, n.length - 2);
	}
	return n;
}
var priceFormatter = function (num) {
	if (num > 999999999)
		return reformNumber((num / 1000000000).toFixed(1)) + " مليار ";
	else if (num > 999999)
		return reformNumber((num / 1000000).toFixed(1)) + " مليون ";
	else if (num > 999)
		return reformNumber((num / 1000).toFixed(1)) + " ألف ";
	else return reformNumber((num / 1).toFixed(1)) + " ريال ";
}
function CustomMarker(latlng, map, args, type, component) {
	this.latlng = latlng;
	this.args = args;
	this.type = type;
	this.setMap(map);
	this.component = component;
}
function returnViewPrice (property){

	let price;
	if(property.price_view  == 1) price = property.price; else price = property.bid_price
	return addCommas(price, ' ريال')
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
			if(self.args.details.price_view  == 1){
				div.innerHTML += priceFormatter(self.args.details.price);
			}
			else{
				div.innerHTML += priceFormatter(self.args.details.bid_price);
				div.className += " bid-price"
			}
		
		}

		google.maps.event.addDomListener(div, "click", function (event) {
			google.maps.event.trigger(self, "click");
			let type = this.dataset.type;
			let id = this.dataset.id;
			let bounds = new google.maps.LatLngBounds();
			if (type == "region") {
				if (self.component) {
					// self.component.properties = [];
					self.component.isloading = true;
				}
				// $.get('/api/v1/regions/' + id + '', function (data) {
				// 	if(data.data.length){
				// 		data.data.forEach(function (el) {
				// 			var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), self.map, el, 'district', self.component);
				// 			bounds.extend(overlay.getPosition());

				// 		});
				// 		self.map.fitBounds(bounds);
				// 		self.map.setZoom(10);
				// 	}else{
				// 		// self.component.isEmpty = true;
				// 		self.map.setCenter(new google.maps.LatLng(self.latlng.lat(), (self.latlng.lng())));
				// 		self.map.setZoom(10);
				// 	}

				// })
				$.ajax({
					url:
						"/api/v1/properties/search?lat=" +
						self.latlng.lat() +
						"&long=" +
						self.latlng.lng() +
						"",
					type: "post",
					dataType: "json",
					success: function (_response) {
						if (!_response) {
							self.component.properties = [];
							self.component.isEmpty = true;
						} else {
							self.component.properties = _response.data;
							self.component.isEmpty = false;
						}
					},
					complete: function (_response) {
						self.component.kind = "properties"
						self.component.isloading = false;
						self.map.setCenter(new google.maps.LatLng(self.latlng.lat(), (self.latlng.lng())));
						self.map.setZoom(9);
					}
				});
				$(".map-marker,.property-card")
					.fadeOut()
					.remove();
			}
			if (type == "district") {
				self.component.isLoading = true;
				$.get('/api/v1/properties/region/' + id + '', function (data) {
					if (data.data) {
						self.component.properties = data.data;
						self.component.isEmpty = false;
					}
					else {
						self.component.isEmpty = true;
						self.component.properties = [];

					}
					self.component.kind = "properties"
					self.component.isLoading = false;
					self.map.setCenter(new google.maps.LatLng(self.latlng.lat(), (self.latlng.lng())));
					self.map.setZoom(12);

				})
				$(".map-marker,.property-card")
					.fadeOut()
					.remove();
			}
			if (type === "property") {
				self.map.setCenter(new google.maps.LatLng(self.latlng.lat(), (self.latlng.lng())));
				setTimeout(function () { self.drawProperty(id); }, 10);

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
	var propertyCard = this.propertyCard = document.createElement('div');
	propertyCard.className = "card horizontal mdl-card mdl-shadow--2dp h-card property-card"
	var picture;
	if (self.args.pictures[0]) {
		picture = self.args.pictures[0].path;
	}
	else {
		picture = "/images/card1.png"
	}
	var content = '<div class="card-image">'
		+ ' <img src=' + picture + '>'
		+ '</div>'
		+ ' <div class="card-stacked">'
		+ ' <div class="card-content">'
		+ '<h5 class="card--title">' + self.args.title + '</h5>'
		+ '<h6 class="card--sub-title">' + self.args.details.description + '</h6>'
		+ ' <span class="card--text__size"> ' + self.args.details.area + 'م<sup>2</sup></span>'
		+ ' </div>'
		+ '<div class="card-footer">'
		+ '<div class="card-footer__price">'
		+ ' <span class="price--text">'
		+ '' + returnViewPrice(self.args.details)
		+ '</span>'
		+ '</div>'
		+ '<div class="footer-contet">'
		+ '<span>' + self.args.details.bathrooms + '</span>'
		+ '<img src="/images/bathroom.svg" alt="">'
		+ '<span>' + self.args.details.rooms + '</span>'
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
		location = "/properties/show/" + id;

	});
	var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
	if (point) {
		propertyCard.style.left = (point.x - 190) + 'px';
		propertyCard.style.top = (point.y - 155) + 'px';
	}
}

function addCommas(num, begText, endText) {
	num += '';
	var x = num.split('.');
	var x1 = x[0];
	var x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	if (begText && endText) {
		return begText + x1 + x2 + endText;
	}
	else if (begText) {
		return x1 + x2 + begText;
	} else {
		return x1 + x2;
	}

}