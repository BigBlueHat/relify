function(doc) {
  var moment = require('views/lib/moment');

  if ('links' in doc && 'created' in doc) {
    // gather rel names
    var rels = Object.keys(doc.links);
    // loop through rels
    for (var i = 0; i < rels.length; i++) {
      // loop through links associated with that rel
      for (var j = 0; j < doc.links[rels[i]].length; j++) {
        emit(moment.unix(doc.created).toArray(),
            {
            url: doc.url,
            rel: rels[i],
            href: doc.links[rels[i]][j]
            });
      }
    }
  }
}
