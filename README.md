# Buscador-Wikipedia

Este buscador permite encontrar y listar una cantidad a elegir de artículos de Wikipedia en idiomas Español, Inglés, Francés, Portugués e Italiano y los resultados pueden ser ordenados por relevancia, fecha de última edición ascendente, fecha de última edición descendente, tamaño de página ascendente, tamaño de página descendente y ninguno.


## Autor
|<img src="https://user-images.githubusercontent.com/63131135/187343349-bee2fc8d-87ad-4eff-9f3d-303994341125.png" width=200px>|
|:---:|
|Edgar Sabido <br> [@EdgarSabidoC](https://github.com/EdgarSabidoC)|


## Apariencia del buscador
<img src="https://user-images.githubusercontent.com/63131135/187785902-259b9bcf-1a7d-4ea5-b636-f27d02a3b730.png">


## Ejemplo del JSON obtenido como respuesta de la API de Wikipedia Search:
{"batchcomplete":"","continue":{"sroffset":10,"continue":"-||"},"query":{"searchinfo":{"totalhits":1844},"search":[{"ns":0,"title":"Hola mundo","pageid":50712,"snippet":"En informática, Hola mundo es un programa que muestra el texto «¡Hola, mundo!» en un dispositivo de visualización, en la mayoría de los casos la pantalla"},{"ns":0,"title":"Hola","pageid":2586606,"snippet":"un pueblo de Kenia; ¡Hola!, una revista española; Hola Airlines, una aerolínea española con base en Palma de Mallorca; Hola mundo, un programa informático"},{"ns":0,"title":"¡Hola!","pageid":666084,"snippet":"¡Hola! es una revista semanal en España especializada en noticias de celebridades, publicada en Madrid, España y en otros 15 países, con ediciones locales"},{"ns":0,"title":"Hola mundo (álbum de Tan Biónica)","pageid":6874946,"snippet":"Hola Mundo es el cuarto y último álbum de estudio de la banda argentina Tan Biónica, sin contar Wonderful noches (el cual es un EP). Fue lanzado el 18"},{"ns":0,"title":"Hola a Todo el Mundo","pageid":4970117,"snippet":"Hola a Todo el Mundo (en adelante HATEM) es un grupo de música de estilo folk, pop y alternativo que surge en Madrid en la primavera de 2006. Tomando prestado"},{"ns":0,"title":"La vuelta al mundo 360° Experience","pageid":10001071,"snippet":"cual tuvo como objetivo promover su cuarto y último álbum de estudio Hola Mundo, lanzado en mayo de 2015. La banda tenía programadas las fechas del 13"},{"ns":0,"title":"¡Hola! TV","pageid":7998828,"snippet":"¡Hola! TV es un canal de televisión por suscripción latinoamericano de origen español, el cual está dirigido al público femenino. Fue lanzado en 2013 y"},{"ns":0,"title":"Simula","pageid":45503,"snippet":"famoso programa "Hola Mundo" en Simula 67: ! esto es un comentario ; Begin comment aquí comienza el programa ; OutText("¡Hola Mundo!"); OutImage; End"},{"ns":0,"title":"PureBasic","pageid":98256,"snippet":"mensaje...: En Visual Basic: MsgBox "HOLA", vbOKOnly, "Hola, Mundo" En PureBasic: MessageRequester("HOLA", "Hola, mundo",#PB_MessageRequester_Ok) Página oficial"},{"ns":0,"title":"Boo (lenguaje de programación)","pageid":180119,"snippet":"MIT/BSD. Boo se integra sin fisuras con Microsoft.NET y Mono. print "Hola Mundo" def fib(): a as long, b as long = 0, 1 while true: yield b a, b = b,"}]}}


### Ejemplo de enlace a un artículo específico de Wikipedia:
Link: http://en.wikipedia.org/?curid=5043734
