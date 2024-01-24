function generarCodigo() {
  // Obtener las 3 primeras letras del nombre
  var nombre = document.getElementById("nombre").value
  var tresPrimerasLetras = nombre.slice(0, 3).toUpperCase()

  // Generar 4 números aleatorios
  var cuatroNumerosAleatorios = Math.floor(1000 + Math.random() * 9000)

  // Combinar las letras y números con un guion
  var codigoGenerado = tresPrimerasLetras + "-" + cuatroNumerosAleatorios

  // Asignar el código generado al campo de entrada
  document.getElementById("codigo_acceso").value = codigoGenerado
}
