const Ziggy = {"url":"http:\/\/crud-dashboard-vue.test","port":null,"defaults":{},"routes":{"users.index":{"uri":"users","methods":["GET","HEAD"]},"users.create":{"uri":"users\/create","methods":["GET","HEAD"]},"users.store":{"uri":"users","methods":["POST"]},"users.show":{"uri":"users\/{user}","methods":["GET","HEAD"]},"users.edit":{"uri":"users\/{user}\/edit","methods":["GET","HEAD"]},"users.update":{"uri":"users\/{user}","methods":["PUT","PATCH"]},"users.destroy":{"uri":"users\/{user}","methods":["DELETE"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
