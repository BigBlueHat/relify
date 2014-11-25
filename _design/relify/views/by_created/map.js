function(doc) {
  var moment = require('views/lib/moment');

  if ('links' in doc && 'created' in doc) {
    for (var i = 0; i < doc.links.length; i++) {
      emit(moment.unix(doc.created).toArray(),
          {
          url: doc.url,
          rel: doc.links[i].rel,
          href: doc.links[i].href
          });
    }
  }
}
