import L from './leafletextension';

export default class LeafletMap {
  #L = L;
  #containerId;
  #defaultCenter;
  #defaultZoom;
  #tileLayer;
  #map;
  #markers = [];

  constructor(settings) {
    this.#containerId = settings.containerId;
    this.#defaultCenter = settings.defaultCenter;
    this.#defaultZoom = settings.defaultZoom;
    this.#tileLayer = settings.tileLayer;
    this.#map = this.#L.map(this.#containerId);
  }

  setUp() {
    this.#L.tileLayer.provider(this.#tileLayer).addTo(this.#map);
    this.#customizeDefaultMarkerIcon();
  }

  buildIcon(data) {
    return this.#L.icon(data);
  }

  addRetailerMarker(retailerData, options) {
    const marker = this.#L.marker(retailerData.coordinates, options);
    marker.bindTooltip(retailerData.name).openTooltip();
    marker.bindPopup(retailerData.popupContent).openPopup();
    marker.addTo(this.#map);
    this.#markers.push(marker);
  }

  async setView() {
    let center, zoom;

    try {
      const userPosition = await this.#getUserPosition();
      center = [userPosition.coords.latitude, userPosition.coords.longitude];
      zoom = 11;
    } catch(error) {
      center = this.#defaultCenter;
      zoom = this.#defaultZoom;
    }

    this.#map.setView(center, zoom);
    this.#rezoomToDisplayMarkers();
  }
  
  flyToCity(coordinates) {
    this.#map.flyTo(coordinates, 13);
  }

  #getUserPosition() {
    return new Promise((resolve, reject) => 
      navigator.geolocation.getCurrentPosition(resolve, reject)
    );
  }

  #rezoomToDisplayMarkers() {
    if(!this.#containsSomeMarker()) {
      this.#map.fitBounds(this.#getMaxBounds());
    }
  }

  #containsSomeMarker() {
    return this.#markers.some(marker => {
      return this.#map.getBounds().contains(marker.getLatLng());
    })
  }

  #getMaxBounds() {
    return this.#markers.reduce((bounds, marker) => {
      const markerPosition = marker.getLatLng();

      if (!bounds.contains(markerPosition)) bounds.extend(markerPosition);

      return bounds;
    }, this.#map.getBounds());
  }

  #customizeDefaultMarkerIcon() {
    for (const field in this.#L.Icon.Default.prototype.options) {
      let value;
      switch (field) {
        case 'iconAnchor':
          value = [10, 33];
          break;
        case 'iconSize':
          value = [20, 33];
          break;
        case 'popupAnchor':
          value = [1, -26];
          break;
        case 'shadowSize':
          value = [33, 33];
          break;
        case 'tooltipAnchor':
          value = [13, -23];
          break;
      }
      if (value) this.#L.Icon.Default.prototype.options[field] = value;
    }
  }
}