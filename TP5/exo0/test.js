function map(f,collection) {
    var result = []; // un tableau new Array();
   
    for (var i = 0; i < collection.length; i++)
    result[i] = f(collection[i]);
    return result;
   }

map( function(x){return x * x * x}, [0, 1, 2, 5, 10]);