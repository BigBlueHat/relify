function(doc) {
  if ('links' in doc) {
    // gather rel names
    var rels = Object.keys(doc.links);
    // loop through rels
    for(var i = 0; i < rels.length; i++) {
      // loop through links associated with that rel
      for(var j = 0; j < doc.links[rels[i]].length; j++) {
        // emith each url => rel => link tripple (and who it's from)
        emit([doc.from, doc.url, rels[i], doc.links[rels[i]][j]],
             (doc.method === 'LINK' ? 1 : -1));
      }
    }
  }
}
