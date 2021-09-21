export default class RetailersGroup {
  #id;
  #stackOrder;
  #members = [];


  constructor(id, stackOrder) {
    this.#id = id;
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
}
