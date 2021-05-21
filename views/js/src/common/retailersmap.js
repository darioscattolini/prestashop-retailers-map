import LeafletMap from './leafletmap';
import RetailersGroup from './retailersgroup';
import SearchEngine from './searchengine';

export default class RetailersMap {
  #mediaPath;
  #dataLink;
  #map;
  #searchEngine;
  #noResultAlert;
  #manyResultsAlert;

  /** @type {RetailersGroup[]} */
  #groups = [];

  constructor(settings) {
    this.#mediaPath = settings.mediaPath;
    this.#dataLink = settings.dataLink;
    this.#map = new LeafletMap(settings);
    this.#searchEngine = new SearchEngine();
    this.#noResultAlert = document.getElementById('no-result-alert');
    this.#manyResultsAlert = document.getElementById('many-results-alert');
  }

  async setUp() {
    this.#map.setUp();

    const mapDataResponse = await fetch(this.#dataLink);
    const mapData = await mapDataResponse.json();
    const { groups, retailers } = mapData;

    this.#addGroupsData(groups);
    this.#addRetailersData(retailers);
    this.#addSearchButtonFunction();
    this.#fillMap();
    await this.#map.setView();
  }

  #addGroupsData(groups) {
    for (const group of groups) {
      const groupObj = new RetailersGroup(
        group.id, group.marker, group.retinaMarker, group.stackOrder
      );
      this.#groups.push(groupObj);
    }
  }

  #addRetailersData(retailers) {
    for (const retailer of retailers) {
      const group = this.#groups.find(group => group.contains(retailer));
      group.addMember(retailer);
      this.#searchEngine.addRetailer(retailer);
    }
  }

  #addSearchButtonFunction() {
    document.getElementById('map-search-form')
      .addEventListener('submit', event => {
        this.#emptySearchAlerts()
        

        const input = event.target[0].value;
        const foundLocations = this.#searchEngine.searchCityOrPostcode(input);
        
        if (foundLocations.length === 1) {         
          this.#map.flyToCity(foundLocations[0].coordinates);
        } else if (foundLocations.length > 1) {
          const list = document.createElement('ul');
          
          for (const location of foundLocations) {
            const listItem = document.createElement('li');
            listItem.innerHTML = `<button>${location.city}</button>`;
            listItem.onclick = () => {
              this.#map.flyToCity(location.coordinates);
            };
            list.appendChild(listItem);
          }

          this.#manyResultsAlert.appendChild(list);
          this.#manyResultsAlert.classList.add('visible');
        } else {
          this.#noResultAlert.classList.add('visible');
        }
      });
  }

  #fillMap() {
    for (const group of this.#groups) {
      const options = {};
      
      if (group.hasIcon()) {
        const data = group.getIconData(this.#mediaPath);
        // this could be done from inside #map passing only data as options
        // but as it is it would rebuild same icon for every retailer
        options.icon = this.#map.buildIcon(data);
      }

      const stackOrder = group.getStackOrder();
      if (stackOrder > 0) options.zIndexOffset = 10 * stackOrder;

      for (const retailer of group.getMembers()) {
        const retailerData = {};
        
        retailerData.coordinates = [
          Number(retailer.latitude), Number(retailer.longitude) 
        ];

        retailerData.name = retailer.name;
        retailerData.popupContent = this.#getPopupContentFor(retailer);
        
        this.#map.addRetailerMarker(retailerData, options);
      }
    }
  }

  #getPopupContentFor(retailer) {
    let content = `
      <h3>${retailer.name}</h3>
      <p>${retailer.address}</p>
      <p>${retailer.postcode} ${retailer.city}</p>
      <p>${retailer.state}, ${retailer.country}</p>
    `;

    if (retailer.phone) content += `<p>${retailer.phone}</p>`;
    if (retailer.email) content += `<p>${retailer.email}</p>`;
    
    content += `
    <style>
      .leaflet-popup-content {
        line-height: 0!important;
      }
    </style>
    `;

    return content;
  }

  #emptySearchAlerts() {
    this.#noResultAlert.classList.remove('visible');
    this.#manyResultsAlert.classList.remove('visible');
    const resultsList = this.#manyResultsAlert.querySelector('ul');
    if (resultsList) resultsList.remove();
  }
}
