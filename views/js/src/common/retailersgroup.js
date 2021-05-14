export default class RetailersGroup {
  #id;
  #markerIconUrl;
  #retinaMarkerIconUrl;
  #stackOrder;
  #members = [];


  constructor(id, markerIconUrl, retinaMarkerIconUrl, stackOrder) {
    this.#id = id;
    this.#markerIconUrl = markerIconUrl;
    this.#retinaMarkerIconUrl = retinaMarkerIconUrl;
    this.#stackOrder = stackOrder;
  }

  addMember(member) {
    this.#members.push(member);
  }

  contains(retailer) {
    return this.#id === retailer.group;
  }

  getMembers() {
    return [...this.#members];
  }

  getStackOrder() {
    return this.#stackOrder;
  }

  getIconData(mediaPath) {
    return {
      iconUrl: mediaPath + 'img/' + this.#markerIconUrl,
      iconRetinaUrl: mediaPath + 'img/' + this.#retinaMarkerIconUrl,
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41],
      shadowUrl: mediaPath + 'img/' + 'marker-shadow.png',
      shadowAnchor: [12, 41],
      tooltipAnchor: [16, -28]
    }
  }

  hasIcon() {
    return Boolean(this.#markerIconUrl);
  }
}
