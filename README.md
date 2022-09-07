# Siigo-Match-Battle

#Descripcion

Siigo Match Battle es un juego interactivo, en el cual pueden participar máximo 7 personas por partida; es similar a un juego de cartas tradicional
pero con temática de motocicletas.

##Funcionalidad 

Un usuario se registra e inicia sesión, posterior a esto crea una partida y el sistema le genera un código para que lo comparta a otros usuarios que
quieran participar; el tope máximo de jugadores en una partida es 7 y mínimo 2, la partida se inicia en cuanto el usuario que comparte el codigo de 
click sobre iniciar partida o cuando se llene el tope. 
Las cartas están numeradas con una combinación de números que van desde 1 a 4 y de la letra A hasta la H, según el número de 
participantes se reparten equitativamente las cartas disponibles y en caso de sobrar quedarán deshabilitadas; estas cartas continen 5 caracteríticas
cada una: cilindraje, año, torque, velocidad máxima y peso con las cuales el usuario puede escoger alguna de estas características para participar en la 
ronda de la partida. 
Los turnos se escogen de acuerdo al número de la carta, estas se ordenan en orden alfabetico y quien tenga la carta que se lista primero inicia, en este 
caso quien tenga la carta con el código 1A inicia la partida y escoge la característica con la cual va a participar en la ronda y el juego automáticamente 
escoge la primer carta maso de los otros participantes y compara quien tiene el número mayor en la característica escogida, quien tenga el valor más alto 
gana la ronda e inicia la siguiente ronda seleccionando la característica que desee. 
Gana quien le quite todas las cartas a sus oponentes; en caso de que uno solo se quede sin cartas, quedará como espectador hasta que termine la partida.
Cuando finalice la partida, el juego retorna un mensaje informando quien fue el ganador de la partida y una tabla de posiciones, posterior a esto
automáticamente se cierra la partida y el código de acceso expira; si se desea se crea una nueva partida, tendrá que crear un código nuevo y se invita otros 
participantes con el código que proporciona el juego. 

###Version 

La versión actual es 1.0, ya que es el primer prototipo que fue desarrollado.

####Autores 

Los desarrolladores encargados de diseñar e implementar este prototipo de juego son Alejandro Cubillos Contreras,quien se encuentra en github como AlejandroC26 y
James Santiago Ordoñez, quien se encuentra en github como jamesOrdonez, aprendices Sena del Tecnólogo en ADSI ID 2280204, regional Huila sede Yambotro - Pitalito. 
Fue desarrollado bajo los criterios de Senasoft 2022 en su 13° edicion.
