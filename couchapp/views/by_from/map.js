function(doc) {
  if ('links' in doc && 'from' in doc) {
    emit([doc.from, doc.rel, doc.url], (doc.method === 'LINK' ? 1 : -1));
  }
}
