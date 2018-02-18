
var provincia_list = [
   {value: 'Azuay'},
   {value: 'Bolívar'},
   {value: 'Cañar'},
   {value: 'Carchi'},
   {value: 'Chimborazo'},
   {value: 'Cotopaxi'},
   {value: 'El Oro'},
   {value: 'Esmeraldas'},
   {value: 'Galápagos'},
   {value: 'Guayas'},
   {value: 'Imbabura'},
   {value: 'Loja'},
   {value: 'Los Ríos'},
   {value: 'Manabí'},
   {value: 'Morona Santiago'},
   {value: 'Napo'},
   {value: 'Orellana'},
   {value: 'Pastaza'},
   {value: 'Pichincha'},
   {value: 'Santa Elena'},
   {value: 'Santo Domingo de los Tsáchilas'},
   {value: 'Sucumbíos'},
   {value: 'Tungurahua'},
   {value: 'Zamora Chinchipe'},   
];

$(document).ready(function() {
   $("#ac_provincia, #ac_provincia2").autocomplete({
      lookup: provincia_list,
   });
});
