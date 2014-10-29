function(doc) {
  if ('links' in doc) {
    for (var i = 0; i < doc.links.length; i++) {
      emit([doc.links[i].rel, doc.links[i].href],
        (doc.method == 'LINK' ? 1 : -1));
    }
  }
}
